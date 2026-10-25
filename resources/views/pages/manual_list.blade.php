<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li>
            <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/"
                alt="Manuals for '{{ $brand->name }}'"
                title="Manuals for '{{ $brand->name }}'">
                {{ $brand->name }}
            </a>
        </li>
    </x-slot:breadcrumb>


    <h1>{{ $brand->name }}</h1>
    <x-top5pop :manuals="$topManuals"/>


    <p>{{ __('introduction_texts.type_list', ['brand'=>$brand->name]) }}</p>



    <div class="manual-grid">
        @foreach ($manuals as $manual)
            <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/"
                class="manual-item"
                alt="{{ $manual->name }}"
                title="{{ $manual->name }}">
                {{ $manual->name }}
                <span class="manual-size">({{ $manual->filesize_human_readable }})</span>
            </a>
        @endforeach
    </div>

</x-layouts.app>
