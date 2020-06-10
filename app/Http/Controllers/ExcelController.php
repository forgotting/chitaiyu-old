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
        $user_name = $user->name;
        $punches = $punch::where('punch_year_month', $year.$month)->where('userid', $user->id)->get();
        $cellData[] = ["\xEF\xBB\xBF".'姓名', "\xEF\xBB\xBF".'日期', "\xEF\xBB\xBF".'上班時間', "\xEF\xBB\xBF".'下班時間', "\xEF\xBB\xBF".'請假開始時間', "\xEF\xBB\xBF".'請假結束時間'];

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
