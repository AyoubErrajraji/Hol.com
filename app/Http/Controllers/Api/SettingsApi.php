<?php

namespace App\Http\Controllers\Api;

use App\Settings;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsApi extends Controller
{
    public function show($id)
    {
        return User::with('settings')->find($id);
    }

    public function update(Request $request)
    {
        $settings = Settings::findOrFail($request->id);
        $settings->update([$request->type => !$settings[$request->type]]);

        return response()->json($settings, 200);
    }
}
