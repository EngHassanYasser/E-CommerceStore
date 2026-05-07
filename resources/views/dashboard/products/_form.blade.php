<!---->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="">product Name</label>
    <x-form.input name="name" :value="$product->name" />
</div>
<div class="form-group">
    <label for=""> product category</label>
    <select name="parent_id" class="form-controller">
        <option value="">Primary product</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('parent_id', $category->id) == $category->parent_id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="">Description</label>
    <textarea name="description" class="form-controller">{{ old('description', $product->description) }}</textarea>
</div>

<div class="form-group">
    <label for="">Quantity</label>
    <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" />
</div>

<div class="form-group">
    <label for="">Image</label>
    <input type="file" name="image" class="form-controller" />
</div>


<div class="form-group">
    <label for="">price</label>
    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
</div>


<div class="form-group">
    <label for="">Compare price</label>
    <input type="number" name="compare_price" class="form-controller" step="0.01" min="0"
        value="{{ old('compare_price', $product->compare_price) }}" />
</div>

<div class="form-group">
    <label>Flags</label>

    <div class="row">
        @foreach ($flags as $flag)
            <div class="col-md-1">
                <label>
                    <input type="checkbox"
                           name="flags[]"
                           value="{{ $flag->id }}"
                           @checked(in_array($flag->id, old('flags', $productFlags ?? [])))>

                    {{ $flag->name }}
                </label>
            </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <label for=""> Tags</label>
    <input type="text" name="tags" value="{{ $tags }}" class="form-controller" />
</div>

<div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active"
        @checked(old('status', $product->status) === 'active')>
    <label class="form-check-label" for="exampleRadios1">
        Active
    </label>
</div>

<div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="exampleRadios2" @checked(old('status', $product->status) === 'archived')
        value="archived">
    <label class="form-check-label" for="exampleRadios2">
        Archived
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="exampleRadios3" @checked(old('status', $product->status) === 'draft')
        value="draft">
    <label class="form-check-label" for="exampleRadios3">
        Draft
    </label>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'save' }}</button>
</div>
