<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvFile extends Model
{
    protected $fillable = [
        'name',
        'csv_file',
        'user_id'
    ];


    public function belongsToUser() {
        return $this->belongsTo('App\Models\User');
    }

}
