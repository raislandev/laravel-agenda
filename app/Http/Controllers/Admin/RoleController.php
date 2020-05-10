<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\PermissionRepositoryInterface;


class RoleController extends Controller
{

    private $router = "roles";
    private $paginate =6;
    private $search = ['name']; 
    private $model;
    private $modelPermission;

    public function __construct(RoleRepositoryInterface $model,PermissionRepositoryInterface $modelPermission ){
       $this->model = $model;
       $this->modelPermission = $modelPermission;
    } 

    
    public function index(Request $req)
    {
        $columnList = ['name'=>'Nome','description'=>'Descrição'];  

        $search = '';
        if(isset($req->search)){
          $search = $req->search;
          $list = $this->model->findWhereLike($this->search, $search,'name','ASC');
        }else{
          $list = $this->model->paginate($this->paginate,'name','ASC');
        }

        $page = "Lista de Funções";

        $routerName = $this->router;

        //$req->session()->flash('msg', 'Ola!');
        //$req->session()->flash('status', 'notification');// success error notification
        
        $breadcrumb = [
          (object)['url'=>route('home'),'title'=>'Home'], 
          (object)['url'=>'','title'=>'Lista de Funções'],  

        ];
       
        return view('admin.'.$routerName.'.index', compact('list','search','routerName','columnList','breadcrumb','page'));
        
    }

    
    public function create()
    {
        $routerName = $this->router;
        $page = "Adicionar Função";
        $permissions = $this->modelPermission->all("name");

        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>'Home'], 
            (object)['url'=>route($routerName.'.index'),'title'=>'Lista de Funções'],
            (object)['url'=>'','title'=>'Adicionar'],  
        ];

        return view('admin.'.$routerName.'.create', compact('routerName','breadcrumb','page','permissions'));

    }

    
    public function store(Request $request)
    {
        $data = $request->all();

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255|',
        ])->validate();


        if($this->model->create($data)){
            $request->session()->flash('msg', 'Registro adicionado com sucesso');
            $request->session()->flash('status', 'success');// success error notification
            return redirect()->back();
        }else{
            $request->session()->flash('msg', 'erro ao adicionar um registro');
            $request->session()->flash('status', 'error');
            return redirect()->back();

        }


    }

   
    public function show($id, Request $req)
    {
        $routerName = $this->router;
        $register = $this->model->find($id);

         if($register){
            $page2 = "Detalhes";

            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>'Home'], 
                (object)['url'=>route($routerName.'.index'),'title'=>'Lista de Funções'],
                (object)['url'=>'','title'=>'Detalhes'],  
            ];

            $delete = false;
            if($req->delete ?? false){
                $req->session()->flash('msg','Que realmente deletar esse registro?');
                $req->session()->flash('status', 'error');
                $delete = true;
            }

            return view('admin.'.$routerName.'.show', compact('routerName','breadcrumb','page2','register','delete'));  
         }

         return redirect()->route($routerName.'.index');
    }

    
    public function edit($id)
    {
        $routerName = $this->router;
        $register = $this->model->find($id);
        $permissions = $this->modelPermission->all("name");

         if($register){
            $page2 = "Editar Função";

            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>'Home'], 
                (object)['url'=>route($routerName.'.index'),'title'=>'Lista de funções'],
                (object)['url'=>'','title'=>'Editar'],  
            ];

            return view('admin.'.$routerName.'.edit', compact('routerName','breadcrumb','page2','register','permissions'));  
         }

         return redirect()->route($routerName.'.index');

        
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->all();

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255|',
        ])->validate();

        if($this->model->update($data,$id)){
            $request->session()->flash('msg', 'Registro atualizado com sucesso');
            $request->session()->flash('status', 'success');// success error notification
            return redirect()->back();
        }else{
            $request->session()->flash('msg', 'erro ao atualizar o registro');
            $request->session()->flash('status', 'error');
            return redirect()->back();

        }
    }

   
    public function destroy($id, Request $request)
    {
        if($this->model->delete($id)){
            $request->session()->flash('msg', 'Registro excluido com sucesso');
            $request->session()->flash('status', 'success');// success error notification
        }else{
            $request->session()->flash('msg', 'erro ao excluir o registro');
            $request->session()->flash('status', 'error');
        }

        $routerName = $this->router;
        return redirect()->route($routerName.'.index');
    }
}
