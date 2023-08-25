@extends('layouts.app')

@section('content')
<section >
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center align-items-md-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="{{asset('logos/befit.png')}}"
          class="img-fluid" alt="Sample image">
      </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form method="POST" action="{{ route('login') }}" name="form">
            @csrf
            <div class="form-outline mb-4">
                <input type="email" id="form3Example3" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                placeholder="Ingrese Email" />

            </div>
            <div class="form-outline mb-3">
                <input type="password" name="password" id="form3Example4" class="form-control form-control-lg @error('password') is-invalid @enderror"
                placeholder="Ingrese Contraseña" />

            </div>

            @if ($errors->any())
                <div class="alert2 alert2-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ __($error) }}<br></li>
                        @endforeach
                        </ul>
                    </div>
            @endif
            <!-- <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('password.reset') }}" class="text-body">¿Olvidaste la contraseña?</a>
            </div> -->

            <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            </div>
            </form>
        </div>
    </div>
  </div>

</section>
@endsection
