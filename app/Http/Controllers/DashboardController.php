<?php

namespace App\Http\Controllers;

use App\Models\CompanyNews;
use App\Models\CompanyNotice;
use App\Models\ServiceNotice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['subscriptions'] = request()->user()->subscriptions();
        $data['tickets'] = request()->user()->tickets;
        $data['ticket_count'] = $data['tickets']->count();
        $data['subscription'] = (request()->user()->active_subscription() || on_trial() || is_garage_by_enterprise()) ? true : false;
        $last_subscription = $data['subscriptions']->first();
        $data['subscription_name'] = $last_subscription?->package->name;
        if ($last_subscription?->expired_at > now()) {
            $data['subscription_status'] = 'Live';
        } else {
            $data['subscription_status'] = 'Expired';
        }

        $data['service_notices'] = ServiceNotice::whereNull('user_id')->latest()->get();
        // $data['company_news'] = CompanyNews::latest()->get();
        $data['company_notices'] = CompanyNotice::latest()->get();

        return view('company.dashboard', compact('data'));
    }
}
