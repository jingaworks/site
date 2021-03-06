<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Region extends Model
{
    use SoftDeletes;

    public $table = 'regions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'denj',
        'mnemonic',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function places()
    {
        return $this->hasMany(Place::class, 'region_id', 'id')
        ->whereNotIn('tip', [40, 23])
        ->whereNotIn('codp', [0])
        ->orderBy('denloc')
        ->select(['id', 'denloc', 'region_id']);
    }
}