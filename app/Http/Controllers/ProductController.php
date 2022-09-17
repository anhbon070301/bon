<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product_image;
use App\Models\Cart;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const PER_PAGE = 10;
    const PER_PAGE_FRONT = 12;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = [];
        $categories = Category::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        if ( isset($request->searchInput) ) {
            $products = Product::where('name', 'like', '%'.$request->searchInput.'%')->orderBy('sort_order', 'ASC')->paginate(self::PER_PAGE); 
        } else {
            $products = Product::orderBy('sort_order', 'ASC')->paginate(self::PER_PAGE); 
        }
             
        return view('admin/product/show', compact('products', 'categories', 'brands'));
    }

    public function shop()
    {
        $totalMoney = 0;
        $quantity = 0;
        
        if (isset(Auth::user()->id)) {
            $cart = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($cart as $cardId => $cardData) {
                $totalMoney +=  floatval($cardData['product_price']) *  floatval($cardData['quantity']);
                $quantity = $cardId + 1;
            }
        }

        $products = Product::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(self::PER_PAGE_FRONT);   

        return view('web/product/show_all', compact('products'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        return view('admin/product/add',compact('categories', 'brands'));
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
            'category' => 'required',
            'brand' => 'required' ,
            'image' => 'required',
            'name' => 'required|unique:products',
            'price' => 'required' ,
            'old_price' => 'required',
            'description' => 'required',
            'tags' => 'required' ,
            'is_best_sell' => 'required',
            'is_new' => 'required' ,
            'sort_order' => 'required'
        ]);

        $image = $request->file('image');
        $image_name= $image->getClientOriginalName();
        $storedPath = $image->move('images',  $image_name);
            
        $data=[
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'name' => $request->name,
            'image' =>  $image_name,
            'price' => $request->price ,
            'old_price' => $request->old_price,
            'description' => $request->description,
            'tags' => $request->tags ,
            'is_best_sell' => $request->is_best_sell,
            'is_new' => $request->is_new ,
            'sort_order' => $request->sort_order,
            'active' => '1'
        ];
     
        Product::create($data);
       
        return redirect()->route('indexProduct');  
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

        if (isset(Auth::user()->id)) {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($carts as $key => $cartData) {
                $totalMoney +=  floatval($cartData['product_price']) *  floatval($cartData['quantity']);
                $quantity = $key +1;
            }
        }
        $comments = Comment::where('product_id',$id)->orderBy('id','DESC')->paginate(5);
        $product = Product::findorfail($id); 
        $products = [];

        if (isset($request->search)) {
            $products = Product::where('active', self::STATUS_ACTIVE)->where('name','like','%'.$request->search.'%')->orderBy('sort_order', 'ASC')->paginate(2);       
        }else{
            $products = Product::where('active', '<', self::STATUS_DELETED)->where('sort_order','=', 1)->orderBy('sort_order', 'ASC')->get(); 
        }   
        $productTag = Product::where('active', self::STATUS_ACTIVE)->where('tags','like', '%'.$product->tags.'%')->orderBy('sort_order', 'ASC')->paginate(3);  
        $productImg = Product_image::where('active', self::STATUS_ACTIVE)->where('product_id', '=', $product->id)->orderBy('sort_order', 'ASC')->paginate(3);         
        
        return view('web/product/show', compact('products', 'product', 'productTag', 'productImg', 'comments'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }
    
    public function showbyBrand($id)
    {
        $categories = Category::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $products = Product::where('active', '<', self::STATUS_DELETED)->where('brand_id',$id)->orderBy('sort_order', 'ASC')->paginate(2);       
        
        return view('admin/product/show', compact('products','categories','brands'));
    }
    public function showbyCate($id)
    {
        $categories = Category::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $products = Product::where('active', '<', self::STATUS_DELETED)->where('category_id',$id)->orderBy('sort_order', 'ASC')->paginate(2);       
        
        return view('admin/product/show', compact('products', 'categories', 'brands'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $products = Product::find($id);
        $category = Category::find($products->category_id);
        $brand = Brand::find($products->brand_id);

        return view('admin/product/update',compact('categories', 'brands', 'products', 'category', 'brand'));
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
        $validatedData = $request->validate([  
            'category' => 'required',
            'brand' => 'required' ,
            'price' => 'required' ,
            'old_price' => 'required',
            'description' => 'required',
            'tags' => 'required' ,
            'is_best_sell' => 'required',
            'is_new' => 'required' ,
            'sort_order' => 'required'
        ]);

        $image_name ="";
        if ( $request->has('image')) {
            $image = $request->file('image');
            $image_name= $image->getClientOriginalName();  
            $storedPath = $image->move('images',  $image_name); 
        }else{
            $image_name= $request->image_old;;  
        }
       
        $products = Product::find($id);
        $products->category_id  = $request->category;
        $products->brand_id  = $request->brand;
        $products->image = $image_name;
        $products->price = $request->price;
        $products->old_price = $request->old_price;
        $products->description = $request->description;
        $products->tags = $request->tags;
        $products->is_best_sell = $request->is_best_sell;
        $products->is_new = $request->is_new;
        $products->sort_order = $request->sort_order;
        $products->save();

        return redirect()->route('indexProduct');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        $products->active = "2";
        $products->save();

        return redirect()->route('indexProduct');
    }

    public function showbyTag($tag) 
    {
        $totalMoney = 0;
        $quantity = 0;
        
        if ( isset(Auth::user()->id) ) {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($carts as $keyCart => $cartData) {
                $totalMoney +=  floatval($cartData['product_price']) *  floatval($cartData['quantity']);
                $quantity = $keyCart +1;
            }
        }
        $products = Product::where('active', self::STATUS_ACTIVE)->where('tags', 'like', '%'.$tag.'%')->orderBy('sort_order', 'ASC')->paginate(12); 

        return view('web/product/show_all',compact('products'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }

    public function active(Request $request) 
    {
        $product = Product::find($request->id);
        $product->active = $request->status;
        $product->save();
        
        echo($request->status);   
    }

    public function search(Request $request) 
    {
        $categories = Category::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        $output = '';
        $outputJS = '';
        $categoryName = '';
        $brandName = '';
        $check = '';
        $products = Product::where('name', 'like', '%'.$request->key.'%')->where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();
        foreach  ($products as $key => $product) {
            foreach ($brands as $brand) {
                if ($product->brand_id  == $brand->id) {
                    $brandName = $brand->name;
                }
            }
            foreach ($categories as $category) {
                if ($product->category_id   == $category->id) {
                    $categoryName = $category->name;
                }
            }
            if ($product->active == 1) { 
                $check = "checked";
            }else {
                $check = "";
            }
            $output .='<tr>
            <td> '.$key.'</td>
            <td><img src="/phone/public/images/'.$product->image.'" width="100px" alt="Khong tai duoc"></td>
            <td>'.$product->name.'</td>
            <td>'.$brandName.'</td>
            <td>'.$categoryName.'</td>
            <td>'.$product->price.'</td>
            <td>'.$product->old_price.'</td>
            <td>'.$product->is_best_sell.'</td>
            <td>'.$product->is_new.'</td>
            <td>'.$product->sort_order.'</td>
            <input type="hidden" value="'.$product->id.'" class="id" id="idp">
            <td><input type="checkbox" '.$check.' class="toggle" value="'.$product->id.'"  data-id="'.$product->id.'" data-on="On" data-off="Off" data-size="mini"    data-toggle="toggle" data-width="20" data-height="10"></td>
            <td>
                <form method="post" action="">
                    <input value="'.$product->id.'" type="hidden" name="id" id="tenhang">
                    <a class="btn btn-success" href="'.route("editProducts", $product->id).'"> <i class="icon-edit"></i> </a>
                    &emsp;
                    <a class="btn btn-danger" onclick="return confirm("Are you sure you want to delete this item ?");" href="'.route("destroyProducts", $product->id).'"> <i class="icon-trash"></i>
                    </a> &emsp;
                    <a class="btn btn-info" href="'.route("showImage", $product->id).'"> <i class="icon-eye-open"></i> </a>
                    &emsp;
                </form>
            </td>
            </tr>';  
        }
        $outputJS.='
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script type="text/javascript"> 
        $(document).ready(function() {
            $(".toggle").on("change", function() {
                var status = $(this).prop("checked") == true ? 1 : 0;
                var id = $(this).data("id"); 
                $.ajax({
                    url: "'.route('active').'",
                    method: "'.'GET'.'",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        $("#" + result).html(data);
                    },
                });
            });
        });
        </script>';
        echo $output.$outputJS; 
    }
}
