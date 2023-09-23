<?php

namespace App\Http\Livewire;

use App\Enums\FaqType;
use App\Models\Blog as ModelsBlog;
use Livewire\Component;

class Blog extends Component
{
    public $general = 4, $staff = 4, $support = 4;
    public $generals = [], $staffs = [], $supports = [];
    public $general_total, $staff_total, $support_total;


    public function render()
    {
        // general
        $general_query = ModelsBlog::with('user:id,first_name,last_name')->whereCategory(FaqType::GENERAL)->whereShow(true);
        $this->general_total = $general_query->count();
        $this->generals = $general_query->take($this->general)->get();

        // staff
        $staff_query = ModelsBlog::with('user:id,first_name,last_name')->whereCategory(FaqType::ACCOUNT)->whereShow(true);
        $this->staff_total = $staff_query->count();
        $this->staffs = $staff_query->take($this->general)->get();

        // support
        $support_query = ModelsBlog::with('user:id,first_name,last_name')->whereCategory(FaqType::STAFF)->whereShow(true);
        $this->support_total = $support_query->count();
        $this->supports = $support_query->take($this->general)->get();

        return view('livewire.blog');
    }

    // load more blog
    public function loadMore($type)
    {
        $this->$type += 1;
    }
}
