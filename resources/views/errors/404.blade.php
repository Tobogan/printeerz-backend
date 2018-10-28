<h2>{{ $exception->getMessage() }}</h2>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                    Une erreur est survenue, merci de contacter le service support.
                </div>
            </div>
        </div>
    </div>
</div>
<style>

@import url('https://fonts.googleapis.com/css?family=Raleway');

    body { background: linear-gradient(
                rgba(0, 0, 0, 0.45), 
                rgba(0, 0, 0, 0.45)
                ),url(/img/daniel-jensen-440210-unsplash.jpg);
                background-size: cover;
                background-repeat: no-repeat;
                color: white;
                font-family: 'Raleway', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
        }

    .error-template {padding: 40px 15px;text-align: center;}
    .error-actions {margin-top:15px;margin-bottom:15px;}
    .error-actions .btn { margin-right:10px; }
</style>