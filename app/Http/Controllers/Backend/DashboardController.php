<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Petani;
use App\Models\PetaniMt;
use App\Services\SettingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = 'Dashboard';
        $this->slug = $this->slugs['backend'].'dashboard';
        $this->route = $this->routes['backend'].'dashboard';
        $this->view = $this->views['backend'].'.dashboard';
        $this->share();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view($this->view.'.index');
    }

    public function search(Request $request)
    {
        try {
            $keyword = $request->has('keyword') ? strtolower($request->input('keyword')) : null;
            $data = Petani::where(DB::raw('LOWER(nama)'), 'like', '%' . $keyword . '%')
                ->orWhere(DB::raw('LOWER(nik)'), 'like', '%' . $keyword . '%')
                ->orWhere(DB::raw('LOWER(kelompok)'), 'like', '%' . $keyword . '%')
                ->get()->toArray();
            return response()->json($data, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(null, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function selectPetani(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'petani_id' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['data' => null, 'quota' => null, 'penebusan' => null, 'sisa' => null], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            $data = Petani::query()->findOrFail($request->petani_id);
            $quota = $data->petaniMt()->groupBy('produk')
                ->selectRaw('sum(qty) as sum, produk')
                ->where('tahun', SettingService::currentTahun())
                ->where('mt', SettingService::currentMt())
                ->pluck('sum','produk');
            $penebusan = $data->petaniMt()->groupBy('produk')
                ->selectRaw('sum(qty_beli) as sum, produk')
                ->where('tahun', SettingService::currentTahun())
                ->where('mt', SettingService::currentMt())
                ->pluck('sum','produk');
            $sisa = $data->petaniMt()->groupBy('produk')
                ->selectRaw('(sum(qty) - sum(qty_beli)) as sum, produk')
                ->where('tahun', SettingService::currentTahun())
                ->where('mt', SettingService::currentMt())
                ->pluck('sum','produk');
            return response()->json(['data' => $data, 'quota' => $quota, 'penebusan' => $penebusan, 'sisa' => $sisa], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['data' => null, 'quota' => null, 'penebusan' => null, 'sisa' => null], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'petani_id' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->route($this->route.'.create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $petani = Petani::query()->where('id', $request->petani_id)->firstOrFail();
            $products = $request->only(array_keys(config('settings.produk')));
            foreach ($products as $product => $qty) {
                if ($qty > 0) {
                    $petani->petaniMt()->create([
                        'qty' => null,
                        'produk' => $product,
                        'mt' => SettingService::currentMt(),
                        'tahun' => SettingService::currentTahun(),
                        'qty_beli' => $qty,
                        'type' => 'orders'
                    ]);
                }
            }
            DB::commit();
            flash()->success(__('message.data_stored'));
            return redirect()->route($this->route.'.index');
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
            return redirect()->route($this->route.'.index');
        }
    }
}
