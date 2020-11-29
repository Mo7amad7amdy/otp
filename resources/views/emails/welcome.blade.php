@component('mail::message')

    {!! $body !!}

    @if($btnText)
        @component('mail::button', ['url' => $btnUrl ? $btnUrl : "" ])
            {{ $btnText }}
        @endcomponent
    @endif

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
