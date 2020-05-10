<div class="table-responsive">
  <table class="table">
      <thead>
      <tr>
        @foreach($columnList as $key => $value)
          <th>{{$value}}</th>
        @endforeach 
          <th>Ações</th>
      </tr>
      </thead>
      <tbody>
      @foreach($list as $key => $value)
          <tr>
          @foreach($columnList as $key2 => $value2)
            @if($key2 != "phone")
                <td>@php echo $value->{$key2} @endphp</td>
            @else
                <td>@php 
                  $phones = '';
                  $array_phones = $value->phones;
                  foreach ($value->phones as $key => $value3) {
                    $phones = $phones.' '.$value3['phone'];
                  }
                  echo $phones
                @endphp</td>
            @endif        
          @endforeach  
            <td>
              <a href="{{route($routerName.'.show',$value->id)}}"><i style="color:black" class="material-icons">pageview</i></a>
              <a href="{{route($routerName.'.edit',$value->id)}}"><i style="color:yellow" class="material-icons">create</i></a>
              <a href="{{route($routerName.'.show',[$value->id,'delete=1'])}}"><i  style="color:red" class="material-icons">delete</i></a>
              @if (!empty($phones))
                  <a style="cursor:pointer" data-toggle="modal" data-target="{{'#m'.strval($value->id)}}"><i style="color:blue" class="material-icons">phone</i></a>
              @endif
              
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>


@if (!empty($phones))
  <!-- Modal -->
  @foreach ($list as $key => $value)
      <div class="modal fade" id="{{'m'.strval($value->id)}}" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Telefones</h4>
          </div>
          <div class="modal-body">
          @foreach ($value->phones as $key => $value2 )
              <span style="padding:5px">{{$value2['phone']}}</span>
              <span style="padding:5px">
                <a style="padding:2px" href="{{'tel:+.'.$value2['phone'] }}"><i style="font-size:1.6em;color:blue" class="fas fa-phone-square"></i></a>
                <a style="padding:2px" href="{{ 'https://api.whatsapp.com/send?phone=55.'.$value2['phone'].'.&text=Olá,%20meu%20amigo!'}}"><i style="font-size:1.8em;color:green" class="fab fa-whatsapp"></i></a>
              </span>
              <br>
          @endforeach
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div>
        
      </div>
    </div>

  @endforeach
@endif  
