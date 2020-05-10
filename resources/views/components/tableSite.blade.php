<table class="table">
    <thead>
     <tr>
      @foreach($columnList as $key => $value)
        <th>{{$value}}</th>
      @endforeach 
     </tr>
    </thead>
    <tbody>
     @foreach($list as $key => $value)
        <tr>
        @foreach($columnList as $key2 => $value2)
          <td>@php echo $value->{$key2} @endphp</td>
        @endforeach  
          <td>
            
          </td>
        </tr>
     @endforeach
   </tbody>
</table>


