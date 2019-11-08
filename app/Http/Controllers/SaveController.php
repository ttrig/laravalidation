<?php

namespace App\Http\Controllers;

use App\Saved;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class SaveController extends BaseController
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'json' => 'required|json',
        ]);

        $count = Saved::where('ip', $request->getClientIp())
            ->where('created_at', '>', now()->subHour())
            ->count();

        if ($count > 10) {
            abort(422, 'You saved to many entries to fast, try again later.');
        }
        $saved = Saved::create([
            'json' => $request->json,
            'ip' => $request->getClientIp(),
        ]);

        return $saved->hashid;
    }
}
