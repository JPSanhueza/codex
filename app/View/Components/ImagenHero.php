<?php

namespace App\View\Components;

use App\Models\HeroImage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class ImagenHero extends Component
{
    public ?string $desktopImageUrl;

    public ?string $mobileImageUrl;

    public function __construct()
    {
        $heroImage = HeroImage::query()->latest()->first();

        $this->desktopImageUrl = $heroImage ? Storage::url($heroImage->desktop_image_path) : null;
        $this->mobileImageUrl = $heroImage ? Storage::url($heroImage->mobile_image_path) : null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.imagen-hero');
    }
}
