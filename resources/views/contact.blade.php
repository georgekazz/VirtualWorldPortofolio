<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <title>Η ομάδα μας | VirtualWorld</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="icon" href="./img/logo-img.png" type="image/x-icon">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #111827;
            /* Σκούρο χωρίς animation */
        }

        .glow {
            position: relative;
        }

        .glow::before {
            content: '';
            position: absolute;
            top: -6px;
            left: -6px;
            right: -6px;
            bottom: -6px;
            border-radius: 9999px;
            background: conic-gradient(from 0deg, #8b5cf6, #9333ea, #8b5cf6);
            z-index: -1;
            animation: spin 6s linear infinite;
            filter: blur(8px);
        }

        @keyframes spin {
            to {
                transform: rotate(1turn);
            }
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: #374151;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: #8b5cf6;
            border-radius: 6px;
        }
    </style>
</head>

<body class="text-white min-h-screen">

    <!-- Header -->
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
                    <a href="./projects" class="text-gray-300 hover:text-white transition">Projects</a>
                    <a href="./about" class="text-gray-300 hover:text-white transition">Σχετικά</a>
                    <a href="#" class="text-gray-300 hover:text-white transition">Ομάδα</a>
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
            <a href="./projects" class="block py-2 text-gray-300 hover:text-white">Projects</a>
            <a href="./about" class="block py-2 text-gray-300 hover:text-white">Σχετικά</a>
            <a href="#" class="block py-2 text-gray-300 hover:text-white">Ομάδα</a>
        </div>
    </header>

    <!-- Main -->
    <main class="pt-24 pb-16 px-6 sm:px-10 max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-purple-300 mb-12 text-center">Η Ομάδα μας</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Μέλος 1 -->
            <div class="bg-gray-800 rounded-xl p-8 text-center shadow-xl hover:scale-[1.02] transition-transform duration-300 flex flex-col items-center h-full min-h-[480px]">
                <div class="glow w-fit mb-6">
                    <img src="{{ asset('./img/keramopoulos-img.jpg') }}" alt="Κεραμόπουλος Ευκλείδης"
                        class="w-36 h-36 rounded-full object-cover border-4 border-purple-500 shadow-md">
                </div>
                <h2 class="text-2xl font-semibold text-purple-300">Κεραμόπουλος Ευκλείδης</h2>
                <p class="text-gray-400 font-medium mt-1 mb-3">Καθηγητής ΔΙΠΑΕ</p>
                <div class="text-sm text-gray-300 mb-6 px-2 overflow-y-auto max-h-48 text-justify scrollbar-thin scrollbar-thumb-purple-500 scrollbar-track-gray-700">
                    Ο Ευκλείδης Κεραμόπουλος είναι Καθηγητής στο Τμήμα Μηχανικών Πληροφορικής και Ηλεκτρονικών Συστημάτων του Διεθνούς Πανεπιστημίου Ελλάδος. Κάτοχος διδακτορικού διπλώματος από το University of WestMinster του Λονδίνου της Μεγάλης Βρετανίας.
                    Είναι ο Διευθυντής του ερευνητικού εργαστηρίου «Διαχείρισης της Πληροφορίας & Μηχανικής Λογισμικού» του Τμήματος Μηχανικών Πληροφορικής και Ηλεκτρονικών Συστημάτων του Διεθνούς Πανεπιστημίου Ελλάδος και μέλος του ερευνητικού εργαστηρίου «Τεχνολογίας Λογισμικού και Δεδομένων» του Τμήματος Εφαρμοσμένης Πληροφορικής του Πανεπιστημίου Μακεδονίας. Τα ερευνητικά του ενδιαφέροντα εστιάζονται στο χώρο της Επικοινωνίας Ανθρώπου Υπολογιστή, των Βάσεων Δεδομένων και του Διαδικτύου.
                    Τα διδακτικά του αντικείμενα εστιάζονται στα μαθήματα «Αλληλεπίδραση Ανθρώπου Μηχανής», «Τεχνολογία Βάσεων Δεδομένων», «Προηγμένα Θέματα Αλληλεπίδρασης Ανθρώπου Μηχανής» και «Σημασιολογικός Ιστός».
                </div>

                <div class="mt-auto flex justify-center gap-5">
                    <a href="https://sites.google.com/view/euclid-keramopoulos/home" target="_blank" class="hover:text-purple-400">
                        <i class="fas fa-globe text-2xl"></i>
                    </a>
                    <a href="mailto:euclid@ihu.gr" class="hover:text-purple-400">
                        <i class="fas fa-envelope text-2xl"></i>
                    </a>
                </div>
            </div>

            <!-- Μέλος 2 -->
            <div class="bg-gray-800 rounded-xl p-8 text-center shadow-xl hover:scale-[1.02] transition-transform duration-300 flex flex-col items-center h-full min-h-[480px]">
                <div class="glow w-fit mb-6">
                    <img src="{{ asset('./img/kazlaris.png') }}" alt="Καζλάρης Γεώργιος-Χριστόφορος"
                        class="w-36 h-36 rounded-full object-cover border-4 border-purple-500 shadow-md">
                </div>
                <h2 class="text-2xl font-semibold text-purple-300">Καζλάρης Γεώργιος-Χριστόφορος</h2>
                <p class="text-gray-400 font-medium mt-1 mb-3">Υπ. Διδάκτωρ ΔΙΠΑΕ</p>
                <div class="text-sm text-gray-300 mb-6 px-2 overflow-y-auto max-h-48 text-justify scrollbar-thin scrollbar-thumb-purple-500 scrollbar-track-gray-700">
                    Ο Γεώργιος-Χριστόφορος Καζλάρης ολοκλήρωσε τις σπουδές του στο Τμήμα Μηχανικών Πληροφορικής και Ηλεκτρονικών Συστημάτων του Διεθνούς Πανεπιστημίου της Ελλάδος στη Θεσσαλονίκη. Η διπλωματική του εργασία επικεντρώθηκε στην ανάπτυξη εκπαιδευτικών εφαρμογών Android για μαθητές πρωτοβάθμιας εκπαίδευσης, αξιοποιώντας την τεχνολογία της επαυξημένης πραγματικότητας, και οδήγησε σε σημαντικές επιστημονικές δημοσιεύσεις στον τομέα αυτό.
                    Εργάζεται ως ερευνητής και προγραμματιστής, με εμπειρία σε διάφορες γλώσσες προγραμματισμού, όπως Java, C# και Kotlin. Συμμετέχει ενεργά σε ερευνητικά έργα σε συνεργασία με το Open Knowledge Foundation Greece. Παράλληλα, εκπονεί διδακτορική διατριβή, με ερευνητικό αντικείμενο τις εκπαιδευτικές εφαρμογές για συνεργατική μάθηση μέσω επαυξημένης πραγματικότητας, αποδεικνύοντας τη δέσμευσή του για την προώθηση της καινοτομίας στον συγκεκριμένο επιστημονικό τομέα.
                </div>
                <div class="mt-auto flex justify-center gap-5">
                    <a href="https://github.com/georgekazz" target="_blank" class="hover:text-purple-400">
                        <i class="fab fa-github text-2xl"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/george-christoforos-kazlaris/" target="_blank" class="hover:text-purple-400">
                        <i class="fab fa-linkedin text-2xl"></i>
                    </a>


                    <a href="mailto:grkazz98@gmail.com" class="hover:text-purple-400">
                        <i class="fas fa-envelope text-2xl"></i>
                    </a>
                </div>
            </div>
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