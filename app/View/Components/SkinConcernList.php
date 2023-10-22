<?php

namespace App\View\Components;

use App\Models\SkinConcern;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class SkinConcernList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = Cache::remember('skin_concern', 120, function () {
            return SkinConcern::select('id', 'name', 'slug')
                ->limit(50)
                ->get();
        });

        return view('components.skin-concern-list', compact('data'));
    }
}
