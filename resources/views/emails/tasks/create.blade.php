@component('mail::message')
    # Introduction

    S'ha creat una tasca.

    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
