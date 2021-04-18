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
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
        </div>
    </section>
</main>
@endsection

