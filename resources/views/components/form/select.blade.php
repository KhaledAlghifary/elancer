@props([
        'id','name','label','selected'=>'' ,'options'
        
        ])

    <div class="from-group">
    @if(isset($label))
    <label for="{{$id}}">{{$label}}</label>
    @endif
        <select
         
         id="{{$id}}"
          name="{{$name}}" 
       

          {{ $attributes->class( ['form-control', 'is-invalid'=> $errors->has($name)] ) }} 

        >
        <option></option>
          @foreach($options as $parent=>$text)
          <option value="{{$parent}}" <?php if($parent == old($name,$selected)):?> selected <?php endif ?>> {{$text}}</option>
            
          @endforeach 

          </select>
        @error($name)
            <p class="invalid-feedback" name="error">{{$message}}</p>
        @enderror

        <p class="invalid-feedback" id="{{$name}}-error"></p>


    </div>
