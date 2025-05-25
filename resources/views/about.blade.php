<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Σχετικά | VirtualWorld</title>

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/three@0.157.0/build/three.min.js"></script>
    <link rel="icon" href="./img/logo-img.png" type="image/x-icon">

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        #background-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 0;
            pointer-events: none;
            background: transparent;
            display: block;
        }
    </style>
</head>

<body class="bg-gray-900 text-white min-h-screen relative">
    <!-- Three.js Background Canvas -->
    <canvas id="background-canvas"></canvas>

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
                    <a href="./projects" class="text-gray-300 hover:text-white transition">Projects</a>
                    <a href="#" class="text-gray-300 hover:text-white transition">Σχετικά</a>
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
            <a href="./projects" class="block py-2 text-gray-300 hover:text-white">Projects</a>
            <a href="#" class="block py-2 text-gray-300 hover:text-white">Σχετικά</a>
            <a href="./contact" class="block py-2 text-gray-300 hover:text-white">Ομάδα</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-24 pb-16 px-6 sm:px-10 max-w-4xl mx-auto relative z-10">
        <h1 class="text-4xl sm:text-5xl font-bold mb-6 text-center text-purple-400">Σχετικά με την Πλατφόρμα</h1>
        <p class="text-lg text-gray-300 leading-relaxed mb-8 text-center">
            Η πλατφόρμα αυτή δημιουργήθηκε με σκοπό να φιλοξενεί και να παρουσιάζει όλα τα έργα που έχουν αναπτυχθεί στο πλαίσιο ερευνητικών και εκπαιδευτικών δραστηριοτήτων με θέμα την επαυξημένη πραγματικότητα. Εδώ συγκεντρώνονται εφαρμογές, πρωτότυπα, καινοτόμες ιδέες και αποτελέσματα που αξιοποιούν τις δυνατότητες της AR τεχνολογίας για μάθηση, εμπειρία και αλληλεπίδραση.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
            <div>
                <h2 class="text-2xl font-semibold text-purple-300 mb-3">Στόχοι:</h2>
                <ul class="space-y-2 text-gray-300 list-disc list-inside">
                    <li>Κεντρική αποθήκευση και προβολή όλων των AR έργων</li>
                    <li>Ενίσχυση της διάδοσης και αξιοποίησης των εφαρμογών</li>
                    <li>Υποστήριξη της συνεργασίας και της συνέχειας των ερευνητικών προσπαθειών</li>
                    <li>Δημιουργία αρχείου έργων για εκπαιδευτικούς και φοιτητές</li>
                </ul>
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-purple-300 mb-3">Χρησιμοποιούμενες Τεχνολογίες:</h2>
                <ul class="space-y-2 text-gray-300 list-disc list-inside">
                    <li>Augmented Reality SDKs (WebAR, Unity AR Foundation)</li>
                    <li>Blender, Unity, Figma</li>
                </ul>
            </div>
        </div>
    </main>


    <script>
        // Three.js setup
        const canvas = document.getElementById('background-canvas');
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({
            canvas: canvas,
            alpha: true,
            antialias: true
        });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setClearColor(0x000000, 0); // διαφανές

        // Κύβος
        const geometry = new THREE.BoxGeometry(2, 2, 2);
        const material = new THREE.MeshStandardMaterial({
            color: 0x7f00ff,
            metalness: 0.6,
            roughness: 0.4
        });
        const cube = new THREE.Mesh(geometry, material);
        scene.add(cube);

        // Φωτισμός
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
        scene.add(ambientLight);

        const directionalLight = new THREE.DirectionalLight(0x7f00ff, 0.8);
        directionalLight.position.set(5, 5, 5);
        scene.add(directionalLight);

        camera.position.z = 7;

        // Animation loop - αργή περιστροφή
        function animate() {
            requestAnimationFrame(animate);
            cube.rotation.x += 0.005;
            cube.rotation.y += 0.007;
            renderer.render(scene, camera);
        }
        animate();

        // Responsive resize
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    </script>
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>