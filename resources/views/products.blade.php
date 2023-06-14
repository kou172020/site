@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品一覧') }}</div>
                
                <div class="card-body">

                <div class="form-group row">
                <form action="{{ route('products') }}" method="GET">
                @csrf
                <div>
                    <label for="">キーワード
                    <div>
                        <input type="text" name="keyword" value="{{ $keyword }}">
                    </div>
                    </label>
                </div>

                <div>
                    <label for="">メーカー
                    <div>
                        <select name="company" data-toggle="select">
                            <option value="">全て</option>
                            @foreach ($company_list as $company)
                            <option value="{{ $company-> id }}">{{ $company->company_name }}</option>    
                            @endforeach

                        </select>
                    </div>
                    </label>
                </div>

                <div>
                    <label for="">価格
                    <div>
                        <input type="number" name="price_min" id="price_min" >
                        {{ __('～') }}
                        <input type="number" name="price_max" id="price_max" >
                    </div>
                    </label>
                </div>

                <div>
                    <label for="">在庫
                    <div>
                        <input type="number" name="stock_min" id="stock_min" >
                        {{ __('～') }}
                        <input type="number" name="stock_max" id="stock_max" >
                    </div>
                    </label>
                </div>

                

                <div>
                    <input type="submit" class="btn btn-primary" value="検索">
                </div>
            </div>
        </form>



                <div class="form-group row">
                <div class="table">
                    <table>
                                <thead>
                                    <tr>
                                    <th><a href="#" data-sort-key="id">ID</a> <i class="fas fa-sort"></i></th>
                                    <th><a href="#" data-sort-key="product_name">商品名</a> <i class="fas fa-sort"></i></th>  
                                    <th><a href="#" data-sort-key="company_id">会社名</a> <i class="fas fa-sort"></i></th>  
                                    <th><a href="#" data-sort-key="stock">在庫数</a> <i class="fas fa-sort"></th>  
                                    <th><a href="#" data-sort-key="price">価格</a> <i class="fas fa-sort"></i></th>
                                    <th>コメント</th>
                                    <th>写真</th>
                                    </tr>
                                </thead>
                    
                                <tbody id=product_table>
            
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->company->company_name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->price }}</td>    
                                        <td>{{ $product->comment }}</td>  
                                        <td> <img src= "{{asset($product->img_path) }}" width =100px></td>    

                                        <td>
                                            <a href="{{ route('show', ['id'=>$product->id]) }}" class="btn btn-primary">詳細</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('delete', ['id'=>$product->id]) }}" method="POST">
                                            @csrf
                                                <button type="submit" class="btn btn-primary" onclick='return confirm("削除しますか？");'>削除</button>
                                            </form>
                                        </td>
                                    @endforeach
                                </tbody>
                            </table>

                            </div>
                        </div>
                        </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <a href="{{ route('create') }}" class="btn btn-primary" >登録</a>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

