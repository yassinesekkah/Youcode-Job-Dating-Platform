<?php
namespace App\Models;

use App\Core\Model;

class Student extends Model
{
    protected static string $table = 'users';

    public static function getStudents(): array
    {
        $sql = "SELECT id, name, email, created_at FROM users WHERE ROLE = 'apprenant'";

        $stmt = self::$db-> prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}