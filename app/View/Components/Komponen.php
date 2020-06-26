<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Komponen extends Component
{
    public $type;
    public $isi;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $isi = null)
    {
        $this->type = $type;
        $this->isi = $isi;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.' . $this->type);
    }
}
