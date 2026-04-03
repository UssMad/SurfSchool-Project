<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Dashboard — Taghazout Surf Expo Management">
    <title>Dashboard — Taghazout Surf Expo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="dashboard-wrapper">

        <!-- ========== SIDEBAR ========== -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <span class="logo-icon">🏄‍♂️</span>
                <h2>Surf Expo</h2>
                <span>Admin Panel</span>
            </div>

            <nav class="sidebar-nav">
                <a href="javascript:void(0)" id="nav-dashboard" class="nav-item active" onclick="showTab('dashboard')">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
                <a href="javascript:void(0)" id="nav-students" class="nav-item" onclick="showTab('students')">
                    <i class="fas fa-users"></i>
                    <span>Students</span>
                </a>
                <a href="javascript:void(0)" id="nav-lessons" class="nav-item" onclick="showTab('lessons')">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Lessons</span>
                </a>
                <a href="javascript:void(0)" id="nav-enrollments" class="nav-item" onclick="showTab('enrollments')">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Enrollments</span>
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

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h1>Dashboard</h1>
                    <p>Welcome back, Admin! Here's your surf school overview.</p>
                </div>
                <div class="header-actions">
                    <span style="color: var(--text-muted); font-size: 13px;">
                        <i class="fas fa-calendar"></i> <?= date('l, M d, Y') ?>
                    </span>
                </div>
            </div>

            <!-- ===== TAB: DASHBOARD (Stats & Charts) ===== -->
            <div id="dashboard" class="tab-content active">
                <!-- ===== STAT CARDS ===== -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div class="stat-value"><?= $totalStudents ?></div>
                        <div class="stat-label">Total Students</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                        <div class="stat-value"><?= $totalLessons ?></div>
                        <div class="stat-label">Total Lessons</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-value"><?= $paid ?></div>
                        <div class="stat-label">Paid Enrollments</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-clock"></i></div>
                        <div class="stat-value"><?= $pending ?></div>
                        <div class="stat-label">Pending Payments</div>
                    </div>
                </div>

                <!-- Bonus: Average students per session -->
                <?php
                    $avgStudents = ($totalLessons > 0) ? round(($paid + $pending) / $totalLessons, 1) : 0;
                ?>
                <div class="avg-stat">
                    <i class="fas fa-chart-line"></i>
                    <span>Average of <strong><?= $avgStudents ?></strong> students per session</span>
                </div>

                <!-- ===== CHARTS (Admin Only) ===== -->
                <div class="charts-grid" style="margin-top: 24px;">
                    <div class="chart-card">
                        <h3><i class="fas fa-chart-doughnut"></i> Student Levels</h3>
                        <div class="chart-container">
                            <canvas id="levelChart"></canvas>
                        </div>
                    </div>
                    <div class="chart-card">
                        <h3><i class="fas fa-chart-bar"></i> Payment Overview</h3>
                        <div class="chart-container">
                            <canvas id="paymentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>



            <!-- ===== TAB: STUDENTS ===== -->
            <div id="students" class="tab-content">
                <!-- Add Student Form -->
                <div class="form-panel">
                    <h3><i class="fas fa-user-plus"></i> Add New Student</h3>
                    <form method="POST" action="dashboard.php?action=createStudent" class="form-inline">
                        <input type="hidden" name="tab" value="students">
                        <div class="form-group" style="flex: 1;">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Full Name" required>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Temp Password" required>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label>Country</label>
                            <input type="text" name="country" placeholder="Country" required>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label>Level</label>
                            <select name="level">
                                <option>Beginner</option>
                                <option>Intermediate</option>
                                <option>Advanced</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </form>
                </div>

                <div class="section">
                    <div class="section-header">
                        <h2><i class="fas fa-users"></i> Students</h2>
                        <form method="GET" class="filter-bar">
                            <input type="hidden" name="tab" value="students">
                            <input type="text" name="search" placeholder="Search by name or country..." value="<?= htmlspecialchars($search ?? '') ?>">
                            <button type="submit"><i class="fas fa-search"></i> Search</button>
                            <?php if ($search): ?>
                                <a href="dashboard.php?tab=students" class="btn btn-sm btn-outline">Clear</a>
                            <?php endif; ?>
                        </form>
                    </div>

                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Level</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($students)): ?>
                                    <tr><td colspan="5" style="text-align:center; color: var(--text-muted); padding: 32px;">No students found.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($students as $s): ?>
                                        <tr>
                                            <td>#<?= $s['id'] ?></td>
                                            <td>
                                                <input type="text" name="name" form="edit-student-<?= $s['id'] ?>" value="<?= htmlspecialchars($s['name']) ?>" class="edit-input" required>
                                            </td>
                                            <td>
                                                <input type="text" name="country" form="edit-student-<?= $s['id'] ?>" value="<?= htmlspecialchars($s['country']) ?>" class="edit-input" required>
                                            </td>
                                            <td>
                                                <?php
                                                    $levelClass = 'badge-' . strtolower($s['level']);
                                                ?>
                                                <span class="badge <?= $levelClass ?>"><?= $s['level'] ?></span>
                                            </td>
                                            <td>
                                                <div class="actions">
                                                    <form method="POST" id="edit-student-<?= $s['id'] ?>" action="dashboard.php?action=updateStudent" class="inline-form">
                                                        <input type="hidden" name="tab" value="students">
                                                        <input type="hidden" name="id" value="<?= $s['id'] ?>">
                                                        <select name="level" class="edit-input">
                                                            <option <?= $s['level'] == 'Beginner' ? 'selected' : '' ?>>Beginner</option>
                                                            <option <?= $s['level'] == 'Intermediate' ? 'selected' : '' ?>>Intermediate</option>
                                                            <option <?= $s['level'] == 'Advanced' ? 'selected' : '' ?>>Advanced</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-sm btn-warning" title="Save Changes">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                    </form>
                                                    <a href="dashboard.php?action=deleteStudent&id=<?= $s['id'] ?>&tab=students" 
                                                       class="btn btn-sm btn-icon btn-danger"
                                                       title="Delete"
                                                       onclick="return confirm('Delete this student?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===== TAB: LESSONS ===== -->
            <div id="lessons" class="tab-content">
                <!-- Create Lesson Form -->
                <div class="form-panel">
                    <h3><i class="fas fa-plus-circle"></i> Create New Lesson</h3>
                    <form method="POST" action="dashboard.php?action=createLesson" class="form-inline">
                        <input type="hidden" name="tab" value="lessons">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" placeholder="e.g. Morning Surf" required>
                        </div>
                        <div class="form-group">
                            <label>Coach</label>
                            <input type="text" name="coach" placeholder="e.g. Youssef" required>
                        </div>
                        <div class="form-group">
                            <label>Date & Time</label>
                            <input type="datetime-local" name="date_time" required>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Create
                        </button>
                    </form>
                </div>

                <div class="section">
                    <div class="section-header">
                        <h2><i class="fas fa-chalkboard-teacher"></i> Lessons</h2>
                        <form method="GET" class="filter-bar">
                            <input type="hidden" name="tab" value="lessons">
                            <input type="text" name="search" placeholder="Search title or coach..." value="<?= htmlspecialchars($search ?? '') ?>">
                            <input type="date" name="date" value="<?= htmlspecialchars($date ?? '') ?>">
                            <button type="submit"><i class="fas fa-search"></i> Search</button>
                            <?php if ($search || $date): ?>
                                <a href="dashboard.php?tab=lessons" class="btn btn-sm btn-outline">Clear</a>
                            <?php endif; ?>
                        </form>
                    </div>

                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Coach</th>
                                    <th>Date & Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($lessons)): ?>
                                    <tr><td colspan="5" style="text-align:center; color: var(--text-muted); padding: 32px;">No lessons found.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($lessons as $l): ?>
                                        <tr>
                                            <td>#<?= $l['id'] ?></td>
                                            <td><strong><?= htmlspecialchars($l['title']) ?></strong></td>
                                            <td><?= htmlspecialchars($l['coach']) ?></td>
                                            <td><?= date('M d, Y — H:i', strtotime($l['date_time'])) ?></td>
                                            <td>
                                                <div class="actions">
                                                    <form method="POST" action="dashboard.php?action=updateLesson" class="inline-form">
                                                        <input type="hidden" name="tab" value="lessons">
                                                        <input type="hidden" name="id" value="<?= $l['id'] ?>">
                                                        <input type="text" name="title" value="<?= htmlspecialchars($l['title']) ?>" class="edit-input" required>
                                                        <input type="text" name="coach" value="<?= htmlspecialchars($l['coach']) ?>" class="edit-input" required>
                                                        <input type="datetime-local" name="date_time" value="<?= date('Y-m-d\TH:i', strtotime($l['date_time'])) ?>" class="edit-input" required>
                                                        <button type="submit" class="btn btn-sm btn-warning" title="Update">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                    </form>
                                                    <a href="dashboard.php?action=deleteLesson&id=<?= $l['id'] ?>&tab=lessons" 
                                                       class="btn btn-sm btn-icon btn-danger"
                                                       title="Delete"
                                                       onclick="return confirm('Delete this lesson?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===== TAB: ENROLLMENTS ===== -->
            <div id="enrollments" class="tab-content">
                <!-- Enroll Student Form -->
                <div class="form-panel">
                    <h3><i class="fas fa-user-plus"></i> Enroll Student in Lesson</h3>
                    <form method="POST" action="dashboard.php?action=enrollStudent" class="form-inline">
                        <input type="hidden" name="tab" value="enrollments">
                        <div class="form-group">
                            <label>Student</label>
                            <select name="student_id" required>
                                <option value="">— Select Student —</option>
                                <?php foreach ($students as $s): ?>
                                    <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?> (<?= $s['level'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Lesson</label>
                            <select name="lesson_id" required>
                                <option value="">— Select Lesson —</option>
                                <?php foreach ($lessons as $l): ?>
                                    <option value="<?= $l['id'] ?>"><?= htmlspecialchars($l['title']) ?> — <?= date('M d', strtotime($l['date_time'])) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Enroll
                        </button>
                    </form>
                </div>

                <div class="section">
                    <div class="section-header">
                        <h2><i class="fas fa-clipboard-list"></i> Enrollments & Payments</h2>
                        <form method="GET" class="filter-bar">
                            <input type="hidden" name="tab" value="enrollments">
                            <input type="text" name="search" placeholder="Search student or lesson..." value="<?= htmlspecialchars($search ?? '') ?>">
                            <button type="submit"><i class="fas fa-search"></i> Search</button>
                            <?php if ($search): ?>
                                <a href="dashboard.php?tab=enrollments" class="btn btn-sm btn-outline">Clear</a>
                            <?php endif; ?>
                        </form>
                    </div>

                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Lesson</th>
                                    <th>Coach</th>
                                    <th>Date</th>
                                    <th>Payment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($enrolls)): ?>
                                    <tr><td colspan="6" style="text-align:center; color: var(--text-muted); padding: 32px;">No enrollments yet.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($enrolls as $e): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($e['name']) ?></strong></td>
                                            <td><?= htmlspecialchars($e['title']) ?></td>
                                            <td><?= htmlspecialchars($e['coach'] ?? '—') ?></td>
                                            <td><?= isset($e['date_time']) ? date('M d, H:i', strtotime($e['date_time'])) : '—' ?></td>
                                            <td>
                                                <?php
                                                    $payClass = $e['payment_status'] == 'Paid' ? 'badge-paid' : 'badge-pending';
                                                ?>
                                                <span class="badge <?= $payClass ?>"><?= $e['payment_status'] ?></span>
                                            </td>
                                            <td>
                                                <form method="POST" action="dashboard.php?action=updatePayment" class="inline-form">
                                                    <input type="hidden" name="tab" value="enrollments">
                                                    <input type="hidden" name="student_id" value="<?= $e['student_id'] ?>">
                                                    <input type="hidden" name="lesson_id" value="<?= $e['lesson_id'] ?>">
                                                    <select name="status">
                                                        <option value="Pending" <?= $e['payment_status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                                        <option value="Paid" <?= $e['payment_status'] == 'Paid' ? 'selected' : '' ?>>Paid</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- ===== CHART.JS SCRIPTS ===== -->
    <script>
        // Tab switching
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            
            // Remove active class from all sidebar items
            document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabName).classList.add('active');

            // Add active class to clicked sidebar item
            const activeNav = document.getElementById('nav-' + tabName);
            if (activeNav) activeNav.classList.add('active');
        }

        // On page load, check for tab in URL
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            if (tab) {
                showTab(tab);
            }
        };

        // Chart.js global config
        Chart.defaults.color = '#8892a8';
        Chart.defaults.font.family = 'Inter';
        Chart.defaults.plugins.legend.labels.padding = 16;
        Chart.defaults.plugins.legend.labels.usePointStyle = true;

        // 1) Student Levels Doughnut Chart
        <?php
            $levelCounts = ['Beginner' => 0, 'Intermediate' => 0, 'Advanced' => 0];
            if (!empty($levelData)) {
                foreach ($levelData as $row) {
                    $levelCounts[$row['level']] = $row['total'];
                }
            }
        ?>
        new Chart(document.getElementById('levelChart'), {
            type: 'doughnut',
            data: {
                labels: ['Beginner', 'Intermediate', 'Advanced'],
                datasets: [{
                    data: [<?= $levelCounts['Beginner'] ?>, <?= $levelCounts['Intermediate'] ?>, <?= $levelCounts['Advanced'] ?>],
                    backgroundColor: ['#00d4aa', '#3b82f6', '#8b5cf6'],
                    borderColor: '#0a1628',
                    borderWidth: 3,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // 2) Payment Status Bar Chart
        new Chart(document.getElementById('paymentChart'), {
            type: 'bar',
            data: {
                labels: ['Paid', 'Pending'],
                datasets: [{
                    label: 'Enrollments',
                    data: [<?= $paid ?>, <?= $pending ?>],
                    backgroundColor: ['rgba(46, 213, 115, 0.7)', 'rgba(255, 165, 2, 0.7)'],
                    borderColor: ['#2ed573', '#ffa502'],
                    borderWidth: 2,
                    borderRadius: 8,
                    barThickness: 60
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: 'rgba(255,255,255,0.04)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</body>
</html>