<?php

namespace App\Admin\Controllers;

use App\User;
use App\Punch;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Admin;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Table;
use Calendar_self;
use Illuminate\Contracts\Support\Renderable;
use Carbon\Carbon;
use App\Admin\Actions\Punch\Delete;
use Illuminate\Support\Arr;


class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '員工';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        //var test = $("#calendar-1").fullCalendar("getDate").format("YYYY");

        /*Admin::script('
        var getmonth = $("#calendar-1").fullCalendar("getDate");
        var year = getmonth.format("YYYY");
        var month = getmonth.format("MM");
        
        $(".fc-excelButton-button").click( 
            function() { alert(year+"-"+month); });
        ');*/

        $grid = new Grid(new User());

        $grid->header(
            function ($type) { 
                $now = Carbon::now();
                $users = User::orderBy('users.id', 'asc');
                $punch_user = Punch::where('punches.punch_year_month', $now->format('Ym'))
                    ->where('punches.punch_date', $now->day)
                    ->get();
                $punch_start_today = [];
                $punch_end_today = [];

                foreach ($users->get() as $user) {
                    $punch_start_today[$user->id] = 0;
                    $punch_end_today[$user->id] = 0;

                    foreach ($punch_user as $punch){

                        if ($punch->description == "1") {
                            if ($user->id == $punch->userid) {
                                $punchtime = explode(":", $punch->punch_time);
                                
                                if ($punchtime[0] >= 12) {
                                    $punchtime[0] = $punchtime[0] - 12;
                                }
                                $ptime = (int)$punchtime[1]/60;
                                $ptime = $punchtime[0] + $ptime;
                                $punch_start_today[$user->id] = round($ptime, 2);
                            }
                        }

                        if ($punch->description == "2") {
                            if ($user->id == $punch->userid) {
                                $punchtime = explode(":", $punch->punch_time);
                                if ($punchtime[0] >= 12) {
                                    $punchtime[0] = $punchtime[0] - 12;
                                }
                                $ptime = (int)$punchtime[1]/60;
                                $ptime = (int)$punchtime[0] + $ptime;
                                $punch_end_today[$user->id] = round($ptime, 2);
                            }
                        }
                    }
                }
                $users = $users->get()->pluck('name')->toArray();
                $doughnut = view('admin.chart.punch', compact('users', 'punch_start_today', 'punch_end_today'));
                $year = $now->format('Y');
                $mon = $now->format('m');
                $lastmon = $now->subMonth()->format('m');
                $lastmon1 = $now->subMonth()->format('m');
                $lastmon2 = $now->subMonth()->format('m');
                $lastmon3 = $now->subMonth()->format('m');
                return new Box('今日打卡紀錄', $doughnut).'
                <a href="../excel/export/punches/'.$year.'-'.$mon.'" target="_blank">
                <button>'.$mon.'</button></a>
                <a href="../excel/export/punches/'.((int)$mon <= 1?$year-1:$year).'-'.$lastmon.'" target="_blank">
                <button>'.$lastmon.'</button></a>
                <a href="../excel/export/punches/'.((int)$mon <= 2?$year-1:$year).'-'.$lastmon1.'" target="_blank">
                <button>'.$lastmon1.'</button></a>
                <a href="../excel/export/punches/'.((int)$mon <= 3?$year-1:$year).'-'.$lastmon2.'" target="_blank">
                <button>'.$lastmon2.'</button></a>';
        });
        
        $grid->column('name', __('姓名'))->modal("行事曆", function ($model) {
            $id = $model->id;
            $punches = DB::table('punches')->where('userid', $id)->get();
            $punches = $punches->map(function ($punch) use ($id) {
                $title = "上班".$punch->punch_time;
                $color = "#337AB7";
                $year_month = substr($punch->punch_year_month, 0, 4) . "-" .substr($punch->punch_year_month, -2);
                $punch_date = $year_month . "-" . $punch->punch_date;
                $start_date = $punch_date;
                $end_date = $punch_date;
                
                if ($punch->description == "2") {
                    $title = "下班 ".$punch->punch_time;
                    $color = "#5CB85C";
                }

                if ($punch->description == "3") {
                    $title = "請假 ".$punch->punch_time." ~ ".$punch->punch_end_time;
                    $color = 'red';
                    $end_year_month = substr($punch->punch_end_year_month, 0, 4) . "-" .substr($punch->punch_end_year_month, -2);
                    $end_date = $year_month . "-" . $punch->punch_end_date;
                    $end_date = $punch_date." ".$punch->punch_end_time;
                }
                
                return Calendar_self::event($title, true, $start_date, $end_date, null, ['color' => $color]);
            });
            $calendar = Calendar_self::addEvents($punches)->setId($id)->setOptions([
                'monthNames' => ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
                'dayNames' => ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"],
                'defaultView' => 'month',
                'firstDay' => 1,
                'timeFormat' => 'H(:mm)',
                'displayEventTime' => false,
                'timezone' => 'Asia/Taipei',
                'header' => [
                    'left' => 'prev, next today',
                    'center' => 'title',
                    'right' => ''
                ],
                'buttonText' => [
                    'today' => '今天',
                    'month' => '月',
                    'week' => '周',
                    'day' => '日'
                ],
                'views' => [
                    'month' => [
                        'titleFormat' => 'YYYY年 M月',
                        'columnFormat' => 'dddd'
                    ]
                ],
                'customButtons' => [
                    'excelButton' => [
                        'text' => '下載',
                        'click' => function (){ alert('tset');}
                    ]
                ]
                ]);

            return $calendar->calendar().$calendar->script();
        });
        //$grid->column('email', __('電子郵件'));
        $grid->column('punch', __('下載打卡紀錄'))->display(
            function ($type) { 
                $now = Carbon::now();
                $year = $now->format('Y');
                $mon = $now->format('m');
                $lastmon = $now->subMonth()->format('m');
                $lastmon1 = $now->subMonth()->format('m');
                $lastmon2 = $now->subMonth()->format('m');
                $lastmon3 = $now->subMonth()->format('m');
                return '
                <a href="../excel/export/punch/'.$this->id.'/'.$year.'-'.$mon.'" target="_blank">
                <button>'.$mon.'</button></a>
                <a href="../excel/export/punch/'.$this->id.'/'.((int)$mon <= 1?$year-1:$year).'-'.$lastmon.'" target="_blank">
                <button>'.$lastmon.'</button></a>
                <a href="../excel/export/punch/'.$this->id.'/'.((int)$mon <= 2?$year-1:$year).'-'.$lastmon1.'" target="_blank">
                <button>'.$lastmon1.'</button></a>
                <a href="../excel/export/punch/'.$this->id.'/'.((int)$mon <= 3?$year-1:$year).'-'.$lastmon2.'" target="_blank">
                <button>'.$lastmon2.'</button></a>';
        });
        $grid->column('email', __('電子郵件'))->display(function ($email) {

            $color = "#333333";
            if ($this->is_night == 1) {
                $color = "red";
            }
            return "<span style='color:".$color."'>$email</span>";
        
        });
        $grid->column('created_at', __('建立時間'));
        $grid->column('updated_at', __('修改時間'));
        $grid->actions(function ($actions) {
            // 去掉删除
            $actions->disableDelete();
            $actions->add(new Delete);
        });
        
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('姓名'));
        $show->field('email', __('電子郵件'));
        $show->field('password', __('密碼'));
        //$show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('建立時間'));
        $show->field('updated_at', __('修改時間'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('姓名'))->rules('required', ['required' => '必填欄位']);
        $form->email('email', __('電子郵件'));
        //$form->image('img_src', __('照片'));
        $form->password('password', __('密碼'));
        //$form->text('remember_token', __('Remember token'));
        $form->radio('is_night', __('是否中班'))->options(['0' => '否', '1'=> '是'])->default('0');

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = $form->password;
            } else {
                $form->password = $form->model()->password;
            }
        });
        // $form->deleting(function (Form $form) {
        //     $form->add(new Delete);
        // });
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
        });

        return $form;
    }
}
