<?php

namespace App\Repositories\Eloquent;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use App\Client;
use App\Phone;

class ClientRepository extends AbstractRepository implements ClientRepositoryInterface {

    protected $model = Client::class;
    protected $modelPhone = Phone::class; 


    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator
    {
        //dd($this->model);
        if (Gate::denies('crud_user_acl')) {
            return $this->model->where('user_id', '=', auth()->user()->id)->orderBy($column,$order)->paginate($paginate);
        }

        return $this->model->orderBy($column,$order)->paginate($paginate);
    }


    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection
    {
    
       
        $query = $this->model;


        if (Gate::denies('crud_user_acl')) {
            
                foreach ($columns as $key => $value) {
                    $query = $query->orWhere($value,'like','%'.$search.'%');
                }
                $query = $query->get()->where('user_id', '=', auth()->user()->id);
    
                
                //$id = Client::where('user_id',auth()->user()->id)->first()->user_id;

                $clients = Client::where('user_id',auth()->user()->id);
                //dd($clients->get());

                $ids = [];
                foreach($clients->get() as $key => $value) {
                    array_push($ids,$value->id);
                }

                $query2 = Phone::orWhere('phone','like','%'.$search.'%');
                $query2 = $query2->get()->whereIn('client_id',$ids);
          
                $query3 = [];
                foreach ($query2 as $key => $value) {
                    array_push($query3,$value->client);
                }

    
                if($query3){
                    foreach ($query3 as $key => $value) {
                        $query->push($value);
                    }
            
                }
    
                return $query->unique();

          
        }
        
        $query2 = Phone::orWhere('phone','like','%'.$search.'%'); 
      
        $query3 = [];
        foreach ($query2->get() as $key => $value) {
            array_push($query3,$value->client);
        }

         
        foreach ($columns as $key => $value) {
            $query = $query->orWhere($value,'like','%'.$search.'%'); 
           
        }

        if($query3){
            $query = $query->get();
            foreach ($query3 as $key => $value) {
                $query->push($value);
            }
     
        }

        try {
            return $query->unique();
        } catch (\Throwable $th) {
            return $query->orderBy($column,$order)->get();
        }
        
    }

    
    
} 


?>