<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Companies extends Model
{
    public function product()
    {
        return $this->hasOne('App\Models\Products');
    }
}
