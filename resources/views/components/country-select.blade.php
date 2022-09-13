<select class="selectpicker with-border" name="country" data-size="7" title="Select Job Type" data-live-search="true">
@foreach($countries as $code => $name)

<option value="{{$code}}" @if($code == $selected) selected @endif  >{{$name}}</option>
@endforeach


</select>

