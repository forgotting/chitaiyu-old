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
use Encore\Admin\Widgets\Table;
use Calendar_self;
use Illuminate\Contracts\Support\Renderable;


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
        //Admin::js('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js');
        Admin::css('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css');
        Admin::js('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js');
        Admin::js('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js');
        /*Admin::script('$(".fc-excelButton-button").click( 
            function() { alert("clicked"); });
        ');
        var test = $("#calendar-1").fullCalendar("getDate").format("YYYY");
        */

        /*Admin::script('
        var getmonth = $("#calendar-1").fullCalendar("getDate");
        var year = getmonth.format("YYYY");
        var month = getmonth.format("MM");
        $(".fc-excelButton-button").click( 
            function() { alert(month); });
        ');*/

        $grid = new Grid(new User());
        
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
            //$punches = new Collection($punches);
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
                    'right' => 'punchButton'
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
                        'click' => ''
                    ]
                ]
                ]);

            return $calendar->calendar().$calendar->script();
        });
        //$grid->column('email', __('電子郵件'));
        $grid->column('created_at', __('建立時間'));
        $grid->column('updated_at', __('修改時間'));

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
        //$show->field('email', __('電子郵件'));
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

        $form->text('name', __('姓名'));
        //$form->email('email', __('電子郵件'));
        //$form->image('img_src', __('照片'));
        $form->password('password', __('密碼'));
        //$form->text('remember_token', __('Remember token'));

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = $form->password;
            } else {
                $form->password = $form->model()->password;
            }
        });

        return $form;
    }
}
