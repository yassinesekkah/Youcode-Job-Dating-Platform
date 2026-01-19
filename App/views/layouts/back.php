<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?? 'Back Office' ?></title>
</head>
<body>

<header style="background: #ddd; padding: 10px;">
    <strong>Admin Panel</strong>
    <a href="/admin">Dashboard</a>
    <a href="/logout">Logout</a>
     <?php if (\App\Core\Security::isAdmin()): ?>
        | <a href="/admin">Admin</a>
    <?php endif; ?>
</header>

<main style="padding: 10px;">
    <?= $content ?>
</main>

<footer style="background: #ddd; padding: 10px;">
    Back Office Footer
</footer>

</body>
</html>
