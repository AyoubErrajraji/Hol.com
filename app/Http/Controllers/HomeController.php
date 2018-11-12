<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $orders = Order::with('payment', 'products')->get();
        $products = Product::all();

        $topCards[0] = 0;
        foreach ($products as $product) {
            if ($product->active){
                $topCards[0]++;
            }
        }

        $topCards[1] = 0;
        foreach ($products as $product) {
            if (!$product->active){
                $topCards[1]++;
            }
        }

        $topCards[2] = $users->count();

        $topCards[3] = 0;
        foreach ($orders as $order){
            foreach ($order->products as $product) {
                $topCards[3] += ($product->price * $product->pivot->amount);
            }
        }

        $ordersPerMonth = Order::select(DB::raw("(COUNT(*)) as order_amount"))
            ->where('created_at', '>', new \DateTime(date('Y-01-01')) )
            ->orderBy('created_at')
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get();
        $monthlyRecapReport = [];
        foreach ($ordersPerMonth as $index => $month){
            $monthlyRecapReport[$index] = $month->order_amount;
        }
        $monthlyRecapReport = json_encode($monthlyRecapReport);

        return view('dashboard', compact('topCards', 'monthlyRecapReport'));
    }
}
