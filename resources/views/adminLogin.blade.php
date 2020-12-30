<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <title>Login Panel</title>
</head>

<body>
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg">
        <a class="navbar-brand" href="{{ route('home') }}"><strong style="color: #3490dc;">Yocomania</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
            <div class="col col-lg-5">
                <br><br><br><br>
                <div class="shadow-lg rounded p-3">
                    <div class="d-flex justify-content-center">
                        <h3><strong>Login Panel</strong></h3>
                    </div>
                    <form action="{{ route('admin.login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Usuario</label>
                            <input name="usuario" type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Usuario" required>
                            {!! $errors->first('usuario', '<span style="color:red" class="help-block">:message</span>')
                            !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password" required>
                            {!! $errors->first('password', '<span style="color:red" class="help-block">:message</span>')
                            !!}
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-lg"><strong>Entrar</strong></button>
                        </div>

                    </form>
                </div>

            </div>
            <div class="col">
            </div>
        </div>
    </div>
</body>

</html>
