@extends('base')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="card">
                    <div class="card-header">Contactez-moi</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'send']) !!}
                        <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Votre nom']) !!}
                            {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Votre email']) !!}
                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('content') ? 'has-error' : '' !!}">
                            {!! Form::textarea ('content', null, ['class' => 'form-control', 'placeholder' => 'Votre message']) !!}
                            {!! $errors->first('content', '<small class="help-block">:message</small>') !!}
                        </div>
                        {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection