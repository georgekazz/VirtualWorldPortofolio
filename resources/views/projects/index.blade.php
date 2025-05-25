<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Projects | VirtualWorld</title>

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="icon" href="./img/logo-img.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #1a202c;
            /* Tailwind's gray-900 */
            color: white;
        }
    </style>
</head>

<body class="min-h-screen relative bg-gray-900 text-white">
    <!-- Navigation Bar -->
    <header class="fixed top-0 left-0 w-full z-20 backdrop-blur-md bg-black/40 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="./" class="text-xl font-semibold text-white hover:text-purple-400 transition">
                        VirtualWorld
                    </a>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="./" class="text-gray-300 hover:text-white transition">Αρχική</a>
                    <a href="#" class="text-gray-300 hover:text-white transition">Projects</a>
                    <a href="./about" class="text-gray-300 hover:text-white transition">Σχετικά</a>
                    <a href="./contact" class="text-gray-300 hover:text-white transition">Ομάδα</a>
                </nav>

                <!-- Mobile Hamburger -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
            <a href="./" class="block py-2 text-gray-300 hover:text-white">Αρχική</a>
            <a href="#" class="block py-2 text-gray-300 hover:text-white">Projects</a>
            <a href="./about" class="block py-2 text-gray-300 hover:text-white">Σχετικά</a>
            <a href="./contact" class="block py-2 text-gray-300 hover:text-white">Ομάδα</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24 pb-16 px-6 sm:px-10 max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-purple-400 mb-10 text-center">Τα Projects μου</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($projects as $project)
            <div class="bg-gray-800 rounded-2xl shadow-lg overflow-hidden flex flex-col">
                @if ($project->thumbnail)
                <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="Thumbnail"
                    class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-700 flex items-center justify-center text-gray-400">
                    Χωρίς εικόνα
                </div>
                @endif

                <div class="p-5 flex flex-col flex-grow">
                    <h2 class="text-2xl font-semibold text-purple-300 mb-2">{{ $project->title }}</h2>
                    <p class="text-gray-300 mb-4 flex-grow">{{ $project->short_description }}</p>
                    <a href="{{ route('projects.show', $project) }}"
                        class="text-purple-400 hover:underline font-semibold mt-auto">Δείτε Περισσότερα →</a>
                </div>
            </div>
            @endforeach
        </div>
    </main>
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>

</html>