<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    @inertiaHead
  </head>
  <body class="nav-md">
    @inertia
    <script src="{{ mix('js/app.js') }}"></script> <!-- Ou o caminho para seu arquivo JS compilado -->
  </body>
</html>