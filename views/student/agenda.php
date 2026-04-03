<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Surf Lessons — Taghazout Surf Expo">
    <title>My Lessons — Taghazout Surf Expo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="dashboard-wrapper">

        <!-- ========== SIDEBAR ========== -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <span class="logo-icon">🏄‍♂️</span>
                <h2>Surf Expo</h2>
                <span>Student</span>
            </div>

            <nav class="sidebar-nav">
                <a href="agenda.php" class="nav-item active">
                    <i class="fas fa-calendar-alt"></i>
                    <span>My Lessons</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="logout.php" class="nav-item logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- ========== MAIN CONTENT ========== -->
        <main class="main-content">

            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <h1>
                    🌊 Welcome, <?= htmlspecialchars($student['name'] ?? 'Surfer') ?>!
                </h1>
                <p class="subtitle">Here are your upcoming surf sessions.</p>

                <div class="welcome-info">
                    <div class="info-item">
                        <i class="fas fa-globe-americas"></i>
                        <span>Country: <strong><?= htmlspecialchars($student['country'] ?? '—') ?></strong></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-signal"></i>
                        <span>Level: <strong>
                            <?php
                                $lvl = $student['level'] ?? 'Beginner';
                                $lvlClass = 'badge-' . strtolower($lvl);
                            ?>
                            <span class="badge <?= $lvlClass ?>"><?= $lvl ?></span>
                        </strong></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-book"></i>
                        <span>Enrolled in <strong><?= count($lessons) ?></strong> lesson(s)</span>
                    </div>
                </div>
            </div>

            <!-- Lessons Section -->
            <div class="section">
                <div class="section-header">
                    <h2><i class="fas fa-calendar-alt"></i> My Upcoming Lessons</h2>
                </div>

                <?php if (empty($lessons)): ?>
                    <div class="empty-state">
                        <i class="fas fa-umbrella-beach"></i>
                        <p>No lessons scheduled yet. Ask your coach to enroll you!</p>
                    </div>
                <?php else: ?>
                    <div class="lessons-list">
                        <?php foreach ($lessons as $l): ?>
                            <?php
                                $dt = strtotime($l['date_time']);
                                $day = date('d', $dt);
                                $month = date('M', $dt);
                                $time = date('H:i', $dt);
                                $fullDate = date('l, M d, Y', $dt);
                                $payClass = $l['payment_status'] == 'Paid' ? 'badge-paid' : 'badge-pending';
                            ?>
                            <div class="lesson-card">
                                <div class="lesson-info">
                                    <div class="lesson-date">
                                        <div class="day"><?= $day ?></div>
                                        <div class="month"><?= $month ?></div>
                                    </div>
                                    <div class="lesson-details">
                                        <h3><?= htmlspecialchars($l['title']) ?></h3>
                                        <p><i class="fas fa-user-tie"></i> Coach: <?= htmlspecialchars($l['coach']) ?></p>
                                        <p><i class="fas fa-clock"></i> <?= $fullDate ?> at <?= $time ?></p>
                                    </div>
                                </div>
                                <span class="badge <?= $payClass ?>">
                                    <i class="fas <?= $l['payment_status'] == 'Paid' ? 'fa-check-circle' : 'fa-hourglass-half' ?>"></i>
                                    &nbsp;<?= $l['payment_status'] ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </main>
    </div>
</body>
</html>
