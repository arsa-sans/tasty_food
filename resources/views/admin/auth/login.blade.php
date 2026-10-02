<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Tasty Food</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-black text-gray-200 antialiased min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md p-8 bg-gray-900 border border-gray-800 rounded-xl shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-amber-500 tracking-wider uppercase mb-2">Tasty Food</h1>
            <p class="text-gray-400">Admin Login</p>
        </div>

        @if($errors->any())
            <div class="mb-6 bg-red-900/50 border border-red-500 text-red-200 px-4 py-3 rounded relative" role="alert">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-white placeholder-gray-500" 
                    placeholder="Enter admin password">
            </div>

            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-black font-semibold py-3 px-4 rounded-lg transition-colors">
                MASUK
            </button>
        </form>
        
        <div class="mt-8 text-center text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-amber-500 transition-colors">&larr; Kembali ke Website</a>
        </div>
    </div>

</body>
</html>
