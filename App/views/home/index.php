<?php

use App\Core\View; 
use App\Core\Security; ?>

<h2><?= $title ?></h2>

<ul>
    <?php foreach ($users as $user): ?>
        <li>
            <?= View::e($user['email']) ?>

            <!-- Update form -->
            <form method="post" action="/users/update" style="display:inline">

                <input type="hidden" name="csrf_token"
                    value="<?= Security::generateCsrfToken(); ?>">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">


                <input type="email" name="email"
                    value="<?= View::e($user['email']) ?>" required>

                <input type="password" name="password"
                    placeholder="New password">

                <button type="submit">Update</button>
            </form>

            <!-- Delete form -->
            <form method="post" action="/users/delete" style="display:inline">

                <input type="hidden" name="csrf_token"
                    value="<?= Security::generateCsrfToken(); ?>">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                <button type="submit">Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

    <?php if (!empty($userFound)): ?>

        <ul>
            <li><?= View::e($userFound['email']) ?></li>
        </ul>
    <?php else: ?>
        <p>Aucun utilisateur trouve</p>
    <?php endif; ?>




<form method="post" action="/users/store">
    <input type="hidden" name="csrf_token"
        value="<?= Security::generateCsrfToken(); ?>">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Create user</button>
</form>