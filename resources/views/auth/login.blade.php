<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}" id="stylesheetLight">
  <link rel="stylesheet" href="{{ asset('css/theme-dark.min.css') }}" id="stylesheetDark">

  <style>body { display: none; }</style>

  <script>
    var colorScheme = ( localStorage.getItem('dashkitColorScheme') ) ? localStorage.getItem('dashkitColorScheme') : 'light';</script>


  <title>{{ config('Printeerz', 'Printeerz') }}</title>
</head>

<body class="d-flex align-items-center bg-auth border-top border-top-2 border-primary">

  <!-- CONTENT
    ================================================== -->
  <div class="container" id="app">
    <div class="row justify-content-center">
      <div class="col-12 col-md-5 col-xl-4 my-5">
        <div class="text-center">
            <img src="{{ asset('img/logo/logo.png') }}" alt="printeerz_logo" class="img mb-6" width="192">
        </div>

        {{-- <!-- Heading -->
        <h1 class="display-4 text-center mb-3">
          Connexion
        </h1> --}}

        <!-- Subheading -->
        <p class="text-muted text-center mb-5">
          Accéder au back-office
        </p>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}

          <!-- Email address -->
          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

            <!-- Label -->
            <label>Adresse email</label>

            <!-- Input -->
            <input type="email" id="email" name="email" class="form-control" placeholder="nom@domaine.com" value="{{ old('email') }}"
              required autofocus>
            @if ($errors->has('email'))
            <div class="invalid-feedback">
              {{ $errors->first('email') }}
            </div>
            @endif
          </div>

          <!-- Password -->
          <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">

            <div class="row">
              <div class="col">

                <!-- Label -->
                <label>Mot de passe</label>

              </div>
              <div class="col-auto">

                <!-- Help text -->
                <a href="{{ route('password.request') }}" class="form-text small text-muted">
                  Mot de passe oublié?
                </a>

              </div>
            </div> <!-- / .row -->

            <!-- Input -->
            <input id="password" type="password" name="password" class="form-control form-control-appended" placeholder="Entrer votre mot de passe">

            @if ($errors->has('password'))
            <div class="invalid-feedback">
              {{ $errors->first('password') }}
            </div>
            @endif
          </div>

          <!-- Submit -->
          <button type="submit" class="btn btn-lg btn-block btn-primary mb-3">
            Connexion
          </button>

          <!-- Link -->
          <div class="text-center">
            <div class="checkbox">
              <label class="text-muted">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se souvenir de moi
              </label>
            </div>
          </div>

        </form>

      </div>
    </div> <!-- / .row -->
  </div> <!-- / .container -->

  <!-- JAVASCRIPT
    ================================================== -->
  <script src="{{ asset('js/app.js') }}"></script>
  <!-- Libs JS -->
  <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Theme JS -->
  <script src="{{ asset('js/theme.min.js') }}"></script>

</body>

</html>