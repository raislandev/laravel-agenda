@extends('layouts.app')

@section('content')
           @page_component(['page'=>$page,'col'=>12])

                @alert(['msg'=>session('msg'), 'status'=>session('status')])

                @endalert  


                @breadcrumb(['itens'=>$breadcrumb ?? []]) 

                @endbreadcrumb  
                  

                @search_component(['routerName'=>$routerName, 'search'=>$search])

                @endsearch_component  


                @table_component(['columnList'=>$columnList,'list'=>$list,'routerName'=>$routerName ])

                @endtable_component

               
                @paginate_component(['search'=>$search, 'list'=>$list])

                @endpaginate_component 

            @endpage_component
@endsection