<?php

namespace App\Http\Livewire;

use App\Models\Page;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AboutTab extends Component
{
    public $tabs = ['vision', 'mission', 'our-team', 'our-history'];
    public $selected;

    public function mount()
    {
        if (request()->type === 'team') {
            $this->selected = 'our-team';
        } else {
            $this->selected = 'vision';
        }
    }

    public function render()
    {
        return view('livewire.about-tab', [
            'page' => $this->selected === 'our-team' ? Team::orderBy('title', 'DESC')->get()->groupBy('category') : Page::whereSlug($this->selected)->first()
        ]);
    }

    public function changeTab($tab)
    {
        $this->selected = $tab;
    }
}
