@extends('layouts.auth')
@section('title') Inicio de sesión @endsection
@section('content')
<div class="bg-image" style="background-image: url('/media/photos/fondo-login.webp');">
  <div class="row mx-0 bg-black-50">
    <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
      <div class="p-4">
        <p class="fs-3 fw-semibold text-white">
          Get Inspired and Create. <br>
          Don't worry be happy
        </p>
        <p class="text-white-75 fw-medium">
          Copyright &copy; <span data-toggle="year-copy"></span>
        </p>
      </div>
    </div>
    <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-body-extra-light">
      <div class="content content-full">        
        <div class="px-4 py-2 mb-4">
          <a class="link-fx fw-bold" href="index.html">
            <i class="fa fa-fire"></i>
            <span class="fs-4 text-body-color">code</span><span class="fs-4">base</span>
          </a>
          <h1 class="h3 fw-bold mt-4 mb-2">Bienvenido a tu tablero</h1>
          <h2 class="h5 fw-medium text-muted mb-0">¡Es un gran día hoy!</h2>
        </div>
        <form class="js-validation-signin" action="{{ route('login') }}" method="post">
          @csrf
          <div class="form-floating mb-4">
            <input type="text" class="form-control @if ($errors->has('email')) is-invalid @endif" id="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required="true" autofocus>
            <label class="form-label" for="login-username">Correo electrónico</label>
            @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-floating mb-4">
            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
            <label class="form-label" for="login-password">Contraseña</label>
          </div>
          <div class="mb-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="login-remember-me" name="login-remember-me" checked>
              <label class="form-check-label" for="login-remember-me">Recuerdame</label>
            </div>
          </div>
          <div class="mb-4">
            <button type="submit" class="btn btn-lg btn-alt-primary fw-semibold">
              Iniciar sesión
            </button>
            <div class="mt-4">
              <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" href="#">
                Create Account
              </a>
              <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block" href="#">
                ¿Olvidaste tu contraseña?
              </a>
            </div>
          </div>
        </form>        
      </div>
    </div>
  </div>
</div>
@endsection
