<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonModal extends Component
{
  public $url;

  public function __construct($url)
  {
    $this->url = $url;
  }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-modal');
    }
}
