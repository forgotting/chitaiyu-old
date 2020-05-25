<?php

namespace App\Admin\Controllers;

use App\CheckIp;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CheckIpController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '白名單';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CheckIp());
        $grid->column('ip', __('IP'));
        $grid->column('iswhite', __('白名單'))->using(['0' => '否', '1' => '是']);
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
        $show = new Show(CheckIp::findOrFail($id));

        $show->field('ip', __('IP'));
        $show->field('iswhite', __('白名單'));
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
        $form = new Form(new CheckIp());

        $form->ip('ip', __('IP'));
        $form->radio('iswhite', __('白名單'))->options(['0' => '否', '1'=> '是'])->default('0');
        return $form;
    }
}
