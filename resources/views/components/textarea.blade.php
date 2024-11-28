@props(['field' => '', 'value' => ''])
<textarea 
    name="{{ $field }}" 
    {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none']) }}
    rows="10"
>{{ old($field, $value) }}</textarea>
@error($field)
    <div class="text-red-600 text-sm mt-2"> {{ $message }} </div>
@enderror
