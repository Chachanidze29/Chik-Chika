<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotificationButton extends Component
{
    public string $active;
    public string $value;

    public function __construct(string $active,string $value)
    {
        $this->active = $active;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification-button');
    }
}
