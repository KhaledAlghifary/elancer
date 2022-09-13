@foreach ($categories as $category)
<?php $id_e = $category->id ?>


<tr>
    <td>{{$category->id}}</td>
    <!-- <td><a href="/categories/show/<//?= $category->id ?>"><//?= $category->name ?></a></td> -->

    <td><a href="{{route('categories.show',[$category])}}"><?= $category->name ?></a></td>


    <td><?= $category->slug ?></td>
    <td><?= $category->parent->name ?></td>
    <td><?= $category->created_at ?></td>

    <!-- <td><a href="{{route('categories.edit',[$category->id])}}">edit</a></td> -->
    <td>
    <form action="{{route('categories.update',$category->id)}}" method="post">
            @method('put')
            <!-- <input type="hidden" name="_method" value="delete"> -->
            @csrf
            <button type="button" class="btn btn-success btn-sm edit-btn" >Edit</button>

        </form>

       
    
    </td>
    
    <td>
        <form action="{{route('categories.destroy',$category->id)}}" method="post">
            @method('delete')
            <!-- <input type="hidden" name="_method" value="delete"> -->
            @csrf
            <button class="btn btn-sm btn-danger">Delete</button>

        </form>
    </td>
</tr>
@endforeach

<!-- the with query s replace the append -->

<tr>
    <td colspan="100%" id="pagination">{{$categories->withQueryString()->links()}}
</td>
</tr>
