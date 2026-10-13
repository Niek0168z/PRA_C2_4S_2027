<x-layouts.app>
    <p>Verwijderen</p>
    <ol class="mb-0">
        @foreach ($manuals as $manual)
            <li>
                {{-- <a href="/{{ $manual->brand->id }}/{{ $manual->brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" title="{{ $manual->brand->name }}: {{ $manual->name }}">{{ $manual->brand->name }}: {{ $manual->name }}</a> --}}
                <p>{{ $manual->brand->name }}: {{ $manual->name }} <button>tets</button></p>
            </li>
        @endforeach
    </ol>
</x-layouts.app>
