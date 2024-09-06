<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
  <!--@ App Meta Tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
    name="viewport" />
  <title>
    @if(empty($title)) {{env("APP_NAME")}} @else {{ $title.' - '.env("APP_NAME")}} @endif
  </title>
  <meta name="robots" content="noindex">
  {{ Vite::useBuildDirectory('theme') }}
  @vite(['resources/theme/css/style.css'])
</head>

<body class="bg-vns-default font-sans antialiased h-screen text-sm">
  <!--Start:: App Page -->
  {{ $slot }}
  <!--End:: App Page -->
  @vite(['resources/theme/js/script.js'])
</body>

</html>