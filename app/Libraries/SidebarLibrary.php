<?php


namespace App\Libraries;


use App\Models\Menu;

class SidebarLibrary
{
    public function generate($active = null)
    {
        $menuModel = new Menu();
        $menus = $menuModel->whereNull('parent_id')->with('children')->get();

        $sidebar = '';
        foreach ($menus as $menu) {

            if(sizeof($menu->children) > 0) {
                $childrenAccesses = false;
                foreach ($menu->children as $child) {
                    if (check_access('index', $child->slug)) {
                        $childrenAccesses = true;
                    }
                }

                if ($childrenAccesses) {
                    $childrenSlugs = $menu->children()->get()->pluck('slug')->toArray();

                    if ($active && in_array($active, $childrenSlugs)) {
                        $sidebar .= '<li class="nav-item active">';
                    } else {
                        $sidebar .= '<li class="nav-item">';
                    }
                    $sidebar .= '<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse-'.$menu->id.'" aria-expanded="true" aria-controls="collapse-'.$menu->slug.'">';
                    $sidebar .= '<i class="fas fa-fw '.$menu->icon.'"></i>';
                    $sidebar .= '<span>'.$menu->name.'</span>';
                    $sidebar .= '</a>';
                    if ($active && in_array($active, $childrenSlugs)) {
                        $sidebar .= '<div id="collapse-'.$menu->id.'" class="collapse show" aria-labelledby="heading-'.$menu->id.'" data-parent="#accordionSidebar">';
                    } else {
                        $sidebar .= '<div id="collapse-'.$menu->id.'" class="collapse" aria-labelledby="heading-'.$menu->id.'" data-parent="#accordionSidebar">';
                    }
                    $sidebar .= '<div class="bg-white py-2 collapse-inner rounded">';
                    foreach ($menu->children as $child) {
                        if (check_access('index', $child->slug)) {
                            if ($active && $active == $child->slug) {
                                $sidebar .= '<a class="collapse-item active" href="'.url($child->slug).'">'.$child->name.'</a>';
                            } else {
                                $sidebar .= '<a class="collapse-item" href="'.url($child->slug).'">'.$child->name.'</a>';
                            }
                        }
                    }
                    $sidebar .= '</div>';
                    $sidebar .= '</div>';
                    $sidebar .= '</li>';
                }
            } else {
                if (check_access('index', $menu->slug)) {
                    if ($active && $active == $menu->slug) {
                        $sidebar .= '<li class="nav-item active">';
                    } else {
                        $sidebar .= '<li class="nav-item">';
                    }
                    $slug = 'javascript:void(0);';
                    if ($menu->slug) {
                        $slug = $menu->slug;
                    }
                    $sidebar .= '<a class="nav-link" href="'.url($slug).'">';
                    $sidebar .= '<i class="fas fa-fw '.$menu->icon.'"></i>';
                    $sidebar .= '<span>'.$menu->name.'</span></a>';
                    $sidebar .= '</li>';
                }
            }
        }

        return $sidebar;
    }
}
