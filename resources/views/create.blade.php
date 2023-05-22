

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品登録画面') }}</div>
                <div class="card-body">
                    <form action="{{ route('submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('名前') }}</label> 
                            <div class="col-md-6">       
                                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Name">
                        
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('メーカー') }}</label>
                
                            <div class="col-md-6">
                                <select class="form-control" id="company_id" name="company_id">
                                    @foreach ($company_list as $company)
                                   <option value="{{ $company-> id }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="stock" class="col-md-4 col-form-label text-md-right">{{ __('数') }}</label>
                
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="stock" name="stock" placeholder="0">
                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="price"class="col-md-4 col-form-label text-md-right">{{ __('価格') }}</label>
                
                            <div class="col-md-6">
                                <input class="form-control" id="price" name="price" placeholder="Price"></input>
                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="comment"class="col-md-4 col-form-label text-md-right">{{ __('コメント') }}</label>
            
                            <div class="col-md-6">
                                <textarea class="form-control" id="comment" name="comment" placeholder="Comment"></textarea>
                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="img_path"class="col-md-4 col-form-label text-md-right">{{ __('写真') }}</label>
                
                            <div class="col-md-6">
                                <input type="file" id="img" name="img" class="form-control"></input>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">送信</button>
                        <button type="button" class="btn btn-primary" onclick="location.href='/products'">戻る</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        

@endsection
