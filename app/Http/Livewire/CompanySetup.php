<?php

namespace App\Http\Livewire;

use App\Enums\ServiceType;
use App\Models\Service;
use App\Models\Vehicle;
use App\Services\GarageService;
use Livewire\Component;

class CompanySetup extends Component
{
    public $vehicles = [], $vehicles_list, $services = [], $services_list = [], $step, $setup;

    public function mount()
    {
        $this->vehicles_list = Vehicle::get();
        if (is_uk()) {
            $this->services_list = Service::get();
            // $this->services_list = [
            //     'mot' => "MOT",
            // ];
        } else {
            $this->services_list = Service::whereNot('value', ServiceType::MOT)->get();
        }

        // $this->services_list = array_merge($this->services_list, [
        //     'services' => "Services",
        //     'repairs' => "Repairs",
        //     'recovery' => "Recovery",
        // ]);
        $this->setup = auth()->user()->setup;

        if (count($this->setup->vehicles) < 1) {
            $this->step = 'vehicles';
        } elseif (count($this->setup->vehicles) > 0 && !$this->setup->services) {
            $this->step = 'services';
        } else {
            $this->step = 'congratulation';
        }
    }

    public function render()
    {
        return view('livewire.company-setup')->extends('layouts.app');
    }


    public function moveSetup($step, $next = null)
    {
        if ($next) {

            if (count($this->$step) < 1) {
                session()->flash('error', trans('general.no_vehicle_error'));
            } else {
                $this->setup->update([
                    $step => $this->$step
                ]);
                $this->step = $next;
            }
        } else {
            if (count($this->$step) < 1) {
                session()->flash('error', trans('general.no_service_error'));
            } else {
                if (!$this->setup->services) {
                    // (new GarageService())->delete();
                    $this->setup->update([
                        $step => true,
                        'is_mot' => in_array('mot', $this->$step) ? true : false,
                        'is_services' => in_array('services', $this->$step) ? true : false,
                        'is_repairs' => in_array('repairs', $this->$step) ? true : false,
                        'is_recovery' => in_array('recovery', $this->$step) ? true : false,
                    ]);
                    try {
                        sleep(20);
                        (new GarageService())->installation();
                        return to_route('company.setup');
                    } catch (\Throwable $th) {
                        $this->setup->update(['services' => false]);
                        (new GarageService())->delete();
                        session()->flash('error', $th->getMessage());
                    }
                }
            }
        }
    }
}
