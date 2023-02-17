<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>商品情報詳細画面</title>
</head>
<body>
    <!-- 商品情報詳細画面→商品一覧画面 -->
    <a href="{{route('product')}}"><button>戻る</button></a>
    <!-- 商品情報詳細画面→商品情報編集画面 -->

    <div>
        商品情報ID:{{$product -> products_id}}
        商品画像:<img src = "{{asset('img/'.$product -> img_path)}}" height = 20px >
        商品名:{{$product -> product_name}}
        メーカー:{{$product -> company_name}}
        価格:{{$product -> price}}
        在庫数:{{$product -> stock}}
        コメント:{{$product -> comment}}
    </div>
    <a href="{{route('edit', $product -> products_id)}}"><button>編集</button></a>
</body>
</html>