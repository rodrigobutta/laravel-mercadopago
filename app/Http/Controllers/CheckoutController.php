<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    
    public function thanks(Request $request)
    {        


        
        return view('checkout.thanks');    
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
