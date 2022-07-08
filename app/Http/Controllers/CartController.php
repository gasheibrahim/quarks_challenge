<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::latest()->paginate(5);

        return view('carts.index',compact('carts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
