<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BladeViewController extends Controller {

    public function marcas(): Factory|View|Application {
        return view( 'admin.marcas' );
    }

    public function categorias(): Factory|View|Application {
        return view( 'admin.categorias' );
    }

    public function modelos(): Factory|View|Application {
        return view( 'admin.modelos' );
    }

    public function productos(): Factory|View|Application {
        return view( 'admin.productos' );
    }

    public function tamanos(): Factory|View|Application {
        return view( 'admin.tamanos' );
    }

}
