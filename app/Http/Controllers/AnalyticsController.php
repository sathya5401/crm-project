<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Lead;
use Carbon\Carbon;
use App\Models\Rfx;
use Spatie\QueryBuilder\QueryBuilder;
use ZipArchive;
use Sheets;

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
        $approvedRfx = Rfx::where('Status', 'awarded')
            ->whereBetween('date_award', [$startOfMonth, $endOfMonth])
            ->get();

        // Calculate total revenue for this month
        $totalRevenue = $approvedRfx->sum('award_amount');

        // Calculate the percentage increase compared to the previous month
        $previousMonthRevenue = Rfx::where('Status', 'awarded')
            ->whereBetween('date_award', [$startOfMonth->subMonth()->startOfMonth(), $endOfMonth->subMonth()->endOfMonth()])
            ->sum('award_amount');

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
        $dealsWon = Rfx::where('Status', 'awarded')
                        ->whereBetween('date_award', [$startmonth, $endmonth])
                        ->count();   
        $dealsApproved = Rfx::where('Status', 'awarded')
                                    ->whereBetween('date_award', [$startmonth, $endmonth])
                                    ->get();
        $revenueWon = $dealsApproved->sum('award_amount');




        
        //5th diagram
        $startMonthDeals = now()->subMonths(2)->startOfMonth();
        $endMonthDeals = now()->endOfMonth();
        
        $rfxCreated = Rfx::whereBetween('created_at', [$startMonthDeals, $endMonthDeals])->count();
        $rfxApproved = Rfx::where('Status', 'awarded')
                                ->whereBetween('date_award', [$startmonth, $endmonth])
                                ->count();
        $rfxRejected = Rfx::where('Status', 'decline')
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

    public function insertDataToLeads()
{
    // Retrieve data from the database (assuming you have the Lead model)
    $leads = Lead::all();

    // Get the Google Sheet
    $sheet = Sheets::spreadsheet('13sEPzmtfPdHeiNwPgeqBPmJ52K07RCFoN7LnQIBgCnI')->sheet('lead');
    $sheet->clear();
    // Add header row
    $headerRow = ['name', 'phone_number', 'address', 'title', 'email', 'faxNo', 'inv_address', 'company','remarks'];
    $sheet->append([$headerRow]);

    // Add data rows
    foreach ($leads as $lead) {
        $rowData = [
            $lead->name,
            $lead->phone_number,
            $lead->address,
            $lead->title,
            $lead->email,
            $lead->faxNo,
            $lead->inv_address,
            $lead->company,
            $lead->remarks,
        ];
        $sheet->append([$rowData]);
    }

    return redirect('https://lookerstudio.google.com/reporting/create?&c.mode=edit&ds.connector=googleSheets&ds.spreadsheetId=13sEPzmtfPdHeiNwPgeqBPmJ52K07RCFoN7LnQIBgCnI&ds.worksheetId=0&ds.includeHiddenCells=true&ds.includeFilteredCells=true&ds.refreshFields=true');
}

public function insertDataToRfx()
{
    // Retrieve data from the database (assuming you have the Lead model)
    $rfx = Rfx::all();

    // Get the Google Sheet
    $sheet = Sheets::spreadsheet('13sEPzmtfPdHeiNwPgeqBPmJ52K07RCFoN7LnQIBgCnI')->sheet('rfqs');
    $sheet->clear();
    // Add header row
    $headerRow = ['Company', 'Custom_Name', 'Custom_Email', 'Custom_Number', 'RFQ_number', 'RFQ_title', 'Due_date', 'Quota_mount', 'Status','Rfx Type','date_award','award_amount'];
    $sheet->append([$headerRow]);

    // Add data rows
    foreach ($rfx as $rfq) {
        $rowData = [
            $rfq->Company,
            $rfq->Custom_Name,
            $rfq->Custom_Email,
            $rfq->Custom_Number,
            $rfq->RFQ_number,
            $rfq->RFQ_title,
            $rfq->Due_date,
            $rfq->Quota_mount,
            $rfq->Status,
            // $rfq->user_id,
            $rfq->rfx_type,
            // $rfq->remarks,
            // $rfq->decline,
            $rfq->date_award,
            $rfq->award_amount,

        ];
        $sheet->append([$rowData]);
    }

    return redirect('https://lookerstudio.google.com/reporting/create?&c.mode=edit&ds.connector=googleSheets&ds.spreadsheetId=13sEPzmtfPdHeiNwPgeqBPmJ52K07RCFoN7LnQIBgCnI&ds.worksheetId=1522162644&ds.includeHiddenCells=true&ds.includeFilteredCells=true&ds.refreshFields=true');
}

    public function downloadDataZip()
    {
        // Fetch leads and RFQs data
        $leadsData = Lead::all();
        $rfqsData = Rfx::all();

        // Create a new ZipArchive instance
        $zip = new ZipArchive;

        // Define the zip file path
        $zipFilePath = public_path('raw_data.zip');

        // Open the zip file
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            // Add leads data to the zip file
            $this->addToZip($zip, $leadsData, 'leads_data.csv');

            // Add RFQs data to the zip file
            $this->addToZip($zip, $rfqsData, 'rfqs_data.csv');

            // Close the zip file
            $zip->close();

            // Set the appropriate headers for downloading
            $headers = array(
                'Content-Type' => 'application/zip',
                'Content-Disposition' => 'attachment; filename=analytics_data.zip',
            );

            // Return the zip file as a response
            return Response::download($zipFilePath, 'raw_data.zip', $headers);
        } else {
            // If unable to open the zip file, return an error response
            return response()->json(['error' => 'Unable to create zip file'], 500);
        }
    }

    // Helper method to add data to the zip file
    private function addToZip($zip, $data, $fileName)
{
    // Open a temporary file for writing
    $tempFile = tmpfile();

    // Write header row to the temporary file
    fputcsv($tempFile, array_keys($data->first()->toArray()));

    // Write data to the temporary file
    foreach ($data as $row) {
        fputcsv($tempFile, $row->toArray());
    }

    // Move the file pointer to the beginning of the file
    fseek($tempFile, 0);

    // Add the temporary file to the zip archive
    $zip->addFromString($fileName, stream_get_contents($tempFile));

    // Close the temporary file
    fclose($tempFile);
}

}
