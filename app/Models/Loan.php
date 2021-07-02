<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $table = 'loans';
    public $timestamps = false;

    public function myUser(){
        return $this->belongsTo(\App\Models\User::class, 'user', 'id');
    }
}
