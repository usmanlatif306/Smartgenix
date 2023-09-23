<?php

namespace App\Http\Livewire;

use App\Models\Career;
use Livewire\Component;

class Careers extends Component
{
    public $tabs = ['uk', 'usa', 'canada', 'asia', 'middle_east'];
    public $selected = 'uk';

    public function render()
    {
        return view('livewire.careers', [
            'jobs' => Career::whereCountry($this->selected)->valid()->get()
        ]);
    }

    public function changeTab($tab)
    {
        $this->selected = $tab;
    }
}
