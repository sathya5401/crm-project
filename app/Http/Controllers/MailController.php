<?php

namespace App\Http\Controllers;
use App\Models\Customers;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function send (Request $request){
        //validate form
        $request->validate([
            'subject'=> 'required',
            'message'=> 'required'
        ]);

    
    $customers = Customers::all();


    if($this->isOnline()){


    foreach ($customers as $customer) {    
    $mail_data = [
        'recipient' => $customer->email,
        'fromEmail' => 'u2005370@siswa.um.edu.my',
        'fromName' => 'CRM Project',
        'subject' => $request->subject,
        'body' => $request->message
    ];
    

    \Mail::send ('marketing.email-template',$mail_data, function ($message) use ($mail_data){
        $message->to($mail_data['recipient'])
        ->from($mail_data['fromEmail'], $mail_data['fromName'])
        ->subject ($mail_data['subject']);
    });
    }

     return redirect()->back()->with('success', 'Email Sent!');

    }else {
        return redirect()->back() -> withInput()->with('error', 'Check your internet connection');
    }
}

public function isOnline($site = "https://youtube.com/"){
    if(@fopen ($site, "r")){
        return true;
    }else{
        return false;
    } 
}
}