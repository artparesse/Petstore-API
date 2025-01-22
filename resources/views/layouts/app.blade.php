<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Management</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
<header class="bg-blue-600 text-white py-4">
    <div class="container mx-auto">
        <a href="/">
            <h1 class="text-3xl font-bold">Pet Store</h1>
        </a>
    </div>
</header>
<main class="container mx-auto py-8">
    @if($errors->any())
        <div class="bg-red-100 mb-4 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</main>
<footer class="bg-gray-800 text-white py-4 mt-8">
    <div class="container mx-auto text-center">
        <p>© {{ date('Y') }} Pet Store. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
