<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  </head>
  <body>
    <header class="bg-light p-3">
        <div class="container">
            @if (Route::has('login'))
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a href="{{ url('/') }}" class="navbar-brand">
                        <strong>Resume Website</strong>
                    </a>
                    <div class="ms-auto d-flex align-items-center gap-3">
                        @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="navbar-brand"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="navbar-brand"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="navbar-brand">
                                Register
                            </a>
                        @endif
                    @endauth
                    </div>
                </nav>
            @endif
        </div>
    </header>
    <main class="">
        <div class="container text-center mt-5 mb-5 p-5 bg-light rounded shadow">
            <h1 class="">Find Resume</h1>
            <input type="text" placeholder="Search..." class=" form-control mt-3 mb-3" style="width: 300px; margin: auto;">
            <a href="#" class="btn btn-primary mt-3 mb-3">
                Search
            </a>
        </div>
    </main>

    @if (Route::has('login'))
        <div class=""></div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>