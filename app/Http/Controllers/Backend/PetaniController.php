<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Image;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PetaniController extends Controller
{
    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = 'Kelompok Tani';
        $this->slug = $this->slugs['backend'].'kelompok-tani';
        $this->route = $this->routes['backend'].'kelompok-tani';
        $this->view = $this->views['backend'].'.kelompok_tani';
        $this->share();

        $this->model = new Category();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->view.'.index');
    }

    public function datatables()
    {
        try {
            $data = numrows($this->model->get());
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $action = null;
                    if (check_access('detail', $this->slug)) {
                        $action .= '<a href="' . route($this->route . '.detail', $data->id) . '" class="btn-action btn btn-xs btn-success" title="' . __('label.detail') . '">' . __('icon.detail') .'</a>';
                    }
                    if (check_access('edit', $this->slug) && !$data->is_default) {
                        $action .= '<a href="' . route($this->route . '.edit', $data->id) . '" class="btn-action btn btn-xs btn-primary" title="' . __('label.edit') . '">' . __('icon.edit') .'</a>';
                    }
                    if (check_access('delete', $this->slug) && !$data->is_default) {
                        $action .= '<a href="' . route($this->route . '.delete', $data->id) . '" class="btn-action btn btn-xs btn-danger" title="' . __('label.delete') . '">' . __('icon.delete') .'</a>';
                    }
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return response()->json($e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view($this->view.'.create');
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route($this->route.'.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->route($this->route.'.create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $this->model;
            $data->name = $request->name;
            $data->save();
            DB::commit();
            flash()->success(__('message.data_stored'));
            return redirect()->route($this->route.'.index');
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
            return redirect()->route($this->route.'.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        try {
            $data = $this->model->findOrFail($id);
            return view($this->view.'.detail', compact('data'));
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route($this->route.'.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = $this->model->findOrFail($id);
            return view($this->view.'.edit', compact('data'));
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route($this->route.'.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->route($this->route.'.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $this->model->findOrFail($id);
            $data->name = $request->name;
            $data->save();
            DB::commit();
            flash()->success(__('message.data_updated'));
            return redirect()->route($this->route.'.index');
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
            return redirect()->route($this->route.'.index');
        }
    }

    /**
     * Display the specified resource that will be deleted.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $data = $this->model->findOrFail($id);
            return view($this->view.'.delete', compact('data'));
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route($this->route.'.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = $this->model->findOrFail($id);
            $data->delete();
            DB::commit();
            flash()->success(__('message.data_deleted'));
            return redirect()->route($this->route.'.index');
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
            return redirect()->route($this->route.'.index');
        }
    }
}
