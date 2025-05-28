<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8" />
    <title>{{ $project->title }} | AR_edutainment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.css" />
    <link rel="icon" href="../img/logo-img.png" type="image/x-icon">
</head>

<body class="bg-gray-900 text-white min-h-screen">
    <canvas id="network-canvas" class="fixed top-0 left-0 w-full h-full -z-10"></canvas>

    <!-- Header -->
    <header class="bg-black/50 backdrop-blur-md border-b border-white/10 fixed top-0 w-full z-20">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('projects.index') }}"
                class="text-white text-xl font-semibold hover:text-purple-400 transition">AR_edutainment</a>
        </div>
    </header>

    <!-- Main -->
    <main class="pt-24 pb-16 px-6 sm:px-10 max-w-5xl mx-auto">
        <a href="{{ route('projects.index') }}" class="text-purple-400 hover:underline mb-8 inline-block text-lg">
            &larr; Πίσω στα Projects
        </a>

        <section class="bg-gray-800 rounded-xl p-6 shadow-lg">
            <h1 class="text-4xl font-bold mb-6 text-purple-400">{{ $project->title }}</h1>

            @if ($project->thumbnail)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . ltrim($project->thumbnail, '/')) }}" alt="Thumbnail"
                        class="w-full max-h-96 object-cover rounded-xl shadow-lg" />
                </div>
            @endif

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
                            <div
                                class="overflow-hidden rounded-lg shadow-md hover:shadow-purple-500 transition-shadow cursor-pointer">
                                <img src="{{ asset('storage/' . $screenshot) }}" alt="Screenshot"
                                    class="object-cover w-full h-56 hover:scale-105 transition-transform duration-300" />
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            @php
                $decodedLinks = json_decode($project->links, true) ?? [];
            @endphp

            @if (is_array($decodedLinks) && count($decodedLinks))
                <h2 class="text-2xl font-semibold text-purple-300 mb-4">Σύνδεσμοι</h2>
                <div class="flex flex-wrap gap-3">
                    @foreach ($decodedLinks as $index => $link)
                        @php
                            $link = trim($link);
                            $displayLink = preg_replace('#^https?://#', '', $link);
                        @endphp
                        @if (filter_var($link, FILTER_VALIDATE_URL))
                            <a href="{{ $link }}" target="_blank" rel="noopener noreferrer"
                                class="inline-block bg-purple-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-purple-700 transition-colors duration-300 font-semibold underline hover:no-underline">
                                Link {{ $index + 1 }}
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif


            @if ($project->education_level || $project->class_level || $project->year || $project->project_type)
                <div class="mt-10">
                    <h2 class="text-2xl font-semibold text-purple-300 mb-4">Tags</h2>
                    <div class="flex flex-wrap gap-3">
                        @if($project->education_level)
                            <span class="bg-purple-600 text-white text-sm px-3 py-1 rounded-full shadow-md">
                                {{ $project->education_level }}
                            </span>
                        @endif

                        @if($project->class_level)
                            <span class="bg-indigo-600 text-white text-sm px-3 py-1 rounded-full shadow-md">
                                {{ $project->class_level }}
                            </span>
                        @endif

                        @if($project->year)
                            <span class="bg-pink-600 text-white text-sm px-3 py-1 rounded-full shadow-md">
                                {{ $project->year }}
                            </span>
                        @endif

                        @if($project->project_type)
                            <span class="bg-green-600 text-white text-sm px-3 py-1 rounded-full shadow-md">
                                {{ $project->project_type }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif


        </section>
    </main>
    <script>
        const canvas = document.getElementById("network-canvas");
        const ctx = canvas.getContext("2d");

        let width, height, nodes;

        function resizeCanvas() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        }

        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();

        const nodeCount = 60;
        const connectionDistance = 120;

        function createNodes() {
            nodes = Array.from({
                length: nodeCount
            }, () => ({
                x: Math.random() * width,
                y: Math.random() * height,
                vx: (Math.random() - 0.5) * 0.6,
                vy: (Math.random() - 0.5) * 0.6,
                radius: 2 + Math.random() * 1.5
            }));
        }

        function draw() {
            ctx.clearRect(0, 0, width, height);

            for (let i = 0; i < nodeCount; i++) {
                const a = nodes[i];

                // draw connections
                for (let j = i + 1; j < nodeCount; j++) {
                    const b = nodes[j];
                    const dx = a.x - b.x;
                    const dy = a.y - b.y;
                    const dist = Math.sqrt(dx * dx + dy * dy);

                    if (dist < connectionDistance) {
                        const opacity = 1 - dist / connectionDistance;
                        ctx.strokeStyle = `rgba(168, 85, 247, ${opacity})`; // purple
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        ctx.moveTo(a.x, a.y);
                        ctx.lineTo(b.x, b.y);
                        ctx.stroke();
                    }
                }

                // draw node
                ctx.beginPath();
                ctx.fillStyle = "#a855f7";
                ctx.arc(a.x, a.y, a.radius, 0, Math.PI * 2);
                ctx.fill();

                // update position
                a.x += a.vx;
                a.y += a.vy;

                // bounce on edge
                if (a.x < 0 || a.x > width) a.vx *= -1;
                if (a.y < 0 || a.y > height) a.vy *= -1;
            }

            requestAnimationFrame(draw);
        }

        createNodes();
        draw();
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.umd.js"></script>
    <script>
        // Απλό bind χωρίς options
        Fancybox.bind("[data-fancybox]");
    </script>
</body>

</html>