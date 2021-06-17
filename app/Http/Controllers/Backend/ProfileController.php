<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\PasswordRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = 'Profile';
        $this->slug = $this->slugs['backend'].'profile';
        $this->route = $this->routes['backend'].'profile';
        $this->view = $this->views['backend'].'.profiles';
        $this->share();

        $this->model = new User();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->model->findOrFail(auth()->user()->id);
            return view($this->view . '.edit', compact('data'));
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route($this->routes['backend'] . 'dashboard.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $data = $this->model->findOrFail(auth()->user()->id);
            $data->name = $request->name;
            $data->username = $request->username;
            $data->save();

            flash()->success(__('message.data_updated'));
            return redirect()->route($this->route.'.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route($this->route.'.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function password(PasswordRequest $request)
    {
        try {
            $data = $this->model->findOrFail(auth()->user()->id);
            if(!Hash::check($request->password_old, $data->password)) {
                throw new \Exception(__('auth.failed'));
            }
            $data->password = Hash::make($request->password);
            $data->save();

            flash()->success(__('message.data_updated'));
            return redirect()->route($this->route.'.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route($this->route.'.index');
        }
    }
}
