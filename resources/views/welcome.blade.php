<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AR_edutainment</title>
    <link rel="icon" href="./img/logo-img.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Three.js CDN -->
    <script src="https://unpkg.com/three@0.157.0/build/three.min.js"></script>

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        #three-canvas {
            position: absolute;
            inset: 0;
            z-index: 0;
        }
    </style>
</head>

<body class="relative bg-gray-900 text-white overflow-hidden min-h-screen">

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
                    <a href="./about" class="text-gray-300 hover:text-white transition">Σχετικά</a>
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
            <a href="./about" class="block py-2 text-gray-300 hover:text-white">Σχετικά</a>
        </div>
    </header>

    <!-- 3D Canvas -->
    <div id="three-canvas"></div>

    <!-- Content Overlay -->
    <div
        class="relative z-10 flex flex-col justify-center items-center text-center min-h-screen px-4 sm:px-6 md:px-10 lg:px-16 mt-16">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
            Καλώς ήρθες στο <span class="text-purple-400">AR_edutainment</span>
        </h1>
        <p class="text-base sm:text-lg md:text-xl text-gray-300 max-w-2xl mb-6 leading-relaxed">
            Εδώ θα βρείτε τα έργα Επαυξημένης Πραγματικότητας που έχουν υλοποιηθεί μέχρι σήμερα στα πλαίσια Πτυχιακών/Διπλωματικών. Όλη αυτή τη δημιουργική προσπάθεια επιμελείται ο καθηγητής <b>Ευκλείδης Κεραμόπουλος. </b> </p>
        <a href="./projects"
            class="bg-purple-600 hover:bg-purple-700 transition px-6 py-3 rounded-xl text-white shadow-lg text-sm sm:text-base md:text-lg">
            Δείτε τα Projects
        </a>
    </div>
    <!-- Floating Button -->
    <div id="floatingBtn"
        class="fixed bottom-4 left-4 w-14 h-14 bg-purple-600 text-white flex items-center justify-center rounded-full shadow-lg cursor-pointer z-50 animate-bounce transition-transform duration-300 ease-in-out">
        <i class="fas fa-circle-info text-xl"></i>
    </div>

    <!-- Modal -->
    <div id="infoModal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div class="bg-gray-800 text-white rounded-lg p-6 max-w-md shadow-2xl relative">
            <button onclick="toggleModal()" class="absolute top-2 right-3 text-white text-2xl">&times;</button>
            <h2 class="text-xl font-bold mb-4">Σχετικά με αυτό το site</h2>
            <p class="text-gray-300 leading-relaxed">
                <b>Το site δημιουργήθηκε από τον Γιώργο-Χριστόφορο Καζλάρη με Laravel, Tailwind CSS.</b><br>
                Στόχος της πλατφόρμας είναι η φιλοξενία εφαρμογών Επαυξημένης Πραγματικότητας (AR), οι οποίες έχουν υλοποιηθεί στο πλαίσιο Πτυχιακών και Διπλωματικών εργασιών, υπό την επίβλεψη του Καθηγητή Ευκλείδη Κεραμόπουλου. </p>
        </div>
    </div>

    <script>
        const btn = document.getElementById('floatingBtn');
        const modal = document.getElementById('infoModal');

        let isDragging = false;
        let hasMoved = false;
        let offsetX, offsetY;

        btn.addEventListener('mousedown', (e) => {
            isDragging = true;
            hasMoved = false;
            offsetX = e.clientX - btn.getBoundingClientRect().left;
            offsetY = e.clientY - btn.getBoundingClientRect().top;
            btn.classList.remove('animate-bounce');
            document.body.style.userSelect = 'none';
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            hasMoved = true;
            const x = e.clientX - offsetX;
            const y = e.clientY - offsetY;
            btn.style.left = `${x}px`;
            btn.style.top = `${y}px`;
            btn.style.right = 'auto';
            btn.style.bottom = 'auto';
        });

        document.addEventListener('mouseup', () => {
            if (isDragging) {
                isDragging = false;
                setTimeout(() => hasMoved = false, 100);
                btn.classList.add('animate-bounce');
                document.body.style.userSelect = '';
            }
        });

        btn.addEventListener('click', () => {
            if (!hasMoved && !isDragging) {
                toggleModal();
            }
        });

        function toggleModal() {
            modal.classList.toggle('hidden');
        }
    </script>

    <script>
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({
            alpha: true
        });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('three-canvas').appendChild(renderer.domElement);

        const particlesGeometry = new THREE.BufferGeometry();
        const count = 500;

        const positions = new Float32Array(count * 3);

        for (let i = 0; i < count * 3; i++) {
            positions[i] = (Math.random() - 0.5) * 100;
        }

        particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));

        const textureLoader = new THREE.TextureLoader();
        const circleTexture = textureLoader.load('./img/disc.png');

        const particlesMaterial = new THREE.PointsMaterial({
            color: 0x7f00ff,
            size: 0.5,
            transparent: true,
            opacity: 0.8,
            map: circleTexture,
            alphaTest: 0.01,
            depthWrite: false
        });

        const particles = new THREE.Points(particlesGeometry, particlesMaterial);
        scene.add(particles);

        camera.position.z = 20;

        const animate = () => {
            requestAnimationFrame(animate);

            particles.rotation.y += 0.001;
            particles.rotation.x += 0.0002;

            renderer.render(scene, camera);
        };

        animate();

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