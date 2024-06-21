<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Cohensive\Embed\Embed as CohensiveEmbed;

class Embed extends Component
{

    public $url;
    /**
     * Create a new component instance.
     */


     public function __construct($url)
     {
         $this->url = $url;
     }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $embed = new CohensiveEmbed();
        $info = $embed->get($this->url);
        return view('components.embed', ['info' => $info]);
    }
}
