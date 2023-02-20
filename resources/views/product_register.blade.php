<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>商品情報登録画面</title>
</head>
<body>
    <form action = "{{route('insertProduct')}}" method = "POST">
        @csrf
    商品名<input type="text" name = "product"><br>
    メーカー<select name = "company">
        <option value="0"></option>
        @foreach ($company as $val)
                <option value = "{{ $val -> id }}">{{ $val -> company_name }}</option>
        @endforeach
        </select><br>
    価格<input type="text" name = "price"><br>
    在庫数<input type="text" name = "stock"><br>
    コメント<textarea name = "comment"></textarea><br>
    商品画像<input type = "file" name = "image"><br>
    <input type="submit" value = "登録"></input><br>
   </form>
    <!-- 商品情報登録画面→商品一覧画面 -->
    <a href="{{route('product')}}"><button>戻る</button></a>
</body>
</html>