@component('mail::message')
    # Tasca Completada

    S'ha marcat com a completada:
    {{--{{ $task->name }}--}}


    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('tasks.manager_email') }}
@endcomponent
