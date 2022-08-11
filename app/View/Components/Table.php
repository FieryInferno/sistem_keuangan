<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
  public $columns;
  public $dataList;
  public $url;

  public function __construct($columns, $dataList, $url)
  {
    $this->columns = $columns;
    $this->dataList = $dataList;
    $this->url = $url;
  }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table');
    }
}
