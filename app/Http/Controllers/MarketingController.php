<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Rfx;

class MarketingController extends Controller
{   
    public function deals()
    {
        $deals = Rfx::whereIn('Status', ['new', 'in-progress'])->get();

        return view('marketing.deals',['deals' => $deals]);
    }
}
