<?php
// Script to create initial admin user
require_once __DIR__ . '/../config/config.php';

$username = 'admin';
$password = 'admin123';
$name = 'Administrator';
$email = 'admin@barangaystoangel.com';

$pdo = getDB();

// Check if admin already exists
$stmt = $pdo->prepare("SELECT id FROM admins WHERE username = ?");
$stmt->execute([$username]);
$existing = $stmt->fetch();

if ($existing) {
    // Update existing admin
    $hashedPassword = hashPassword($password);
    $id = $existing['id'];
    $stmt = $pdo->prepare("UPDATE admins SET password = ?, name = ?, email = ? WHERE id = ?");
    $stmt->execute([$hashedPassword, $name, $email, $id]);
    echo "✅ Admin user updated successfully!\n";
} else {
    // Create new admin
    $id = uniqid('admin_', true);
    $hashedPassword = hashPassword($password);
    $stmt = $pdo->prepare("INSERT INTO admins (id, username, password, name, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id, $username, $hashedPassword, $name, $email]);
    echo "✅ Admin user created successfully!\n";
}

echo "Username: $username\n";
echo "Password: $password (change this after first login!)\n";
echo "Name: $name\n";
echo "Email: $email\n";
?>

