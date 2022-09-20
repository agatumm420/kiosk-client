<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PrintTime extends Component
{
    // public function render()
    // {
    //     return view('livewire.print-time');
    // }
    protected $listeners = ['PrintTime' => 'doPrinting'];
    public function doPrinting(){
        dd('I m printing');
    }
}
