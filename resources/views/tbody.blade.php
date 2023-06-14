

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
            </tr>
@endforeach