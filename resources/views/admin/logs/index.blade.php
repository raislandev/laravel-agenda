@extends('layouts.app')

@section('content')
           @page_component(['page'=>$page,'col'=>12])


                @breadcrumb(['itens'=>$breadcrumb ?? []]) 

                @endbreadcrumb  
                

                @tableSite_component(['columnList'=>$columnList,'list'=>$list,'routerName'=>$routerName ])

                @endtableSite_component

                @paginate_component(['search'=>$search, 'list'=>$list])

                @endpaginate_component 

            @endpage_component
@endsection