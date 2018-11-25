<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\ProductApi;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use Mollie\Api\MollieApiClient;
use phpDocumentor\Reflection\DocBlock\Description;


const IDEAL = 'ideal';



class PaymentApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{

            $today = date("Ymd");
            $rand = strtoupper(substr(uniqid(sha1(time())),0,4));
            $orderId = $today.$rand;

            $selectedIssuerId = "ideal_INGBNL2A";
            $currency = "EUR";
            $amount = "100.00";

            $mollie = new MollieApiClient();
            $mollie->setApiKey("test_WD2sWvUWWRqBKfUTy5VS5t8f623ad3");
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "{$currency}",
                    "value" => "{$amount}"
                ],
                "method" => IDEAL,
                "description" => "Order: #{$orderId}",
                "redirectUrl" => "https://hol.agilepixels.com",
               //"webhookUrl"  => "https://webshop.example.org/mollie-webhook/",
                "issuer"      => $selectedIssuerId, // test the issuer
                "metadata" => [
                    "order_id" => $orderId,
                ],
                ]);

            //$payment_status = $mollie->payments->get($_POST["id"]);

            if ($payment->isPaid()) {
                /*
                 * At this point you'd probably want to start the process of delivering the product to the customer.
                 */
                echo ("Payment received ");
            } elseif ($payment->isOpen()) {
                /*
                 * The payment is open.
                 */
                echo ("Payment is open ");
            } elseif ($payment->isPending()) {
                /*
                 * The payment is pending.
                 */
                echo("Payment is pending");
            } elseif ($payment->isFailed()) {
                /*
                 * The payment has failed.
                 */
                echo("Payment has failed.");
            } elseif ($payment->isExpired()) {
                /*
                 * The payment is expired.
                 */
                echo("Payment is expired.");
            } elseif ($payment->isCanceled()) {
                /*
                 * The payment has been canceled.
                 */
                echo("Payment has been canceled.");
            };

            return $payment->getCheckoutUrl();
//            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);


        }

    }
}

