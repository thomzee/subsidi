<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $menu;
    public $route;
    public $slug;
    public $view;

    public $slugs = [
        'backend' => 'backend/',
        'frontend' => 'frontend/',
    ];
    public $views = [
        'backend' => 'backend',
        'frontend' => 'frontend'
    ];
    public $routes = [
        'backend' => 'backend::',
        'frontend' => 'frontend::'
    ];

    public function share()
    {
        view()->share([
            'menu'  => $this->menu,
            'route' => $this->route,
            'slug'  => $this->slug,
            'view'  => $this->view,

            'routes' => $this->routes,
            'slugs'  => $this->slugs,
            'views'  => $this->views,
        ]);
    }
}
