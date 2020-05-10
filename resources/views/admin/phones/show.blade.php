@extends('layouts.app')

@section('content')
           @page_component(['page'=>$page2,'col'=>12])

                @alert(['msg'=>session('msg'), 'status'=>session('status')])

                @endalert  


                @breadcrumb(['itens'=>$breadcrumb ?? []])

                @endbreadcrumb  
                
                <p>Telefone: {{$register->phone}}</p>
                
               @if($delete)
                  @form_component(['action'=>route($routerName.".destroy",$register->id),'method'=>"DELETE"])
                    <button class="btn btn-danger " >Excluir</button>
                  @endform_component
               @endif
                
            


            @endpage_component
@endsection