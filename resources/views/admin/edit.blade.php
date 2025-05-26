<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Επεξεργασία Project</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 min-h-screen flex items-center justify-center p-6">

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="max-w-3xl w-full bg-gray-800 rounded-lg shadow-lg p-8 space-y-8">
        @csrf
        @method('PUT')

        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-purple-400 hover:text-purple-600 mb-6">
            ← Πίσω στη λίστα
        </a>
        
        <h1 class="text-3xl font-bold text-purple-400 mb-6 border-b border-purple-600 pb-3 text-center">Επεξεργασία Project</h1>

        <!-- Τίτλος -->
        <div>
            <label for="title" class="block mb-2 font-semibold text-white">Τίτλος</label>
            <input
                type="text"
                name="title"
                id="title"
                required
                value="{{ old('title', $project->title) }}"
                class="w-full rounded-md border border-gray-600 bg-gray-900 px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500" />
            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Σύντομη Περιγραφή -->
        <div>
            <label for="short_description" class="block mb-2 font-semibold text-white">Σύντομη Περιγραφή</label>
            <textarea
                name="short_description"
                id="short_description"
                rows="3"
                required
                class="w-full rounded-md border border-gray-600 bg-gray-900 px-4 py-2 resize-none text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('short_description', $project->short_description) }}</textarea>
            @error('short_description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Πλήρης Περιγραφή -->
        <div>
            <label for="full_description" class="block mb-2 font-semibold text-white">Πλήρης Περιγραφή</label>
            <textarea
                name="full_description"
                id="full_description"
                rows="6"
                required
                class="w-full rounded-md border border-gray-600 bg-gray-900 px-4 py-2 resize-y text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('full_description', $project->full_description) }}</textarea>
            @error('full_description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Thumbnail -->
        <div>
            <label for="thumbnail" class="block mb-2 font-semibold text-white">Thumbnail (εικόνα προφίλ)</label>
            <input
                type="file"
                name="thumbnail"
                id="thumbnail"
                accept="image/*"
                class="w-full text-gray-200 file:bg-purple-600 file:text-white file:px-4 file:py-2 file:rounded-md file:border-0 cursor-pointer focus:outline-none" />
            @if($project->thumbnail)
            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="Thumbnail" class="mt-3 max-h-32 rounded-lg shadow-md" />
            @endif
            @error('thumbnail')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Screenshots -->
        <div>
            <label for="screenshots" class="block mb-2 font-semibold text-white">Screenshots (πολλαπλές εικόνες)</label>
            <input
                type="file"
                name="screenshots[]"
                id="screenshots"
                accept="image/*"
                multiple
                class="w-full text-gray-200 file:bg-purple-600 file:text-white file:px-4 file:py-2 file:rounded-md file:border-0 cursor-pointer focus:outline-none" />
            @if($project->screenshots)
            <div class="mt-3 flex flex-wrap gap-3">
                @foreach(json_decode($project->screenshots) as $screenshot)
                <img src="{{ asset('storage/' . $screenshot) }}" alt="Screenshot" class="max-h-24 rounded-lg shadow-md" />
                @endforeach
            </div>
            @endif
            @error('screenshots.*')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Links -->
        <div>
            <label for="links" class="block mb-2 font-semibold text-white">Σύνδεσμοι</label>
            <input
                type="text"
                name="links"
                id="links"
                placeholder="Π.χ. https://github.com/username/project"
                value="{{ old('links', $project->links) }}"
                class="w-full rounded-md border border-gray-600 bg-gray-900 px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500" />
            @error('links')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Επιλογές -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <!-- Επίπεδο Εκπαίδευσης -->
            <div>
                <label for="education_level" class="block mb-2 font-semibold text-white">Επίπεδο Εκπαίδευσης</label>
                <select
                    name="education_level"
                    id="education_level"
                    class="w-full rounded-md border border-gray-600 bg-gray-700 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">-- Επιλέξτε --</option>
                    @foreach(['Δημοτικό', 'Γυμνάσιο', 'Λύκειο', 'Ανώτατη Εκπαίδευση'] as $level)
                    <option value="{{ $level }}" {{ old('education_level', $project->education_level) == $level ? 'selected' : '' }}>
                        {{ $level }}
                    </option>
                    @endforeach
                </select>
                @error('education_level')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Τάξη -->
            <div>
                <label for="class_level" class="block mb-2 font-semibold text-white">Τάξη</label>
                <select
                    name="class_level"
                    id="class_level"
                    class="w-full rounded-md border border-gray-600 bg-gray-700 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">-- Επιλέξτε --</option>
                    @foreach(["Α'", "Β'", "Γ'", "Δ'" ,"Ε'","ΣΤ'"] as $class)
                    <option value="{{ $class }}" {{ old('class_level', $project->class_level) == $class ? 'selected' : '' }}>
                        {{ $class }}
                    </option>
                    @endforeach
                </select>
                @error('class_level')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Χρονιά -->
            <div>
                <label for="year" class="block mb-2 font-semibold text-white">Χρονιά</label>
                <select
                    name="year"
                    id="year"
                    class="w-full rounded-md border border-gray-600 bg-gray-700 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">-- Επιλέξτε --</option>
                    @for($y = 2012; $y <= date('Y'); $y++)
                        <option value="{{ $y }}" {{ old('year', $project->year) == $y ? 'selected' : '' }}>
                        {{ $y }}
                        </option>
                        @endfor
                </select>
                @error('year')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Τύπος Έργου -->
            <div>
                <label for="project_type" class="block mb-2 font-semibold text-white">Τύπος Έργου</label>
                <select
                    name="project_type"
                    id="project_type"
                    class="w-full rounded-md border border-gray-600 bg-gray-700 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">-- Επιλέξτε --</option>
                    @foreach(['Πτυχιακή', 'Διπλωματική', 'Διδακτορικό', 'Άλλο'] as $type)
                    <option value="{{ $type }}" {{ old('project_type', $project->project_type) == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                    @endforeach
                </select>
                @error('project_type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button
            type="submit"
            class="w-full bg-purple-600 hover:bg-purple-700 transition-colors text-white font-semibold py-3 rounded-md shadow-md">
            Αποθήκευση Αλλαγών
        </button>
    </form>

</body>

</html>