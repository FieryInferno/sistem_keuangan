<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
  public $columns;
  public $dataList;
  public $url;
  public $idTable;
  public $excel;

  public function __construct($columns, $dataList, $url = null, $idTable = 'table', $excel = null)
  {
    $this->columns = $columns;
    $this->dataList = $dataList;
    $this->url = $url;
    $this->idTable = $idTable;
    $this->excel = $excel;
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
