<?php

namespace App\Http\Controllers;

use App\Facades\Alert;
use App\Http\Requests\ResidentialUnitsRequest;
use App\Models\MasterOptions;
use App\Models\ResidentialUnits;
use App\Types\MasterOptionsType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ResidentialUnitsController extends Controller {

    /**
     * @param Request $request
     * @return array|Application|Factory|View
     */
    public function index(Request $request) {

        /**
         * We capture the data sent by POST to register the user.
         */
        if ($request->isMethod('POST')) {
            $start = (int)$request->get('start');
            $length = (int)$request->get('length');
            $search = (string)$request->get('search', false);
            $page = ($start / $length) + 1;
            $data = ResidentialUnits::query();
            if (!empty($search)) $data = $data->where('name', 'like', sprintf('%%%s%%', $search));
            $data = $data->paginate(perPage: $length, page: $page);

            return [
                'data' => $data->collect()->map(function (ResidentialUnits $item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'address' => $item->address,
                        'status' => $item->status
                    ];
                })->toArray(),
                "recordsTotal" => $data->total(),
                "recordsFiltered" => $data->total(),
            ];
        }

        confirmDelete(__('messages.confirm.title'), __('messages.confirm.delete-item'));
        return view('residential-units.index');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create() {
        $Options = MasterOptions::getDataFormSelect([MasterOptionsType::TYPE_STRATUM, MasterOptionsType::TYPE_SPECIFICATIONS]);
        return view('residential-units.create', compact('Options'));
    }

    /**
     * @param ResidentialUnits $model
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function update(ResidentialUnits $model) {
        $Options = MasterOptions::getDataFormSelect([MasterOptionsType::TYPE_STRATUM, MasterOptionsType::TYPE_SPECIFICATIONS]);
        return view('residential-units.update', compact('Options', 'model'));
    }

    /**
     * @param ResidentialUnitsRequest $request
     * @param ResidentialUnits|null $model
     * @return RedirectResponse
     */
    public function store(ResidentialUnitsRequest $request, ResidentialUnits $model = null) {
        if (empty($model)) {
            $model = ResidentialUnits::create($request->validated());
            if (!$model->wasRecentlyCreated) throw ValidationException::withMessages(['default' => __('messages.errors.model-saved')]);
        } else {
            $model->update($request->validated());
        }
        return redirect()->route('residential-units.index');
    }

    /**
     * @param ResidentialUnits $model
     * @return RedirectResponse
     */
    public function destroy(ResidentialUnits $model) {
        $model->forceDelete();
        Alert::tSuccess('messages.success.model-destroy');
        return redirect()->route('residential-units.index');
    }

}
