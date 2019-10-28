<?php

namespace App\PaymentMethods;

use App\Order;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;

class MercadoPago
{
    public function __construct()
    {
        SDK::setClientId(
            config("payment-methods.mercadopago.client")
        );
        SDK::setClientSecret(
            config("payment-methods.mercadopago.secret")
        );
    }


    public function setupPaymentAndGetRedirectURL(Order $order): string
    {
        # Create a preference object
        $preference = new Preference();

        # Create an item object
        $item = new Item();
        $item->id = $order->id;
        $item->title = $order->title;
        $item->quantity = 1;
        $item->currency_id = 'ARS';
        $item->unit_price = $order->total_price;
        $item->picture_url = $order->featured_img;

        # Create a payer object
        $payer = new Payer();
        $payer->email = $order->preorder->billing_email;
        $payer->name = "Charles";
        $payer->surname = "Luevano";
        $payer->date_created = "2018-06-02T12:58:41.425-04:00";
        $payer->phone = array(
            "area_code" => "",
            "number" => "949 128 866"
        );
        $payer->identification = array(
            "type" => "DNI",
            "number" => "12345678"
        );
        $payer->address = array(
            "street_name" => "Cuesta Miguel Armendáriz",
            "street_number" => 1004,
            "zip_code" => "11020"
        );



        # Setting preference properties
        $preference->items = [$item];
        $preference->payer = $payer;

        # Save External Reference
        $preference->external_reference = $order->id;
        $preference->back_urls = [
            "success" => route('checkout.thanks'),
            "pending" => route('checkout.pending'),
            "failure" => route('checkout.error'),
        ];

        $preference->auto_return = "all";
        $preference->notification_url = route('ipn');
        # Save and POST preference
        $preference->save();

        if (config('payment-methods.use_sandbox')) {
            return $preference->sandbox_init_point;
        }

        return $preference->init_point;
    }

    
}
