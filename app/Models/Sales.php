<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Salees extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Products');
    }
}
