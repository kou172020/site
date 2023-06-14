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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>


    <script>
            $(document).ready(function() {
            // 商品一覧を非同期で取得
            function getProductList() {
                var url = "{{ route('products') }}";
                var keyword = $('input[name="keyword"]').val();
                var company_id = $('select[name="company_id"]').val();
                var price_min = $('input[name="price_min"]').val();
                var price_max = $('input[name="price_max"]').val();
                var stock_min = $('input[name="stock_min"]').val();
                var stock_max = $('input[name="stock_max"]').val();

                //URLにパラメータを追加
                if (!empty(keyword)) {
                    url = "{{ route('products') }}" + "?keyword=" + encodeURIComponent(keyword);
                }

                if (!empty(company_id)) {
                url += (url.includes('?') ? '&' : '?') + "&company_id=" + encodeURIComponent(company_id);
                }


                if (!empty(price_min)) {
                url += (url.includes('?') ? '&' : '?') + 'price_min=' + encodeURIComponent(price_min);
                }
                if (!empty(price_max)){
                    url += (url.includes('?') ? '&' : '?') + 'price_max=' + encodeURIComponent(price_max);
                }

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        $('#product_table').html(response.view);
                    },
                    error: function() {
                        alert("商品一覧の取得に失敗しました。");
                    }
                    });
                }

            getProductList('','');


            $('form#search_form').on('submit', function(e) {
                e.preventDefault();
                getProductList();
            });
            });



            //ソート

            $(function() {
            $('th a').click(function() {
                event.preventDefault();
                var url = "{{ route('products') }}";
                var keyword = $('input[name="keyword"]').val();
                var company_id = $('select[name="company_id"]').val();
                var price_min = $('input[name="price_min"]').val();
                var price_max = $('input[name="price_max"]').val();
                var stock_min = $('input[name="stock_min"]').val();
                var stock_max = $('input[name="stock_max"]').val();


                // クリックされたヘッダーのカラム名とソート順を取得
                var sortkey = $(this).data('sort-key');
                var sortorder = $(this).hasClass('asc') ? 'desc' : 'asc';

                // 検索条件が入力されている場合は、URLにパラメータを追加する
                if (!empty(sortkey)) {
                    url += (url.includes('?') ? '&' : '?') + 'sort_key=' + encodeURIComponent(sortKey);
                }
                if (!empty(sortorder)) {
                    url += (url.includes('?') ? '&' : '?') + 'sort_order=' + encodeURIComponent(sortOrder);
                }

                // 矢印アイコンの色を変更
                $('th a').removeClass('asc desc');
                $(this).addClass(sortorder);

                $.ajax({
                type: "GET",
                url: url,
                
                success: function(response) {
                    $('#product_table').html(response.view);
                },
                error: function() {
                    alert("商品一覧の取得に失敗しました。");
                }
                });

                return false;
            });
            });

            // 削除ボタンのクリックイベントを設定
            $(document).on('click', '.delete-button', function() {
                var form = $(this).closest('form');

                if (confirm('本当に削除しますか？')) {
                    $.ajax({
                        type: 'POST',
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function(response) {
                            alert(response.message);
                            form.closest('tr').remove();
                        },
                        error: function() {
                            alert('削除に失敗しました');
                        }
                    });
                }
            });





    </script>





    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
</html>
