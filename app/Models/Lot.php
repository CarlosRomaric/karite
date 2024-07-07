<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lot extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];
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

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function agribusiness()
    {
        return $this->belongsTo(Agribusiness::class);
    }
    
    public function sealeds()
    {
        return $this->hasMany(Sealed::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
