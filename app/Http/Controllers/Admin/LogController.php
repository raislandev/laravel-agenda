<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\LogRepositoryInterface;
use Spatie\Activitylog\Models\Activity;


class LogController extends Controller
{
    private $router = "logs";
    private $paginate =6;
    private $search = ['log_name']; 
    private $model;

    public function __construct(LogRepositoryInterface $model){
        $this->model = $model;
     }
    

    public function index(Request $req)
    {
        $columnList = 
        [  
            'description'=>'Descrição',
            'subject_id'  => 'Id do Sujeito',
            'causer_id' => 'Id do Causador',
            'created_at' => 'Data'
        ];  
        //dd(Activity::all());

        $search = '';
        if(isset($req->search)){
          $search = $req->search;
          $list = $this->model->findWhereLike($this->search, $search,'id','DESC');
        }else{
          $list = $this->model->paginate($this->paginate,'id','DESC');
        }

        $page = "Lista de logs";

        $routerName = $this->router;

        //$req->session()->flash('msg', 'Ola!');
        //$req->session()->flash('status', 'notification');// success error notification
        
        $breadcrumb = [
          (object)['url'=>route('home'),'title'=>'Home'], 
          (object)['url'=>'','title'=>'Lista de logs'],  

        ];
        return view('admin.'.$routerName.'.index', compact('list','search','routerName','columnList','breadcrumb','page'));
        
    }
  
}
