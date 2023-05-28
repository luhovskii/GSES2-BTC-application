<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BinanceController extends Controller
{
    const BINANCE_BTCUAH_URL = "https://api.binance.com/api/v3/ticker/price?symbol=BTCUAH";

    /**
     * Fetches the current BTCUAH rate.
     */
    public static function retrieveBtcUahData() {
        return Http::accept('application/json')->
        get( self::BINANCE_BTCUAH_URL );
    }

    /**
     * Responds with the actual BTCUAH rate.
     */
    public function showRate() {
        $response = self::retrieveBtcUahData()->json();

        return response()->json(
            $response['price'],
            200
        );
    }
}
