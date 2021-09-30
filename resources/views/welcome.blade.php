<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <title>E-commerce</title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
    <link rel="icon" type="image/png" sizes="32x32" href="/ico/favicon-32x32.png">
</head>
<body>
    <div id="app"></div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>