<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>One time notification | App</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->
    @include('layouts.stylesheet')
    @yield('stylesheet')
</head>

<body>
    <div id="app">
        <input type="hidden" id="token" value="{{ csrf_token() }}">
        @include('layouts.header')

        <div class="row mt-5 mx-auto">
            @yield('body')
        </div>

        @include('layouts.script')
        @yield('script')
    </div>
</body>

</html>
