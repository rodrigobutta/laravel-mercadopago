<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    
    public function thanks(Request $request)
    {        

        $order_id = $request->get('external_reference');
        $collection_id = $request->get('collection_id');
        $preference_id = $request->get('preference_id');
        $merchant_order_id = $request->get('merchant_order_id');

        

        
        return view('checkout.thanks',compact('order_id','collection_id','preference_id','merchant_order_id') );    
    }


    public function pending(Request $request)
    {        
        return view('checkout.pending');    
    }


    public function error(Request $request)
    {        
        return view('checkout.error');    
    }


}
