<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Libraries\RoleLibrary;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    private $model;
    private $roleLibrary;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = 'Role';
        $this->slug = $this->slugs['backend'].'role';
        $this->route = $this->routes['backend'].'role';
        $this->view = $this->views['backend'].'.roles';
        $this->share();

        $this->model = new Role();
        $this->roleLibrary = new RoleLibrary();
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
                    if (check_access('edit', $this->slug)) {
                        $action .= '<a href="' . route($this->route . '.edit', $data->id) . '" class="btn-action btn btn-xs btn-primary" title="' . __('label.edit') . '">' . __('icon.edit') .'</a>';
                    }
//                    if (check_access('delete', $this->slug)) {
//                        $action .= '<a href="' . route($this->route . '.delete', $data->id) . '" class="btn-action btn btn-xs btn-danger" title="' . __('label.delete') . '">' . __('icon.delete') .'</a>';
//                    }
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
            $menuRoles = $this->roleLibrary->generate();
            return view($this->view.'.create', compact('menuRoles'));
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
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $this->model;
            $data->name = $request->name;
            $data->slug = Str::slug($request->name);
            $data->save();

            foreach ($request->accesses as $key => $access) {
                $data->menus()->attach([
                    $key => ['accesses' => implode(config('access.delimiter'), $access)]
                ]);
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
            $menuRoles = $this->roleLibrary->generate($id, 'show');
            return view($this->view.'.detail', compact('data', 'menuRoles'));
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
            $menuRoles = $this->roleLibrary->generate($id, 'edit');
            return view($this->view.'.edit', compact('data', 'menuRoles'));
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
    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $this->model->findOrFail($id);
            $data->name = $request->name;
            $data->slug = Str::slug($request->name);
            $data->save();

            $data->menus()->detach();
            foreach ($request->accesses as $key => $access) {
                $data->menus()->attach([
                    $key => ['accesses' => implode(config('access.delimiter'), $access)]
                ]);
            }
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
            $menuRoles = $this->roleLibrary->generate($id, 'show');
            return view($this->view.'.delete', compact('data', 'menuRoles'));
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
        try {
            $data = $this->model->findOrFail($id);
            $data->menus()->detach();
            $data->delete();
            flash()->success(__('message.data_deleted'));
            return redirect()->route($this->route.'.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route($this->route.'.index');
        }
    }
}
