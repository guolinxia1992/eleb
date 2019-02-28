<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //商家列表
    public function businessList()
    {
        $keyword = $_GET['keyword']??'';
        $shop = Shop::all();
        if($keyword){
            $shop = Shop::where('shop_name','like',"%$keyword%")->get();
        }
        return $shop;
    }

    public function business()
    {
        $id = $_GET['id'];
//        dd($id);
        $shops = Shop::find($id);
        $menucategories = MenuCategory::where('shop_id','=',$id)->get();
        foreach ($menucategories as $menucategory){
            $menucategory['goods_list'] = Menu::where('category_id','=',$menucategory->id)->get();
        }
        $shops['commodity'] = $menucategories;

        return $shops;
    }
}
