<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests\productRequest;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    //商品情報を全て引っ張ってくる
    public function getAll() {
        $result = \DB::table('products') 
        -> select(
            'products.id as products_id',
            'company_id',
            'product_name',
            'price',
            'stock',
            'comment',
            'img_path',
            'company_name'
        ) 
        -> leftjoin('companies', 'companies.id','=', 'products.company_id') ->get();    // 全件表示状態
        return $result;
    }

    //情報検索処理
    public function getSearch($req) {
        //dd($req->search);
        $search = \DB::table('products')
        // likeで部分一致検索が可能になる
        -> select(
            'products.id as products_id',
            'company_id',
            'product_name',
            'price',
            'stock',
            'comment',
            'img_path',
            'company_name',
        ) 
        -> leftjoin('companies', 'companies.id','=', 'products.company_id');
        if($req -> search){
            //
            $search -> where('product_name',"LIKE", '%'.$req -> search.'%');
        }
        if($req -> companySearch) {
            $search -> where('company_id',$req -> companySearch);
        }
        $search = $search -> get();
        return $search;//$result;
    }

    //企業名を引っ張ってくる
    public function getCompany() {
        $resultCompany = \DB::table('companies')->get();
        return $resultCompany;
    }

    //新規商品登録
    public function newProduct($req) {
        $query = \DB::table('products');
        $insertProduct = $query -> insert([
            'product_name' => $req -> product,
            'company_id' => $req -> company,
            'price' => $req -> price,
            'stock' => $req -> stock,
            'comment' => $req -> comment,
            'img_path' => $req -> image,
            ]);
        return;
    }

    //商品情報削除
    public function itemDelete($id){
        $query = \DB::table('products');
        $itemDelete = $query -> where('id', '=', $id) -> delete();
        return;
    }

    //商品詳細表示処理
    public function getInfo($id) {
        $query = \DB::table('products');
        $getInfo = $query 
        -> select(
            'products.id as products_id',
            'company_id',
            'product_name',
            'price',
            'stock',
            'comment',
            'img_path',
            'company_name'
        ) 
        -> leftjoin('companies', 'companies.id','=', 'products.company_id') 
        -> where('products.id', $id) 
        -> first();
        return $getInfo;
    }

    //商品情報編集(更新)処理
    public function infoUpdate(Request $req) {
        $query = \DB::table('products');
        $query -> where('id', $req -> id)
        -> update([
            'company_id' => $req -> company,
            'product_name' => $req -> product,
            'price' => $req -> price,
            'stock' => $req -> stock,
            'comment' => $req -> comment,
            'img_path' => $req -> img_path,
        ]);
        return;
    }

    
        //高田さん
    //検索機能
    public function getSearchQuery(Request $req) {
        // dd($req->productName);
        $product = \DB::table($this->table)->select(
            'products.id as products_id',
            'company_id',
            'product_name',
            'price',
            'stock',
            'comment',
            'img_path',
            'company_name'
        );

        // if($req->productName){
        //     // dd($req->productName);
        //     $product->where('product_name',$req->productName);
        // }else if($req->stockMin && $req->stockMax){
        //     // dd($req->stockMin);
        //     $product->where('stock','>=',$req->stockMin)
        //     ->where('stock','=<',$req->stockMax);
        // }else if($req->priceMax && $req->priceMin){
        //     // dd($req->priceMax);
        //     $product->where('price','=<',$req->priceMin)
        //     ->where('price','>=',$req->priceMax);
        // }else {
        //     // dd($req->company_select);
        //     $product->where('companies.id',$req->company_select);
        // }

        if($req->productName){
            // dd($req->productName);
            $product = $product->where('product_name',$req->productName);
        }
        // if($req->stockMin && $req->stockMax){
        //     // dd($req->stockMin);
        //     $product->where('stock','<=',$req->stockMax)
        //     ->where('stock','>=',$req->stockMin);
        // }
        // if($req->priceMax && $req->priceMin){
        //     // dd($req->priceMax,$req->priceMin);
        //     $product->where('price','<=',$req->priceMax)
        //     ->where('price','>=',$req->priceMin);
        // }
        if($req->company_select && $req->company_select != 0){
            // dd($req->company_select);
            $product->where('companies.id',$req->company_select);
        }
        // dd($product->toSql());
        $product = $product->leftjoin('companies','companies.id','=','products.company_id')->get();
        // dd($product[0]->stock);
        return $product;
    }
}
