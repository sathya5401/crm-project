<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = ['id', 'name', 'email', 'message','status'];
    use HasFactory;
}
