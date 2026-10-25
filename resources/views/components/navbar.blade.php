<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-header mr-auto">
            <a class="navbar-brand" href="/" title="{{ __('misc.home_alt') }}">{{ __('misc.homepage_title') }}</a>
        </div>
        <div id="navbar" class="form-inline">
            @auth
                <a href="{{ route('admin.manuals.create') }}">Beheer</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-link" type="submit">Uitloggen</button>
                </form>
            @else
                <a href="{{ route('login') }}">Inloggen</a>
            @endauth

            <script>
                (function () {
                    var cx = 'partner-pub-6236044096491918:8149652050';
                    var gcse = document.createElement('script');
                    gcse.type = 'text/javascript';
                    gcse.async = true;
                    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(gcse, s);
                })();
            </script>
            <gcse:searchbox-only></gcse:searchbox-only>


        </div><!--/.navbar-collapse -->
    </div>
</nav>
