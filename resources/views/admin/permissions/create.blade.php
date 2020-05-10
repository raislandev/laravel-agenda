@extends('layouts.app')

@section('content')
           @page_component(['page'=>$page,'col'=>12])

                @alert(['msg'=>session('msg'), 'status'=>session('status')])

                @endalert  


                @breadcrumb(['itens'=>$breadcrumb ?? []])

                @endbreadcrumb  

              
                @form_component(['action'=>route($routerName.".store"),'method'=>"POST"])
                  @include('admin.'.$routerName.'.form')
                  <button class="btn btn-primary float-right" >Adicionar</button>
                @endform_component


            @endpage_component
@endsection