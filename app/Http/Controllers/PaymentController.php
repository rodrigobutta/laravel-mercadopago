<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\PreOrder;

class PaymentController extends Controller
{

    public function pay(Request $request)
    {        

        $preOrder = new PreOrder();

        $preOrder->billing_email = "rbutta@gmail.com";

        $preOrder->save();
        
        return $this->createOrder($preOrder, $request);    
    }


    public function ipn(Request $request)
    {        
        return view('checkout.ipn'); 
    }


    public function createOrder(PreOrder $preOrder, Request $request)
    {
        $allowedPaymentMethods = config('payment-methods.enabled');

        // $request->validate([
        //     'payment_method' => [
        //         'required',
        //         Rule::in($allowedPaymentMethods),
        //     ],
        //     'terms' => 'accepted',
        // ]);

        $order = $this->setUpOrder($preOrder, $request);

        // $this->notify($order);

        $url = $this->generatePaymentGateway(
            $request->get('payment_method'), 
            $order
        );
        return redirect()->to($url);
    }

    protected function generatePaymentGateway($paymentMethod, Order $order) : string
    {
        $method = new \App\PaymentMethods\MercadoPago;

        return $method->setupPaymentAndGetRedirectURL($order);
    }


    protected function setUpOrder(PreOrder $preOrder, Request $request) : Order
    {
        $order = new Order;

        $order->preorder()->associate($preOrder);

        $order->title = "Titulo de la compra";
        $order->total_price = 100;
        $order->featured_img = "https://laravel.com/img/logomark.min.svg";

        $order->save();    
        
        
        // dd($order);


        return $order;
    }



}
