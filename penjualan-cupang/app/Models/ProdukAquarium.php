<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukAquarium extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'image', 'harga'];
}