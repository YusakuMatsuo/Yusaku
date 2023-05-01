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
        // dd($req);
        $model = new Product();
        // dd($req->search);
        // dd($req);
        $result = $model -> getSearch($req);
        $resultCompany = $model ->getCompany();

        // dd($result);
        // dd($resultCompany);
        //dd($result);
        // return view('products', ['product' => $result, 'company' => $resultCompany]);
        return response()->json($result);
        // return $result;
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
        $model = new Product();
        $company = $model -> getCompany();
        return view('product_register', ['company' => $company]);

        // return back();
    }
        return redirect(route('regist'));
    }


    //情報削除処理
    
    public function itemDelete($id) {
        DB::beginTransaction();
        try {            
            $model = new Product();
            // $product = $model -> itemDel();
            $model -> itemDelete($id);
            $product = $model -> getAll();
            $company = $model -> getCompany();
            DB::commit();
            return view('products', ['product' => $product, 'company' => $company]);
        } catch(\Exception $e) {
                DB::rollback();
                $model = new Product();
                $product = $model -> getAll();
                $company = $model -> getCompany();
                return view('products', ['product' => $product, 'company' => $company]);
            }
            return redirect(route('product'));
    }

    //商品情報編集(更新)処理
    public function infoUpdate($id, Request $req) {
        $model = new Product();
        DB::beginTransaction();
        try {
            $itemUpdate = $model -> infoUpdate($req);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        $product = $model -> getInfo($req -> id);
        $resultCompany = $model ->getCompany();
        return view('product_editing', ['product' => $product, 'company' => $resultCompany]);
    }

    //降順処理
    public function dataDesc(Request $req){
        // dd($req->id);
        $model = new Product();
        // dd($req->id);
        // $result = $model -> dataDesc();
        // dd($result);
        //降順
        
        //昇順
        if ((substr($req->id,-3) === 'Asc')) {
            // dd(substr($req->id,-3));
            //ソートするカラム名を習得
            $sortname = (substr($req->id,0,-3));
            // dd($sortname);
        } else if ((substr($req->id,-4) === 'Desc')) {
            $sortname = (substr($req->id,0,-4));
        }
        $result = $model->dataDesc();

        return response()->json($result);
    }
    
}