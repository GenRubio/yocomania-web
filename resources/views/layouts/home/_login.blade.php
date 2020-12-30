<div class="card mr-5" style="box-shadow: 5px 10px 18px #888888;">
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            {!! $errors->first('nombre', '<span style="color:red" class="help-block">:message</span>') !!}
            <div class="form-group">
                <input name="nombre" id="loginNombre" type="text" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Usuario..." required>
            </div>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                placeholder="Contraseña..." required>
            <a href="{{ route('recover.password') }}" style="text-decoration: none; color:#3490dc;"><strong>¿Contraseña
                    olvidada?</strong></a>
            <br><br>
            <button style="width: 100%" type="submit" class="btn btn-outline-primary"><strong>ENTRAR</strong></button>
        </form>
    </div>
</div>
<script>
      $(document).ready(function() {
          $("#loginNombre").focus();
      });
</script>
