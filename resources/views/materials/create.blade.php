<div class="row">
    {!! Form::open(['route' => 'materials.store', 'files' => true]) !!}
        @include('materials.fields')
    {!! Form::close() !!}
</div>

