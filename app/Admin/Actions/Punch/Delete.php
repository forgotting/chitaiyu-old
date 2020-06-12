<?php

namespace App\Admin\Actions\Punch;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Punch;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Delete extends RowAction
{
    public $name = '刪除';

    public function handle(Model $model)
    {
        // $model ...
        try {
            $id = $model->id;
            $user = User::find($id);
            $user->delete();
            $punch = Punch::where('userid', $id);
            $punch->delete();
        } catch (QueryException $ex) {
            dd($ex->getMessage());
        }
        

        return $this->response()->success('刪除成功')->refresh();
    }

}