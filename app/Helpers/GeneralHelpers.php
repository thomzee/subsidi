<?php

if (! function_exists('check_access')) {
    function check_access($action, $slug = null)
    {
        $return = false;

        $slug = empty($slug) ? request()->path() : $slug ;
        $menu = (new \App\Models\Menu)->where('slug', $slug)->first();
        $accesses = [];

        if ($menu) {
            $roleIds = \Illuminate\Support\Arr::flatten(auth()->user()->userRoles()->select('role_id')->get()->toArray());
            foreach ($menu->roleMenus()->whereIn('role_id', $roleIds)->get() as $roleMenu) {
                $accesses[] = explode(config('access.delimiter'), $roleMenu->accesses);
            }
        }

        if (in_array($action, \Illuminate\Support\Arr::collapse($accesses))) {
            $return = true;
        }

        return $return;
    }
}

if (!function_exists('numrows')) {
    function numrows($data, $index = 1, $name = 'no')
    {
        if (is_object($data)) {
            foreach ($data as $key => $value) {
                $value->{$name} = $index;
                $index++;
            }
        } else
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $data[$key][$name] = $index;
                    $index++;
                }
            }
        return $data;
    }
}

if (!function_exists('authRole')) {
    function authRole()
    {
        return auth()->user()->roles()->firstOrFail();
    }
}
