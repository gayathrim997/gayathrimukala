<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers;

class Client extends Model
{
    use HasFactory;
   
    protected $fillable =['name', 'description','department_id','updated_at', 'created_at' , 'added_by', 'status'];
}
