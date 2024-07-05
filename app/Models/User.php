<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuth;



class User extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, BasicAuth, UserRoleTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'username',
        'phone',
        'agribusiness_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (is_null($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }

    public function agribusiness()
    {
        return $this->belongsTo(Agribusiness::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('fullname', 'like', '%' . $search . '%');
            $query->orWhere('phone', 'like', '%' . $search . '%');
            $query->orWhere('username', 'like', '%' . $search . '%');
            $query->orWhereHas('agribusiness', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
                $query->orWhere('acronym', 'like', "%{$search}%");
            });
        });
    }

    /**
     * @param Builder $builder
     */
    public function scopeRetrievingByUsersType(Builder $builder)
    {
        if (!$this->isTraceAgriAdmin() && !$this->isPlateformAdmin()) {
            $builder->where('agribusiness_id', auth()->user()->agribusiness_id);
        } else {
            $builder->whereHas('roles', function ($q) {
                $q->whereIn('name', ['ADMINISTRATEUR TRACEAGRI', 'ADMINISTRATEUR PLATEFORME', 'ADMINISTRATEUR COOPERATIVE']);
            });
        }
    }

    public function farmers(){
        return $this->hasMany(Farmer::class);
    }
}
