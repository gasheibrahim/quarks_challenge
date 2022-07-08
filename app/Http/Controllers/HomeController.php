<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function show($id)
    {
        $product = Product::find($id);
        return view('buy',compact('product'));
    }

    public function addcart(request $request ,$id)
    {
        if(Auth::id())
        {
            $user=auth()->user();

            $product=product::find($id);

            $cart=new cart;

            $cart->name=$user->name;
            $cart->product_name=$product->product_name;
            $cart->price=$product->price;
            $cart->quantity = $request->quantity;

            $cart->save();

            return view('checkouts.create');
        }
        else
        {
            return redirect('login');
        }
    }
}
