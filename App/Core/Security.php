<?php

namespace App\Core;


class Security
{
    private static array $permissions = [
        'admin' => [
            'view_admin',
            'manage_users',
            'delete_users',
        ],
        'user' => [
            'view_profile',
        ],
    ];

    public static function generateCsrfToken(): string
    {
        if (!Session::has('csrf_token')) {
            Session::set('csrf_token', bin2hex(random_bytes(32)));
        }

        return Session::get('csrf_token');
    }

    public static function verifyCsrfToken(?string $token): bool
    {
        if (!$token || !Session::has('csrf_token')) {
            return false;
        }

        return hash_equals(Session::get('csrf_token'), $token);
    }

    public static function checkCsrfOrFail(?string $token): void
    {
        if (!self::verifyCsrfToken($token)) {
            http_response_code(419);
            exit('Invalid CSRF token');
        }
    }

    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    ///check lconexion
    public static function requireAuth(): void
    {
        if (!Session::has('user')) {
            http_response_code(401);
            exit('Unauthorized');
        }
    }

    ///check Role
    public static function requireRole(string $role): void
    {
        self::requireAuth();

        if (Session::get('user')['role'] !== $role) {
            http_response_code(403);
            View::render('errors/403');
            exit;
        }
    }

    public static function isAdmin(): bool
    {
        return Session::has('user') && Session::get('user')['role'] === 'admin';
    }


    public static function hasPermission(string $permission): bool
    {
        if (!Session::has('user')) {
            return false;
        }

        //njibo role
        $role = Session::get('user')['role'];

        return in_array(
            $permission,
            self::$permissions[$role] ?? [],
            true
        );
    }

    public static function requirePermission(string $permission): void
    {
        self::requireAuth();

        if (!self::hasPermission($permission)) {
            http_response_code(403);
            exit('Permission denied');
        }
    }
}
