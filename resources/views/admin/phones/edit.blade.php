@extends('layouts.app')

@section('content')
           @page_component(['page'=>$page2,'col'=>12])

                @alert(['msg'=>session('msg'), 'status'=>session('status')])

                @endalert  


                @breadcrumb(['itens'=>$breadcrumb ?? []])

                @endbreadcrumb  

              
                @form_component(['action'=>route($routerName.".update",$register->id),'method'=>"PUT"])
                  @include('admin.'.$routerName.'.form')
                  <button class="btn btn-primary float-right" >Editar</button>
                @endform_component


            @endpage_component
@endsection