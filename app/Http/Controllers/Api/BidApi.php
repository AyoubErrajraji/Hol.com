<?php

namespace App\Http\Controllers\Api;

use App\Bid;
use App\Events\BidSentEvent;
use App\Mail\Newbid;
use App\Mail\Outbid;
use App\Ad;
use App\Settings;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BidApi extends Controller
{
    public function index()
    {
        return Bid::where('active', 1)->get();
        // TODO Page to ban certain bids
    }

    public function show($id)
    {
        return Bid::find($id);
    }

    public function store(Request $request)
    {
        $ad = Ad::with('bid')->find($request->on_id);
        $latestBid = isset($ad->bid[0]) ? $ad->bid[0] : $ad;
        $newBid = $request->all();

        if ($newBid['price'] > $latestBid->price) {

            // Save new bid to database
            $bid = Bid::create($request->all());
            event(new BidSentEvent($bid, User::find($request->by_id)));

            // Send outbid mail to old champion
            if ($newBid['by_id'] != $latestBid->by_id) {
                //Mail::to(User::find($latestBid->by_id))->send(new Outbid($ad));
            }

            // Send newbid mail to ad owner
            $owner = User::findOrFail($ad->user_id);
            $owner_settings = Settings::where('user_id', $owner->id)->first();
            if($owner_settings->email_on_bid_for_your_ad){
                //Mail::to($owner)->send(new Newbid($ad));
            }

            $bid->champion_mail_send = $newBid['by_id'] != $latestBid->by_id;
            $bid->owner_mail_send = $owner_settings->email_on_bid_for_your_ad;

            return response()->json($bid, 201);

        } else {
            return response()->json([
                'error' => 'Er is al een hoger bod geplaatst'
            ], 406);
        }
    }

    public function update(Request $request, Bid $bid)
    {
        $bid->update($request->all());

        return response()->json($bid, 200);
    }

    public function delete(Bid $bid)
    {
        $bid->delete();

        return response()->json(null, 204);
    }
}
