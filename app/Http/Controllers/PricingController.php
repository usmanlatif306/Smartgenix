<?php

namespace App\Http\Controllers;

use App\Enums\MessageType;
use App\Models\ContactMessage;
use App\Models\Package;
use App\Services\SeoService;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(convert_price(145.56));
        if (!user_log()) {
            user_service()->create_log();
        }

        (new SeoService())->load('pricing');
        $packages = Package::orderBy('price', 'desc')->get();
        return view('pricing', compact('packages'));
    }


    /**
     * Send Quote Information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function quote(Request $request)
    {
        $quote = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'role' => $request->role,
            'garages' => $request->garages,
        ];
        ContactMessage::create([
            'type' => MessageType::Quote,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'subject' => 'Quote request for enterprise account',
            'quote' => $quote,
            'is_answered' => false
        ]);

        // $name = $request->first_name . ' ' . $request->last_name;
        // Notification::route('mail', $request->email)->notify(new MessageReceivedNotification($name));

        return back()->with('success', 'Your message has been received and a
        member of our team will message you shortly.
        ');
    }
}
