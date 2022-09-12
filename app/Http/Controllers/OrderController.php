<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order_item;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Category;
use App\Models\Brand;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate = Category::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $band = Brand::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $order = Order::where('status',0)->get();
        return view('admin/order/show',compact('cate','band','order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tinh = Province::find($request->provinces);
        $huyen = District::find($request->districts);
        $xa = Ward::find($request->wards);
        $address = $request->address;
        $diachi = $address.'-'.$xa->name.'-'.$huyen->name.'-'.$tinh->name;
       
        $today = Carbon::today();
        
        $id = $request->idc;
        $cart = Cart::whereIn('id',$id)->get();
        $dataO = [
            'user_id' => $request->user_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'total_money' => $request->total_money,
            'total_products' => $request->total_products,
            'created_date' => $today,
            'address' => $diachi,
            'status' => "0"
        ];
        $order = Order::create($dataO);
       if(isset($order)){
        $customer = Customer::find($request->user_id);
        $customer->name = $request->customer_name;
        $customer->phone = $request->customer_phone;
        $customer->email = $request->customer_email;
        $customer->save();
        foreach ($cart as $c){
           
            $data=[
                'order_id' => $order->id,
                'product_id' => $c->product_id,
                'product_name' => $c->product_name,
                'product_image' => $c->product_image,
                'product_price' => $c->product_price,
                'product_quantity' => $c->quantity
              
            ];
            Order_item::create($data);
        }
        Cart::whereIn('id',$id)->delete();
       }
        
       return redirect()->route('showCart',Auth::user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
    public function update($id)
    {
        $order = Order::find($id);
        $order->status = '1';
        $order->save();
        return redirect()->route('indexOrder');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
