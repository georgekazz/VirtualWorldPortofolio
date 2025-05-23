<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Δημιουργία Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen p-10">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-purple-400 mb-8">Προσθήκη Project</h1>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-gray-800 p-6 rounded-xl shadow-lg">
            @csrf

            <div>
                <label class="block mb-2 text-sm">Τίτλος</label>
                <input type="text" name="title" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required>
            </div>

            <div>
                <label class="block mb-2 text-sm">Σύντομη Περιγραφή</label>
                <textarea name="short_description" rows="2" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required></textarea>
            </div>

            <div>
                <label class="block mb-2 text-sm">Αναλυτική Περιγραφή</label>
                <textarea name="full_description" rows="5" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required></textarea>
            </div>

            <div>
                <label class="block mb-2 text-sm">Thumbnail (εικόνα εξωφύλλου)</label>
                <input type="file" name="thumbnail" class="text-white" accept="image/*">
            </div>

            <div>
                <label class="block mb-2 text-sm">Screenshots (πολλαπλές εικόνες)</label>
                <input type="file" name="screenshots[]" class="text-white" accept="image/*" multiple>
            </div>

            <div>
                <label class="block mb-2 text-sm">Links (ένας ανά γραμμή)</label>
                <textarea name="links" rows="3" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white"></textarea>
            </div>

            <button type="submit" class="bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded text-white font-semibold">
                Αποθήκευση
            </button>
        </form>
    </div>
</body>
</html>
