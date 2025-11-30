<?php
require_once __DIR__ . '/../config/config.php';
requireLogin();

$pdo = getDB();

// Get statistics
$stats = [
    'total_employees' => $pdo->query("SELECT COUNT(*) FROM employees")->fetchColumn(),
    'active_employees' => $pdo->query("SELECT COUNT(*) FROM employees WHERE status = 'Active'")->fetchColumn(),
    'total_payroll' => $pdo->query("SELECT COUNT(*) FROM payrolls")->fetchColumn(),
    'pending_payroll' => $pdo->query("SELECT COUNT(*) FROM payrolls WHERE status = 'Pending'")->fetchColumn(),
];

$admin = getCurrentAdmin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Barangay Sto. Angel Payroll</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fffc',
                            100: '#cafdf3',
                            200: '#a1f4e5',
                            300: '#78e4d5',
                            400: '#4fc9c0',
                            500: '#34b9b0',
                            600: '#1fb9aa',
                            700: '#159488',
                            800: '#0f6f65',
                            900: '#0b4d47',
                        },
                    },
                },
            },
        }
    </script>
</head>
<body class="min-h-screen page-gradient">
    <?php include __DIR__ . '/includes/header.php'; ?>
    
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Overview of Barangay Sto. Angel Payroll System
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                <a href="<?php echo base_url('admin/employees.php'); ?>" class="glass-card tilt-hover overflow-hidden transition">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="bg-blue-500 rounded-md p-3">
                                <span class="text-2xl">👥</span>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Employees</dt>
                                    <dd class="text-2xl font-semibold text-gray-900"><?php echo $stats['total_employees']; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="<?php echo base_url('admin/employees.php'); ?>" class="glass-card tilt-hover overflow-hidden transition">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="bg-green-500 rounded-md p-3">
                                <span class="text-2xl">✅</span>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Active Employees</dt>
                                    <dd class="text-2xl font-semibold text-gray-900"><?php echo $stats['active_employees']; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="<?php echo base_url('admin/payroll.php'); ?>" class="glass-card tilt-hover overflow-hidden transition">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="bg-yellow-500 rounded-md p-3">
                                <span class="text-2xl">💰</span>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Payroll Records</dt>
                                    <dd class="text-2xl font-semibold text-gray-900"><?php echo $stats['total_payroll']; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="<?php echo base_url('admin/payroll.php'); ?>" class="glass-card tilt-hover overflow-hidden transition">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="bg-orange-500 rounded-md p-3">
                                <span class="text-2xl">⏳</span>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Pending Payroll</dt>
                                    <dd class="text-2xl font-semibold text-gray-900"><?php echo $stats['pending_payroll']; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-8">
                <div class="glass-card tilt-hover p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Barangay Payroll Briefing</h2>
                            <p class="text-sm text-gray-500">Snapshot of frontline programs</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                            Community Fund
                        </span>
                    </div>
                    
                    <div class="space-y-3 text-sm text-gray-600" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <p>
                            Focused on the honoraria and allowances of barangay security teams, health workers,
                            daycare staff, and project-based aides. Each payroll batch is tagged whether it draws from
                            the regular fund, SEF, or special project grants for easy treasury auditing.
                        </p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Automatic hazard pay and night-shift differential for security deployment</li>
                            <li>Consolidated summaries ready for Municipal Accounting submission</li>
                            <li>Tracking for medical missions, cleanliness drives, and similar allowances</li>
                        </ul>
                    </div>
                </div>
                <div class="glass-card tilt-hover p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Disbursement Timeline</h2>
                    <div class="space-y-4">
                        <div class="timeline-step">
                            <div class="timeline-badge">
                                1
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Attendance Validation</p>
                                <p class="text-sm text-gray-600">Digital DTRs and activity logs from security and health workers are uploaded.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="timeline-badge">
                                2
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Treasury Review</p>
                                <p class="text-sm text-gray-600">System-generated reports are forwarded for the Treasurer and Captain’s approval.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="glass-card tilt-hover p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
                    <div class="space-y-3">
                        <a href="<?php echo base_url('admin/employees.php?action=new'); ?>" class="block w-full bg-primary-600 hover:bg-primary-700 text-white text-center py-2 px-4 rounded-lg transition">
                            Add New Employee
                        </a>
                        <a href="<?php echo base_url('admin/payroll.php?action=new'); ?>" class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-2 px-4 rounded-lg transition">
                            Create Payroll
                        </a>
                    </div>
                </div>

                <div class="glass-card tilt-hover p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">System Information</h2>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p>Barangay Sto. Angel Payroll Management System</p>
                        <p>Version 1.0.0</p>
                        <p class="pt-2 text-xs text-gray-400">
                            Last updated: <?php echo date('F j, Y'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

