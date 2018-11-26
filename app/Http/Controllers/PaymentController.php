<?php

namespace App\Http\Controllers;


use App\Payment;
use Illuminate\Http\Request;
use Mollie\Api\MollieApiClient;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $mollie = new MollieApiClient();
            $mollie->setApiKey("test_WD2sWvUWWRqBKfUTy5VS5t8f623ad3");
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "10.00"
                ],
                "description" => "My first API payment",
                "redirectUrl" => "http://google.com",
            ]);
            return $payment->getCheckoutUrl();
//            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $canceled_payment)
    {
    }
}