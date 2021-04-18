@extends('app.app')
@section('content')
<main role="main">   
    <header class="section background-dark">
        <div class="line">        
            <h1 class="text-white margin-top-bottom-40 text-size-60 text-line-height-1">Reset Password</h1>
        </div>  
    </header>
    <!-- Section 1 -->
    <section class="section-small-padding background-white"> 
        <div class="line">
            <div class="margin" >
                @include("app.notices.flash")
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </section>
</main>
@endsection

