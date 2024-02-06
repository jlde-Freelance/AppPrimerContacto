<?php

namespace App\Models;

use App\Facades\Alert;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

/**
 * @property int $id
 * @property string $entity
 * @property int $entity_id
 * @property string $type
 * @property string $path
 * @property array $metadata
 * @property int $order
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ResourceFile extends Model {

    /**
     * Constants
     */
    public const TYPE_IMAGE = 'image';
    public const TYPE_VIDEO = 'video';
    public const TYPE_PDF = 'pdf';
    public const TYPE_FILE = 'file';

    public const IMG_SIZE_ORIGINAL = 'original';
    public const IMG_SIZE_MEDIUM = 'medium';
    public const IMG_SIZE_SMALL = 'small';

    public const DEFAULT_QUALITY = 90;

    public $timestamps = false;

    protected $casts = [
        'metadata' => 'json',
    ];

    /**
     * @return string[]
     */
    public static function getSizes() {
        return [
            self::IMG_SIZE_ORIGINAL => 'origin',
            self::IMG_SIZE_MEDIUM => '700x700',
            self::IMG_SIZE_SMALL => '100x100',
        ];
    }

    /**
     * @param String $FileName
     * @return void
     */
    public static function removeImage(String $FileName): void {
        $SIZES = self::getSizes();
        foreach ($SIZES as $key => $size) {
            $DS = DIRECTORY_SEPARATOR;
            $storage_path = storage_path("app{$DS}images{$DS}{$key}{$DS}{$FileName}");
            if (file_exists($storage_path)) unlink($storage_path);
        }
    }

    /**
     * @param UploadedFile $Image
     * @param String $FileName
     * @return \Intervention\Image\Image[] |null
     */
    public static function saveNewImage(UploadedFile $Image, String $FileName): ?array {
        try {
            $IMG = Image::make($Image->getPathname());
            $SIZES = self::getSizes();
            $DS = DIRECTORY_SEPARATOR;
            $NEW_IMAGES = [];
            foreach ($SIZES as $key => $size) {
                $path_base = "app{$DS}images{$DS}{$key}";
                if (!file_exists(storage_path($path_base))) mkdir(storage_path($path_base), 0777, true);
                $storage_path = storage_path("{$path_base}{$DS}{$FileName}");
                $WidthAndHeight = explode('x', $size);
                $width = $WidthAndHeight[0];
                $height = $WidthAndHeight[1] ?? false;
                if ($height) {
                    $IMG->resize($width, $height, fn($constraint) => $constraint->aspectRatio());
                    $IMG->save($storage_path, ResourceFile::DEFAULT_QUALITY);
                } else $IMG->save($storage_path);
                $NEW_IMAGES[] = $IMG;
            }
            return $NEW_IMAGES;
        } catch (Exception $e) {
            if (env('APP_ENV', 'dev') == 'dev') dd($e);
            return null;
        }
    }
}
