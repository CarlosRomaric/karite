<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Str;

abstract class Model extends Eloquent
{
    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var int
     */
    protected $perPage = 10;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            if (is_null($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }

}
