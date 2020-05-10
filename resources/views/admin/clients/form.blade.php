<div class="row">
    <div class="form-group col-6">
        <label for="name">Nome</label>
        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"  value="{{ old('name') ?? ($register->name ?? '') }}">
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="name">E-mail</label>
        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ?? ($register->email ?? '') }}">
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    @if(!empty($register))
       <div class="container">
            <a style="color:white" href="{{route('phones.create',$register->id)}}" class="btn btn-warning" >+ Telefone</a>   
       </div> 

       <div class="container" style="padding:10px">
           @foreach ($register->phones as $key => $value)
            <span style='margin-bottom:5px;margin-left:5px;float:left;padding:10px;background:#778899;border-radius: 25px;color:white'><a href="{{route('phones.edit',$value->id) }}">{{ $value->phone}}</a>
            <a href="{{ route('phones.show',[$value->id,'delete=1'])}}"><i style='color:black;cursor:pointer' class='material-icons'>highlight_off</i></a></span>  
           @endforeach
       </div>
    @endif

    

    <script>

       

 </script>

</div>

