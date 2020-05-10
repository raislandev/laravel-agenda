<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\LogRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;

use App\ActivityLog;

class LogRepository extends AbstractRepository implements LogRepositoryInterface {

    protected $model = ActivityLog::class;

    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator
    {
        //dd($this->model);
        if (Gate::denies('crud_user_acl')) {
            return $this->model->where('causer_id', '=', auth()->user()->id)->orderBy($column,$order)->paginate($paginate);
        }

        return $this->model->orderBy($column,$order)->paginate($paginate);
    }
    
    
    
    
    
} 


?>