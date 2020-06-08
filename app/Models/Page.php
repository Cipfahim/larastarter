<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Register media collections
     */
    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->useFallbackUrl(config('app.placeholder').'800.png')
            ->useFallbackPath(config('app.placeholder').'800.png');
    }

    /**
     * Find page by slug.
     *
     * @param $slug
     * @return mixed
     */
    public static function findBySlug($slug)
    {
        return self::where('slug',$slug)->firstOrFail();
    }

    /**
     * Scope a query to only include active pages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
