<?php

namespace App\Models;

use App\Casts\Currency;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $uuid
 * @property string $code
 * @property int $type_id
 * @property MasterOptions $type
 * @property int $action_id
 * @property MasterOptions $action
 * @property int $unit_id
 * @property ResidentialUnits $unit
 * @property int $location_id
 * @property Location $location
 * @property float $rental_value
 * @property float $sale_value
 * @property string $image_primary
 * @property string $description
 * @property int $status
 * @property string $address
 * @property string $neighborhood
 * @property string $latitude
 * @property string $longitude
 * @property string $house_level
 * @property string $apartment_level
 * @property string $bedrooms
 * @property string $bathrooms
 * @property string $parking
 * @property string $total_area
 * @property string $built_area
 * @property string $apartment_area
 * @property string $year_of_remodeling
 * @property string $administration
 * @property User $created_by
 * @property User $updated_by
 * @property array $specifications
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class RealEstate extends ModelBase {

    use SoftDeletes;

    public const  STATUS_INACTIVE = 0;
    public const  STATUS_ACTIVE = 1;

    /**
     * Variables de caché
     */

    private array|null $cache_image = null;
    private array|null $cache_images = null;
    private array|null $cache_specifications = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "code",
        "type_id",
        "action_id",
        "unit_id",
        "location_id",
        "rental_value",
        "sale_value",
        "description",
        "status",
        "address",
        "neighborhood",
        "latitude",
        "longitude",
        "house_level",
        "apartment_level",
        "bedrooms",
        "bathrooms",
        "parking",
        "total_area",
        "built_area",
        "apartment_area",
        "year_of_remodeling",
        "administration",

        "specifications"
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     * @var array<string, string>
     */
    protected $casts = [
        'rental_value' => Currency::class,
        'sale_value' => Currency::class,
        'administration' => Currency::class,
        'specifications' => 'array',
    ];

    protected static function boot(): void {
        // Boot other traits on the Model
        parent::boot();

        /**
         * Listen for the creating event on the user model.
         * Sets the 'id' to a UUID using Str::uuid() on the instance being created
         */
        static::creating(function (RealEstate $model) {
            if ($model->getAttribute('uuid') === null) {
                $model->setAttribute('uuid', \Str::uuid()->toString());
            }
        });
    }


    /**
     * @return HasOne
     */
    public function type(): HasOne {
        return $this->hasOne(MasterOptions::class, 'id', 'type_id');
    }

    /**
     * @return HasOne
     */
    public function action(): HasOne {
        return $this->hasOne(MasterOptions::class, 'id', 'action_id');
    }

    /**
     * @return HasOne
     */
    public function unit(): HasOne {
        return $this->hasOne(ResidentialUnits::class, 'id', 'unit_id')->withTrashed();
    }

    /**
     * @return HasOne
     */
    public function location(): HasOne {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    /**
     * @return HasMany
     */
    public function resourceFile(): HasMany {
        return $this->hasMany(ResourceFile::class, 'entity_id', 'id')->where('entity', RealEstate::class);
    }


    /**
     * @return string
     */
    public static function getLastCode(): string {
        $lastCode = (int)(self::withTrashed()->orderByDesc('id')->value('code') ?? 0) + 1;
        return str_pad($lastCode, 5, '0', STR_PAD_LEFT);
    }

    public static function findByUUID($uuid) {
        return RealEstate::where('uuid', $uuid)->firstOrFail();
    }

    /**
     * @return MasterOptions[]|null
     */
    public function getSpecificationsDetail(): ?array {
        if ($this->cache_specifications) return $this->cache_specifications;
        if ($this->specifications) {
            $this->cache_specifications = MasterOptions::getOptionsInArray($this->specifications)->get()->all();
            return $this->cache_specifications;
        }
        return [];
    }


    /**
     * @param $size
     * @return array|mixed
     */
    public function getImagePrimary($size = null): mixed {
        if ($this->cache_image) return $size ? $this->cache_image[$size] : $this->cache_image;
        $this->cache_image = null;
        if ($this->image_primary) {
            $SIZES = ResourceFile::getSizes();
            foreach ($SIZES as $key => $value) {
                $this->cache_image[$key] = asset("images/$key/$this->image_primary");
            }
        } elseif ($_images = $this->getImages()) {
            foreach ($_images as $key => $value) {
                $this->cache_image[$key] = current($value);
            }
        } else {
            $SIZES = ResourceFile::getSizes();
            foreach ($SIZES as $key => $value) {
                $this->cache_image[$key] = asset('img/default_image.jpg');
            }
        }
        return ($size && $this->cache_image) ? $this->cache_image[$size] : $this->cache_image;
    }

    /**
     * @param ResourceFile::IMG_SIZE_MEDIUM $size
     * @return array|mixed
     */
    public function getImages($size = null): mixed {
        if ($this->cache_images) return $size ? $this->cache_images[$size] : $this->cache_images;
        $ResourceFilesPath = ResourceFile::query()
            ->where('entity', RealEstate::class)
            ->where('entity_id', $this->id)
            ->get()->collect()->map(fn(ResourceFile $x) => $x->path)
            ->toArray();
        if ($ResourceFilesPath) {
            $this->cache_images = [];
            $SIZES = ResourceFile::getSizes();
            foreach ($ResourceFilesPath as $Path) {
                foreach ($SIZES as $key => $value) {
                    $this->cache_images[$key][] = asset("images/$key/$Path");
                }
            }
            return ($size && $this->cache_images) ? $this->cache_images[$size] : $this->cache_images;
        }
        return [];
    }

    /**
     * @return void
     */
    public function deleteAllImages(): void {
        if ($this->image_primary) ResourceFile::removeImage($this->image_primary);
        if ($this->resourceFile()->count()) {
            $ResourceFiles = $this->resourceFile()->get()->all();
            foreach ($ResourceFiles as $ResourceFile) {
                ResourceFile::removeImage($ResourceFile->path);
                $ResourceFile->delete();
            }
        }
    }

}
