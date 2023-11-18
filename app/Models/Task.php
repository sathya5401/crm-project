<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'descrip',  
        'contact',
        'owner',
        'due_date',
        'status',
        'priority',
        'user_id',

    ];
    
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
