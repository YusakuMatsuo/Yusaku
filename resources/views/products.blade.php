<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <title>商品一覧画面</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>
    <!-- 検索 -->
    @csrf
        <!-- メーカー名を選択 -->
        <select name="companySearch">
            <option value = "">企業名選択</option>
             @foreach ($company as $val)
                <option value = "{{ $val -> id }}">{{ $val -> company_name }}</option>
            @endforeach
        </select>

        <input type="text" name="product_name" placeholder = "商品名を入力" id = "product_name">
        <input type="button" name="showProducts" id="showProducts" value="検索">

    <button>ソート</button>


    
    <!-- 商品一覧画面→商品情報登録画面 -->
    <a href="{{route('regist')}}"><button>新規登録</button></a>

    <!-- 商品情報 -->
    <div>
        @foreach($product as $val) 
            <div style = "border : solid; 2px;" class = "dbconnection">
                <div class = "connection">商品ID:{{$val->products_id}}</div>
                <div class = "connection">メーカー名:{{$val -> company_name}}</div>
                <div class = "connection">商品画像:<img src = "{{asset('img/'.$val -> img_path)}}" height = 20px ></div>
                <div class = "connection">商品名:{{$val -> product_name}}</div>
                <div class = "connection">価格:{{$val -> price}}</div>  
                <div class = "connection">在庫数:{{$val -> stock}}</div>
                <div class = "connection"><a href="{{route('itemDelete', $val -> products_id)}}"><input type="button" value="削除"  id = "btn"></a></div>
                <div class = "connection"><a href="{{route('detail', $val -> products_id)}}"><button>詳細表示</button></a></div>
            </div>
        @endforeach

    </div>

    
    
    <script src="{{ asset('/js/deleteAlert.js') }}"></script>
</body>
</html>