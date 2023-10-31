<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Repositories\Interface\ISliderRepository;

class Slide extends Component
{
    private $sliderRepo;
    public function __construct(ISliderRepository $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $slides = $this->sliderRepo->activeSlider();
        return view('components.slide',compact('slides'));
    }
}
