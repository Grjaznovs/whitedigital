<?php

namespace App\Http\Controllers;

use \NumberFormatter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhitedigitalController extends Controller {
    public static function convert_number_to_words(int $number) {
        $declination = [
            'tūkstoši',
            'simti'
        ];
        $dictionary  = [
            0 => 'nulle',
            1 => 'viens',
            2 => 'divi',
            3 => 'trīs',
            4 => 'četri',
            5 => 'pieci',
            6 => 'seši',
            7 => 'septiņi',
            8 => 'astoņi',
            9 => 'deviņi',
            10 => 'desmit',
            11 => 'vienpadsmit',
            12 => 'divpadsmit',
            13 => 'trīspadsmit',
            14 => 'četrpadsmit',
            15 => 'piecpadsmit',
            16 => 'sešpadsmit',
            17 => 'septiņpadsmit',
            18 => 'astoņpadsmit',
            19 => 'deviņpadsmit',
            20 => 'divdesmit',
            30 => 'trīsdesmit',
            40 => 'četrdesmit',
            50 => 'piecdesmit',
            60 => 'sešdesmit',
            70 => 'septiņdesmit',
            80 => 'astoņdesmit',
            90 => 'deviņdesmit',
            100 => 'simts',
            1000 => 'tūkstotis'
        ];

        $text = '';
        if ($number < 21) {
            $text = $dictionary[$number];
        } elseif ($number < 100) {
            $tens = ((int) ($number / 10)) * 10;
            $text = $dictionary[$tens];
            $units = $number % 10;
            if ($units) {
                $text .= ' '.$dictionary[$units];
            }
        } elseif ($number < 1000) {
            $hundreds = (int) ($number / 100);
            $is_declination = $hundreds == 1 ? $dictionary[100] : $declination[1];
            $text = $dictionary[$hundreds].' '.$is_declination;
            $remainder = $number % 100;
            if ($remainder) {
                $text .= ' '.Self::convert_number_to_words($remainder);
            }
        } else {
            $baseUnit = (int) pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $is_declination = $numBaseUnits == 1 ? $dictionary[$baseUnit] : $declination[0];
            $text = Self::convert_number_to_words($numBaseUnits).' '.$is_declination;
            if ($remainder) {
                $text .= ' '.Self::convert_number_to_words($remainder);
            }
        }

        return $text;
    }

    public function index(Request $request) {
        if (!ctype_digit($request->number) || $request->number < 0 || $request->number > 9999 || !in_array($request->lang, ['lat', 'eng'])) {
            abort(400, '400 Bad Request');
        }

        if ($request->lang == 'eng') {
            $fmt = new NumberFormatter('en', NumberFormatter::SPELLOUT);
            $text = $fmt->format($request->number);
        } elseif ($request->lang == 'lat') {
            $text = $this->convert_number_to_words($request->number);
        }

        $list = [
            'text' => $text
        ];

        return view('whitedigital/index', $list);
    }
}