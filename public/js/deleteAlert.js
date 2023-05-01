// const { sortedLastIndex } = require("lodash");

$(document).on('click', '#btn', function () {
    if(!window.confirm("削除しますか？")) {
        return false;
    }
});


$(document).on('click', '#showProducts', function () {
    let search = $('#product_name').val();
    //取得
    // let getCompany = $('#company_id');
    let companySearch = $('#getCompany').val();
    //console.log(companySearch);

    let minPrice = $('#minPrice').val();//下限価格
    // console.log(minPrice);
    let maxPrice = $('#maxPrice').val();//上限価格
    let minStock = $('#minStock').val();//下限個数
    let maxStock = $('#maxStock').val();//上限個数
    
    // console.log('minPrice:',minPrice);
    // console.log('maxPrice:',maxPrice);
    // console.log('minStock:',minStock);
    // console.log('maxStock:',maxStock);
    // console.log('rowDesc:', rowDesc);

    $.ajax({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        url: 'search',
        type: 'POST',
        data:JSON.stringify
        ({
            search:search,
            companySearch:companySearch,
            minPrice:minPrice,
            maxPrice:maxPrice,
            minStock:minStock,
            maxStock:maxStock,
        }),
        //送る文
        datatype:'json',
        contentType: 'application/json',
    }).done(function(data){
        // console.log('done');
        // console.log(data);
        $("div").remove(".connection");
        // console.log("テスト");

        //var data = JSON.stringify(data);
        // console.log(data.);
        
        //追加分
        //console.log(data);
        //dataの中身 
        //console.log("名前:"+data[0].product_name);
        // $("#products").append('<div class="dbconnection" id = "'+data[0].products_id+'"></div>');
        // $("#products").append('<div class="connection">'+data[0].products_id+'</div>');  

        // console.log(data)
        // console.log("chk1");
        $.each(data,function(index,val){
            //console.log(index);            
            // 要素を指定
            // $("#products").append('<div class="connection" id = "'+val.products_id+'"></div>');
            // $('#products').append('<div class="connection">'+val.products_id+'</div>');  
            Kansu(val);

        })
        //console.log("chk2");
    })

    //ajax失敗
    .fail(function(data){
        console.log('fail');
        //エラー確認
        console.log('error data:'+data);
        console.log('error:'+e);
        return;
    })
});

//test 
// function dataDesc(sort){
//     console.log(sort);
// }

//降順処理

function dataDesc(id){
    // console.log(id);
// $(document).on('click', '#infoDesc', function(){
    //まずは金額から

    // let priceDesc = $('#dataDesc');

    // console.log("priceDesc:");
    // console.log("price:"+priceDesc);

    // console.log("ID取得:"+id);
    
    
    $.ajax({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        url: 'dataDesc',
        type: 'POST',
        data:JSON.stringify
        ({
            id:id
        }),
        //送る文
        datatype:'json',
        contentType: 'application/json',
    }).done(function(data){
        // console.log("done");
        $.each(data,function(index,val){

            Kansu(val);

        })
        //価格で検証、id切り替え
        // let replaceId = document.getElementById('priceAsc').id = 'priceDesc';
        // console.log(replaceId);

        
    })

    //ajax失敗
    .fail(function(data){
        console.log('fail');
        //エラー確認
        console.log('error data:'+data);
        console.log('error:'+e);
        return;
    })
// });
}


function Kansu (val) {
    let text_content = document.getElementById('dbconnection');
    // dbconnection.classList.add('add_content');

    //新しいHTML要素を作成
    let new_content = document.createElement('div');//idつける
    new_content.setAttribute('id', val.products_id);
    // new_content.innerHTML = "商品ID:"+val.products_id + "メーカー名:"+val.company_name + "商品画像:"+val.img_path + "商品名:"+val.product_name + "価格:"+val.price + "在庫数:"+val.stock;
    // var aaa = document.getElementById(val.products_id);
    new_content.innerHTML =   "<div class = connection>商品ID:"+val.products_id+"</div>"
        +"<div class = connection>メーカー名:"+val.company_name+"</div>"
        +"<div class = connection>商品画像:"+val.img_path+"</div>"
        +"<div class = connection>商品名:"+val.product_name+"</div>"
        +"<div class = connection>価格:"+val.price+"</div>"
        +"<div class = connection>在庫数:"+val.stock+"</div>"
        +"<div class = connection><a href={{route('itemDelete', "+val.products_id+"><input type=button value=削除  id = btn></a></div>"
        +"<div class = connection><a href={{route('detail', "+val.products_id+"><button>詳細表示</button></a></div>"
        +"<div class = connection style = border:solid 1px></div>"

     //指定した要素の末尾に挿入
    text_content.appendChild(new_content);
    // text_content.appendChild(_content);
    return;
}
    
//     //高田さん検索機能非同期処理
// $(document).on('click', '#showProducts', function () {
//     // $('#searchbutton').on('click',function(){
//         console.log("----search_func_start----");
//         let productName = $('#productName').val();
//         let company_select = $('#company_select').val();
//         // let priceMax = $('#priceMax').val();
//         // let priceMin = $('#priceMin').val();
//         // let stockMax = $('#stockMax').val();
//         // let stockMin = $('#stockMin').val();
//         // let productName = document.getElementsByName('productName').value;
//         // let company_select = document.getElementsByName('company_select');
//         console.log("get_ok");
//         console.log(productName+":名前");
//         console.log(company_select+":セレクト");
//         console.log("texttest-----------");
//         $.ajax({
//             headers:{
//                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
//             },
//             url: 'search',
//             type: 'POST',
//             data:JSON.stringify({
//                 productName:productName,
//                 company_select:company_select,
//                 // priceMax:priceMax,
//                 // priceMin:priceMin,
//                 // stockMax:stockMax,
//                 // stockMin:stockMin
//             }),
//             datatype:"text",
//             contentType: "application/json",
//             // processData: false,
//         })
//         //ajax成功
//         .done(function(data){
//             console.log('---done---');
//             console.log('中身:'+data);
//             // console.log('data[0].product_name:'+data[0].product_name);
//             $("td").remove(".dbconect");
//             $("tr").remove(".dbconect");
//             console.log("delete");
            
//             //ループテスト
//             $.each(data,function(index,val){
//                 console.log(index);
//                 $("#product").append('<tr class="dbconect" id = "'+val.products_id+'"></tr>');
//                 $('#'+val.products_id).append(
//                     '<td class="dbconect">'+val.products_id+'</td>');
//                 $('#'+val.products_id).append(
//                     '<td class="dbconect"><img src="'+productUrl+'image/'+val.img_path+'" height="300" width="300"></td>');
//                 $('#'+val.products_id).append(
//                     '<td class="dbconect">'+val.product_name+'</td>');
//                 $('#'+val.products_id).append(
//                     '<td class="dbconect">'+val.price+'</td>');
//                 $('#'+val.products_id).append(
//                     '<td class="dbconect">'+val.stock+'</td>');
//                 $('#'+val.products_id).append(
//                     '<td class="dbconect">'+val.company_name+'</td>');
//                 $('#'+val.products_id).append(
//                     '<td class="dbconect"><a href="'+productUrl+'productdetails/'+val.products_id+
//                     ') }}"><input type="button" value="詳細表示" id="detailbutton"></a><td>');
//                 $('#'+val.products_id).append(
//                     '<td class="dbconect" id="'+val.products_id+'">'
//                         +'<input class="deletebutton" type="button" value="削除"></td>');
    
//             });
//         })
//         //ajax失敗
//         .fail(function(data){
//             console.log("fail")
//             console.log("error:"+e);
//             return;
//         })
//     });
    

// //検索機能非同期処理(送る様)
// $(document).on('click', '#searchbutton', function () {
//     //searchbuttonがクリックされた時にこの関数に入る記述をしている
//         console.log("----search_func_start----");
//         //関数に入ったからログ確認
//         let productName = $('#productName').val();
//         //jsを利用し、ID=productNameの中身を取得し、変数productNameに入れている

//         console.log("get_ok");
//         console.log(productName+":名前");
//         //ログ確認
//         console.log("texttest-----------");
//         $.ajax({
//             headers:{
//                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
//             },
//             //構文
//             url: 'productsearch', 
//             //URL(web.phpに記述されているやつ)
//             type: 'POST',
//             //POST or GET
//             data:JSON.stringify({productName:productName}),
//             //送る物 変数dataに送る　型：json 文字列のコード　
//             datatype:"text",
//             //何型で送るか
//             contentType: "application/json",
//             //構文
//         })
//         //ajax成功
//         .done(function(data){
//             console.log('done');
//             //成否判定用ログ
//             $('td').remove('.dbconect');
//             //tdタグのclass=dbconectをHTMLから削除している
//             console.log('delete');
//             //ログ確認

//             $.each(data,function(index,val){
//             //受け渡された配列(data)を繰り返し文でHTMLに反映させる
//                 console.log(index);
//                 //今何回目かログ確認
//                 $('#product').append('<tr class="dbconect" id = "'+val.products_id+'"></tr>');
//                 //tr文をHTML内のテーブルに記述している
//                 $('#'+val.products_id).append('<td class="dbconect">'+val.products_id+'</td>');  
//                 //tr文をHTML内のテーブルに記述している
//             });
//         })
//         //ajax失敗
//         .fail(function(data){
//             console.log('fail');
//             //エラー確認
//             console.log('error:'+e);
//             return;
//         })
//     });