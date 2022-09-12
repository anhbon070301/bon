<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;


class BrandController extends Controller
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
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brandList = Brand::where('active', '<', 2)->orderBy('sort_order', 'ASC')->get();       
        
        return view('admin/brands/show', compact('brands','categories','brandList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Category::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $band = Brand::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        return view('admin/brands/add',compact('cate','band'));
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
            'name' => 'required|unique:brands',
            'sort_order' => 'required' ,
            'image_url' => 'required'
        ]);
        $image = $request->file('image_url');
        $image_name= $image->getClientOriginalName();
        $storedPath = $image->move('images',  $image_name);
            
        $data=[
            'name' => $request->name,
            'image_url' => $image_name,
            'link' => $request->link,
            'sort_order'=> $request->sort_order,
            'active'=> "1"
            
        ];
     
        Brand::create($data);
       
        return redirect()->route('showBrand');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate = Category::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $band = Brand::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::findOrFail($id);
         return view('admin/brands/update' ,compact('brands','cate','band'));
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
            'name' => 'required',
            'sort_order' => 'required' 
        ]);
        $image_name ="";
        if( $request->has('image')){
            $image = $request->file('image');
            $image_name= $image->getClientOriginalName();  
            $storedPath = $image->move('images',  $image_name); 
        }else{
          
            $image_name= $request->image_old;;  
        }
       
        $brands = Brand::find($id);
        $brands->name = $request->name;
        $brands->image_url = $image_name;
        $brands->link = $request->link;
        $brands->sort_order = $request->sort_order;
        $brands->save();

        return redirect()->route('showBrand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brands = Brand::find($id);
        $brands->active = "2";
        $brands->save();
        return redirect()->route('showBrand');
    }
    public function active(Request $request){
        $p = Brand::find($request->id);
        $p->active = $request->status;
        $p->save();
        echo($request->status);
        
    }
}
