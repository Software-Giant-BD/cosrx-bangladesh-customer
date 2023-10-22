<?php

namespace App\Repositories;

use App\Models\Slider;
use App\Repositories\Interface\ISliderRepository;
use DB;

class SliderRepository extends Repository implements ISliderRepository
{
    private $Admin_url_public;

    public function __construct()
    {
        $this->Admin_url_public = env('Admin_url_public');
        $modelName = 'App\Models\Slider';
        parent::__construct($modelName);
    }

    public function activeSlider()
    {
        return Slider::select('id', 'redirect_url', 'feature', 'title', DB::raw("CONCAT('$this->Admin_url_public',image) AS image"))
            ->where('status', 'Active')->orderBy('feature', 'desc')->get();
    }
}
