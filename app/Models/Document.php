<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['document_name', 'document_type', 'file', 'rfx_id'];

    // Define the relationship with the Rfx model
    public function rfx()
    {
        return $this->belongsTo(Rfx::class, 'rfx_id');
    }
}
