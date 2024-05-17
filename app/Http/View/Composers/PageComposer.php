<?php

namespace App\Http\View\Composers;

use App\Models\Page;
use Illuminate\View\View;

class PageComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('pages', Page::orderBy('name','ASC')->get(['name', 'slug']));

    }
}
