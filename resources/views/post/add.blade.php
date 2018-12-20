@extends('base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Contactez-moi</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'post_add_post']) !!}
                        <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Votre nom']) !!}
                            {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('content') ? 'has-error' : '' !!}">
                            {!! Form::textarea ('content', null, ['class' => 'form-control', 'placeholder' => 'Votre message']) !!}
                            {!! $errors->first('content', '<small class="help-block">:message</small>') !!}
                        </div>
                        {!! Form::submit('Ajouter !', ['class' => 'btn btn-info pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection