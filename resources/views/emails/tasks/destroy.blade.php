@component('mail::message')
    # Introduction

    S'ha eliminat una tasca.

    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
