<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\View\View;

class CategoryComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories',Category::where('status', 1)->get(['id', 'category_name']));

    }
}
