<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\productRequest;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    //商品一覧画面表示
    public function productView () {
        $model = new Product();
        $product = $model -> getAll();
        $company = $model -> getCompany();
        // dd($product);
        // dd($company);
         return view('products', ['product' => $product, 'company' => $company]);
    }

    //商品詳細情報画面
    public function productDetailView ($id) {
        $model = new Product();
        $product = $model -> getInfo($id);
        return view('product_detail', ['product' => $product]);
    }

    //商品詳細編集画面
    public function productEditView ($id) {
        $model = new Product();
        $product = $model -> getInfo($id);
        $resultCompany = $model ->getCompany();
        // dd($product);
        return view('product_editing', ['product' => $product, 'company' => $resultCompany]);
    }

    //商品情報登録画面
    public function productRegistView () {
        $model = new Product();
        $company = $model -> getCompany();
        return view('product_register', ['company' => $company]);
    }

    //商品の検索結果を表示
    public function getSearch(Request $req) {
        $model = new Product();
        // dd($req->search);
        $result = $model -> getSearch($req);
        $resultCompany = $model ->getCompany();
        // dd($result);
        return view('products', ['product' => $result, 'company' => $resultCompany]);
    }








    //商品の新規登録

    public function insertProduct(Request $req) {
        DB::beginTransaction();

        try{
        // dd($req->img_path);
        $model = new Product();
        $company = $model -> getCompany();
        $InsertProduct = $model -> newProduct($req);
        DB::commit();
        return view('product_register', ['company' => $company]);
    } catch(\Exception $e) {
        DB::rollback();
        return back();
    }
        return redirect(route('regist'));
    }



    //情報削除処理
    public function itemDelete($id) {
        $model = new Product();
        // $product = $model -> itemDel();
        $model -> itemDelete($id);
        $product = $model -> getAll();
        $company = $model -> getCompany();
        return view('products', ['product' => $product, 'company' => $company]);
    }

    //商品情報編集(更新)処理
    public function infoUpdate($id, Request $req) {
        $model = new Product();
        $itemUpdate = $model -> infoUpdate($req);
        $product = $model -> getInfo($req -> id);
        $resultCompany = $model ->getCompany();
        return view('product_editing', ['product' => $product, 'company' => $resultCompany]);
    } 
}