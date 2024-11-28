<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    // Engedélyezett mezők tömeges hozzárendeléshez
    protected $fillable = ['title', 'text', 'user_id'];

}
