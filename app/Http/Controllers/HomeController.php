<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller {

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function __invoke() {
        return view('dashboard');
    }

}
