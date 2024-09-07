@props(['author' , 'size'])

@php
$imageSize = match ($size ?? null) {
'xs'=> 'w-6 h-6',
'sm'=> 'w-7 h-7',
'md'=> 'w-10 h-10',
'lg'=> 'w-14 h-14',
};

$textSize = match ($size ?? null) {
'xs'=> 'text-xs',
'sm'=> 'text-sm',
'md'=> 'text-base',
'lg'=> 'text-lg',
}
@endphp


<img class="{{ $imageSize }} rounded-full mr-3" src="{{ $author->profile_photo_url }}" alt="{{ $author->name }}">
<span class="mr-1 {{ $textSize }}">{{ $author->name }}</span>