<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <a href="/" title="{{ __('misc.home_alt') }}" alt="{{ __('misc.home_alt') }}">
            <h1>
                <a href="{{ route('admin.manuals.create') }}">
                    {{ __('misc.homepage_title') }}
                </a>
            </h1>
        </a>
        {{ $introduction_text ?? '' }}
    </div>
</div>
