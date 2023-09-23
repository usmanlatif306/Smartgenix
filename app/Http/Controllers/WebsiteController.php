<?php

namespace App\Http\Controllers;

use App\Enums\FaqType;
use App\Http\Requests\ContactMessageRequest;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Package;
use App\Models\Page;
use App\Notifications\MessageReceivedNotification;
use App\Services\FeatureService;
use App\Services\GarageService;
use App\Services\SeoService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;

class WebsiteController extends Controller
{
    /**
     * homepage
     *
     * @return void
     */
    public function homepage()
    {
        if (!user_log()) {
            user_service()->create_log();
        }

        (new SeoService())->load('homepage');

        // loading statistics from garage db
        $data['feagures'] = (new GarageService())->statistics();

        // features
        $data['products'] = (new FeatureService())->features(4);

        // faqs
        $faqs = Faq::whereShow(true)->latest()->get();
        $data['faqs'] = [
            'General' => $faqs->where('type', FaqType::GENERAL),
            'Support' => $faqs->where('type', FaqType::STAFF),
            'Account' => $faqs->where('type', FaqType::ACCOUNT),
        ];

        return view('home', compact('data'));
    }

    /**
     * about
     *
     * @return void
     */
    public function about()
    {
        (new SeoService())->load('about');
        return view('about');
    }


    /**
     * features
     *
     * @return void
     */
    public function features()
    {
        (new SeoService())->load('features');
        $data['your_features'] = Feature::whereType('you')->get();
        $data['customer_features'] = Feature::whereType('customer')->get();

        return view('features', compact('data'));
    }

    /**
     * contact
     *
     * @return void
     */
    public function contact()
    {
        (new SeoService())->load('contact');
        return view('contact');
    }

    /**
     * contact
     *
     * @return void
     */
    public function search_garage()
    {
        return view('search_garage');
    }

    /**
     * save message to db
     *
     * @param  mixed $request
     * @return void
     */
    public function saveMessage(ContactMessageRequest $request)
    {
        ContactMessage::create($request->validated() + ['is_answered' => false]);

        $name = $request->first_name . ' ' . $request->last_name;
        Notification::route('mail', $request->email)->notify(new MessageReceivedNotification($name));

        return redirect()->back()->with('success', 'Your message has been received and a
        member of our team will message you shortly.
        ');
    }
    /**
     * blog
     *
     * @return void
     */
    public function blog()
    {
        (new SeoService())->load('blog');
        $latest_blogs = Blog::with('user:id,first_name,last_name')->latest()->take(3)->get();

        return view('blog', compact('latest_blogs'));
    }

    public function page(Page $page)
    {
        (new SeoService())->load($page->slug);
        return view('page', compact('page'));
    }
    /**
     * termConditions
     *
     * @return void
     */
    public function termConditions()
    {
        return view('terms');
    }

    /**
     * privacyPolicy
     *
     * @return void
     */
    public function privacyPolicy()
    {
        return view('privacy');
    }

    public function language($lang)
    {
        App::setLocale($lang);
        session()->put('locale', $lang);

        return back();
    }
}
