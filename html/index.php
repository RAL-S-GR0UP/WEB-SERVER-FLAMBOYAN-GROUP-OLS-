<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Kegelapan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset dan Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #0a0a0a;
            color: #e0e0e0;
            line-height: 1.6;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(100, 0, 0, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 60%, rgba(139, 0, 0, 0.1) 0%, transparent 20%);
        }

        /* Header & Navigation */
        header {
            background: linear-gradient(to bottom, #1a0000, #0a0000);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);
            border-bottom: 1px solid #5a0000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #8b0000;
            text-shadow: 0 0 10px #8b0000;
            letter-spacing: 2px;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav li {
            margin-left: 1.5rem;
        }

        nav a {
            color: #c9c9c9;
            text-decoration: none;
            transition: color 0.3s;
            font-size: 1.1rem;
            position: relative;
        }

        nav a:hover {
            color: #8b0000;
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #8b0000;
            transition: width 0.3s;
        }

        nav a:hover::after {
            width: 100%;
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 140px);
            padding: 2rem;
        }

        .page {
            display: none;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page.active {
            display: block;
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Welcome Page */
        .welcome-container {
            text-align: center;
            padding: 3rem 1rem;
        }

        h1 {
            font-size: 3.5rem;
            color: #8b0000;
            margin-bottom: 1.5rem;
            text-shadow: 0 0 15px rgba(139, 0, 0, 0.7);
            letter-spacing: 3px;
        }

        .subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: #a9a9a9;
        }

        .portal {
            width: 300px;
            height: 300px;
            margin: 2rem auto;
            border-radius: 50%;
            background: radial-gradient(circle, #8b0000, #1a0000);
            box-shadow: 
                0 0 50px #8b0000,
                inset 0 0 50px rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            animation: pulse 4s infinite alternate;
        }

        .portal::before {
            content: '';
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            border: 2px solid #8b0000;
            box-shadow: 0 0 20px #8b0000;
            animation: rotate 10s linear infinite;
        }

        .portal-inner {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: radial-gradient(circle, #ff0000, #1a0000);
            box-shadow: 0 0 30px #ff0000;
            animation: innerPulse 3s infinite alternate;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 50px #8b0000, inset 0 0 50px rgba(0, 0, 0, 0.8); }
            100% { box-shadow: 0 0 80px #8b0000, inset 0 0 30px rgba(0, 0, 0, 0.8); }
        }

        @keyframes innerPulse {
            0% { transform: scale(1); box-shadow: 0 0 30px #ff0000; }
            100% { transform: scale(1.1); box-shadow: 0 0 50px #ff0000; }
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .cta-button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(to bottom, #8b0000, #5a0000);
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-top: 2rem;
            transition: all 0.3s;
            border: 1px solid #5a0000;
            box-shadow: 0 0 15px rgba(139, 0, 0, 0.5);
        }

        .cta-button:hover {
            background: linear-gradient(to bottom, #a00000, #6a0000);
            box-shadow: 0 0 20px rgba(139, 0, 0, 0.8);
            transform: translateY(-3px);
        }

        /* Profile Page */
        .team-title {
            text-align: center;
            margin-bottom: 2rem;
            color: #8b0000;
            font-size: 2.5rem;
            text-shadow: 0 0 10px rgba(139, 0, 0, 0.7);
        }

        .members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .member-card {
            background: linear-gradient(to bottom, #1a0000, #0a0000);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #5a0000;
            cursor: pointer;
        }

        .member-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 25px rgba(139, 0, 0, 0.4);
        }

        .member-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-bottom: 2px solid #8b0000;
        }

        .member-info {
            padding: 1.5rem;
        }

        .member-name {
            font-size: 1.5rem;
            color: #8b0000;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 5px rgba(139, 0, 0, 0.5);
        }

        .member-role {
            font-size: 1rem;
            color: #a9a9a9;
            margin-bottom: 1rem;
            font-style: italic;
        }

        .member-desc {
            font-size: 0.9rem;
            color: #c9c9c9;
        }

        /* Footer */
        footer {
            background: linear-gradient(to top, #1a0000, #0a0000);
            padding: 1.5rem;
            text-align: center;
            border-top: 1px solid #5a0000;
            color: #a9a9a9;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                padding: 1rem;
            }
            
            nav ul {
                margin-top: 1rem;
                justify-content: center;
            }
            
            nav li {
                margin: 0 0.75rem;
            }
            
            h1 {
                font-size: 2.5rem;
            }
            
            .portal {
                width: 250px;
                height: 250px;
            }
            
            .portal::before {
                width: 270px;
                height: 270px;
            }
            
            .portal-inner {
                width: 120px;
                height: 120px;
            }
            
            .members-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
            }
            
            .subtitle {
                font-size: 1.2rem;
            }
            
            .portal {
                width: 200px;
                height: 200px;
            }
            
            .portal::before {
                width: 220px;
                height: 220px;
            }
            
            .portal-inner {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">FLAMBOYAN</div>
        <nav>
            <ul>
                <li><a href="#" onclick="showPage('welcome')">Home</a></li>
                <li><a href="#" onclick="showPage('profile')">Anggota</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Halaman Selamat Datang -->
        <section id="welcome" class="page active">
            <div class="welcome-container">
                <h1>SELAMAT DATANG</h1>
                <p class="subtitle">Di Portal Kegelapan yang Tak Terjangkau</p>
                <div class="portal">
                    <div class="portal-inner"></div>
                </div>
                <p>Masuklah ke dalam dunia yang penuh misteri dan kekuatan gelap</p>
                <a href="#" class="cta-button" onclick="showPage('profile')">Jelajahi Anggota</a>
            </div>
        </section>

        <!-- Halaman Profil Anggota -->
        <section id="profile" class="page">
            <h2 class="team-title">ANGGOTA KELOMPOK</h2>
            <div class="members-grid">
                <!-- Anggota 1 -->
                <div class="member-card" onclick="redirectToMember('farez')">
                    <img src="farez.jpg" alt="farez" class="member-image">
                    <div class="member-info">
                        <h3 class="member-name">Alfareza Heryana Putra</h3>
                        <p class="member-role">bang dull</p>
                        <p class="member-desc">"Tak perlu cahaya, cukup dengar namaku.. Alfareza"</p>
                    </div>
                </div>

                <!-- Anggota 2 -->
                <div class="member-card" onclick="redirectToMember('ray')">
                    <img src="rayhann.jpg" alt="demonlord" class="member-image">
                    <div class="member-info">
                        <h3 class="member-name">Mochammad Rayhan Febian</h3>
                        <p class="member-role">Hanze Seijitsu</p>
                        <p class="member-desc">"Cinta tak selalu datang dengan cahaya.. kadang ia datang bersama bayangan. Halo Aku Rayhan"</p>
                    </div>
                </div>

                <!-- Anggota 3 -->
                <div class="member-card" onclick="redirectToMember('latif')">
                    <img src="latif.jpeg" alt="latif" class="member-image">
                    <div class="member-info">
                        <h3 class="member-name">Latif Sahrul Sidik</h3>
                        <p class="member-role">Latif</p>
                        <p class="member-desc">"Cahaya yang menyinari bumi, hi aku Latif Sahrul Sidik"</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Portal Kegelapan. Semua Hak Dilindungi Kegelapan.</p>
    </footer>

    <script>
        // Fungsi untuk menampilkan halaman tertentu
        function showPage(pageId) {
            // Sembunyikan semua halaman
            document.querySelectorAll('.page').forEach(page => {
                page.classList.remove('active');
            });
            
            // Tampilkan halaman yang dipilih
            document.getElementById(pageId).classList.add('active');
        }

        // Fungsi untuk mengarahkan ke folder anggota
        function redirectToMember(memberName) {
            // Mapping nama anggota ke folder
            const memberFolders = {
                'farez': '/alfareza',
                'ray': '/rayhan',
                'latif': '/latif'
            };
            
            // Dapatkan path folder berdasarkan nama anggota
            const folderPath = memberFolders[memberName];
            
            if (folderPath) {
                // Redirect ke folder anggota
                window.location.href = folderPath;
            } else {
                alert('Folder anggota tidak ditemukan!');
            }
        }
    </script>
</body>
</html>