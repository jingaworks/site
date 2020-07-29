<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Subcategory extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'subcategories';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'category_id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        
        if ($file) {
            unset($file->mime_type);
            unset($file->collection_name);
            unset($file->created_at);
            unset($file->updated_at);
            unset($file->manipulations);
            unset($file->order_column);
            unset($file->custom_properties);
            unset($file->size);
            unset($file->model_id);
            unset($file->responsive_images);
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            // $file->preview   = $file->getUrl('preview');
            unset($file->name);
            unset($file->file_name);
            unset($file->disk);
            unset($file->model_type);
        }

        return $file;
    }
}
