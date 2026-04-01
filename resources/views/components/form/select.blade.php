<select name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }}>

@foreach ($options as $value => $label)

<option value="{{ $value }}" 
    {{ $value == $selected ? 'selected' : '' }}>
    {{ $label }}
</option>

@endforeach

</select>