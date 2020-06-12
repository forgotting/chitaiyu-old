<?php

namespace App\Admin\Actions\Punch;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
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
            $model->delete();
            $punch = Punch::where('userid', $id);
            $punch->delete();
        } catch (QueryException $exception) {
            // dd($ex->getMessage());
            return $this->response()->error("{$exception->getMessage()}");
        }
        

        return $this->response()->success('刪除成功')->refresh();
    }

}