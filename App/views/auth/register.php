<h2>Register</h2>

<form method="post" action="/register">
    <input type="hidden" name="csrf_token"
           value="<?= \App\Core\Security::generateCsrfToken() ?>">

    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">

    <button type="submit">Register</button>
</form>
