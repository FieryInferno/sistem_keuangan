<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
  public $columns;
  public $dataList;
  public $url;
  public $idTable;

  public function __construct($columns, $dataList, $url, $idTable = 'table')
  {
    $this->columns = $columns;
    $this->dataList = $dataList;
    $this->url = $url;
    $this->idTable = $idTable;
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
