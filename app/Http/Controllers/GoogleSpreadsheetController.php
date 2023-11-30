<?php
 
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Rfx;
use Sheets;
  
class GoogleSpreadsheetController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        // $sheets = Sheets::spreadsheet('13sEPzmtfPdHeiNwPgeqBPmJ52K07RCFoN7LnQIBgCnI')->sheet('demo1')->get();
        // $header = $sheets->pull(0);
        // $posts = Sheets::collection($header, $sheets);
        // $posts = $posts->take(5000);
        
        // $data = $posts->toArray();

        // if ($data) {
        //     foreach ($data as $key => $value) {
        //         info($value);
        //     }
        // }else{
        //     info('data not found');
        // }
    }

    public function insertDataToSheet()
    {
        // Retrieve data from the Lead model
        $leads = Lead::all();

        // Retrieve data from the RFx model
        $rfqs = RFx::all();

        // Get the Google Sheet
        $spreadsheetId = '13sEPzmtfPdHeiNwPgeqBPmJ52K07RCFoN7LnQIBgCnI';
        
        // Insert data for 'lead' worksheet
        $this->insertDataForWorksheet($spreadsheetId, 'lead', ['name', 'phone_number', 'address', 'title', 'email', 'faxNo', 'inv_address', 'company'], $leads);

        // Insert data for 'rfqs' worksheet
        $this->insertDataForWorksheet($spreadsheetId, 'rfqs', ['Company', 'Custom_Name', 'Custom_Email', 'Custom_Number', 'RFQ_number', 'RFQ_title', 'Due_date', 'Quota_mount', 'Status', 'user_id'], $rfqs);

        return response()->json(['message' => 'Data inserted into Google Sheet successfully']);
    }

    private function insertDataForWorksheet($spreadsheetId, $worksheetName, $header, $data)
    {
        // Get the Google Sheet
        $sheet = Sheets::spreadsheet($spreadsheetId)->sheet($worksheetName);

        // Clear existing content
        $sheet->clear();

        // Add header row
        $sheet->append([$header]);

        // Add data rows
        foreach ($data as $item) {
            $rowData = array_map(function ($field) use ($item) {
                return $item->{$field};
            }, $header);

            $sheet->append([$rowData]);
        }
    }

}