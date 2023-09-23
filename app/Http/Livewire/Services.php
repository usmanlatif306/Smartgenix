<?php

namespace App\Http\Livewire;

use App\Models\Garage\Garage;
use App\Models\Garage\Membership;
use App\Models\Garage\MotAppointment;
use App\Models\Garage\RepairAppointment;
use App\Models\Garage\ServiceAppointment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Services extends Component
{
    public $currency, $search = '', $garages = [], $garage, $types, $type, $cost, $is_service, $duration, $full_cost, $major_cost, $memberships;

    public function mount()
    {
        $this->currency = setting('currency_symbol');
        $this->types = ['mot', 'service', 'repair', 'memberships'];
        $this->type = 'mot';
        // $this->SelectGarage(1);
    }

    public function render()
    {
        return view('livewire.services');
    }

    public function updatedSearch()
    {
        $this->garages = Garage::select(['id', 'name', 'country', 'city', 'address'])->whereLike('name', $this->search)->get();
    }

    public function updatedType()
    {
        $this->calculate();
    }

    public function SelectGarage($garage_id)
    {
        $this->garage = Garage::withCount('reviews')->withAvg('reviews', 'overall')->find($garage_id);
        $this->search = '';
        $this->calculate();
    }

    public function calculate()
    {
        $this->garage = Garage::withCount('reviews')->withAvg('reviews', 'overall')->find($this->garage->id);
        if ($this->type == 'mot') {
            $this->cost = garage_setting('mot_price', $this->garage->id);
            $this->is_service = $this->garage->is_mot ? true : false;
            $duration = floor(MotAppointment::where('garage_id', $this->garage->id)->where('status', 'completed')->select(DB::raw("AVG(TIME_TO_SEC(TIMEDIFF(completed_at, started_at))/60) AS timediff"))->get()->avg('timediff') / 1440);
            $this->duration =  $duration > 1 ? $duration . ' days' : $duration . ' day';
        }

        if ($this->type == 'service') {
            $this->cost = garage_setting('interm_service', $this->garage->id);
            $this->full_cost = garage_setting('full_service', $this->garage->id);
            $this->major_cost = garage_setting('major_service', $this->garage->id);
            $this->is_service = $this->garage->is_services ? true : false;
            $duration = floor(ServiceAppointment::where('garage_id', $this->garage->id)->where('status', 'completed')->select(DB::raw("AVG(TIME_TO_SEC(TIMEDIFF(completed_at, started_at))/60) AS timediff"))->get()->avg('timediff') / 1440);
            $this->duration =  $duration > 1 ? $duration . ' days' : $duration . ' day';
        }

        if ($this->type == 'repair') {
            $this->cost = 0;
            $this->is_service = $this->garage->is_repairs ? true : false;
            $duration = floor(RepairAppointment::where('garage_id', $this->garage->id)->where('status', 'completed')->select(DB::raw("AVG(TIME_TO_SEC(TIMEDIFF(completed_at, started_at))/60) AS timediff"))->get()->avg('timediff') / 1440);
            $this->duration =  $duration > 1 ? $duration . ' days' : $duration . ' day';
        }

        if ($this->type === 'memberships') {
            $this->memberships = Membership::where('garage_id', $this->garage->id)->get();
            if ($this->memberships->count() > 1) {
                $this->is_service = true;
            } else {
                $this->is_service = false;
            }
        }
    }
}
