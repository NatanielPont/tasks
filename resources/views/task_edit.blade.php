<div class="modal fade" tabindex="-1" id="create-{{$task->id}}" role="document" aria-labelledby="create-label"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="/tasks/{{$task->id}}" method="POST">

                    @csrf
                    {{ method_field('PUT') }}
                    <v-input
                            success
                            label="Click name to Edit (max. 25 ctrs)"
                            readonly
                    >
                    </v-input>
                    <br>
                    <input name="name" type="text" value="{{$task->name}}" placeholder="{{$task->name}}" required>
                    Completed:
                    @if ( $task->completed )
                        <input name="completed" type="checkbox" checked>
                    @else
                        <input name="completed" type="checkbox">
                    @endif
                    <v-btn type="Submit" color="info">
                        Editar
                    </v-btn>
                </form>
            </div>
        </div>
    </div>
</div>
