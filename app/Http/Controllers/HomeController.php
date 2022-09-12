<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Charts\ProductsChart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalMoney = 0;
        $quantity = 0;
        
        $cart = Cart::where('user_id',Auth::user()->id)->get();
            foreach ($cart as $key => $c){
                $totalMoney +=  floatval($c['product_price']) *  floatval($c['quantity']);
                $quantity = $key +1;
            }
        $banners = Banner::where('active', 1)->orderBy('sort_order', 'ASC')->get();  
        $brands = Brand::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $best_sell = Product::where('active', 1)->where('is_best_sell',1)->orderBy('sort_order', 'ASC')->paginate(3);
        $new = Product::where('active', 1)->where('is_new',1)->orderBy('sort_order', 'ASC')->paginate(3);
        $products = Product::where('active', 1)->where('is_new',1)->orderBy('sort_order', 'ASC')->get(); 

        return view('home',compact('banners','products','brands','best_sell','new'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }


}
