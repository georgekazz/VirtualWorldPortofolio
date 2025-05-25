<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8" />
    <title>{{ $project->title }} | Virtual Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.css" />
</head>

<body class="bg-gray-900 text-white min-h-screen">
    <!-- Header -->
    <header class="bg-black/50 backdrop-blur-md border-b border-white/10 fixed top-0 w-full z-20">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('projects.index') }}"
                class="text-white text-xl font-semibold hover:text-purple-400 transition">VirtualWorld</a>
        </div>
    </header>

    <!-- Main -->
    <!-- Main -->
    <main class="pt-24 pb-16 px-6 sm:px-10 max-w-5xl mx-auto">
        <a href="{{ route('projects.index') }}" class="text-purple-400 hover:underline mb-8 inline-block text-lg">
            &larr; Πίσω στα Projects
        </a>

        <section class="bg-gray-800 rounded-xl p-6 shadow-lg">
            <h1 class="text-4xl font-bold mb-6 text-purple-400">{{ $project->title }}</h1>

            <p class="text-gray-300 text-lg leading-relaxed mb-8 text-justify">{{ $project->full_description }}</p>

            @php
            $screenshots = json_decode($project->screenshots, true) ?? [];
            $links = is_string($project->links) ? json_decode($project->links, true) : $project->links;
            @endphp

            @if($screenshots && count($screenshots))
            <h2 class="text-2xl font-semibold text-purple-300 mb-4">Screenshots</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach ($screenshots as $screenshot)
                <a data-fancybox="gallery" href="{{ asset('storage/' . $screenshot) }}">
                    <div class="overflow-hidden rounded-lg shadow-md hover:shadow-purple-500 transition-shadow cursor-pointer">
                        <img src="{{ asset('storage/' . $screenshot) }}" alt="Screenshot"
                            class="object-cover w-full h-56 hover:scale-105 transition-transform duration-300" />
                    </div>
                </a>
                @endforeach
            </div>
            @endif

            @php
                $decodedLinks = json_decode($project->links, true);
            @endphp

            @if ($decodedLinks && is_array($decodedLinks) && count($decodedLinks))
                <h2 class="text-2xl font-semibold text-purple-300 mb-4">Σύνδεσμοι</h2>
                <ul class="list-disc list-inside text-purple-400 space-y-2 mb-2 text-lg">
                    @foreach ($decodedLinks as $link)
                        @php
                            $link = trim($link);
                            $displayLink = preg_replace('#^https?://#', '', $link);
                        @endphp
                        @if (filter_var($link, FILTER_VALIDATE_URL))
                            <li>
                                <a href="{{ $link }}" target="_blank" rel="noopener noreferrer" class="hover:underline">
                                    {{ $displayLink }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @elseif ($project->links && is_string($project->links))
            @php
                $link = trim($project->links);
                $displayLink = preg_replace('#^https?://#', '', $link);
            @endphp
            @if (filter_var($link, FILTER_VALIDATE_URL))
            <h2 class="text-2xl font-semibold text-purple-300 mb-4">Σύνδεσμος</h2>
            <p>
                <a href="{{ $link }}" target="_blank" rel="noopener noreferrer"
                class="inline-block bg-purple-600 text-white px-5 py-2 rounded-lg shadow-md
                        hover:bg-purple-700 transition-colors duration-300 font-semibold
                        underline hover:no-underline">
                    Σύνδεσμος
                </a>
            </p>


            @endif
            @endif



        </section>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.umd.js"></script>
    <script>
        // Απλό bind χωρίς options
        Fancybox.bind("[data-fancybox]");
    </script>
</body>

</html>