<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyJobRequest;
use App\Models\Career;
use App\Models\CareerApplicant;
use App\Notifications\UploadCVNotification;
use App\Services\SeoService;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CareerController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        (new SeoService())->load('careers');
        $latests = Career::valid()->take(3)->get();

        return view('careers', compact('latests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplyJobRequest $request)
    {
        $apply = CareerApplicant::where('career_id', $request->career_id)->whereEmail($request->email)->first();

        if ($apply) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        $data = $request->validated();

        $data['resume'] = $this->fileUpload($request->resume, 'resume');
        CareerApplicant::create($data);

        return redirect()->back()->with('success', 'You have successully applied for job.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_cv(Request $request)
    {
        $cv = $this->fileUpload($request->file, 'cv');
        Notification::route('mail', 'queries@smartgenix.co.uk')
            ->notify(new UploadCVNotification($request->information, $cv));

        return redirect()->back()->with('success', 'Your CV has been uploaded successfully!');
    }
}
