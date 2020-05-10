<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Contracts\PhoneRepositoryInterface;
use Illuminate\Validation\Rule;
use App\Client;



class ClientController extends Controller
{
    private $router = "clients";
    private $paginate =6;
    private $search = ['name','email']; 
    private $model;
    private $modelPhone;

    public function __construct(ClientRepositoryInterface $model,PhoneRepositoryInterface $modelPhone){
       $this->model = $model;
       $this->modelPhone = $modelPhone;
    } 

    
    public function index(Request $req)
    {
         
        $columnList = ['name'=>'Nome','email'=>'email','phone'=>'Telefones'];  

        $search = '';
        if(isset($req->search)){
          $search = $req->search;
          $list = $this->model->findWhereLike($this->search, $search,'name','ASC');
        }else{
          $list = $this->model->paginate($this->paginate,'name','ASC');
    
        }

        $page = "Lista de Clientes";

        $routerName = $this->router;

        
        $breadcrumb = [
          (object)['url'=>route('home'),'title'=>'Home'], 
          (object)['url'=>'','title'=>'Lista de clientes'],  

        ];
       
        return view('admin.'.$routerName.'.index', compact('list','search','routerName','columnList','breadcrumb','page'));
        
    }

    
    public function create()
    {
        $routerName = $this->router;
        $page = "Adicionar Cliente";

        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>'Home'], 
            (object)['url'=>route($routerName.'.index'),'title'=>'Lista de clientes'],
            (object)['url'=>'','title'=>'Adicionar'],  
        ];

        return view('admin.'.$routerName.'.create', compact('routerName','breadcrumb','page'));

    }

    
    public function store(Request $request)
    {
        $data = $request->all();
        $routerName = $this->router;

        $user = auth()->user();
        $data['user_id'] = $user->id;


        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ])->validate();
        
        $register='';
        if($register = Client::create($data)){
            $request->session()->flash('msg', 'Registro adicionado com sucesso');
            $request->session()->flash('status', 'success');// success error notification
            return redirect()->route($routerName.'.edit',$register->id);
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
                (object)['url'=>route($routerName.'.index'),'title'=>'Lista de Clientes'],
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


         if($register){
            $page2 = "Editar Cliente";

            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>'Home'], 
                (object)['url'=>route($routerName.'.index'),'title'=>'Lista de Clientes'],
                (object)['url'=>'','title'=>'Editar'],  
            ];

            return view('admin.'.$routerName.'.edit', compact('routerName','breadcrumb','page2','register'));  
         }

         return redirect()->route($routerName.'.index');

        
    }

    
    public function update(Request $request, $id)
    {
        //$this->authorize('edit-user');
        $data = $request->all();

        //dd($data);
        $user = auth()->user();
        $data['user_id'] = $user->id;
        
        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
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
