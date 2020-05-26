<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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
        $grid = new Grid(new User());
        $grid->column('id', __(''));
        $grid->column('name', __('姓名'))->link(function () {
            return url("../punch/" . $this->id);
        });
        /*$users = new User();
        $grid->column('name', __('姓名'))->modal('行事曆', function ($model) {

            $users = $model->users()->take(10)->get()->map(function ($user) {
                return $comment->only(['id', 'content', 'created_at']);
            });
        
            return new Table(['ID', '姓名', 'email'], $users->toArray());
        });*/
        $grid->column('email', __('電子郵件'));
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
        $show->field('email', __('電子郵件'));
        $show->field('password', __('密碼'));
        $show->field('remember_token', __('Remember token'));
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
        $form->email('email', __('電子郵件'));
        $form->image('img_src', __('照片'));
        $form->password('password', __('密碼'));
        $form->text('remember_token', __('Remember token'));

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
