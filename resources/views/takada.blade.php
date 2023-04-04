@extends('layouts.app')

@section('content')
        <div>商品一覧です。</div>
        @csrf
        <div><input type="text" name="productName" id="productName">商品名</div>
            <select name="company_select" id="company_select">
                <option value="0">----</option>
                <option value="1">キットカット</option>
                <option value="2">てすた！</option>
                <option value="3">サンプル3</option>
            </select>
            会社名
            <br>
            価格<input type="text" name="priceMax" id="priceMax">上限
            <input type="text" name="priceMin" id="priceMin">下限
            <br>
            在庫<input type="text" name="stockMax" id="stockMax">上限
            <input type="text" name="stockMin" id="stockMin">下限
            <br>
            <input type="button" value="検索" id="searchbutton">

        <a href="{{ route('newproduct') }}"><input type="button" id="create_button" value="新規登録"></a>
        <select name="sortcol" id="sortcol">
            <option value="not">----</option>
            <option value="idAsc">ID↑</option>
            <option value="idDesc">ID↓</option>
            <option value="product_nameAsc">商品名↑</option>
            <option value="product_nameDesc">商品名↓</option>
            <option value="priceAsc">価格↑</option>
            <option value="priceDesc">価格↓</option>
            <option value="stockAsc">在庫数↑</option>
            <option value="stockDesc">在庫数↓</option>
            <option value="company_nameAsc">メーカー名↑</option>
            <option value="company_nameDesc">メーカー名↓</option>
        </select>
        <table id="product">
            <tr id="productTable">
                <th>id</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
            </tr>
            @foreach($product as $product)
            <tr class="dbconect" id="{{$product->products_id}}">
                    <td >{{$product->products_id}}</td>
                    <td ><img src="{{asset('image/'.$product->img_path)}}" height="300" width="300"></td>
                    <td >{{$product->product_name}}</td>
                    <td >{{$product->price}}</td>
                    <td >{{$product->stock}}</td>
                    <td >{{$product->company_name}}</td>
                    <td ><a href="{{ route('productdetails',$product->products_id) }}"><input type="button" value="詳細表示" name="" id="detailbutton"></a><td>
                    <td id="{{$product->products_id}}"><input class="deletebutton" type="button" value="削除"></td>
            </tr>
            @endforeach
        </table>
            <input type="submit" name="" id="">
        </form>

        <script>

        </script>
@endsection