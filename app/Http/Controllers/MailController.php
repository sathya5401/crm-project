<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function send(Request $request)
    {
        // Validate form
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'attachment' => 'nullable|file|max:20480' // Max 20MB file
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($this->isOnline()) {
            $attachment = $request->file('attachment');

            Mail::send('marketing.email-template', ['body' => $request->message], function ($message) use ($request, $attachment) {
                $message->to($request->email)
                        ->from('u2005370@siswa.um.edu.my', 'CRM Project')
                        ->subject($request->subject);

                // Attach file if it's uploaded
                if ($attachment && $attachment->isValid()) {
                    $message->attach($attachment->getRealPath(), [
                        'as' => $attachment->getClientOriginalName(),
                        'mime' => $attachment->getClientMimeType(),
                    ]);
                }
            });

            return redirect()->back()->with('success', 'Email Sent!');

        } else {
            return redirect()->back()->with('error', 'Check your internet connection');
        }
    }

    public function isOnline($site = "https://youtube.com/")
    {
        try {
            if (@fopen($site, "r")) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }
}
