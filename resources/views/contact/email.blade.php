@extends("email")

@section("body")
    Nom : {{ $name }}<br/>
    Email : {{ $email }}<br/>
    Message : {{ $content }}<br/>
@endsection
