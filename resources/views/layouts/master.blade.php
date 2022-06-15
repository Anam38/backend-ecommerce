<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <title>Laravel 8 Vue JS CRUD Example  - Tutsmake</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>

    <link rel="shortcut icon" href="{{ asset ('template/images/favicon.png')}} " />

    @include('layouts.snippets.styles')

    @stack('styles')

</head>
<body>
  <div class="container-scroller">
    <div id=app>
      <content-component>
        <!-- content -->
        <!-- end content -->
      </content-component>
    </div>
  </div>

  <!-- script -->
  <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

  @include('layouts.snippets.scripts')

  @stack('scripts')
</body>
</html>
