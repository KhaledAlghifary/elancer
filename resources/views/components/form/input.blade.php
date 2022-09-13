    @props([
        'id','name','label'=>' ','value'=>'','type' =>'text'
        ])

    <div class="from-group">
    <label for="{{$id}}">{{$label}}</label>
        <input
         type="{{$type}}" 
         id="{{$id}}"
          name="{{$name}}" 
          value="{{old($name,$value)}}"

          {{ $attributes->class(['form-control', 'is-invalid'=> $errors->has($name)]) }} 

        >
         
        @error($name)
            <p class="invalid-feedback" name="error">{{$message}}</p>
        @enderror

        <p class="invalid-feedback" id="name-error"></p>

    </div>
