<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?? 'Front Office' ?></title>
</head>
<body>

<header style="background: #ddd; padding: 10px;">
    <a href="/">Home</a>
    <a href="/login">Login</a>
    <a href="/register">Register</a>
     <?php if (\App\Core\Security::isAdmin()): ?>
        | <a href="/admin">Admin</a>
    <?php endif; ?>
</header>

<main style="padding: 10px;">
    <?= $content ?>
</main>

<footer style="background: #ddd; padding: 10px">
    Front Footer
</footer>

</body>
</html>