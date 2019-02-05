<!doctype html>
<html lang="fr">

@include('includes.head')

<body class="d-flex align-items-center bg-auth border-top border-top-2 border-primary" style="background-image: url('/img/daniel-jensen-440210-unsplash.jpg'); background-size: cover; background-repeat: no-repeat;">

  <!-- CONTENT
    ================================================== -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-5 col-xl-4 my-5">

        <div class="text-center">

          <!-- Preheading -->
          <h6 class="text-uppercase text-muted mb-4">
            Vous êtes perdu?
          </h6>

          <!-- Heading -->
          <h1 class="display-4 mb-3">
            Il n'y a personne ici 😭
          </h1>

          <!-- Subheading -->
          <p class="text-muted mb-4">
            On se perd parfois mais la sortie est proche.
          </p>

          <!-- Button -->
          <a href="{{route('home')}}" class="btn btn-lg btn-primary">
            Retourner à l'accueil
          </a>

        </div>

      </div>
    </div> <!-- / .row -->
  </div> <!-- / .container -->

</body>

</html>