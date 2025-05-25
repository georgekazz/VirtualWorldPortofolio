<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <title>Admin Login | VirtualWorld</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="./img/logo-img.png" type="image/x-icon">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #0f172a;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-gray-900 p-8 rounded-xl shadow-2xl">
        <h2 class="text-3xl font-bold text-center text-purple-400 mb-6">Σύνδεση Διαχειριστή</h2>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-300 mb-2">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 rounded bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-300 mb-2">Κωδικός</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 rounded bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded transition">
                Σύνδεση
            </button>
        </form>

        <p class="text-sm text-gray-500 mt-4 text-center">Είσοδος μόνο για εξουσιοδοτημένους χρήστες.</p>
    </div>
</body>

</html>