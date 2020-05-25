<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;

class QuoteController extends Controller
{
    //
    public function index($id) {
        $customer = json_decode($this->chancecustomer($id));
        $customer_name = $customer->customer_name;

        return view('quote', ['customer_name' => $customer_name]);
    }

    public function count(Request $request) {
        $word_length = $request->word_length;
        $word_width = $request->word_width;
        $c_word_count = $request->c_word_count;
        $c_word_height = $request->c_word_height;
        $eb_word_count = $request->eb_word_count;
        $eb_word_height = $request->eb_word_height;
        $e_word_count = $request->e_word_count;
        $e_word_height = $request->e_word_height;
        $use_type = $request->use_type;
        $other_price = $request->other_price;
        $id = $request->id;
        $use_half = $request->use_half;
        $use_script = $request->use_script;
        $discount = $request->discount ? $request->discount : 100;
        $c_price = 0;
        $eb_price = 0;
        $e_price = 0;
        $rubber_price = 0;
        $resin_price = 0;

        $customer = json_decode($this->chancecustomer($id));
        $customer_config = $customer->customer_config;
        $customer_name = $customer->customer_name;
        //橡膠版rubber
        if ($c_word_count > 0)
            $c_price = $this->c_price_word($c_word_height, $customer_config) * $c_word_count;

        if ($eb_word_count > 0)
            $eb_price = $this->eb_price_word($eb_word_height, $customer_config) * $eb_word_count;
        
        if ($e_word_count > 0)
            $e_price = $this->e_price_word($e_word_height, $customer_config) * $e_word_count;

        $rubber_price = ceil($c_price + $eb_price + $e_price);

        //樹脂版resin
        //change to inch
        $resin_price = ceil($this->count_resin($word_length, $word_width, $use_type, $use_script, $customer));
        $resin_price = $this->carry_price($resin_price) * $use_half;
        $resin_price = ceil($resin_price * ($discount / 100));
        $resin_price += $other_price;

        if ($use_type == 'rubber') {
            $rubber_price += ceil($this->count_rubber($word_length, $word_width));
            $rubber_price = $this->carry_price($rubber_price) * $use_half;
            $rubber_price = ceil($rubber_price * ($discount / 100));
            $rubber_price += $other_price;
            $resin_price = 0;
        }
        
        return view('quote', 
            ['resin_price' => $resin_price, 
            'rubber_price' => $rubber_price, 
            'customer_name' => $customer_name]);
    }

    //選擇是哪一個客戶
    public function chancecustomer($id) {
        $customer_config = "normal";
        $customer_name = "一般";

        if ($id == "2") {
            $customer_config = "one";
            $customer_name = "凱一";
        }
        elseif ($id == "3") {
            $customer_config = "east";
            $customer_name = "東揚";
        }
        elseif ($id == "4") {
            $customer_config = "crane";
            $customer_name = "鶴強";
        }

        return json_encode(['customer_config'=>$customer_config, 'customer_name'=>$customer_name,]);
    }

    //將金額無條件進位成個位數為0
    public function carry_price($price) {
        if ($price % 10 != 0)
            $price = ceil($price / 10) * 10;

        return $price;
    }

    //計算樹脂版的單價
    public function signal_price_resin($resin_type, $use_script, $customer_config) {
        $resin_price = 12;

        if ($resin_type == "resin4") {    
            $resin_price = 8;

            if ($use_script == "true") {
                $resin_price = 10.5;
            }

            if ($customer_config == "one") {
                $resin_price = 7;

                if ($use_script == "true") {
                    $resin_price = 9.5;
                }
            }
        }

        if ($resin_type == "resin7") {

            if ($customer_config == "one") {
                $resin_price = 11;
            }
            
            if ($use_script == "true") {
                $resin_price = 14;
            }
        }            

        return $resin_price;
    }

    //樹脂版的長寬高
    public function count_resin($word_length, $word_width, $resin_type, $use_script, $customer) {
        $word_length = $word_length * 0.393700787 + 1;
        $word_width = $word_width * 0.393700787 + 1;
        $resin_price = $this->signal_price_resin($resin_type, $use_script, $customer->customer_config);
        $resin = 0;
        
        $resin = ceil($word_length * $word_width * $resin_price);

        if ($word_length <= 1 && $word_width <= 1) {
            $resin = 0;
        }

        return $resin;
    }

    //橡膠版的長寬高
    public function count_rubber($word_length, $word_width) {
        $rubber = $word_length * $word_width;

        return $rubber;
    }

    //中文黑體字價錢
    public function c_price_word($word_height, $customer_config) {
        $price = 0;
        $word_height = ceil($word_height);
        $price = Config::get($customer_config . 'price.chinese.' . $word_height);

        return $price;
    }

    //英文黑體字價錢
    public function eb_price_word($word_height, $customer_config) {
        $price = 0;
        $word_height = ceil($word_height);
        $price = Config::get($customer_config . 'price.english.' . $word_height);

        return $price;
    }

    //英文美數字
    public function e_price_word($word_height, $customer_config) {
        $price = 0;
        $word_height = ceil($word_height);
        $price = Config::get($customer_config . 'price.art_english.' . $word_height);

        return $price;
    }
}