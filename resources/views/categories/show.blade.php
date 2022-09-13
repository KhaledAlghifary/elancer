@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1 class="mb-3">Category-<?= $category->id ?></h1>
        <div class="table-responsive"></div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Parent ID</th>
                    <th>Created At</th>
                </tr>
            <tbody>
                

                    <tr>
                        <td><?= $category->id ?></td>
                        <td><?= $category->name ?></a></td>
                        <td><?= $category->slug ?></td>
                        <td><?= $category->parent_id ?></td>
                        <td><?= $category->created_at ?></td>
                    </tr>
               
            </tbody>
    </div>
    </div>
    </thead>
    </table>
@endsection