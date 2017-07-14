@extends('layouts.app')

@section('content')
<div class="uk-background-cover uk-height-viewport" style="background-image: url(http://www.rd.com/wp-content/uploads/sites/2/2017/01/02-know-reasons-hit-workout-plateau-505776960-BartekSzewczyk.jpg);">
  <div class="uk-width-5-6 uk-width-1-3@m uk-position-center uk-card uk-card-default uk-margin-remove">
    <div class="uk-card-body">

      <div class="uk-text-center  uk-margin-small-bottom">
        <i class="fa fa-user fa-3x uk-text-primary" aria-hidden="true"></i>
        <span class="uk-text-lead">fitW3</span>
        <span class="uk-text-meta uk-display-block">Welcome back!</span>

      </div>

      <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

          <fieldset class="uk-fieldset">


              <div class="uk-margin">
                    <div class="uk-inline uk-width-1-1">
                        {{-- <span class="uk-form-icon" uk-icon="icon: user"></span> --}}
                        <span class="uk-form-icon">
                          <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        <input id="email" type="email" name="email" class="uk-input {{ $errors->has('email') ? ' uk-form-danger' : '' }}" type="text" placeholder="Email">
                    </div>
                    @if ($errors->has('email'))
                      <div class="uk-text-danger uk-text-meta" uk-alert>
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
                        <div class="uk-text-danger uk-text-meta" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                      @endif
                  </div>

                  <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom">Login</button>


          </fieldset>
      </form>
      <a href="/register" class="uk-button uk-button-secondary uk-width-1-1">Register new account</a>
     </div>
  </div>
</div>
@endsection
