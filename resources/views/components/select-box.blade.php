
@props(['selectLabel' => "선택하세요", 'options' => [ ]  ])

<select {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    <option value="" class="hidden" >{{ $selectLabel }}</option>
    @foreach ((array)$options as $key => $value)
        <option value="{{ $key }}" class=" " >{{ $value }}</option>
    @endforeach
</select>
