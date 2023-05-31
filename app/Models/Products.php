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

    public function submitProduct($request)
    {
        // ディレクトリ名
        $dir = 'img';

        // アップロードされたファイル名を取得
        $file_name = $request->file('img')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('img')->storeAs('public/' . $dir, $file_name);
        
        $path = 'storage/' . $dir . '/' . $file_name;


        DB::table('product')->insert([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $path,
        ]);

    }

    public function updateProduct($request)
    {

        $file_name = $request->file('img')->getClientOriginalName();

        $path = $product->img_path;
        if (isset($path)) {
            
            \Storage::disk('public')->delete($path);
          
            $request->file('img')->storeAs('public/' . 'img', $file_name);

            $path = 'storage/' . 'img' . '/' . $file_name;

        }else{
            $request->file('img')->storeAs('public/' . 'img', $file_name);
            $path = 'storage/' . 'img' . '/' . $file_name;
        }

        $this->img_path = $path;

        $this->product_name = $request->input('product_name');
        $this->company_id = $request->input('company_id');
        $this->price = $request->input('price');
        $this->stock = $request->input('stock');
        $this->comment = $request->input('comment');



        $this->save();

    }

}
