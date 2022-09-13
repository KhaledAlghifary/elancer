<x-app-layout title="edit Project">

<form action="{{route('client.projects.update',$project->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
	@include('client.projects._form')
</form>
</x-app-layout>