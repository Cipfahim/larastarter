<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Module extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get modules with permissions
     *
     * @return mixed
     */
    public static function getWithPermissions()
    {
        return Cache::rememberForever('permissions.getWithPermissions', function() {
            return self::with('permissions')->get();
        });
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('permissions.getWithPermissions');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            self::flushCache();
        });

        static::created(function() {
            self::flushCache();
        });

        static::deleted(function() {
            self::flushCache();
        });
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
