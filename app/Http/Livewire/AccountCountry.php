<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Livewire\Component;

class AccountCountry extends Component
{
    public $countries, $cities, $country, $city, $is_country;

    public function mount()
    {
        $this->countries = Country::orderBy('name')->get();
        $this->country = old('country', request()->user()->company?->country);
        $this->city = old('city', request()->user()->company?->city);
        $this->is_country = old('country', request()->user()->company) ? true : false;
        $this->cities = old('country', request()->user()->company) ? Country::where('name', $this->country)->first()->cities : [];
    }

    public function render()
    {
        return view('livewire.account-country');
    }

    public function updatedCountry()
    {
        if ($this->country) {
            $this->cities = Country::where('name', $this->country)->first()->cities;
            $this->is_country = true;
        } else {
            $this->is_country = false;
            $this->city = '';
        }
    }
}
