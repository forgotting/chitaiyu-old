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
            $cellData[] = ["", "", "", $user_name, "", "", ""];
            $cellData[] = ["", "", "", iconv("UTF-8", "BIG5", $year."年".$month."月"), "", "", ""];
            $cellData[] = [iconv("UTF-8", "BIG5", '星期一'),
                iconv("UTF-8", "BIG5", '星期二'),
                iconv("UTF-8", "BIG5", '星期三'),
                iconv("UTF-8", "BIG5", '星期四'),
                iconv("UTF-8", "BIG5", '星期五'),
                iconv("UTF-8", "BIG5", '星期六'),
                iconv("UTF-8", "BIG5", '星期日')];
            $month_days = $this->days_in_month($month, $year);

            // 31 / 7 = 4.xxx => 5
            $week_days = ceil($month_days / 7)+ 1;
            $week = date("w", mktime(0, 0, 0, $month, 1, $year));
            for($week_day = 1; $week_day <= $week_days; $week_day++) {
            
                $weeks = [];
                $week_min = (($week_day - 1) * 7) + 1;
                $week_max = $week_min + 6;
                if ($week != 1) {
                    $week_max = $week_day * 7 - ($week - 1);
                    $week_min = $week_max - 6;
                }
    
                if ($week_max >= $month_days) $week_max = $month_days;
    
                for($day = $week_min ; $day <= $week_max; $day++) {
                    $punch_data = $this->exportExcel($month, $year, $day, $month_days, $punches, $punch, $user->id);
                    $start_time = "";
                    $end_time = "";
                    $punch_time = "";
                    $punch_end_time = "";
                    // $cellData[] = [$day, $punch_data["start_time"], $punch_data["end_time"], $punch_data["punch_time"], $punch_data["punch_end_time"]];
                    if (!empty($punch_data["start_time"])) $start_time = "\n上班:" . $punch_data["start_time"];
                    if (!empty($punch_data["end_time"])) $end_time = "\n下班:" . $punch_data["end_time"];
                    if (!empty($punch_data["punch_time"])) $punch_time = "\n請假開始時間:" . $punch_data["punch_time"];
                    if (!empty($punch_data["punch_end_time"])) $punch_end_time = "\n請假結束時間:" . $punch_data["punch_end_time"];
                    $excel_day = $day;
                    if ($excel_day <= 0 ) $excel_day = "";
    
                    $weeks[] = [$excel_day . iconv("UTF-8", "BIG5", $start_time) . iconv("UTF-8", "BIG5", $end_time) . iconv("UTF-8", "BIG5", $punch_time) . iconv("UTF-8", "BIG5", $punch_end_time)];
                }
                $collection = collect($weeks);
                $flattened = $collection->flatten();
                $cellData[] = $flattened->all();
            }
            // $cellData[] = [iconv("UTF-8", "BIG5", '姓名'),
            // iconv("UTF-8", "BIG5", '日期'),
            // iconv("UTF-8", "BIG5", '上班時間'),
            // iconv("UTF-8", "BIG5", '下班時間'),
            // iconv("UTF-8", "BIG5", '請假開始時間'),
            // iconv("UTF-8", "BIG5", '請假結束時間')];
            // $month_days = $this->days_in_month($month, $year);

            // for($day = 1; $day <= $month_days; $day++) {
            //     $punch_data = $this->exportExcel($month, $year, $day, $month_days, $punches, $punch, $user->id);
            //     $cellData[] = [$user_name, $day, $punch_data["start_time"], $punch_data["end_time"], $punch_data["punch_time"], $punch_data["punch_end_time"]];
            // }
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
        // $cellData[] = [iconv("UTF-8", "BIG5", '日期'),
        //     iconv("UTF-8", "BIG5", '上班時間'),
        //     iconv("UTF-8", "BIG5", '下班時間'),
        //     iconv("UTF-8", "BIG5", '請假開始時間'),
        //     iconv("UTF-8", "BIG5", '請假結束時間')];
        $cellData[] = ["", "", "", iconv("UTF-8", "BIG5", $user_name), "", "", ""];
        $cellData[] = ["", "", "", iconv("UTF-8", "BIG5", $year."年".$month."月"), "", "", ""];
        $cellData[] = [iconv("UTF-8", "BIG5", '星期一'),
            iconv("UTF-8", "BIG5", '星期二'),
            iconv("UTF-8", "BIG5", '星期三'),
            iconv("UTF-8", "BIG5", '星期四'),
            iconv("UTF-8", "BIG5", '星期五'),
            iconv("UTF-8", "BIG5", '星期六'),
            iconv("UTF-8", "BIG5", '星期日')];

        $month_days = $this->days_in_month($month, $year);

        // 31 / 7 = 4.xxx => 5
        $week_days = ceil($month_days / 7)+ 1;
        $week = date("w", mktime(0, 0, 0, $month, 1, $year));
        for($week_day = 1; $week_day <= $week_days; $week_day++) {
        
            $weeks = [];
            $week_min = (($week_day - 1) * 7) + 1;
            $week_max = $week_min + 6;
            if ($week != 1) {
                $week_max = $week_day * 7 - ($week - 1);
                $week_min = $week_max - 6;
            }

            if ($week_max >= $month_days) $week_max = $month_days;

            for($day = $week_min ; $day <= $week_max; $day++) {
                $punch_data = $this->exportExcel($month, $year, $day, $month_days, $punches, $punch, $id);
                $start_time = "";
                $end_time = "";
                $punch_time = "";
                $punch_end_time = "";
                // $cellData[] = [$day, $punch_data["start_time"], $punch_data["end_time"], $punch_data["punch_time"], $punch_data["punch_end_time"]];
                if (!empty($punch_data["start_time"])) $start_time = "\n上班:" . $punch_data["start_time"];
                if (!empty($punch_data["end_time"])) $end_time = "\n下班:" . $punch_data["end_time"];
                if (!empty($punch_data["punch_time"])) $punch_time = "\n請假開始時間:" . $punch_data["punch_time"];
                if (!empty($punch_data["punch_end_time"])) $punch_end_time = "\n請假結束時間:" . $punch_data["punch_end_time"];
                $excel_day = $day;
                if ($excel_day <= 0 ) $excel_day = "";

                $weeks[] = [$excel_day . iconv("UTF-8", "BIG5", $start_time) . iconv("UTF-8", "BIG5", $end_time) . iconv("UTF-8", "BIG5", $punch_time) . iconv("UTF-8", "BIG5", $punch_end_time)];
            }
            $collection = collect($weeks);
            $flattened = $collection->flatten();
            $cellData[] = $flattened->all();
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

    public function exportExcel($month, $year, $day, $month_days, $punches, $punch, $id) 
    {
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

        return ["start_time" => $start_time, "end_time" => $end_time, "punch_time" => $punch_time, "punch_end_time" => $punch_end_time];
    }

    public function days_in_month($month, $year)
    {
        // calculate number of days in a month
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

}
