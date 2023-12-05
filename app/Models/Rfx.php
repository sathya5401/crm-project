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
        'Custom_Name',
        'Custom_Email',
        'Custom_Number',
        'RFQ_number',
        'RFQ_title',
        'Due_date',
        'Quota_mount',
        'Status',
        'user_id',
        'rfx_type',
        'remarks',
        'decline',
        'date_award',
        'award_amount',
        // 'document_name',
        // 'document_type',
        // 'file',
    ];

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'file' => 'array',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'rfx_id');
    }
}
