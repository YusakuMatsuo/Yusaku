<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <title>商品一覧画面</title>
    <link href="{{asset('./css/border.css')}}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>
    <!-- 検索 -->
    @csrf
        <!-- メーカー名を選択 -->
        <select name="companySearch" id = "getCompany"> 
            <option value = "">企業名選択</option>
            @foreach ($company as $val)
                <option value = "{{ $val -> id }}">{{ $val -> company_name }}</option>
            @endforeach
        </select>

        <input type="text" name="product_name" placeholder = "商品名を入力" id = "product_name"><br>
        <input type="text" name = "minPrice" placeholder = "" id = "minPrice">円から<br>
        <input type="text" name = "maxPrice" placeholder = "" id = "maxPrice">円まで<br>
        <input type="text" name = "minStock" placeholder = "" id = "minStock">個から<br>
        <input type="text" name = "maxStock" placeholder = "" id = "maxStock">個まで<br>
        <input type="button" value = "id" name = "rowDesc" id ="idAsc" onclick = "dataDesc(this.id)">
        <input type="button" value = "会社id" id ="company_idAsc" onclick = "dataDesc(this.id)">
        <input type="button" value = "商品名" class = "rowDesc" id ="product_nameAsc" onclick = "dataDesc(this.id)">
        <input type="button" value = "価格" name = "rowDesc" id ="priceAsc" onclick = "dataDesc(this.id)">
        <input type="button" value = "在庫" id ="stockAsc" onclick = "dataDesc(this.id)">
        <input type="button" value = "コメント" id ="commentAsc" onclick = "dataDesc(this.id)">
        <input type="button" value = "画像" id ="img_pathAsc" onclick = "dataDesc(this.id)">
        <input type="button" value = "登録日" id ="created_atAsc" onclick = "dataDesc(this.id)">
        <input type="button" value = "更新日" id ="updated_atAsc" onclick = "dataDesc(this.id)"><br>

        <input type="button" name="showProducts" id="showProducts" value="検索">
    
    <!-- 商品一覧画面→商品情報登録画面 -->
    <a href="{{route('regist')}}"><button>新規登録</button></a>

    <!-- 商品情報 -->
    <div>
        @foreach($product as $val) 
            <div class = "dbconnection" id = "dbconnection">
                <div class = "connection" id = "connection">商品ID:{{$val->products_id}}</div>
                <div class = "connection">メーカー名:{{$val -> company_name}}</div>
                <div class = "connection">商品画像:<br><img src = "{{asset('img/'.$val -> img_path)}}" height = 40px ></div>
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