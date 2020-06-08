<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageResource;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function __invoke($slug)
    {
        return Page::findBySlug($slug);
    }
}
