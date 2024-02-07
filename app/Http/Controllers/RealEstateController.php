<?php

namespace App\Http\Controllers;

use Exception;
use App\Facades\Alert;
use App\Models\Location;
use App\Models\MasterOptions;
use App\Models\RealEstate;
use App\Models\ResourceFile;
use App\Types\MasterOptionsType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class RealEstateController extends Controller {

    /**
     * @param Request $request
     * @return array|Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request) {

        /**
         * We capture the data sent by POST to register the user.
         */
        if ($request->isMethod('POST')) {
            $start = (int)$request->get('start', 1);
            $length = (int)$request->get('length', 10);
            $page = ($start / $length) + 1;
            $data = RealEstate::query()->whereNot('status', RealEstate::STATUS_IN_CREATION)->paginate(perPage: $length, page: $page);
            return [
                'data' => $data->collect()->map(function (RealEstate $item) {
                    return [
                        'id' => $item->id,
                        'uuid' => $item->uuid,
                        'code' => $item->code,
                        'type' => $item->type->value,
                        'action' => $item->action?->value,
                        'action_id' => $item->action_id,
                        'unit' => $item->unit?->name,
                        'rental_value' => $item->rental_value,
                        'sale_value' => $item->sale_value,
                        'location' => $item->location?->toArray(),
                        'images' => $item->getImages(ResourceFile::IMG_SIZE_SMALL),
                        'bedrooms' => $item->bedrooms,
                        'bathrooms' => $item->bathrooms,
                        'status' => $item->status
                    ];
                })->toArray(),
                "recordsTotal" => $data->total(),
                "recordsFiltered" => $data->total(),
            ];
        }

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

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function update(RealEstate $model) {
        $Options = MasterOptions::getDataFormSelect([
            MasterOptionsType::TYPE_REAL_ESTATE,
            MasterOptionsType::TYPE_REAL_ESTATE_ACTION,
            MasterOptionsType::TYPE_SPECIFICATIONS
        ]);
        $Options[Location::TYPE_LOCATION_OPTIONS] = Location::getDataFormSelect();
        $newCode = RealEstate::getLastCode();
        return view('real-estate.update', compact('Options', 'model'));
    }

    /**
     * @param Request $request
     * @param RealEstate|null $model
     * @return RedirectResponse
     */
    public function store(Request $request, RealEstate $model = null) {

        /**
         * Preparation vars
         */
        if (is_null($model)) $model = new RealEstate();

        /**
         * We update the base properties of the model.
         */
        $model->loadFillable($request->only($model->getFillable()));

        DB::beginTransaction(); // Start transaction

        $status = $model->save() ?? false; // Saved the primary information

        /**
         * we save images
         */
        if ($status) $status = $this->saveImages($request, $model);

        if ($status) DB::commit();
        else DB::rollBack();

        if ($status) Alert::tSuccess('messages.success.model-update');
        return redirect()->route('real-estate.index');

    }

    /**
     * @param Request $request
     * @param RealEstate $model
     * @return bool
     */
    protected function saveImages(Request $request, RealEstate $model): bool {

        /**
         * Definitions of variables
         */
        $status = true;

        $ImagePrimary = $request->allFiles()['image_primary'] ?? null;
        if ($ImagePrimary) {
            $FileName = sprintf('%s_%s.jpg', \Str::uuid(), $model->id);
            $IMGs = ResourceFile::saveNewImage($ImagePrimary, $FileName);
            if ($status = count($IMGs) > 0) {
                $model->image_primary = $FileName;
                $model->save();
            }
        }

        /**
         * We save the images
         * @var UploadedFile[] $Images
         */
        $Images = $request->allFiles()['images'] ?? [];
        $ImagesOld = $request->get('images_old', []);
        $ImagesOldSaved = ResourceFile::query()
            ->where('entity', RealEstate::class)
            ->where('entity_id', $model->id)
            ->get()->collect()->map(fn(ResourceFile $x) => $x->path)
            ->toArray();

        /**
         * We look for the differences to eliminate temporary images
         */
        $images_old_diff = array_diff($ImagesOldSaved, $ImagesOld);
        if (!empty($images_old_diff)) {
            foreach ($images_old_diff as $FileName) ResourceFile::removeImage($FileName);
            ResourceFile::query()->where(['entity' => RealEstate::class, 'entity_id' => $model->id])
                ->whereIn('path', array_values($images_old_diff))
                ->delete();
        }

        if (!empty($Images)) {
            $NewImages = [];
            foreach ($Images as $Image) {
                if ($status) {
                    try {
                        $FileName = sprintf('%s_%s.jpg', \Str::uuid(), $model->id);
                        $IMGs = ResourceFile::saveNewImage($Image, $FileName);
                        if ($status = count($IMGs) > 0) $NewImages[] = $FileName;
                    } catch (Exception $e) {
                        if (env('APP_ENV', 'dev') == 'dev') dd($e);
                        Alert::tError('messages.errors.model-saved');
                        $status = false;
                    }
                }
            }

            // we save the metadata to model
            $ImgForToSave = array_unique(array_values([...$ImagesOld, ...$NewImages]));
            foreach ($ImgForToSave as $k => $image) {
                ResourceFile::query()->updateOrCreate([
                    'entity' => RealEstate::class,
                    'entity_id' => $model->id,
                    'path' => $image,
                ], [
                    'entity' => RealEstate::class,
                    'entity_id' => $model->id,
                    'type' => ResourceFile::TYPE_IMAGE,
                    'path' => $image,
                    'order' => $k + 1
                ]);
            }
        }

        return $status;
    }

}
