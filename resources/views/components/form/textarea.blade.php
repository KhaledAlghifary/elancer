@props([
        'id','name','label'=>' ','value'=>''
        ])

    <div class="from-group">
    @if(isset($label))
    <label for="{{$id}}">{{$label}}</label>
    @endif
        <textarea
      
         id="{{$id}}"
        name="{{$name}}" 
         

          {{ $attributes->class(['form-control', 'is-invalid'=> $errors->has($name)]) }} 

        >
        {{old($name,$value)}}
        </textarea>
         
        @error($name)
            <p class="invalid-feedback" name="error">{{$message}}</p>
        @enderror
        <p class="invalid-feedback" id="{{$name}}-error"></p>


    </div>
