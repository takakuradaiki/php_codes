<?php

namespace xampp\htdocs\php_codes\babanuki\normal_babanuki;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\r\Request;

class BabaNukiController extends Controller
{
    public function init(Request $request)
    {
        $deck = $this->getTrump();
    }

    private function getTrump()
    {
        $suits = array(
            "♠",
            "♥",
            "☘",
            "♦",
        );

        $faces = [];
        for ($i = 2; $i < 11; $i++) {
            $faces[] = $i;
        }
        $faces[] = 'J';
        $faces[] = 'Q';
        $faces[] = 'K';
        $faces[] = 'A';

        $deck = [];

        foreach ($suits as $suit) {
            foreach ($faces as $key => $face) {
                $deck[] = "$suit $face";
            }
        }
        array_push($deck, 'joker 14');
        shuffle($deck);
        return $deck;
    }
}
