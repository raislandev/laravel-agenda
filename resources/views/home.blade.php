@extends('layouts.app')

@section('content')

 @page_component(['col'=>12, 'page'=>$page])
        
        <!-- Portfolio Grid -->
        <div id="portfolio">

            <div class="row">
              @can ('crud_user_acl')
              <div style="cursor:pointer" onclick="window.location = '{{route('users.index')}}'" class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" >
                  <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                      <i class="fas fa-plus fa-3x"></i>
                    </div>
                  </div>
                  <img class="img-fluid" src="{{asset('img/portfolio/user.webp')}}" alt="">
                </a>
                <div class="portfolio-caption">
                  <h4>Lista de Usuários</h4>
                  <p class="text-muted">Criar ou Editar</p>
                </div>
              </div>
              @endcan

              <div style="cursor:pointer" onclick="window.location = '{{route('clients.index')}}'" class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link">
                  <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                      <i class="fas fa-plus fa-3x"></i>
                    </div>
                  </div>
                  <img class="img-fluid" src="{{asset('img/portfolio/clients.webp')}}" alt="">
                </a>
                <div class="portfolio-caption">
                  <h4>Lista de Clientes</h4>
                  <p class="text-muted">Criar ou Editar</p>
                </div>
              </div>

                <div style="cursor:pointer" onclick="window.location = '{{route('logs.index')}}'" class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link">
                  <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                      <i class="fas fa-plus fa-3x"></i>
                    </div>
                  </div>
                  <img class="img-fluid" src="{{asset('img/portfolio/log.webp')}}" alt="">
                </a>
                <div class="portfolio-caption">
                  <h4>Lista de Logs</h4>
                  <p class="text-muted">Logs</p>
                </div>
              </div>  

             @can ('crud_user_acl')
              <div style="cursor:pointer" onclick="window.location = '{{route('roles.index')}}'" class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" >
                  <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                      <i class="fas fa-plus fa-3x"></i>
                    </div>
                  </div>
                  <img class="img-fluid" src="{{asset('img/portfolio/function.webp')}}" alt="">
                </a>
                <div class="portfolio-caption">
                 <h4>Lista de Funções</h4>
                  <p class="text-muted">Criar ou Editar</p>
                </div>
              </div>

              <div style="cursor:pointer" onclick="window.location = '{{route('permissions.index')}}'" class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link">
                  <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                      <i class="fas fa-plus fa-3x"></i>
                    </div>
                  </div>
                  <img class="img-fluid" src="{{asset('img/portfolio/permission.webp')}}" alt="">
                </a>
                <div class="portfolio-caption">
                  <h4>Lista de Permissões</h4>
                  <p class="text-muted">Criar ou Editar</p>
                </div>
              </div>
              @endcan

            </div>

        </div>
@endpage_component
@endsection
