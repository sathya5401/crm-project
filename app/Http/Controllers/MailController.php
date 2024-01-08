<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User; 
use App\Models\Customers; 

class MailController extends Controller
{
    public function send(Request $request)
    {
        // Validate form
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'message' => 'required',
            'attachment' => 'nullable|file|max:20480' // Max 20MB file
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $categories = $request->input('categories', []);
        $recipients = $this->getRecipients($categories);

        if ($this->isOnline()) {
            $attachments = $request->file('attachments', []);

            Mail::send('marketing.email-template', ['body' => $request->message], function ($message) use ($request, $attachments, $recipients) {
                foreach ($recipients as $recipient) {
                    $message->to($recipient);
                }
    
                $message->from('u2005370@siswa.um.edu.my', 'CRM Project')
                        ->subject($request->subject);
    
                // Attach files if they're uploaded
                foreach ($attachments as $attachment) {
                    if ($attachment && $attachment->isValid()) {
                        $message->attach($attachment->getRealPath(), [
                            'as' => $attachment->getClientOriginalName(),
                            'mime' => $attachment->getClientMimeType(),
                        ]);
                    }
                }
            });

            return redirect()->to('marketing/sentmail');

        } else {
            return redirect()->back()->with('error', 'Check your internet connection');
        }
    }

    private function getRecipients(array $categories)
    {
        $recipients = [];

        if (in_array('users', $categories)) {
            $userEmails = User::pluck('email')->toArray();
            $recipients = array_merge($recipients, $userEmails);
        }

        foreach (['upstream', 'midstream', 'downstream'] as $category) {
            if (in_array($category, $categories)) {
                $customerEmails = Customers::where('category', $category)->pluck('email')->toArray();
                $recipients = array_merge($recipients, $customerEmails);
            }
        }

        return array_unique($recipients);
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
