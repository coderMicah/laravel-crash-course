@props(['name'])
@error($name)
    <p class="mt-1 text-xs text-rose-500 font-semibold">{{ $message }}</p>
@enderror
