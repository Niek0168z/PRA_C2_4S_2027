@props(['manuals'])

<section class="top5pop">
    <h2>Dit zijn de top 5 populairste handleidingen van dit merk:</h2>

    <ol class="mb-0">
        @foreach ($manuals as $manual)
            <li>
                <a href="/{{ $manual->brand->id }}/{{ $manual->brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" title="{{ $manual->brand->name }}: {{ $manual->name }}">{{ $manual->brand->name }}: {{ $manual->name }}</a>
            </li>
        @endforeach
    </ol>
</section>
