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
        $users = new User;
        $users = $users->get();

        return view('punch',['users' => $users]);
    }

    public function start(Request $request) {
        $id = $request->get('id');
        $punch_year_month = $request->get('punch_year_month');
        $punch_date = $request->get('punch_date');
        $punch_time = $request->get('punch_time');
        $punch = new Punch;
        $status = true;
        $status_msg = "success";

        if ($punch::where('userid', $id)->where('punch_date', $punch_date)->where('punch_year_month', $punch_year_month)->where('description', "1")->count() <= 0) {
            $punch->userid = $id;
            $punch->punch_year_month = $punch_year_month;
            $punch->punch_date = $punch_date;
            $punch->punch_time = $punch_time;
            $punch->description = "1";
            $punch->save();
        }
        $year_month = substr($punch_year_month, 0, 4) . "-" .substr($punch_year_month, -2);
        $punch_date = $year_month . "-" . $punch_date;

        return response()->json(['punch_date' => $punch_date, 'punch_time' => $punch_time, 'description' => "1", 'status' => $status, 'status_msg' => $status_msg]);
    }

    public function stop(Request $request) {
        $id = $request->get('id');
        $punch_year_month = $request->get('punch_year_month');
        $punch_date = $request->get('punch_date');
        $punch_time = $request->get('punch_time');
        $punch = new Punch;
        //$status = true;
        $status_msg = "success";

        $status = $this->check_punch($id, $punch_year_month, $punch_date);
        
        if ($status == false) {
            $status_msg = "請確認上班狀態";
            return response()->json(['punch_date' => $punch_date, 'punch_time' => $punch_time, 'description' => "2", 'status' => $status, 'status_msg' => $status_msg]);
        }

        if ($punch::where('userid', $id)->where('punch_date', $punch_date)->where('punch_year_month', $punch_year_month)->where('description', "2")->count() <= 1) {
            $punch->userid = $id;
            $punch->punch_year_month = $punch_year_month;
            $punch->punch_date = $punch_date;
            $punch->punch_time = $punch_time;
            $punch->description = "2";
            $punch->save();
        }

        $year_month = substr($punch_year_month, 0, 4) . "-" .substr($punch_year_month, -2);
        $punch_date = $year_month . "-" . $punch_date;

        return response()->json(['punch_date' => $punch_date, 'punch_time' => $punch_time, 'description' => "2", 'status' => $status, 'status_msg' => $status_msg]);
    }

    public function check_punch($id, $year_month, $date) {
        $users = new User;
        $user_night = $users::where('id', $id)->first()->is_night;
        $status = true;

        if ($user_night == "0") {
            $punch = new Punch;
            $is_punch = $punch::where('userid', $id)
                ->where('punch_date', $date)
                ->where('punch_year_month', $year_month)
                ->where('description', "1")
                ->count();
            
            if ($is_punch <= 0) {
                $status = false;
            }
        } else {
            $yesterday = Carbon::create(substr($year_month, 0, 4), substr($year_month, -2), $date);
            Carbon::setTestNow($yesterday); 
            $yesterday = new Carbon('yesterday');
            $punch = new Punch;
            $is_punch = $punch::where('userid', $id)
                ->where('punch_date', $yesterday->format('d'))
                ->where('punch_year_month', $yesterday->format('Ym'))
                ->where('description', "1")
                ->count();
            
            if ($is_punch <= 0) {
                $status = false;
            }
        }

        return $status;
    }

    public function user_punch($id) {
        $now = Carbon::now();
        $events = [];
        $punch = new Punch;
        $punches = $punch::where('userid', $id)->get();
        $users = new User;
        $user = $users::where('id', $id)->first();
        $start_punch = "";
        $finish_punch = "";
        $now_year_month = $now->format('Ym');
        $now_day = $now->day;
        $is_start_punch = 0;

        if ($user->is_night == 1) {
            $is_start_punch = $punch::where('userid', $id)
                ->where('punch_date', $now_day)
                ->where('punch_year_month', $now_year_month)
                ->where('description', "2")
                ->count();
            if ($is_start_punch <= 0) {
                $yesterday = Carbon::create($now->format('Y'), $now->format('m'), $now_day);
                Carbon::setTestNow($yesterday); 
                $yesterday = new Carbon('yesterday');
                $now_year_month = $yesterday->format('Ym');
                $now_day = $yesterday->format('d');
            }
        }

        foreach ($punches as $key => $value) {
            $title = "上班";
            $end_year_month = "";
            $year_month = substr($value->punch_year_month, 0, 4) . "-" . substr($value->punch_year_month, -2);
            
            if ($value->punch_year_month == $now_year_month && $value->punch_date == $now_day) {
                if ($value->description == "1")
                    $start_punch = $value->punch_time;
                
                if ($value->description == "2")
                    $finish_punch = $value->punch_time;
            }
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

        $first = $now->format('Y')."-".$now->format('m')."-".$now_day." ".$start_punch;
        $second = $now->format('Y')."-".$now->format('m')."-".$now_day." ".$finish_punch;
        
        if (strtotime($second) < strtotime($first)) {
            $finish_punch = "";
        }

        return view('punch-user', ['events' => $events, 'user_name' => $user->name, 'start_punch' => $start_punch, 'finish_punch' => $finish_punch]);
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
