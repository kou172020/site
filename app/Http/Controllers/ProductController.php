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
        $price_max = $request->input('price_max');
        $price_min = $request->input('price_min');
        $stock_max = $request->input('stock_max');
        $stock_min = $request->input('stock_min');
    
        $sort_key = $request->input('sort_key'); 
        $sort_order = $request->input('sort_order');

        $query = Products::query();

        if(!empty($company)) {
            $query->where('company_id', 'LIKE', $company);
        }

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        if(!empty($price_max)) {
            $query->where('price', '<=',$price_max );
        }

        if(!empty($price_min)) {
            $query->where('price', '>=',$price_min );
        }

        if(!empty($stock_max)) {
            $query->where('stock', '<=',$stock_max );
        }

        if(!empty($stock_max)) {
            $query->where('stock', '<=',$stock_min );
        }
          



        $company_list = Companies::all();

        $products = $query->get();


        if($request->ajax()) {
            return response()->json([
                'view' => view('tbody')->with(compact('products'))->render()
            ])->header('Content-Type', 'application/json; charset=utf-8');
        } else {
            return view('products', [
                'products' => $products,
                'company' => $company,
                'keyword' => $keyword,
                'sort_key' => $sort_key,
                'sort_order' => $sort_order,
                'company_list' => $company_list,
            ]);
        }
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

    public function submit(ProductRequest $request)
    {

        DB::beginTransaction();
    
        try {

            $model = new Products();
            $model->submitProduct($request);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
           
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


    public function update(ProductRequest $request, $id)
    {
        $product = Products::find($id);
        $company_list = Companies::all();


        DB::beginTransaction();
        
        try {
            $product->updateProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect()->route('products');
    }


    public function delete($id)
    {

        if ($request->ajax()) {

            DB::beginTransaction();

            try {
                
                $product = Products::find($id);
                $product->delete();
                DB::commit();

            } catch (\Exception $e) {
 
                DB::rollback();
                return response()->json(['message' => '削除に失敗しました。']);
            }
            
            return response()->json(['message' => '削除が完了しました。']);
        
        } else {
            return back();
        }

    }


    public function search(Request $request)
    {

         $product = Products::query();


         
    }
}