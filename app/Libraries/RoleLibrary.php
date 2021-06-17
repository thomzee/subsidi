<?php


namespace App\Libraries;


use App\Models\Menu;

class RoleLibrary
{
    public static function generate($roleId = null, $action = null)
    {
        $menuModel = new Menu();
        $menus = $menuModel->whereNull('parent_id')->with('children')->get();

        $menuRoles = '<ul style="list-style: none;">';
        foreach ($menus as $menu) {
            if ($menu->slug && $menu->children) {
                $menuRoles .= '<div class="row">';
                $menuRoles .= '<div class="col-md-4">';
                $menuRoles .= $menu->name;
                $menuRoles .= '</div>';
                $menuRoles .= '<div class="col-md-8">';
                $menuRoles .= '<div class="accesses row">';
                $menuRole = $menu->roleMenus->where('role_id', $roleId)->first();

                $accesses = config('access.menu.'.$menu->slug.'.action');
                foreach ($accesses as $access) {
                    $checked = '';
                    $disabled = '';
                    if ($action && $action == 'show') $disabled = 'disabled';
                    !$menuRole || !in_array($access, explode(config('access.delimiter'), $menuRole->accesses)) || !$action ?: $checked = 'checked';
                    $menuRoles .= '<label class="col-md-2">'.$access. ' ' .'<input type="checkbox" name="accesses['.$menu->id.'][]" value="'.$access.'" '.$checked.' '.$disabled.'></label>';
                }

                $menuRoles .= '</div>';
                $menuRoles .= '</div>';
                $menuRoles .= '</div>';
            }else {
                $menuRoles .= $menu->name;
                $menuRoles .= '<li>';
                $menuRoles .= '<ul style="list-style: none;">';
                foreach ($menu->children as $child) {
                    $menuRoles .= '<li>';
                    $menuRoles .= '<div class="row">';
                    $menuRoles .= '<div class="col-md-4">';
                    $menuRoles .= $child->name;
                    $menuRoles .= '</div>';
                    $menuRoles .= '<div class="col-md-8">';
                    $menuRoles .= '<div class="accesses row">';
                    $menuRole = $child->roleMenus->where('role_id', $roleId)->first();

                    $accesses = config('access.menu.'.$child->slug.'.action');
                    foreach ($accesses as $access) {
                        $checked = '';
                        $disabled = '';
                        if ($action && $action == 'show') $disabled = 'disabled';
                        !$menuRole || !in_array($access, explode(config('access.delimiter'), $menuRole->accesses)) || !$action ?: $checked = 'checked';
                        $menuRoles .= '<label class="col-md-2">'.$access. ' ' .'<input type="checkbox" name="accesses['.$child->id.'][]" value="'.$access.'" '.$checked.' '.$disabled.'></label>';
                    }

                    $menuRoles .= '</div>';
                    $menuRoles .= '</div>';
                    $menuRoles .= '</div>';
                    $menuRoles .= '<hr>';
                    $menuRoles .= '</li>';
                }
                $menuRoles .= '</ul>';
                $menuRoles .= '</li>';
            }
        }
        $menuRoles .= '</ul>';

        return $menuRoles;
    }
}
