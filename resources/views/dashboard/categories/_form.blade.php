
<!---->
<div class="form-group">
        <label for="">Category Name</label>
       <x-form.input name="name" :value="$category->name"/>
    </div>

    <div class="form-group">
        <label for="">Category Parent</label>
        <select   name="parent_id" class="form-controller">
            <option value="">Primary Category</option>
            @foreach ($parents as $parent)
                 <option value="{{ $parent->id }}" @selected(old('parent_id',$parent->id) == $category->parent_id)>{{ $parent->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" class="form-controller">{{ old('description',$category->description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="">Image</label>
        <input type="file" name="image" class="form-controller"/>
    </div>

    <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active" @checked(old('status',$category->status) === "active")>
    <label class="form-check-label" for="exampleRadios1">
       Active
    </label>
</div>

<div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="exampleRadios2" @checked(old('status',$category->status) === "archived") value="archived">
    <label class="form-check-label" for="exampleRadios2">
       Archived
    </label>
</div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ $button_label ?? 'save' }}</button>
    </div>