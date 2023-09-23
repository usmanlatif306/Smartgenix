<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Package;
use App\Services\FeatureService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = (new FeatureService())->features(8, 'products');

        return view('products', compact('data'));
    }

    public function show()
    {
        $type =  request()->segment(2) === 'independent' ? 'Individual garage' : request()->segment(2);
        $feature_type =  request()->segment(2) === 'independent' ? 'individual' : request()->segment(2);
        $package = Package::where('name', $type)->first();
        $features = Feature::where('type', $feature_type)->get();

        return view('show-product', compact('type', 'package', 'features'));
    }

    // public function recovery()
    // {
    //     $type =  request()->segment(2) === 'independent' ? 'individual' : request()->segment(2);
    //     $package = Package::where('name', $type)->first();
    //     $features = Feature::where('type', $type)->get();

    //     return view('recovery', compact('type', 'package', 'features'));
    // }

    // public function enterprise()
    // {
    //     $type =  request()->segment(2) === 'independent' ? 'individual' : request()->segment(2);
    //     $features = Feature::where('type', $type)->get();

    //     return view('enterprise', compact('type', 'features'));
    // }
}
