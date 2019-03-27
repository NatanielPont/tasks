@component('mail::message')
    # Tasca pendent

    S'ha marcado com  a pendent la tarea:
    {{--{{ $task->name }}--}}
    :anger:

    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('tasks.manager_email') }}
@endcomponent
