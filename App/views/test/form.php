    <h2>Test validation</h2>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $messages): ?>
            <?php foreach ($messages as $message): ?>
                <li><?= \App\Core\View::e($message) ?></li>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post" action="/test">
    <div>
        <input type="text" name="email" placeholder="Email">
    </div>

    <div>
        <input type="password" name="password" placeholder="Password">
    </div>

    <button type="submit">Envoyer</button>
</form>
