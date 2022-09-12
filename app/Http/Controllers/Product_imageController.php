<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_image;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Banner;

class Product_imageController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cate = Category::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $band = Brand::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $products = Product::find($id);
        $image = Product_image::where('active', 1)->where('product_id', $id)->orderBy('sort_order', 'ASC')->get();
        return view('admin/img_product/add',compact('products','image','cate','band'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([  
            'sort_order' => 'required' ,
            'image_url' => 'required'
        ]);
        $image = $request->file('image_url');
        $image_name= $image->getClientOriginalName();
        $storedPath = $image->move('images',  $image_name);
            
        $data=[
            'product_id' => $request->product_id,
            'image_url' => $image_name,
            'sort_order'=> $request->sort_order,
            'active'=> "1"
            
        ];
     
        Product_image::create($data);
       
        return redirect()->route('showImage',$request->product_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $product = Product::find($id);
        $images = Product_image::where('active', self::STATUS_ACTIVE)->where('product_id', $id)->orderBy('sort_order', 'ASC')->get();       
        return view('admin/img_product/show',compact('images','product','categories','brands'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$idp)
    {
        $image = Product_image::find($id);
        $image->active = "2";
        $image->save();
        return redirect()->route('showImage',$idp);
    }
  public function home(){
    $banners = Banner::where('active', 1)->orderBy('sort_order', 'ASC')->get();  
    $brands = Brand::where('active', 1)->orderBy('sort_order', 'ASC')->get();
    $best_sell = Product::where('active', 1)->where('is_best_sell',1)->orderBy('sort_order', 'ASC')->paginate(3);
    $new = Product::where('active', 1)->where('is_new',1)->orderBy('sort_order', 'ASC')->paginate(3);
    $products = Product::where('active', 1)->where('is_new',1)->orderBy('sort_order', 'ASC')->get(); 
    
    return view('welcome',compact('banners','products','brands','best_sell','new')); 
  }
}
