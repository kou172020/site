
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品詳細画面') }}</div>
                <div class="card-body">
    
                <div class="form-group row">
                <div class="table">
                        <table>
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>商品名</th>  
                                    <th>会社名</th>  
                                    <th>数</th>  
                                    <th>価格</th>
                                    <th>コメント</th>
                                    <th>写真</th>
                                    </tr>
                                </thead>
                    
                                <tbody>
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->company->company_name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->price }}</td>    
                                        <td>{{ $product->comment }}</td>
                                        <td> <img src= "{{asset($product->img_path) }}"></td>          
                                        <td><a href="{{ route('edit', ['id'=>$product->id]) }}" class="btn btn-primary">編集</a></td>
                                    </tr>   

                                </tbody>

                        </table>
                </div>

                
                </div>
                <div class="form-group row">
                <a href="{{ route('products') }}" class="btn btn-primary">戻る</a>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>

        @endsection


