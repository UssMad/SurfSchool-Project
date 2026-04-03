<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Taghazout Surf Expo — Professional Surf School Management Platform">
    <title>Taghazout Surf Expo — Ride the Waves</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="home-body">

    <!-- ========== NAVBAR ========== -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <span class="logo-icon">🏄‍♂️</span>
                <span>Surf Expo</span>
            </div>
            <div class="nav-links">
                <a href="#features" class="nav-link">Features</a>
                <a href="#about" class="nav-link">About</a>
                <div class="nav-auth">
                    <a href="public/login.php" class="btn btn-sm btn-outline">Login</a>
                    <a href="public/register.php" class="btn btn-sm btn-success">Join Expo</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ========== HERO SECTION ========== -->
    <header class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="badge-new">NEW: SPRING 2026 REGISTRATION OPEN</div>
            <h1>Master the Ocean, <br><span class="text-glow">Manage the Flow</span></h1>
            <p>The ultimate management platform for Taghazout's elite surf schools. <br>Track students, schedule lessons, and grow your community.</p>
            <div class="hero-actions">
                <a href="public/register.php" class="btn btn-primary-home">
                    Get Started Free <i class="fas fa-arrow-right"></i>
                </a>
                <a href="#features" class="btn btn-outline-home">
                    Learn More
                </a>
            </div>
        </div>
        <div class="hero-image-container">
            <img src="assets/img/hero-bg.png" alt="Surf Hero" class="hero-img">
        </div>
        <div class="scroll-indicator" onclick="document.getElementById('features').scrollIntoView({behavior: 'smooth'})">
            <i class="fas fa-chevron-down"></i>
        </div>
    </header>

    <!-- ========== FEATURES SECTION ========== -->
    <section id="features" class="features">
        <div class="section-title">
            <h2>Built for the <span class="text-glow">Perfect Session</span></h2>
            <p>Everything you need to run your surf school smoothly from the beach or the office.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Smart Dashboards</h3>
                <p>Monitor school performance, student progress, and revenue with crystal clear visual charts.</p>
            </div>
            <div class="feature-card highlighted">
                <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
                <h3>Seamless Scheduling</h3>
                <p>Automated lesson planning with coach assignments and real-time student capacity tracking.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-mobile-alt"></i></div>
                <h3>Mobile Focused</h3>
                <p>Manage your entire school from your phone while you're on the sand or out in the water.</p>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="home-footer">
        <div class="footer-content">
            <div class="footer-brand">
                <span class="logo-icon">🏄‍♂️</span>
                <h3>Surf Expo</h3>
            </div>
            <p>&copy; 2026 Taghazout Surf Expo. All rights reserved.</p>
            <div class="footer-socials">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>

</body>
</html>
