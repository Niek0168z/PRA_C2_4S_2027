<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="Manuals for '{{$brand->name}} {{ $manual->name }}'" title="Manuals for '{{$brand->name}} {{ $manual->name }}'">{{ $manual->name }}</a></li>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" alt="View manual for '{{$brand->name}} '" title="View manual for '{{$brand->name}} {{ $manual->name }}'">View</a></li>
    </x-slot:breadcrumb>


    <h1>{{ $brand->name }} - {{ $manual->name }}</h1>
    <p>{{ __('misc.views', ['count' => $manual->counter])}}</p>

    @php($shortLinkUrl = url('/link/'.$manual->getOrCreateShortCode()))
    <p>
        {{ __('misc.short_link') }}
        <a href="{{ $shortLinkUrl }}" id="short-link">{{ $shortLinkUrl }}</a>
    </p>

    <div id="short-link-copied" style="display: none; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 1000; padding: 12px 24px; background: #333; color: #fff; border-radius: 6px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);">
        {{ __('misc.link_copied') }}
    </div>

    <script>
        document.getElementById('short-link').addEventListener('click', function (event) {
            event.preventDefault();
            const url = this.href;
            const showCopied = function () {
                const copied = document.getElementById('short-link-copied');
                copied.style.display = 'block';
                setTimeout(function () { copied.style.display = 'none'; }, 2000);
            };

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(url).then(showCopied);
            } else {
                const textarea = document.createElement('textarea');
                textarea.value = url;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                showCopied();
            }
        });
    </script>


    @if ($manual->locally_available)
        <iframe src="{{ $manual->url }}" width="780" height="600" frameborder="0" marginheight="0" marginwidth="0">
        Iframes are not supported<br />
        <a href="{{ $manual->url }}" target="new" alt="Download your manual here" title="Download your manual here">Click here to download the manual</a>
        </iframe>
    @else
        <a href="{{ $manual->url }}" target="new" alt="Download your manual here" title="Download your manual here">Click here to download the manual</a>
    @endif

</x-layouts.app>
