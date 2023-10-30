<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFx extends Model
{
    use HasFactory;

    protected $table = 'rfqs';

    protected $fillable = [
        'Company',
        'Pic',  
        'Custom_Name',
        'Custom_Email',
        'Custom_Number',
        'RFQ_number',
        'RFQ_title',
        'Due_date',
        'Quota_mount',
        'Status',
        //Remark
    ];

}
