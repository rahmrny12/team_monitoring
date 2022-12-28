@extends('layouts.app')

@section('content')
    <section class="vh-100 m-5">
        <div class="container-fluid h-custom">
            <div class="row">
                <div class="col-md-5 text-center bg-white">
                    <h3 class="my-5">Sign in to HubStaff</h3>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <button class="btn btn-light mt-3 w-25 fw-bold text-light mx-auto px-3" style="background-color: #1CF1CF"
                                type="submit">Log In</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-7 p-5 rounded" style="background-color: #1CF1CF">
                    <h1>Have you heard about
                        Hubstaff?</h1>
                    <h5 class="mb-5">The Agile, visual project management tool is changing
                        the way teams work. Collaborate better and get more
                        done with focused sprints and detailed project boards.</h5>
                    <img class="img-fluid w-50" src="{{ asset('assets/images/login-page.png') }}">
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
