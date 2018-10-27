<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'email_on_outbit', 'email_on_closed_watchlistitem', 'email_on_bid_for_your_ad',
    ];

    protected $casts = ['email_on_outbit' => 'boolean', 'email_on_closed_watchlistitem' => 'boolean', 'email_on_bid_for_your_ad' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
