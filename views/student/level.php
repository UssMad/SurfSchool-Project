<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Level — Taghazout Surf Expo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card" style="text-align: center;">
            <div class="auth-logo">
                <span class="logo-icon">🏄‍♂️</span>
                <h1>Your Surf Level</h1>
            </div>

            <?php if (isset($student)): ?>
                <p style="margin-bottom: 16px; color: var(--text-secondary);">
                    <?= htmlspecialchars($student['name']) ?>
                </p>
                <?php $lvlClass = 'badge-' . strtolower($student['level']); ?>
                <span class="badge <?= $lvlClass ?>" style="font-size: 18px; padding: 10px 24px;">
                    <?= $student['level'] ?>
                </span>
            <?php else: ?>
                <p style="color: var(--text-muted);">No student info found.</p>
            <?php endif; ?>

            <p class="auth-footer" style="margin-top: 32px;">
                <a href="my_lessons.php"><i class="fas fa-arrow-left"></i> Back to My Lessons</a>
            </p>
        </div>
    </div>
</body>
</html>
