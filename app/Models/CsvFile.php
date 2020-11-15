<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvFile extends Model
{
    use HasFactory;


    public function belongsToUser() {
        return $this->belongsTo('App\Models\User');
    }

}
