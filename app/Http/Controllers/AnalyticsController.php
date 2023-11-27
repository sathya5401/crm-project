<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Lead;
use Carbon\Carbon;
use App\Models\Rfx;


class AnalyticsController extends Controller
{
    //
    public function index(Request $request)
    {   
        //1st diagram
        $pipelineRfx = Rfx::whereIn('Status', ['new', 'in-progress'])->count();
        



        //3rd diagram
         // Calculate start and end of the current month
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        // Filter Rfx records with approved status and within the current month
        $approvedRfx = Rfx::where('Status', 'approved')
            ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
            ->get();

        // Calculate total revenue for this month
        $totalRevenue = $approvedRfx->sum('Quota_mount');

        // Calculate the percentage increase compared to the previous month
        $previousMonthRevenue = Rfx::where('Status', 'approved')
            ->whereBetween('updated_at', [$startOfMonth->subMonth()->startOfMonth(), $endOfMonth->subMonth()->endOfMonth()])
            ->sum('Quota_mount');

        $percentageIncreaseRevenue = ($previousMonthRevenue > 0) ? (($totalRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100 : 100;




        //2nd diagram
        $currentMonthLeads = Lead::whereMonth('created_at', Carbon::now()->month)->count();

        // Calculate the start and end of the previous month
        $startOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth();

        $previousMonthLeads = Lead::whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])->count();

        // Calculate percentage increase
        $percentageIncreaseLeads = ($previousMonthLeads > 0) ? (($currentMonthLeads - $previousMonthLeads) / $previousMonthLeads) * 100 : 100;






        //4th diagram
        // Get the selected number of months from the form submission
        $selectedMonths = $request->input('months', 2); // Default to 2 months if not provided

        // Calculate the start and end dates based on the selected number of months
        $startmonth = now()->subMonths($selectedMonths - 1)->startOfMonth();
        $endmonth = now()->endOfMonth();

        // $startmonth = now()->subMonth()->startOfMonth();
        // $endmonth = now()->endOfMonth();

        $leadsCreated = Lead::whereBetween('created_at', [$startmonth, $endmonth])->count();
        $dealsCreated = Rfx::whereBetween('created_at', [$startmonth, $endmonth])->count();
        $dealsWon = Rfx::where('Status', 'approved')
                        ->whereBetween('updated_at', [$startmonth, $endmonth])
                        ->count();   
        $dealsApproved = Rfx::where('Status', 'approved')
                                    ->whereBetween('updated_at', [$startmonth, $endmonth])
                                    ->get();
        $revenueWon = $dealsApproved->sum('Quota_mount');




        
        //5th diagram
        $startMonthDeals = now()->subMonths(2)->startOfMonth();
        $endMonthDeals = now()->endOfMonth();
        
        $rfxCreated = Rfx::whereBetween('created_at', [$startMonthDeals, $endMonthDeals])->count();
        $rfxApproved = Rfx::where('Status', 'approved')
                                ->whereBetween('updated_at', [$startmonth, $endmonth])
                                ->count();
        $rfxRejected = Rfx::where('Status', 'rejected')
                                ->whereBetween('updated_at', [$startmonth, $endmonth])
                                ->count();  

        return view('analytics', [
            'currentMonthLeads' => $currentMonthLeads,
            'previousMonthLeads' => $previousMonthLeads,
            'percentageIncreaseRevenue' => $percentageIncreaseRevenue,
            'totalRevenue' => $totalRevenue,
            'percentageIncreaseLeads' => $percentageIncreaseLeads,
            'pipelineRfx' => $pipelineRfx,
            'leadsCreated'=> $leadsCreated,
            'dealsCreated'=> $dealsCreated,
            'dealsWon' => $dealsWon,
            'revenueWon' => $revenueWon,
            'selectedMonths' => $selectedMonths,
            'rfxCreated' => $rfxCreated,
            'rfxApproved' => $rfxApproved,
            'rfxRejected' => $rfxRejected,
        ]);
        
        
    }

}
