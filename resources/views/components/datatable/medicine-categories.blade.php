<div class="flex w-60 flex-wrap gap-1.5">
    @if ($categories->count() > 0)
        @foreach ($categories as $item)
            <p class="block w-fit px-1.5 py-1 text-xs rounded-md bg-primary text-white">
                {{ $item->name }}
            </p>
        @endforeach
    @else   
        <p class="block w-fit px-1.5 py-1 text-xs rounded bg-gray-500 text-white">
            Tanpa Kategori
        </p>
    @endif
</div>
{{-- {{ $row->name }} --}}