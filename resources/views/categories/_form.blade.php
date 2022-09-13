
    <x-form.input value="{{$category->name}}" class="form-control-lg" :data_id="$category->id" name="name" label="Name" id=name/>
    

    <x-form.input value="{{$category->slug}}" name="slug" label="Slug" id=slug/>
    

    <div class="from-group">
        <label for="description">Description</label>
        <textarea id="description" name="description"  class="form-control @error('description') is-invalid @enderror">{{old('description',$category->description)}}</textarea>
        @error('description')
            <p class="invalid-feedback" name="error">{{$message}}</p>
        @enderror
    </div>

    <x-form.select id="parent_id" name="parent_id" label="Parent" :options="$categories->pluck('name','id')->toArray()" selected="{{$category->parent_id}} "/>

    <!-- <div class="from-group">
        <label for="parent_id">Parent ID</label>
        <select id="description" name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
            <option value="">No Parent</option>
            @foreach ($categories as $categori)
            <option value="{{$categori->id}}" @if($categori->id == old('parent_id',$categori->parent_id)) selected @endif >{{$categori->name}}</option>
            @endforeach

        </select>

        @error('parent_id')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div> -->

    
    <div class="from-group">
        <label for="art_path">File</label>
        <input type="file" id="art_path" name="art_path" class="form-control @error('art_path') is-invalid @enderror">
        @error('art_path')
            <p class="invalid-feedback" name="error">{{$message}}</p>
        @enderror
    </div>


   