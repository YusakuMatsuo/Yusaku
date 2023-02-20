<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>商品情報編集画面</title>
</head>
<body>
    <!-- 商品情報編集画面→商品情報詳細画面 -->
    <a href="{{route('detail',$product->products_id)}}"><button>戻る</button></a>

    <!-- 更新フォーム -->
    <form action = "{{route('infoUpdate',$product->products_id)}}" method = "POST">
        @csrf
    商品ID:{{$product->products_id}}
    商品名<input type="text" name = "product" value= "{{$product -> product_name}}"><br>

    メーカー<select name = "company">
        @foreach ($company as $val)
        @if($val -> id == $product->company_id) 
            <option value="{{$val -> id}}" selected>{{$val -> company_name}}</option>
        @else
            <option value="{{$val -> id}}">{{$val -> company_name}}</option>
        @endif

        @endforeach
        </select><br>
        
    価格<input type="text" name = "price" value = "{{$product -> price}}"><br>
    在庫数<input type="text" name = "stock" value = "{{$product -> stock}}"><br>
    コメント<textarea name = "comment" value = "{{$product -> comment}}">{{$product -> comment}}</textarea><br>
    商品画像<input type = "file" name = "img_path" value = "{{$product -> img_path}}"><br>
    <input type="submit" value = "更新"></input><br>
   </form>
</body>
</html>
