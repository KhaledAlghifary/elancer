@extends('layouts.dashboard')

@section('page-title')
{{$title}}
<small><a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">Create</a></small>

<input id="search" name="search">



@endsection


@section('content')


<button type="button" id="modal-button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Add Category
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="{{route('categories.store')}}" method="post" id="form-modal" class="form">
                    @csrf
                    @method('post')

                    @include('/categories/_form')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="Add-Category">Add</button>
                    </div>
                </form>


            </div>


        </div>
    </div>
</div>



<div class="container">

    <x-flash-message />

    <!-- component called the / is  important -->





    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Parent ID</th>
                <th>Created At</th>

                <th></th>
                <th></th>




            </thead>
            <tbody id="x-tbody">

            </tbody>

        </table>

        <button id="test" type="submit"> test</button>


    </div>
</div>






<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="http://malsup.github.io/jquery.blockUI.js"></script>

<script>
    //the first page
    $(document).ready(function() {

        loadpage();





    });

    //paginate using the href from the a
    $(document).on('click', '.page-link', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');




        loadpage(url);



    })

    //search using the search input
    $(document).on('input', "[name=search]", function(event) {
        event.preventDefault();
        const url = "{{route('categories.table')}}" + "?name=" + $(this).val();




        loadpage(url);



    })

    //delete button

    $(document).on('click', ".btn-danger", function(event) {
        const form = $(this).closest('form');
        const url = form.attr('action');
        const data = form.serialize();
        const tr = $(this).closest('tr');

        event.preventDefault();

        $.ajax({

            url,
            data,
            type: 'DELETE',

            success: function() {
                tr.hide(3000, function() {
                    $(this).remove();
                });


            }

        })
    })

//create modal

    $(document).on('click', '#modal-button', function(event) {
        event.preventDefault();

        $.ajax({

            success: function() {

                $("#Add-Category").on('click', function(event) {
                    const form = $(this).closest('form');
                    const url = form.attr('action');
                    const data = form.serialize();


                    event.preventDefault();

                    $.ajax({
                        url,
                        data,
                        type: 'POST',
                        success: function(result) {

                            $("#form-modal")[0].reset();

                            $("#staticBackdrop").modal('hide');



                            loadpage();


                        }
                    })
                })

            }


        })



    })




    //edit modal

    $(document).on('click', '.edit-btn', function(event) {

        const editForm = $(this).closest('form');
        const UpdateUrl = editForm.attr('action');




        event.preventDefault();
        $.ajax({
            url: UpdateUrl,
            success: function(result) {

                const form = $('#staticBackdrop form')[0];



                $('#staticBackdrop form [name=name]').val(result.name);
                $('#staticBackdrop form [name=slug]').val(result.slug);
                $('#staticBackdrop form [name=description]').val(result.description);
                $('#staticBackdrop form [name=parent_id]').val(result.parent_id)
                $('#staticBackdrop form [name=_method]').val('put');
                $("#staticBackdrop").modal('show');





                $("#Add-Category").on('click', function(event) {
                    event.preventDefault();


                    const form = $(this).closest('form');
                    const data = form.serialize();
                    
                    console.log(UpdateUrl);





                    $.ajax({
                        url: UpdateUrl,
                        data,
                        method: 'PUT',


                        success: function(result) {

                            $("#staticBackdrop").modal('hide');


                            loadpage();


                        },

                        error: function(result) {

                            $("#staticBackdrop").modal('hide');


                            loadpage();


                        },




                    })





                })













            }

        })

    })




    function loadpage(xUrl) {

        const initUrl = "{{route('categories.table')}}";

        $.ajax({
            url: xUrl ?? initUrl,

            success: function(result) {

                $('#x-tbody').html(result)

            },







        });

    }
</script>
@endsection