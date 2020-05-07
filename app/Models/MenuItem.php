<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MenuItem extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * MenuItem belongsTo a menu
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * MenuItem hasMany child's (optional)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(MenuItem::class, 'parent_id', 'id')
            ->orderBy('order', 'asc');;
    }

    /**
     * Child menu belongsTo a parent menu item
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id', 'id');
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
