<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeanimals extends Model
{
    use HasFactory;
    protected $table= 'tiposanimal';
    public $timestamps =false;
    public $fillable = ['tipo','eliminado'];
}
