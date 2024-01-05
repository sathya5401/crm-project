<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = ['name', 'email', 'phone','address','registration_no',
    'website_url','fax_no','pic','pic_phone','designation','Company'];

}
