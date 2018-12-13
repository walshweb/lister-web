@php $bodyclass = 'login'; @endphp
@extends('layouts.app')

@section('content')

<div class="row logform">
      <div class="ten columns">
        <form method="POST" action="/authme" autocomplete="off">
            @csrf

            <div class="form-group row">
                <label for="email">Identify Yourself</label>
                    <input id="email" type="text" class="form-control" name="phone" value="{{ old('email') }}" required autofocus placeholder="406-999-999">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>
        </form>
      </div>

</div>

@endsection
