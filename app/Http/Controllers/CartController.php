<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use DB;
use App\Models\Product;
use App\Models\Ward;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = Cart::where('product_id',$request->product_id )->where('user_id', $request->user_id)->first();;
        
        if(!empty($cart)){
         $newQuantity = $cart->quantity + $request->quantity;
           
           $cart->quantity = $newQuantity;
           $cart->save();
         
        }else{
            $data = [
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_image' => $request->product_image
    
            ];
        
            Cart::create($data);
           
        }
       

        return redirect()->route('showCart',Auth::user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $totalMoney = 0;
        $quantity = 0;
        $products = [];
        if(isset($request->search)){
            $products = Product::where('active', 1)->where('name','like','%'.$request->search.'%')->orderBy('sort_order', 'ASC')->paginate(2);       
        }else{
            $products = Product::where('active', 1)->where('sort_order','=', 1)->orderBy('sort_order', 'ASC')->get(); 
        }
        
        $pro_is_best_sell = Product::where('active', 1)->where('is_best_sell','=', 1)->orderBy('sort_order', 'ASC')->paginate(2); 
        $cart = Cart::where('user_id',$id)->get();
        foreach ($cart as $key => $c){
            $totalMoney +=  floatval($c['product_price']) *  floatval($c['quantity']);
            $quantity = $key + 1;
        }
        return view('web/cart/show',compact('cart','products','pro_is_best_sell'))->with('totalMoney',$totalMoney)->with('quantity',$quantity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cong($id)
    {
        $cart = Cart::find($id);
        $quantity = $cart->quantity + 1 ;
        $cart->quantity = $quantity;
        $cart->save();
        return redirect()->route('showCart',Auth::user()->id);
    }
    public function tru($id)
    {
        $cart = Cart::find($id);
        $quantity = $cart->quantity - 1 ;
        $cart->quantity = $quantity;
        $cart->save();
        return redirect()->route('showCart',Auth::user()->id);
    }
    public function update(Request $request,$id)
    {
        if(isset($request->update_cart))
        {
            $cart = Cart::whereIn('id',$request->idc)->get();

            foreach ($cart as $c){
                $cartU = Cart::find($c->id);
                $cartU->quantity = $request->quantity[$c->id];
                $cartU->save();
            }
            
            return redirect()->route('showCart',Auth::user()->id);
        }else{
            $totalMoney = 0;
            $quantity = 0;
            $products = []; 
            if(isset($request->search)){
                $products = Product::where('active', 1)->where('name','like','%'.$request->search.'%')->orderBy('sort_order', 'ASC')->paginate(2);       
            }else{
                $products = Product::where('active', 1)->where('sort_order','=', 1)->orderBy('sort_order', 'ASC')->get(); 
            }
            
            $provinces = Province::all();
            $pro_is_best_sell = Product::where('active', 1)->where('is_best_sell','=', 1)->orderBy('sort_order', 'ASC')->paginate(2); 
            $cart = Cart::whereIn('id',$request->idc)->where('user_id',$id)->get();
            foreach ($cart as $key => $c){
                $totalMoney +=  floatval($c['product_price']) *  floatval($c['quantity']);
                $quantity = $key +1;
            }
            
            return view('web/order/add',compact('cart','products','pro_is_best_sell','provinces'))->with('quantity',$quantity)->with('totalMoney',$totalMoney);
        }
    }
    public function select_delivery(Request $request){
        $data = $request->all();
        $output = "";
        if($data['action']){
            if($data['action'] == 'provinces'){
                $huyen = District::where('province_id',$data['id'])->get();
                $output.='<option value="">---Chọn Huyện---</option>';
                foreach ($huyen as $h){
                    $output.='<option value="'.$h->id.'">'.$h->name.'</option>';
                }
            }else{
                $xa = Ward::where('district_id',$data['id'])->get();
                $output.='<option value="">---Chọn Xã---</option>';
                foreach ($xa as $x){
                    $output.='<option value="'.$x->id.'">'.$x->name.'</option>';
                }
            }
            echo $output;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->route('showCart',Auth::user()->id);
    }
}
