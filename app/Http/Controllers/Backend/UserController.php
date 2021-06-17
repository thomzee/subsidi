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

class UserController extends Controller
{
    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = 'User';
        $this->slug = $this->slugs['backend'].'user';
        $this->route = $this->routes['backend'].'user';
        $this->view = $this->views['backend'].'.users';
        $this->share();

        $this->model = new User();
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
                ->editColumn('status', function ($data) {
                    $check = '';
                    if ($data->status == 1) {
                        $check = 'checked';
                    }
                    $isDisabled = 'disabled';
                    if (check_access('status', $this->slug)) {
                        $isDisabled = '';
                    }
                    return '<input ' . $isDisabled . ' type="checkbox" ' . $check . ' class="bs-toggle change-status" data-id="' . $data->id . '" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">';
                })
                ->addColumn('role', function ($data) {
                    return $data->roles()->first()->name;
                })
                ->rawColumns(['action', 'status'])
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
            $roles = Role::all();
            return view($this->view.'.create', compact('roles'));
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
            $data->password = bcrypt($request->password);
            $data->username = $request->username;
            if ($request->has('status')) {
                $data->status = 1;
            } else {
                $data->status = 0;
            }
            $data->save();

            $role = Role::findOrFail($request->role);
            $data->roles()->sync($role, [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
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
            $roles = Role::all();
            $data = $this->model->findOrFail($id);
            return view($this->view.'.detail', compact('data', 'roles'));
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
            $roles = Role::all();
            $data = $this->model->findOrFail($id);
            return view($this->view.'.edit', compact('data', 'roles'));
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
            $data->username = $request->username;
            if ($request->password) {
                $data->password = $request->password;
            }
            if ($request->has('status')) {
                $data->status = 1;
            } else {
                $data->status = 0;
            }
            $data->save();

            $role = Role::findOrFail($request->role);
            $data->roles()->sync($role, [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
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
            $roles = Role::all();
            $data = $this->model->findOrFail($id);
            return view($this->view.'.delete', compact('data', 'roles'));
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
            $data->roles()->detach();
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

    public function changeStatus(Request $request) {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false
                ], 422);
            }
            $status = 1;
            $data = $this->model->findOrFail($request->id);
            if ($data->status == 1) {
                $status = 0;
            }
            $data->update([
                'status' => $status
            ]);
            DB::commit();
            return response()->json([
                'success' => true
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false
            ], 500);
        }
    }
}
