<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JurnalExport implements FromView, ShouldAutoSize
{
  public $data;

  public function __construct($data)
  {
      $this->data = $data;
  }

  public function view(): View
  {
    return view('jurnalExcel', ['data' => $this->data]);
  }
}
