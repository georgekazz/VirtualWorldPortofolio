<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8" />
    <title>Admin Login | AR_edutainment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/three@0.157.0/build/three.min.js"></script>
    <link rel="icon" href="./img/logo-img.png" type="image/x-icon" />

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #0f172a;
            margin: 0;
            overflow-x: hidden;
            position: relative;
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

<body class="min-h-screen flex items-center justify-center px-4 relative text-white">

    <!-- Background Canvas για κύβους -->
    <canvas id="background-canvas"></canvas>

    <div class="w-full max-w-md bg-gray-900 bg-opacity-90 p-8 rounded-xl shadow-2xl relative z-10">
        <h2 class="text-3xl font-bold text-center text-purple-400 mb-6">Σύνδεση Διαχειριστή</h2>
        <div id="error-message" class="mt-4 text-center text-red-500 font-semibold hidden"></div>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-300 mb-2">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 rounded bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500" />
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-300 mb-2">Κωδικός</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 rounded bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500" />
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded transition">
                Σύνδεση
            </button>
        </form>

        <!-- Κουμπί επιστροφής στην αρχική -->
        <div class="mt-6 text-center">
            <a href="../" class="inline-block px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded text-gray-300 hover:text-white transition">
                Επιστροφή στην Αρχική
            </a>
        </div>

        <p class="text-sm text-gray-500 mt-4 text-center">Είσοδος μόνο για εξουσιοδοτημένους χρήστες.</p>
    </div>
    <script>
        const form = document.getElementById('login-form');
        const errorDiv = document.getElementById('error-message');

        form.addEventListener('submit', function(e) {
            errorDiv.classList.add('hidden'); 

            const email = form.email.value.trim();
            const password = form.password.value.trim();

            if (!email || !password) {
                e.preventDefault(); 
                errorDiv.textContent = 'Παρακαλώ συμπληρώστε email και κωδικό.';
                errorDiv.classList.remove('hidden');
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                errorDiv.textContent = 'Παρακαλώ εισάγετε έγκυρο email.';
                errorDiv.classList.remove('hidden');
                return;
            }
        });
    </script>

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
        renderer.setClearColor(0x000000, 0); 
        const cubesGroup = new THREE.Group();
        scene.add(cubesGroup);

        const cubeCount = 80;
        const cubeSize = 0.3;
        const radius = 10;

        const colors = [
            new THREE.Color(0x7f00ff), 
            new THREE.Color(0x0055ff) 
        ];

        for (let i = 0; i < cubeCount; i++) {
            const geometry = new THREE.BoxGeometry(cubeSize, cubeSize, cubeSize);
            const material = new THREE.MeshStandardMaterial({
                color: colors[0],
                metalness: 0.6,
                roughness: 0.4
            });
            const cube = new THREE.Mesh(geometry, material);

            const phi = Math.acos(2 * Math.random() - 1);
            const theta = 2 * Math.PI * Math.random();

            cube.position.set(
                radius * Math.sin(phi) * Math.cos(theta),
                radius * Math.sin(phi) * Math.sin(theta),
                radius * Math.cos(phi)
            );

            cube.userData = {
                rotationSpeedX: 0.001 + Math.random() * 0.003,
                rotationSpeedY: 0.001 + Math.random() * 0.003,
                colorPhase: Math.random() * Math.PI * 2
            };

            cubesGroup.add(cube);
        }

        // Φωτισμός
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
        scene.add(ambientLight);

        const directionalLight = new THREE.DirectionalLight(0x7f00ff, 0.7);
        directionalLight.position.set(5, 5, 5);
        scene.add(directionalLight);

        camera.position.z = 20;

        function animate(time = 0) {
            requestAnimationFrame(animate);

            cubesGroup.children.forEach(cube => {
                cube.rotation.x += cube.userData.rotationSpeedX;
                cube.rotation.y += cube.userData.rotationSpeedY;

                cube.userData.colorPhase += 0.01;
                const t = (Math.sin(cube.userData.colorPhase) + 1) / 2;
                cube.material.color.lerpColors(colors[0], colors[1], t);
            });

            renderer.render(scene, camera);
        }
        animate();

        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    </script>
</body>

</html>