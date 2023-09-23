<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Package;
use Livewire\Component;
use Illuminate\Validation\Rules\Password;

class Registration extends Component
{
    public $packages, $package, $selected, $countries, $cities = [], $selectedCountry, $is_validated = false, $is_country = false, $step = 'company', $disable = false;
    public $company_name, $company_address, $opening, $closing, $out_of_hour_response = 'yes', $country, $city, $company_telephone, $company_postcode, $first_name, $middle_name, $last_name, $telephone, $mobile, $role, $email, $password, $password_confirmation;

    public function mount()
    {
        $this->countries = Country::orderBy('name')->get();
        $this->packages = Package::where('name', '!=', 'Enterprise')->orderBy('price', 'desc')->get();

        if (request()->package) {
            $this->selected = $this->packages->where('name', ucfirst(request()->package))->first() ?? $this->packages->first();
        } else {
            $this->selected = $this->packages->first();
        }

        $this->package = $this->selected->id;
    }
    public function render()
    {
        return view('livewire.registration');
    }

    public function updatedPackage()
    {
        $this->is_validated = false;
        $this->selected = $this->packages->find($this->package);
    }

    public function updatedCountry()
    {
        if ($this->country) {
            $this->selectedCountry = Country::where('name', $this->country)->first();
            $this->cities = $this->selectedCountry->cities;
            $this->city = '';
            $this->is_country = true;
        } else {
            $this->city = '';
            $this->is_country = false;
        }
    }

    public function validateInputs()
    {
        if ($this->step === 'company') {
            $this->validate([
                'package' => 'required',
                'company_name' => ['required', 'string', 'max:255', 'unique:companies,name'],
                'company_address' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'company_telephone' => ['required', 'string', 'min:4', 'max:13'],
                'company_postcode' => ['required', 'string', 'max:7'],
                'opening' => ['required'],
                'closing' => ['required'],
                'out_of_hour_response' => ['required'],
            ]);
            $this->step = 'about';
        } elseif ($this->step === 'about') {
            $this->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'telephone' => ['required', 'string', 'min:4', 'max:13'],
                'mobile' => ['required', 'string', 'min:4', 'max:13'],
                'role' => ['required', 'string', 'max:255'],
            ]);
            $this->step = 'last';
        } else {

            $this->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:garage.users,email'],
                'password' => [
                    'required', 'confirmed',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                ],
            ]);

            // if user is from uk
            if (is_uk()) {
                $response = postcodes($this->company_postcode);

                if ($response['status'] == 200) {
                    $latitude = $response['result']['latitude'];
                    $longitude = $response['result']['longitude'];
                } else {
                    // postcode is incorrect
                    $message = $response['error'] . '. Your postcode does not belong to UK';
                }
            } else {
                // finding coordinates of address
                // $address = $this->company_postcode . ' ' . $this->company_address;
                // $coordinates = findAddressCoordinates($address);
                // if (isset($coordinates['geometry'])) {
                //     $latitude = $coordinates['geometry']['location']['lat'];
                //     $longitude = $coordinates['geometry']['location']['lng'];
                // } else {
                //     $message = $coordinates;
                // }

                $latitude = rand(30.4512, 32.0123);
                $longitude = rand(71.7818, 74.2569);
            }

            if (isset($latitude)) {
                $this->dispatchBrowserEvent('validated', [
                    'package' => $this->package,
                    'company_name' => $this->company_name,
                    'company_address' => $this->company_address,
                    'country' => $this->country,
                    'city' => $this->city,
                    'company_postcode' => $this->company_postcode,
                    'company_telephone' => $this->company_telephone,
                    'opening' => $this->opening,
                    'closing' => $this->closing,
                    'out_of_hour_response' => $this->out_of_hour_response,
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'telephone' => $this->telephone,
                    'mobile' => $this->mobile,
                    'role' => $this->role,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                ]);
                $this->disable = true;
            } else {
                $this->step = 'company';
                $errorMsg = $message ?? 'Invalid address. No coordinates found agaist this address';
                session()->flash('invalidAddress', $errorMsg);
            }
        }
    }

    public function backStep()
    {
        if ($this->step === 'about') {
            $this->step = 'company';
        } else {
            $this->step = 'about';
        }
    }
}
