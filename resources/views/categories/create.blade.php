@extends('layouts.dashboard')

@section('content')



<div Class="container">
    <h1>Create Category</h1>
    <form action="{{route('categories.store')}}" method="post" id="form-create" class="form">

        @csrf
        <!-- <input type="hidden" name="_token" value="<//?= csrf_token()?>"> -->


        @include('/categories/_form')
        <div class="from-group">
        <button class="btn btn-primary" type="submit">Submit</button>
      
    </div>
    </form>



</div>

<x-ajax/>
@endsection