@props(['manuals'])

<section class="top10">
    <h2>Dit zijn de top 10 populairste handleidingen van deze website:</h2>

    <ol class="mb-0">
        @foreach ($manuals as $manual)
            <li>
                <a href="/{{ $manual->brand->id }}/{{ $manual->brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" title="{{ $manual->brand->name }}: {{ $manual->name }}">{{ $manual->brand->name }}: {{ $manual->name }}</a>
            </li>
        @endforeach
    </ol>
</section>
