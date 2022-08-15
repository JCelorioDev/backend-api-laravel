<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class animals extends Model
{
    use HasFactory;
    protected $table= 'animales';
    public $timestamps =false;
    public $fillable = ['id_tiposanimal','nombre','imagen','eliminado'];
}
