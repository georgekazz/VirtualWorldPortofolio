<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard | AR_edutainment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-gray-800 px-6 py-4 flex justify-between items-center shadow">
        <div class="text-2xl font-bold text-purple-400">Admin Dashboard</div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="text-red-500 hover:text-red-600 transition">
                <i class="fas fa-sign-out-alt mr-1"></i> Αποσύνδεση
            </button>
        </form>
    </nav>

    <main class="flex-grow container mx-auto p-6">

        <h1 class="text-4xl font-bold mb-8 text-purple-400 text-center">Διαχείριση Έργων</h1>

        <!-- Κουμπί που ανοίγει το modal -->
        <div class="max-w-4xl mx-auto mb-10 text-center">
            <button id="openModalBtn"
                class="bg-purple-600 hover:bg-purple-700 transition text-white font-semibold py-3 px-8 rounded-md">
                Προσθήκη Νέου Project
            </button>
        </div>

        <!-- Modal -->
        <div id="projectModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden px-4 py-10">
            <div class="bg-gray-800 rounded-xl shadow-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto relative p-6">
                <!-- Κουμπί κλεισίματος -->
                <button id="closeModalBtn" class="absolute top-4 right-4 text-gray-400 hover:text-white text-2xl font-bold">&times;</button>

                <h2 class="text-2xl font-semibold mb-4 text-purple-300 text-center">Προσθήκη Νέου Project</h2>

                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label for="title" class="block mb-1 font-medium text-gray-300">Τίτλος</label>
                        <input type="text" name="title" id="title" required
                            class="w-full rounded-md border border-gray-600 bg-gray-900 px-3 py-2 text-white focus:outline-none focus:border-purple-500" />
                    </div>

                    <div>
                        <label for="short_description" class="block mb-1 font-medium text-gray-300">Σύντομη Περιγραφή</label>
                        <textarea name="short_description" id="short_description" rows="2" required
                            class="w-full rounded-md border border-gray-600 bg-gray-900 px-3 py-2 text-white resize-none focus:outline-none focus:border-purple-500"></textarea>
                    </div>

                    <div>
                        <label for="full_description" class="block mb-1 font-medium text-gray-300">Πλήρης Περιγραφή</label>
                        <textarea name="full_description" id="full_description" rows="5" required
                            class="w-full rounded-md border border-gray-600 bg-gray-900 px-3 py-2 text-white resize-none focus:outline-none focus:border-purple-500"></textarea>
                    </div>

                    <div>
                        <label for="thumbnail" class="block mb-1 font-medium text-gray-300">Thumbnail (εικόνα προφίλ)</label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required
                            class="w-full text-gray-200 file:bg-purple-600 file:text-white file:px-4 file:py-2 file:rounded-md file:border-0 cursor-pointer focus:outline-none" />
                    </div>

                    <div>
                        <label for="screenshots" class="block mb-1 font-medium text-gray-300">Screenshots (πολλαπλές εικόνες)</label>
                        <input type="file" name="screenshots[]" id="screenshots" accept="image/*" multiple
                            class="w-full text-gray-200 file:bg-purple-600 file:text-white file:px-4 file:py-2 file:rounded-md file:border-0 cursor-pointer focus:outline-none" />
                    </div>

                    <div>
                        <label for="links" class="block mb-1 font-medium text-gray-300">Σύνδεσμοι (π.χ. GitHub, Live Site)</label>
                        <input type="text" name="links" id="links" placeholder="Π.χ. https://github.com/username/project"
                            class="w-full rounded-md border border-gray-600 bg-gray-900 px-3 py-2 text-white focus:outline-none focus:border-purple-500" />
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="education_level" class="block text-sm font-medium text-white">Επίπεδο Εκπαίδευσης</label>
                            <select name="education_level" id="education_level"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-700 text-white">
                                <option value="">-- Επιλέξτε --</option>
                                <option value="Δημοτικό" @if(old('education_level', $project->education_level ?? '') == 'Δημοτικό') selected @endif>Δημοτικό</option>
                                <option value="Γυμνάσιο" @if(old('education_level', $project->education_level ?? '') == 'Γυμνάσιο') selected @endif>Γυμνάσιο</option>
                                <option value="Λύκειο" @if(old('education_level', $project->education_level ?? '') == 'Λύκειο') selected @endif>Λύκειο</option>
                                <option value="Ανώτατη Εκπαίδευση" @if(old('education_level', $project->education_level ?? '') == 'Ανώτατη Εκπαίδευση') selected @endif>Ανώτατη Εκπαίδευση</option>
                            </select>
                        </div>

                        <div>
                            <label for="class_level" class="block text-sm font-medium text-white">Τάξη</label>
                            <select name="class_level" id="class_level"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-700 text-white">
                                <option value="">-- Επιλέξτε --</option>
                                <option value="Α'" @if(old('class_level', $project->class_level ?? '') == "Α'") selected @endif>Α'</option>
                                <option value="Β'" @if(old('class_level', $project->class_level ?? '') == "Β'") selected @endif>Β'</option>
                                <option value="Γ'" @if(old('class_level', $project->class_level ?? '') == "Γ'") selected @endif>Γ'</option>
                                <option value="Δ'" @if(old('class_level', $project->class_level ?? '') == "Δ'") selected @endif>Δ'</option>
                                <!-- Πρόσθεσε όποιες τάξεις θες -->
                            </select>
                        </div>

                        <div>
                            <label for="year" class="block text-sm font-medium text-white">Χρονιά</label>
                            <select name="year" id="year" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-700 text-white">
                                <option value="">-- Επιλέξτε --</option>
                                @for($y = 2012; $y <= date('Y'); $y++)
                                    <option value="{{ $y }}" @if(old('year', $project->year ?? '') == $y) selected @endif>{{ $y }}</option>
                                    @endfor
                            </select>
                        </div>

                        <div>
                            <label for="project_type" class="block text-sm font-medium text-white">Τύπος Έργου</label>
                            <select name="project_type" id="project_type"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-700 text-white">
                                <option value="">-- Επιλέξτε --</option>
                                <option value="Πτυχιακή" @if(old('project_type', $project->project_type ?? '') == "Πτυχιακή") selected @endif>Πτυχιακή</option>
                                <option value="Διπλωματική" @if(old('project_type', $project->project_type ?? '') == "Διπλωματική") selected @endif>Διπλωματική</option>
                                <option value="Διδακτορικό" @if(old('project_type', $project->project_type ?? '') == "Διδακτορικό") selected @endif>Διδακτορικό</option>
                                <option value="Άλλο" @if(old('project_type', $project->project_type ?? '') == "Άλλο") selected @endif>Άλλο</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 transition text-white font-semibold py-2 px-6 rounded-md w-full">
                        Αποθήκευση Project
                    </button>
                </form>
            </div>
        </div>

        <!-- JavaScript για το modal -->
        <script>
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const projectModal = document.getElementById('projectModal');

            openModalBtn.addEventListener('click', () => {
                projectModal.classList.remove('hidden');
            });

            closeModalBtn.addEventListener('click', () => {
                projectModal.classList.add('hidden');
            });

            // Κλείσιμο modal με το πάτημα εκτός του modal περιεχομένου
            projectModal.addEventListener('click', (e) => {
                if (e.target === projectModal) {
                    projectModal.classList.add('hidden');
                }
            });
        </script>


        <!-- Λίστα projects -->
        <section class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-semibold mb-4 text-purple-300 text-center">Υπάρχοντα Projects</h2>
            <div class="overflow-x-auto rounded-lg shadow-lg bg-gray-800">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Τίτλος</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Σύντομη Περιγραφή</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-400 uppercase tracking-wider">Ημ. Δημιουργίας</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-purple-400 uppercase tracking-wider">Ενέργειες</th>
                        </tr>
                    </thead>
                    <!-- csrf token -->
                    @csrf

                    <!-- Προβολή επιτυχίας -->
                    @if(session('success'))
                    <div class="mb-4 p-3 bg-green-600 text-white rounded">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Δυναμική λίστα projects -->
                    <tbody>
                        @forelse($projects as $project)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $project->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $project->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $project->short_description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $project->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center space-x-3">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="text-blue-500 hover:text-blue-700" title="Επεξεργασία"><i class="fas fa-edit"></i></a>

                                <!-- Φόρμα διαγραφής με confirm -->
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="inline" onsubmit="return confirm('Είσαι σίγουρος ότι θέλεις να διαγράψεις αυτό το project;');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Διαγραφή" class="text-red-500 hover:text-red-700 bg-transparent border-0 cursor-pointer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-400">Δεν υπάρχουν projects.</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </section>

    </main>

</body>

</html>