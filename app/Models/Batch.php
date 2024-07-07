<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Batch extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];
    protected $table = "batchs";
    protected $keyType = 'string';
    public $incrementing = false;


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

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
