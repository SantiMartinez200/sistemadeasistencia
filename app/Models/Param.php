<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Param extends Model
{
    use HasFactory;
  protected $fillable = [
    'promote',
    'regular',
    'total_classes',
  ];
}
