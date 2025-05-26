<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Projects | AR_edutainment</title>

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="icon" href="./img/logo-img.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #1a202c;
            color: white;
        }

        #scroll-line::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.3);
            height: 0%;
            transition: height 0.2s ease-out;
        }

        #scroll-line.pulse {
            animation: pulseGlow 2s infinite ease-in-out;
        }

        @keyframes pulseGlow {

            0%,
            100% {
                opacity: 0.6;
            }

            50% {
                opacity: 1;
            }
        }
    </style>
</head>
<div id="scroll-line" class="fixed left-0 top-0 h-full w-1 bg-gradient-to-b from-purple-500 to-fuchsia-500 opacity-70 transition-opacity duration-500 z-40"></div>

<body class="min-h-screen relative bg-gray-900 text-white">
    <!-- Navigation Bar -->
    <header class="fixed top-0 left-0 w-full z-20 backdrop-blur-md bg-black/40 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="./" class="text-xl font-semibold text-white hover:text-purple-400 transition">
                        AR_edutainment
                    </a>
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a href="./" class="text-gray-300 hover:text-white transition">Αρχική</a>
                    <a href="#" class="text-gray-300 hover:text-white transition">Projects</a>
                    <a href="./contact" class="text-gray-300 hover:text-white transition">Ομάδα</a>
                    <a href="./about" class="text-gray-300 hover:text-white transition">Σχετικά</a>
                </nav>
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

        <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
            <a href="./" class="block py-2 text-gray-300 hover:text-white">Αρχική</a>
            <a href="#" class="block py-2 text-gray-300 hover:text-white">Projects</a>
            <a href="./contact" class="block py-2 text-gray-300 hover:text-white">Ομάδα</a>
            <a href="./about" class="block py-2 text-gray-300 hover:text-white">Σχετικά</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24 pb-16 px-6 sm:px-10 max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-purple-400 mb-10 text-center">Projects</h1>

        <!-- Search Bar -->
        <div class="mb-8 max-w-md mx-auto">
            <input type="text" id="searchInput" placeholder="Αναζήτηση Project..."
                class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500" />
        </div>

        <!-- Filters -->
        <div class="mb-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="filters">
            <select id="filter-education" class="w-full bg-gray-700 text-white px-4 py-2 rounded-lg border border-gray-600">
                <option value="">Εκπαιδευτικό Επίπεδο</option>
                @foreach ($projects->pluck('education_level')->unique()->filter()->sort() as $level)
                <option value="{{ strtolower($level) }}">{{ $level }}</option>
                @endforeach
            </select>
            <select id="filter-class" class="w-full bg-gray-700 text-white px-4 py-2 rounded-lg border border-gray-600">
                <option value="">Τάξη</option>
                @foreach ($projects->pluck('class_level')->unique()->filter()->sort() as $class)
                <option value="{{ strtolower($class) }}">{{ $class }}</option>
                @endforeach
            </select>
            <select id="filter-year" class="w-full bg-gray-700 text-white px-4 py-2 rounded-lg border border-gray-600">
                <option value="">Έτος</option>
                @foreach ($projects->pluck('year')->unique()->filter()->sortDesc() as $year)
                <option value="{{ strtolower($year) }}">{{ $year }}</option>
                @endforeach
            </select>
            <select id="filter-type" class="w-full bg-gray-700 text-white px-4 py-2 rounded-lg border border-gray-600">
                <option value="">Τύπος Project</option>
                @foreach ($projects->pluck('project_type')->unique()->filter()->sort() as $type)
                <option value="{{ strtolower($type) }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="projectsGrid">
            @foreach ($projects as $project)
            <div class="bg-gray-800 rounded-2xl shadow-lg overflow-hidden flex flex-col project-card"
                data-title="{{ strtolower($project->title) }}"
                data-education="{{ strtolower($project->education_level) }}"
                data-class="{{ strtolower($project->class_level) }}"
                data-year="{{ strtolower($project->year) }}"
                data-type="{{ strtolower($project->project_type) }}">

                @if ($project->thumbnail)
                <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="Thumbnail"
                    class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-700 flex items-center justify-center text-gray-400">Χωρίς εικόνα</div>
                @endif

                <div class="p-5 flex flex-col flex-grow">
                    <h2 class="text-2xl font-semibold text-purple-300 mb-2">{{ $project->title }}</h2>
                    <p class="text-gray-300 mb-4">{{ $project->short_description }}</p>

                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($project->education_level)
                        <span class="bg-purple-600 text-white text-xs px-3 py-1 rounded-full shadow-md">{{ $project->education_level }}</span>
                        @endif
                        @if($project->class_level)
                        <span class="bg-indigo-600 text-white text-xs px-3 py-1 rounded-full shadow-md">{{ $project->class_level }}</span>
                        @endif
                        @if($project->year)
                        <span class="bg-pink-600 text-white text-xs px-3 py-1 rounded-full shadow-md">{{ $project->year }}</span>
                        @endif
                        @if($project->project_type)
                        <span class="bg-green-600 text-white text-xs px-3 py-1 rounded-full shadow-md">{{ $project->project_type }}</span>
                        @endif
                    </div>

                    <a href="{{ route('projects.show', $project) }}"
                        class="text-purple-400 hover:underline font-semibold mt-auto">Δείτε Περισσότερα →</a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div id="pagination" class="flex justify-center mt-8 space-x-2"></div>
    </main>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        const projectsPerPage = 12;
        let currentPage = 1;

        const searchInput = document.getElementById('searchInput');
        const projectCards = Array.from(document.querySelectorAll('.project-card'));
        const paginationContainer = document.getElementById('pagination');

        const filters = {
            education: document.getElementById('filter-education'),
            class: document.getElementById('filter-class'),
            year: document.getElementById('filter-year'),
            type: document.getElementById('filter-type'),
        };

        let filteredProjects = projectCards;

        function displayProjects(page = 1, filtered = null) {
            const projects = filtered || filteredProjects;
            const totalPages = Math.ceil(projects.length / projectsPerPage);
            currentPage = Math.min(page, totalPages) || 1;

            projectCards.forEach(card => card.style.display = 'none');

            const start = (currentPage - 1) * projectsPerPage;
            const end = start + projectsPerPage;
            projects.slice(start, end).forEach(card => card.style.display = 'flex');

            renderPagination(totalPages);
        }

        function renderPagination(totalPages) {
            paginationContainer.innerHTML = '';
            if (totalPages <= 1) return;

            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement('button');
                btn.textContent = i;
                btn.className = `px-3 py-1 rounded ${
                    i === currentPage ? 'bg-purple-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600'
                }`;
                btn.addEventListener('click', () => displayProjects(i));
                paginationContainer.appendChild(btn);
            }
        }

        function applyFilters() {
            const query = searchInput.value.trim().toLowerCase();
            const education = filters.education.value;
            const classLevel = filters.class.value;
            const year = filters.year.value;
            const type = filters.type.value;

            filteredProjects = projectCards.filter(card => {
                const matchesQuery = card.dataset.title.includes(query);
                const matchesEducation = !education || card.dataset.education === education;
                const matchesClass = !classLevel || card.dataset.class === classLevel;
                const matchesYear = !year || card.dataset.year === year;
                const matchesType = !type || card.dataset.type === type;

                return matchesQuery && matchesEducation && matchesClass && matchesYear && matchesType;
            });

            displayProjects(1, filteredProjects);
        }

        Object.values(filters).forEach(filter => {
            filter.addEventListener('change', applyFilters);
        });

        searchInput.addEventListener('input', applyFilters);

        displayProjects();

        // Scroll-based progress & animation
        const scrollLine = document.getElementById('scroll-line');
        const progressLine = document.createElement('div');
        progressLine.style.position = 'absolute';
        progressLine.style.left = '0';
        progressLine.style.top = '0';
        progressLine.style.width = '100%';
        progressLine.style.background = 'white';
        progressLine.style.opacity = '0.3';
        progressLine.style.height = '0%';
        scrollLine.appendChild(progressLine);

        function updateScrollLine() {
            const scrollTop = window.scrollY;
            const docHeight = document.body.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            progressLine.style.height = `${scrollPercent}%`;

            if (scrollPercent > 1) {
                scrollLine.classList.add('pulse');
            } else {
                scrollLine.classList.remove('pulse');
            }
        }

        window.addEventListener('scroll', updateScrollLine);
        updateScrollLine();
    </script>
</body>

</html>