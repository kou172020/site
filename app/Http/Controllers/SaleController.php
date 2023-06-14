<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Companies;
use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product_id = $request->input('product_id');

        $product = Products::find($product_id);

        if ($product) {
            if ($product->stock === 0) {
                return response()->json(['error' => '在庫がありません。'], 400);
            }

            DB::beginTransaction();

            try {
                $sale = new Sale();
                $sale->product_id = $productId;
                $sale->save();

                // Productテーブルのstockの値を1減算
                $product->stock -= 1;
                $product->save();

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => '処理に失敗しました。'], 500);
            }

            return response()->json(['message' => '処理が完了しました。']);
        }

        return response()->json(['error' => '商品が見つかりません。'], 404);
    }

   
}