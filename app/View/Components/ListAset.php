<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListAset extends Component
{
  public $aset;
  public $status;

  public function __construct($aset, $status = null)
  {
    $this->aset = $aset;
    $this->status = $status;
  }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-aset');
    }
}
