<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Σχετικά | AR_edutainment</title>

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

        .bg-grid-pattern {
            background-image:
                linear-gradient(rgba(147, 51, 234, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(147, 51, 234, 0.1) 1px, transparent 1px);
            background-size: 40px 40px;
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
                        AR_edutainment
                    </a>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="./" class="text-gray-300 hover:text-white transition">Αρχική</a>
                    <a href="./projects" class="text-gray-300 hover:text-white transition">Projects</a>
                    <a href="./contact" class="text-gray-300 hover:text-white transition">Ομάδα</a>
                    <a href="#" class="text-gray-300 hover:text-white transition">Σχετικά</a>
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
            <a href="./contact" class="block py-2 text-gray-300 hover:text-white">Ομάδα</a>
            <a href="#" class="block py-2 text-gray-300 hover:text-white">Σχετικά</a>
        </div>
    </header>

    <main class="pt-24 pb-16 px-6 sm:px-10 max-w-4xl mx-auto relative z-10 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-gray-300 font-sans">

        <h1 class="text-4xl sm:text-5xl font-extrabold mb-6 text-center text-purple-400 drop-shadow-[0_0_10px_rgba(147,51,234,0.7)]">
            Σχετικά με την Πλατφόρμα
        </h1>

        <p class="text-lg leading-relaxed mb-8 text-center max-w-3xl mx-auto tracking-wide" style="text-shadow: 0 0 6px rgba(147,51,234,0.6);">
            Η πλατφόρμα αυτή δημιουργήθηκε από τον <b class="text-purple-400">Καζλάρη Γεώργιο-Χριστόφορο</b> με σκοπό να φιλοξενεί και να παρουσιάζει όλα τα έργα που έχουν αναπτυχθεί στο πλαίσιο ερευνητικών και εκπαιδευτικών δραστηριοτήτων με θέμα την επαυξημένη πραγματικότητα. Εδώ συγκεντρώνονται εφαρμογές, πρωτότυπα, καινοτόμες ιδέες και αποτελέσματα που αξιοποιούν τις δυνατότητες της AR τεχνολογίας για μάθηση, εμπειρία και αλληλεπίδραση.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
            <div class="bg-gray-900 bg-opacity-40 backdrop-blur-md rounded-lg p-6 border border-purple-600 shadow-lg shadow-purple-700/40 hover:shadow-purple-500/60 transition">
                <h2 class="text-2xl font-semibold text-purple-300 mb-3 drop-shadow-[0_0_8px_rgba(147,51,234,0.8)]">
                    Στόχοι:
                </h2>
                <ul class="space-y-2 list-disc list-inside text-purple-200 tracking-wide">
                    <li>Κεντρική αποθήκευση και προβολή όλων των AR έργων</li>
                    <li>Ενίσχυση της διάδοσης και αξιοποίησης των εφαρμογών</li>
                    <li>Υποστήριξη της συνεργασίας και της συνέχειας των ερευνητικών προσπαθειών</li>
                    <li>Δημιουργία αρχείου έργων για εκπαιδευτικούς και φοιτητές</li>
                </ul>
            </div>

            <div class="bg-gray-900 bg-opacity-40 backdrop-blur-md rounded-lg p-6 border border-purple-600 shadow-lg shadow-purple-700/40 hover:shadow-purple-500/60 transition">
                <h2 class="text-2xl font-semibold text-purple-300 mb-3 drop-shadow-[0_0_8px_rgba(147,51,234,0.8)]">
                    Χρησιμοποιούμενες Τεχνολογίες:
                </h2>
                <ul class="space-y-2 list-disc list-inside text-purple-200 tracking-wide">
                    <li>Augmented Reality SDKs (WebAR, Unity AR Foundation)</li>
                    <li>Blender, Unity, Figma</li>
                </ul>
            </div>
        </div>

        <div class="pointer-events-none fixed inset-0 z-0 mix-blend-screen opacity-10 bg-grid-pattern"></div>

    </main>

    <script>
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

        // Ομάδα για όλους τους κύβους
        const cubesGroup = new THREE.Group();
        scene.add(cubesGroup);

        const cubeCount = 40;
        const cubeSize = 1.2;
        const radius = 12; // ακτίνα γύρω από το κέντρο (κείμενο)

        const colors = [
            new THREE.Color(0x7f00ff), // μωβ
            new THREE.Color(0x0055ff) // μπλε
        ];

        // Δημιουργούμε τους κύβους
        for (let i = 0; i < cubeCount; i++) {
            const geometry = new THREE.BoxGeometry(cubeSize, cubeSize, cubeSize);
            const material = new THREE.MeshStandardMaterial({
                color: colors[0],
                metalness: 0.6,
                roughness: 0.4
            });
            const cube = new THREE.Mesh(geometry, material);

            // Τοποθέτηση σε τυχαίο σημείο πάνω σε σφαίρα γύρω από το κέντρο
            const phi = Math.acos(2 * Math.random() - 1); // 0->π
            const theta = 2 * Math.PI * Math.random(); // 0->2π
            cube.position.set(
                radius * Math.sin(phi) * Math.cos(theta),
                radius * Math.sin(phi) * Math.sin(theta),
                radius * Math.cos(phi)
            );

            // Αποθηκεύουμε τυχαίες ταχύτητες περιστροφής για κάθε κύβο
            cube.userData = {
                rotationSpeedX: 0.001 + Math.random() * 0.004,
                rotationSpeedY: 0.001 + Math.random() * 0.004,
                colorPhase: Math.random() * Math.PI * 2 // για εναλλαγή χρώματος
            };

            cubesGroup.add(cube);
        }

        // Φωτισμός
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
        scene.add(ambientLight);

        const directionalLight = new THREE.DirectionalLight(0x7f00ff, 0.8);
        directionalLight.position.set(5, 5, 5);
        scene.add(directionalLight);

        camera.position.z = 25;

        // Animation loop
        function animate(time = 0) {
            requestAnimationFrame(animate);

            cubesGroup.children.forEach(cube => {
                // Περιστροφή
                cube.rotation.x += cube.userData.rotationSpeedX;
                cube.rotation.y += cube.userData.rotationSpeedY;

                // Εναλλαγή χρώματος smooth μωβ <-> μπλε
                cube.userData.colorPhase += 0.01;
                const t = (Math.sin(cube.userData.colorPhase) + 1) / 2; // 0->1
                cube.material.color.lerpColors(colors[0], colors[1], t);
            });

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