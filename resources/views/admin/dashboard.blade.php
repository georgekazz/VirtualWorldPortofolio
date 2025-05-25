<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard | VirtualWorld</title>
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

        <!-- Φόρμα προσθήκης project -->
        <section class="bg-gray-800 rounded-xl p-6 shadow-lg mb-10 max-w-4xl mx-auto">
            <h2 class="text-2xl font-semibold mb-4 text-purple-300">Προσθήκη Νέου Project</h2>
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

                <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 transition text-white font-semibold py-2 px-6 rounded-md w-full">
                    Αποθήκευση Project
                </button>
            </form>
        </section>

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
                                <a href="#" class="text-blue-500 hover:text-blue-700" title="Επεξεργασία"><i class="fas fa-edit"></i></a>
                                <a href="#" class="text-red-500 hover:text-red-700" title="Διαγραφή"><i class="fas fa-trash-alt"></i></a>
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