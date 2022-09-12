<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Cart;
use Session;

class CartController extends Controller
{
    public function save_cart(Request $request)
    {

        $data = [
            'id' => $request->id,
            'qty' => $request->quantity,
            'name' => $request->image,
            'price' => $request->price,
            'weight' => '12',
            'options' => [
                'image' => $request->image,
            ],
        ];
       
        Cart::add($data);

        return redirect()->route('home');
    }
    public function show_cart()
    {
        $cart = Cart::content();
        dd($cart);
        //return view('cart.view');
    }

    public function delete_cart($rowId)
    {
        Cart::remove($rowId);

        return redirect()->back();
    }

    public function update_quantity(Request $request, $rowId)
    {
        Cart::update($rowId, $request->input('update_qty'));

        return redirect()->back();
    }
}
