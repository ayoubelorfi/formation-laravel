<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        {!! Html::style('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css') !!}
    </head>
    <body>
        @component('navbar')
        @endcomponent
        @yield("body")
        {!! Html::script('https://code.jquery.com/jquery-3.3.1.slim.min.js') !!}
        {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js') !!}
        {!! Html::script('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js') !!}
    </body>
</html>
