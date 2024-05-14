<?php

namespace App\Http\View\Composers;

use App\Models\SubCategory;
use Illuminate\View\View;

class SubCategoryComposer
{

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('subcategories', SubCategory::where('status', '=', '1')->orderBy('id')->get(['id', 'subcategory_name','subcategory_slug','category_id']));
    }
}
