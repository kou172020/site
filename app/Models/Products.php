<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    protected $fillable = [
        'product_name',
        'company_id',
        'price',
        'stock',
        'comment',
        'img_path',
    ]; //保存したいカラム名

    public function company()
    {
        return $this->belongsTo('App\Models\Companies');
    }

    public function sale()
    {
        return $this->hasOne('App\Models\Sales');
    }
}
