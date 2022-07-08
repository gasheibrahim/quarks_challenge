<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use Paypack\Paypack;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkouts = Checkout::latest()->paginate(5);

        return view('checkouts.index',compact('checkouts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checkouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $paypack = new  Paypack();

        $paypack->config([
        'client_id' => '6353bb6c-feca-11ec-99ff-dead0a7edbde',
        'client_secret' => '44fdea279a9dd9eb94707f808d2a3386da39a3ee5e6b4b0d3255bfef95601890afd80709'
        ]);

        $cashin = $paypack->Cashin([
            'phone' => $request->phone,
            'amount' => $request->amount
        ]);

        $checkout = new Checkout();

        $checkout->phone = $request->phone;
        $checkout->amount = $request->amount;
        $checkout->ref = $cashin['ref'];
        $checkout->status = $cashin['status'];
        $checkout->save();

        return redirect()->route('checkouts.index')
                        ->with('success','Thank you.');
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
    public function destroy($id)
    {
        //
    }
}
