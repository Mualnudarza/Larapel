<?php

namespace App\Livewire;
use Livewire\Component;
class Counter extends Component
{
    public $count = 0;

    public function tambah(){
        $this -> count++;
    }

    public function kurang(){
        $this -> count--;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
