<?php

namespace App\Admin\Controllers;

use App\Punch;
use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PunchController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '打卡';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Punch());

        $grid->model()->orderBy('id', 'desc');

        $grid->column('id', __('Id'))->hide();
        $grid->column('userid', __('姓名'))->display(function ($userid) {

            $name = "";
            $users = new User();
            $user = $users::where('id', $userid)->first();
            
            if (isset($user->name)) {
                $name = $user->name;
            }
            //print($user->name);
            return $name;
        
        })->sortable();
        $grid->column('punch_year_month', __('打卡時間'))->display(function () {

            $year_month_array = str_split($this->punch_year_month, 4);
            $year_month = $year_month_array[0] . "-" . $year_month_array[1];
            $year_month = $year_month . "-" . str_pad($this->punch_date, 2, '0', STR_PAD_LEFT);
            $year_month = $year_month . " " . $this->punch_time;
            return $year_month;
        
        });
        $grid->column('punch_date', __('Punch date'))->hide();
        $grid->column('punch_time', __('Punch time'))->hide();
        $grid->column('punch_end_year_month', __('請假時間'))->display(function () {

            $year_month = "";

            if (isset($this->punch_end_year_month)) {
                $year_month_array = str_split($this->punch_end_year_month, 4);
                $year_month = $year_month_array[0] . "-" . $year_month_array[1];
                $year_month = $year_month . "-" . str_pad($this->punch_end_date, 2, '0', STR_PAD_LEFT);
                $year_month = $year_month . " " . $this->punch_end_time;
            }
            return $year_month;
        
        });;
        $grid->column('punch_end_date', __('Punch end date'))->hide();
        $grid->column('punch_end_time', __('Punch end time'))->hide();
        $grid->column('description', __('類別'))->using(['1' => '上班', '2' => '下班', '3' => '請假'])->label([
            1 => 'info',
            2 => 'success',
            3 => 'warning',
            4 => 'default',
        ])->sortable()->filter([
            1 => '上班',
            2 => '下班',
            3 => '請假',
        ]);
        $grid->column('created_at', __('建立時間'))->sortable();
        $grid->column('updated_at', __('Updated at'))->hide();
        $grid->actions(function ($actions) {
            $actions->disableView();
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
        $show = new Show(Punch::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('userid', __('Userid'));
        $show->field('punch_year_month', __('Punch year month'));
        $show->field('punch_date', __('Punch date'));
        $show->field('punch_time', __('Punch time'));
        $show->field('punch_end_year_month', __('Punch end year month'));
        $show->field('punch_end_date', __('Punch end date'));
        $show->field('punch_end_time', __('Punch end time'));
        $show->field('description', __('Description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Punch());

        $form->display('userid', __('姓名'))->with(function ($value) {
            $name = "";
            $user = new User();
            $user = $user::where("id", $value)->first();
            
            if (isset($user->name)) {
                $name = $user->name;
            }
            return $name;
        });
        $form->number('punch_year_month', __('打卡或請假開始時間'));
        $form->number('punch_date', __('日期'))->max(31)->min(1);
        $form->text('punch_time', __('時間'));
        $form->number('punch_end_year_month', __('請假結束時間'));
        $form->number('punch_end_date', __('日期'))->max(31)->min(1);
        $form->text('punch_end_time', __('時間'));
        $punch_type = [
            1 => '上班',
            2 => '下班',
            3 => '請假' ,
        ];
        $form->radio('description', __('類型'))->options($punch_type);

        return $form;
    }
}
