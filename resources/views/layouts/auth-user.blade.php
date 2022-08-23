<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>{{ isset($headerTitle) ? $headerTitle . '-' : '' }}Lara Camp</title>

  {{-- Style --}}
  @include('includes.style')

</head>

<body>
    {{-- Navbar --}}
    @include('includes.auth-navbar-user')

    {{-- Page Content --}}
    @yield('content')

    {{-- Page Javascript --}}
    @yield('javascript')
    
    {{-- Bootstrap Script --}}
    @include('includes.script')
</body>
</html>