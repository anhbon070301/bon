<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Customer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Charts\ProductsChart;
use App\Models\Order_item;
use App\Models\Order;
use App\Models\Comment;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function signup()
    {
        return view('auth/login');
    }
    public function home()
    {
        $productsChart = new ProductsChart;
        $productsChart->labels(['Jan', 'Feb', 'Mar']);
        $productsChart->dataset('Products by trimester', 'line', [10, 25, 13]);
        $categories = Category::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $order = Order_item::groupBy('product_name')->groupBy('product_id')->select('product_name','product_image', Order_item::raw('sum(product_quantity) as total'))->orderBy('total', 'desc')->paginate(3);
        $or = Order::orderBy('total_money','DESC')->paginate(5);
        $comment = Comment::orderBy('id','DESC')->paginate(5);
        return view('admin/home', [ 'productsChart' => $productsChart ] ,compact('categories','brands','order','or','comment'));
        
    }
    public function index()
    {
        $cate = Category::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $band = Brand::where('active', 1)->orderBy('sort_order', 'ASC')->get();
        $user = User::where('active', 1)->paginate(5);       
        return view('admin/user/show', compact('user','cate','band'));
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // $name = $data['lastname']."".$data['firstname'];
        $dataCustomer = [
            'active'=> "1",
        ];
        Customer::create($dataCustomer);
        $name = $data['name'].' '.$data['firstname'];
        return User::create([
            'username' => $name,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'active' => "1",
        ]);
    }
}
