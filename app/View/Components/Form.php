<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
  public $form;

  public function __construct($form)
  {
    $this->form = $form;
  }

  public function render()
  {
    return view('components.form');
  }
}
