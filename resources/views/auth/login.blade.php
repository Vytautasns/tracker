@extends('layouts.app')

@section('content')
  <img src="http://www.rd.com/wp-content/uploads/sites/2/2017/01/02-know-reasons-hit-workout-plateau-505776960-BartekSzewczyk.jpg" id="bg" alt="">

<div class="uk-width-5-6 uk-width-1-3@m uk-position-center uk-overlay uk-overlay-default uk-margin-remove">
  <div>
    <form method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}

        <fieldset class="uk-fieldset">

            <legend class="uk-legend">Login</legend>

            <div class="uk-margin">
                  <div class="uk-inline uk-width-1-1">
                      {{-- <span class="uk-form-icon" uk-icon="icon: user"></span> --}}
                      <span class="uk-form-icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                      </span>
                      <input id="email" type="email" name="email" class="uk-input {{ $errors->has('email') ? ' uk-form-danger' : '' }}" type="text" placeholder="Email">
                  </div>
                  @if ($errors->has('email'))
                    <div class="uk-alert-warning" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                  @endif
              </div>

              <div class="uk-margin">
                    <div class="uk-inline uk-width-1-1">
                        {{-- <span class="uk-form-icon" uk-icon="icon: user"></span> --}}
                        <span class="uk-form-icon">
                          <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        <input id="password" type="password" name="password" class="uk-input {{ $errors->has('password') ? ' uk-form-danger' : '' }}" type="password" placeholder="Password">
                    </div>
                    @if ($errors->has('password'))
                      <div class="uk-alert-warning" uk-alert>
                          <a class="uk-alert-close" uk-close></a>
                          <strong>{{ $errors->first('password') }}</strong>
                      </div>
                    @endif
                </div>

                <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom">Login</button>


        </fieldset>
    </form>
    <a href="/register">Register new account</a>
   </div>
</div>




{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
