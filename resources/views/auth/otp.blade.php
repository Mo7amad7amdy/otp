@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">OTP Validation</h4>

                <form class="card p-2" action="{{ route('otp.send') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="verify_code" id="otp" placeholder="Type your OTP" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div>
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <div>Expire In <span id="timer"></span></div>

                </form>
                <br>
                <form class="needs-validation" action="{{ route('otp.resend') }}" method="post">
                    @csrf
                    <button class="btn btn-success" type="submit" disabled="disabled" id="resendButton">Resend OTP</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        let timerOn = true;

        function timer(remaining) {
            var m = Math.floor(remaining / 60);
            var s = remaining % 60;

            m = m < 10 ? '0' + m : m;
            s = s < 10 ? '0' + s : s;
            document.getElementById('timer').innerHTML = m + ':' + s;
            remaining -= 1;

            if(remaining >= 0 && timerOn) {
                setTimeout(function() {
                    timer(remaining);
                }, 1000);
                return;
            }

            if(!timerOn) {
                // Do validate stuff here
                return;
            }

            // Do timeout stuff here
            $('#resendButton').prop("disabled", false);
        }

        timer(120);
    </script>
@endsection
