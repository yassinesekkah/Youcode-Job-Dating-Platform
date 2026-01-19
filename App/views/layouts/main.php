

<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?? 'App' ?></title>
</head>
<body>

<header style="background: #ddd; padding: 10px;">
    <strong>HEADER</strong>

    <?php if (\App\Core\Security::isAdmin()): ?>
        | <a href="/admin">Admin</a>
    <?php endif; ?>
    
</header>

<main style="padding: 10px;">
    <?= $content ?>
</main>

<footer style="background: #ddd; padding: 10px;">
    <strong>FOOTER</strong>
</footer>

</body>
</html>
