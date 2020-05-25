<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\Punch;
use App\User;
use Carbon\Carbon;
use Mail;

class PunchController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $punch = new Punch;
        $users = new User;
        $users = $users->get();
        $start_punch = $punch::where('punch_date', $now->day)->where('punch_year_month', $now->format('Ym'))->get();

        foreach ($users as $user) {
            foreach ($start_punch as $start) {
                if ($user["id"] == $start["userid"]) {
                    //上班時間
                    if ($start["description"] == "1") {
                        $user["start_date"] = $start["punch_date"];
                        $user["start_time"] = $start["punch_time"];
                    }
                    //下班時間
                    if ($start["description"] == "2") {
                        $user["stop_time"] = $start["punch_time"];
                    }
                }
            }
        }
        return view('punch',['start_punch' => $users]);
    }

    public function start(Request $request) {
        $id = $request->get('id');
        $punch_year_month = $request->get('punch_year_month');
        $punch_date = $request->get('punch_date');
        $punch_time = $request->get('punch_time');
        $punch = new Punch;

        if ($punch::where('userid', $id)->where('punch_date', $punch_date)->where('punch_year_month', $punch_year_month)->where('description', "1")->count() <= 0) {
            $punch->userid = $id;
            $punch->punch_year_month = $punch_year_month;
            $punch->punch_date = $punch_date;
            $punch->punch_time = $punch_time;
            $punch->description = "1";
            $punch->save();
        }

        return response()->json(['punch_time' => $punch_time]);
    }

    public function stop(Request $request) {
        $id = $request->get('id');
        $punch_year_month = $request->get('punch_year_month');
        $punch_date = $request->get('punch_date');
        $punch_time = $request->get('punch_time');
        $punch = new Punch;

        if ($punch::where('userid', $id)->where('punch_date', $punch_date)->where('punch_year_month', $punch_year_month)->where('description', "2")->count() <= 0) {
            $punch->userid = $id;
            $punch->punch_year_month = $punch_year_month;
            $punch->punch_date = $punch_date;
            $punch->punch_time = $punch_time;
            $punch->description = "2";
            $punch->save();
        }

        return response()->json(['punch_time' => $punch_time]);
    }

    public function user_punch($id) {
        $events = [];
        $punch = new Punch;
        $punches = $punch::where('userid', $id)->get();
        $users = new User;
        $user_name = $users::where('id', $id)->first()->name;

        foreach ($punches as $key => $value) {
            $title = "上班";
            $end_year_month = "";
            $year_month = substr($value->punch_year_month, 0, 4) . "-" .substr($value->punch_year_month, -2);
            
            if (isset($value->punch_end_year_month))
                $end_year_month = substr($value->punch_end_year_month, 0, 4) . "-" .substr($value->punch_end_year_month, -2);
            //print($end_year_month);
            if ($value->description == "2")
                $title = "下班";
            if ($value->description == "3")
                $title = "請假";
            $events[] = json_decode('{
                "id": ' . $value->id . ',
                "title": "' . $title . '",
                "year_month": "' . $year_month . '",
                "date": "' . str_pad($value->punch_date, 2, "0", STR_PAD_LEFT) . '",
                "time": "' . $value->punch_time . '",
                "description": "' . $value->description . '",
                "end_year_month": "' . $end_year_month . '",
                "end_date": "' . (isset($value->punch_end_date)?str_pad($value->punch_end_date, 2, "0", STR_PAD_LEFT):'') . '",
                "end_time": "' . (isset($value->punch_end_time)?$value->punch_end_time:'') . '"          
              }');
        }

        return view('punch-user', ['events' => $events, 'user_name' => $user_name]);
    }

    public function checkuser($id, $password) {
        $id = $id;
        $password = $password;
        $user = new User;
        $user = $user::where('id', $id)->where('password', $password);

        if ($user->count() > 0) {
            Auth::login($user->firstOrFail());

            if (Auth::check()) {
                //return redirect()->intended('punch/' . $id);
                return json(['result' => true, 'name' => $user->first()->name]);
            }
        }

        return response()->json(['result' => false, 'msg' => '請輸入正確的密碼']);
    }

    public function ajaxUpdate(Request $request) {
        $user_id = $request->get('user_id');
        $start_time = $request->get('start_time');
        $finish_time = $request->get('finish_time');

        $start_time = explode(" ", $start_time);
        $start_punch_date = $start_time[0];
        $start_punch_time = $start_time[1];
        $start_punch_date = str_replace("-", "", $start_punch_date);
        $start_punch_month_year = substr($start_punch_date, 0, 6);
        $start_punch_date = substr($start_punch_date, 6);

        $finish_time = explode(" ", $finish_time);
        $end_punch_date = $finish_time[0];
        $end_punch_time = $finish_time[1];
        $end_punch_date = str_replace("-", "", $end_punch_date);
        $end_punch_month_year = substr($end_punch_date, 0, 6);
        $end_punch_date = substr($end_punch_date, 6);

        $punch = new Punch;
        $punch->userid = $user_id;
        $punch->punch_year_month = $start_punch_month_year;
        $punch->punch_date = $start_punch_date;
        $punch->punch_time = $start_punch_time;
        $punch->punch_end_year_month = $end_punch_month_year;
        $punch->punch_end_date = $end_punch_date;
        $punch->punch_end_time = $end_punch_time;
        $punch->description = "3";
        $punch->save();

        $title = "請假";
        $event = json_decode('{
            "id": ' . $user_id . ',
            "title": "' . $title . '",
            "date": "' . $start_time[0] . '",
            "time": "' . $start_punch_time . '",
            "end_date": "' . $finish_time[0] . '",
            "end_time": "' . $end_punch_time . '" 
        }');

        return response()->json(['event' => $event]);
    }
}

?>
