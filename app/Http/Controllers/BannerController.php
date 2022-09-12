<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Brand;

class BannerController extends Controller
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
        $banners = Banner::where('active','<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();

        return view('admin/banners/show', compact('banners', 'categories', 'brands'));
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

        return view('admin/banners/add', compact('categories', 'brands'));
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
            'title' => 'required|unique:banners',
            'content' => 'required',
            'sort_order' => 'required',
            'image_url' => 'required'
        ]);

        $image = $request->file('image_url');
        $image_name = $image->getClientOriginalName();
        $storedPath = $image->move('images',  $image_name);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $image_name,
            'sort_order' => $request->sort_order,
            'active' => "1"

        ];
        Banner::create($data);

        return redirect()->route('indexBanners');
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
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $banner = Banner::findOrFail($id);
        
        return view('admin/banners/update', compact('banner', 'categories', 'brands'));
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
            'title' => 'required',
            'content' => 'required',
            'sort_order' => 'required'
        ]);
        
        $image_name = "";
        if ($request->has('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $storedPath = $image->move('images',  $image_name);
        } else {
            $image_name = $request->image_old;;
        }

        $banner = Banner::find($id);
        $banner->title = $request->title;
        $banner->image_url = $image_name;
        $banner->content = $request->content;
        $banner->sort_order = $request->sort_order;
        $banner->save();

        return redirect()->route('indexBanners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banners = Banner::find($id);
        $banners->active = "2";
        $banners->save();

        return redirect()->route('indexBanners');
    }
    public function active(Request $request){
        $p = Banner::find($request->id);
        $p->active = $request->status;
        $p->save();
        echo($request->status);
    }
}
