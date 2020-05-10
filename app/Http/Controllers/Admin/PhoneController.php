<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PhoneRepositoryInterface;
use Validator;



class PhoneController extends Controller
{
    private $router = "phones";
    private $model;

    public function __construct(PhoneRepositoryInterface $model){
       $this->model = $model;
    } 

    
    
    public function create($id)
    {
        $routerName = $this->router;
        $page = "Adicionar Phone";

        $phones = '';
        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>'Home'], 
            (object)['url'=>route('clients.index'),'title'=>'Lista de clientes'],
            (object)['url'=>'','title'=>'Adicionar'],  
        ];

        return view('admin.'.$routerName.'.create', compact('routerName','breadcrumb','page'));

    }


    public function show($id, Request $req)
    {
        $routerName = $this->router;
        $register = $this->model->find($id);

         if($register){
            $page2 = "Detalhes";

            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>'Home'], 
                (object)['url'=>route('clients.index'),'title'=>'Lista de Clientes'],
                (object)['url'=>'','title'=>'Detalhes'],  
            ];

            $delete = false;
            if($req->delete ?? false){
                //$req->session()->flash('msg','Que realmente deletar esse registro?');
                $req->session()->flash('status', 'error');
                $delete = true;
            }

            return view('admin.'.$routerName.'.show', compact('routerName','breadcrumb','page2','register','delete'));  
         }

         return redirect()->back();
         //return redirect()->route('clients.index');
    }

    
    public function store(Request $request,$id)
    {
        $data = $request->all();
        $data['client_id'] = $id;
        
        Validator::make($data, [
            'phone' => 'required|string|max:255',
        ])->validate();

        if($this->model->create($data)){
            $request->session()->flash('msg', 'Registro adicionado com sucesso');
            $request->session()->flash('status', 'success');// success error notification
            return redirect()->route('clients.edit',$id);
        }else{
            $request->session()->flash('msg', 'erro ao adicionar um registro');
            $request->session()->flash('status', 'error');
            return redirect()->back();

        }


    }

    
    public function edit($id)
    {
        $routerName = $this->router;
        $register = $this->model->find($id);

        
         if($register){
            $page2 = "Editar Telefone";

            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>'Home'], 
                (object)['url'=>route('clients.index'),'title'=>'Lista de usuários'],
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
        
        Validator::make($data, [
            'phone' => 'required|string|max:255',
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

        //$routerName = $this->router;
        return redirect()->route('clients.index');
    }
}
