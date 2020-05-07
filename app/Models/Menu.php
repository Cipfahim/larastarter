<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Menu extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     *  Menu has many  menu items
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class)
            ->doesntHave('parent')
            ->orderBy('order','asc');
    }

    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('backend.sidebar.menu');
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
}
