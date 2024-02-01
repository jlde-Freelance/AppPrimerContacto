<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MasterOptions;
use App\Models\RealEstate;
use App\Types\MasterOptionsType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class RealEstateController extends Controller {
    public function index() {
        confirmDelete(__('messages.confirm.title'), __('messages.confirm.delete-item'));
        return view('real-estate.index');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create() {

        $Options = MasterOptions::getDataFormSelect([
            MasterOptionsType::TYPE_REAL_ESTATE,
            MasterOptionsType::TYPE_REAL_ESTATE_ACTION,
            MasterOptionsType::TYPE_SPECIFICATIONS
        ]);
        $Options[Location::TYPE_LOCATION_OPTIONS] = Location::getDataFormSelect();
        $newCode = RealEstate::getLastCode();

        return view('real-estate.create', compact('Options', 'newCode'));
    }

}
