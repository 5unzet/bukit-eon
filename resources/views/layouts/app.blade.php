<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukit Eon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('components.swal')
</head>
<body>
    @yield('content')
</body>
@if(session('swal'))
<script>
    Swal.fire(@json(session('swal')));
</script>
@endif
</html>
