
@extends('layouts.dashboard')

@section('content')
    <div Class="container">
    <h1>Create Category</h1>
    <form action="{{route('categories.update',$category->id)}}" method="post">

    @method('put')
    @csrf

    <!-- <input type="hidden" name="_method" value="put">
    <input type="hidden" name="_token" value="<//?= csrf_token()?>"> -->

    <!-- <//?= csrf_field()?> -->

    @include('/categories/_form')

    <div class="from-group">
        <button class="btn btn-primary" type="submit">Submit</button>
      
    </div>
    </form>
   


    </div>

@endsection