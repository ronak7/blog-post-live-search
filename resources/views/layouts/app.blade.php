<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript">
        $('#search-date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: true
        });

        var _token = $('input[name="_token"]').val();

        load_data('', _token);

        function load_data(date="", _token)
        {
            $.ajax({
                url:"{{ route('post.search') }}",
                method:"POST",
                data:{date:date, _token:_token},
                success:function(data)
                {
                    var resData = data.posts;
                    var html = '';
                    const monthNames = ["January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"
                        ];
                    $.each(resData, (i,value) => {
                        html += '<div class="card mb-4"><div class="card-body"><h2 class="card-title">'+ value.title +'</h2>';
                        html += '<p class="card-text">'+ value.body+'</p>';
                        var resData = data.posts;
                        $.each(value.category, (v,cat) => {
                            html += '<a href="#" class="btn btn-primary">'+ cat.name +'</a>&nbsp;&nbsp;';
                        });
                        var d = new Date(value.created_at);
                        var created_at_date = monthNames[d.getMonth()] + ' ' + d.getDate() + ', ' + d.getFullYear();
                        html += '</div><div class="card-footer text-muted">Posted on '+ created_at_date  +'</div></div>';
                    });

                    $('#post-list').html(html);

                    var categories = '<option>Select</option>';
                    $.each(data.categories, (index, category) => {
                        categories += '<option value="'+ category.id +'">'+ category.name +'</option>';
                    });
                    $('#category_id').html(categories);
                }
            })
        }

        $(document).on('change', '#search-date', function(){
            var date = $(this).val();
            load_data(date, _token);
        });
    </script>
</html>
