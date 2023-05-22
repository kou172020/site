<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Companies;
use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
   

    public function index(Request $request)
    {
        $products = Products::with('company')->get();
        $company = $request->input('company');
        $keyword = $request->input('keyword');
    
        $query = Products::query();

        if(!empty($company)) {
            $query->where('company_id', 'LIKE', $company);
        }

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        $company_list = Companies::all();

        $products = $query->get();

        return view('products', [
            'products' => $products,
            'company' => $company,
            'keyword' => $keyword,
            'company_list' => $company_list,
        ]);
    }

    public function create(Request $request)
    {        
        $products = Products::with('company')->get();
        $company_list = Companies::all();

        return view('create', [
            'products' => $products,
            'company_list' => $company_list,
        ]);
    }

    public function submit(Request $request)
    {
        // ディレクトリ名
        $dir = 'img';

        // アップロードされたファイル名を取得
        $file_name = $request->file('img')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('img')->storeAs('public/' . $dir, $file_name);
        
        $path = 'storage/' . $dir . '/' . $file_name;


        Products::create([
            'product_name' => $request->product_name,
            'company_id' => $request->company_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $path,
        ]);
           
         return redirect()->route('create');



    }


    public function show($id)
    {
        $product = Products::find($id);

        return view('show', compact('product'));
    }


    public function edit($id)
    {
        $product = Products::find($id);
        $company_list = Companies::all();
        return view("edit", [
            'products' => $product,
            'company_list' => $company_list,
        ]);
    }


    public function update(Request $request, $id)
    {
        $product = Products::find($id);
        $company_list = Companies::all();


        $file_name = $request->file('img')->getClientOriginalName();

        // 現在の画像へのパスをセット
        $path = $product->img_path;
        if (isset($path)) {
            // 現在の画像ファイルの削除
            \Storage::disk('public')->delete($path);
            // 選択された画像ファイルを保存してパスをセット
            $request->file('img')->storeAs('public/' . 'img', $file_name);

            $path = 'storage/' . 'img' . '/' . $file_name;

        }else{
            $request->file('img')->storeAs('public/' . 'img', $file_name);
            $path = 'storage/' . 'img' . '/' . $file_name;
        }


        $product->update([  
            "product_name" => $request->product_name,  
            "company_id" => $request->company_id,
            "price" => $request->price,
            "stock" => $request->stock,
            "comment" => $request->comment,
            "img_path" => $path,  
        ]); 

        return redirect()->route('products');
    }


    public function delete($id)
    {
        $product = Products::find($id);
        $product->delete();

        return redirect()->route('products');
    }


    public function search(Request $request)
    {
         /* テーブルから全てのレコードを取得する */
         $product = Products::query();


         
    }
}