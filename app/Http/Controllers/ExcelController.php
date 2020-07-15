<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\User;
use App\Punch;

class ExcelController extends Controller
{
    public function punchAllExport(Request $request, $year, $month) {
        $punch = new Punch;
        $users = new User;
        foreach ($users::all() as $user) {
            $user_name = iconv("UTF-8", "BIG5", $user->name);
            $punches = $punch::where('punch_year_month', $year.$month)->where('userid', $user->id)->get();
            $cellData[] = [iconv("UTF-8", "BIG5", '姓名'),
            iconv("UTF-8", "BIG5", '日期'),
            iconv("UTF-8", "BIG5", '上班時間'),
            iconv("UTF-8", "BIG5", '下班時間'),
            iconv("UTF-8", "BIG5", '請假開始時間'),
            iconv("UTF-8", "BIG5", '請假結束時間')];

            $month_days = $this->days_in_month($month, $year);
            //dd($punches);

            for($day = 1; $day <= $month_days; $day++) {
                $start_time = "";
                $end_time = "";
                $punch_time = "";
                $punch_end_time = "";
                $night_punch_day = $day + 1;
                $start_night_time = "";
                $end_night_time = "";

                foreach ($punches as $key => $value) {

                    if ($value->punch_date == $day) {

                        if ($value->description == "1") {
                            $start_time = $value->punch_time;
                        }
    
                        if ($value->description == "2") {
                            $end_time = $value->punch_time;
                        }
    
                        $year = substr($value->punch_year_month, 0, 4);
                        $mon = substr($value->punch_year_month, -2);
                        $date = $value->punch_date;
                        $first = $year."-".$mon."-".$date." ".$start_time;
                        $second = $year."-".$mon."-".$date." ".$end_time;
                        if (strtotime($second) < strtotime($first)) {
                            $end_time = "";
                        }
                    }
    
                    if ($end_time == "") {
                        if ($night_punch_day == $value->punch_date) {
                            if ($value->description == "1") {
                                $start_night_time = $value->punch_time;
                            }
    
                            if ($start_night_time == "") {
                                $start_night_time = "23:59";
                            }
        
                            if ($value->description == "2") {
                                $end_night_time = $value->punch_time;
                            }
    
                            $year = substr($value->punch_year_month, 0, 4);
                            $mon = substr($value->punch_year_month, -2);
                            $date = $value->punch_date;
                            $first = $year."-".$mon."-".$date." ".$start_night_time;
                            $second = $year."-".$mon."-".$date." ".$end_night_time;
    
                            if (strtotime($second) <= strtotime($first)) {
                                $end_time = $end_night_time;
                            }
                        }
                        if ($night_punch_day > $month_days) {
                            $next_year = $year;
                            $next_month = $month + 1;
    
                            if ($next_month > 12) {
                                $next_year = $next_year + 1;
                                $next_month = 1;
                            }
                            $next_month = str_pad($next_month, 2, "0", STR_PAD_LEFT);
                            $next_month_punch = $punch::where('punch_year_month', $next_year.$next_month)
                                ->where('punch_date', 1)
                                ->where('userid', $user->id)
                                ->where('description', 2)
                                ->first();
                            if (isset($next_month_punch->punch_time)) {
                                $end_time = $next_month_punch->punch_time;
                            }
                        }
                    }
    
                    if ($start_time == "") {
                        $end_time = "";
                    }

                    if ($value->description == "3") {

                        if ($value->punch_date <= $day && $value->punch_end_date >= $day) {
                            
                            if ($value->punch_date == $day) {
                                $punch_time = $value->punch_time;
                            }

                            if ($value->punch_end_date == $day) {
                                $punch_end_time = $value->punch_end_time;
                            }
                        }
                    }
                }
                $cellData[] = [$user_name, $day, $start_time, $end_time, $punch_time, $punch_end_time];
            }
        }
        $filename = $year . $month . ".csv";
        $f = fopen('php://memory', 'w'); // 寫入 php://memory
        
        foreach ($cellData as $row) {
            fputcsv($f, $row);
        }
        fseek($f, 0);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="' . $filename . '"');
        fpassthru($f);
        fclose($f);
        
    }

    public function punchExport(Request $request, $id, $year, $month) {
        $punch = new Punch;
        $users = new User;
        $user_name = $users::where('id', $id)->first()->name;
        $punches = $punch::where('punch_year_month', $year.$month)->where('userid', $id)->get();
        $cellData[] = [iconv("UTF-8", "BIG5", '日期'),
            iconv("UTF-8", "BIG5", '上班時間'),
            iconv("UTF-8", "BIG5", '下班時間'),
            iconv("UTF-8", "BIG5", '請假開始時間'),
            iconv("UTF-8", "BIG5", '請假結束時間')];

        $month_days = $this->days_in_month($month, $year);
        //dd($month_days);

        for($day = 1; $day <= $month_days; $day++) {
            $start_time = "";
            $end_time = "";
            $punch_time = "";
            $punch_end_time = "";
            $night_punch_day = $day + 1;
            $start_night_time = "";
            $end_night_time = "";

            foreach ($punches as $key => $value) {

                if ($value->punch_date == $day) {

                    if ($value->description == "1") {
                        $start_time = $value->punch_time;
                    }

                    if ($value->description == "2") {
                        $end_time = $value->punch_time;
                    }

                    $year = substr($value->punch_year_month, 0, 4);
                    $mon = substr($value->punch_year_month, -2);
                    $date = $value->punch_date;
                    $first = $year."-".$mon."-".$date." ".$start_time;
                    $second = $year."-".$mon."-".$date." ".$end_time;
                    if (strtotime($second) < strtotime($first)) {
                        $end_time = "";
                    }
                }
                
                if ($end_time == "") {
                    if ($night_punch_day == $value->punch_date) {
                        if ($value->description == "1") {
                            $start_night_time = $value->punch_time;
                        }

                        if ($start_night_time == "") {
                            $start_night_time = "23:59";
                        }
    
                        if ($value->description == "2") {
                            $end_night_time = $value->punch_time;
                        }

                        $year = substr($value->punch_year_month, 0, 4);
                        $mon = substr($value->punch_year_month, -2);
                        $date = $value->punch_date;
                        $first = $year."-".$mon."-".$date." ".$start_night_time;
                        $second = $year."-".$mon."-".$date." ".$end_night_time;

                        if (strtotime($second) <= strtotime($first)) {
                            $end_time = $end_night_time;
                        }
                    }
                    
                    if ($night_punch_day > $month_days) {
                        $next_year = $year;
                        $next_month = $month + 1;

                        if ($next_month > 12) {
                            $next_year = $next_year + 1;
                            $next_month = 1;
                        }
                        $next_month = str_pad($next_month, 2, "0", STR_PAD_LEFT);
                        $next_month_punch = $punch::where('punch_year_month', $next_year.$next_month)
                            ->where('punch_date', 1)
                            ->where('userid', $id)
                            ->where('description', 2)
                            ->first();
                        if (isset($next_month_punch->punch_time)) {
                            $end_time = $next_month_punch->punch_time;
                        }
                    }
                }

                if ($start_time == "") {
                    $end_time = "";
                }

                if ($value->description == "3") {

                    if ($value->punch_date <= $day && $value->punch_end_date >= $day) {
                        
                        if ($value->punch_date == $day) {
                            $punch_time = $value->punch_time;
                        }

                        if ($value->punch_end_date == $day) {
                            $punch_end_time = $value->punch_end_time;
                        }
                    }
                }
            }
            $cellData[] = [$day, $start_time, $end_time, $punch_time, $punch_end_time];
        }
        
        $filename = $year . $month .'-'. $user_name . ".csv";
        $f = fopen('php://memory', 'w'); // 寫入 php://memory
        
        foreach ($cellData as $row) {
            fputcsv($f, $row);
        }
        fseek($f, 0);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="' . $filename . '"');
        fpassthru($f);
        fclose($f);
    }
    public function punchExport1(Request $request, $id, $year, $month) {
        $punch = new Punch;
        $users = new User;
        $user_name = $users::where('id', $id)->first()->name;
        $punches = $punch::where('punch_year_month', $year.$month)->where('userid', $id)->get();
        $cellData[] = ['日期', '上班時間', '下班時間', '請假開始時間', '請假結束時間'];

        $month_days = $this->days_in_month($month, $year);
        //dd($punches);

        for($day = 1; $day <= $month_days; $day++) {
            $start_time = "";
            $end_time = "";
            $punch_time = "";
            $punch_end_time = "";

            foreach ($punches as $key => $value) {

                if ($value->punch_date == $day) {

                    if ($value->description == "1") {
                        $start_time = $value->punch_time;
                    }

                    if ($value->description == "2") {
                        $end_time = $value->punch_time;
                    }
                }

                if ($value->description == "3") {

                    if ($value->punch_date <= $day && $value->punch_end_date >= $day) {
                        
                        if ($value->punch_date == $day) {
                            $punch_time = $value->punch_time;
                        }

                        if ($value->punch_end_date == $day) {
                            $punch_end_time = $value->punch_end_time;
                        }
                    }
                }
            }
            $cellData[] = [$day, $start_time, $end_time, $punch_time, $punch_end_time];
        }
        //dd($cellData);
        Excel::create('打卡紀錄-'. $user_name .'-'. $year . $month,function ($excel) use ($cellData, $user_name, $year, $month)
        {
            $excel->sheet($user_name .'-'. $year . $month, function ($sheet) use ($cellData)
            {
                $sheet->rows($cellData);
            });
        })->download('csv');
    }

    public function days_in_month($month, $year)
    {
        // calculate number of days in a month
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

}
