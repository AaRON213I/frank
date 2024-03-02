<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'frn'; 
    protected $fillable  = ['username', 'password'];
}

