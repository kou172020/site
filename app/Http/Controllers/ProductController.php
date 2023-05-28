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
        DB::beginTransaction();

            try {
                
                $product = Products::find($id);
                $product->delete();
                DB::commit();

            } catch (\Exception $e) {
 
                DB::rollback();
                
            }

        return redirect()->route('products');
    }


    public function search(Request $request)
    {

         $product = Products::query();


         
    }
}