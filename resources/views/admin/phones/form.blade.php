<div class="row">
    <div class="form-group col-6">
        <label for="phone">Telefone</label>
        <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"  value="{{ old('phone') ?? ($register->phone ?? '') }}">
        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>    
    

</div>

