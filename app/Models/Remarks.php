<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remarks extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'inquiry_id'];

    public function inquiry()
{
    return $this->belongsTo(Inquiry::class);
}
}
