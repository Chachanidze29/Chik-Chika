<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserLink extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $href,public string $value)
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-link');
    }
}
