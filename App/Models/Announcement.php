<?php

namespace App\Models;

use App\Core\Model;

class Announcement extends Model
{
    protected static string $table = 'announcements';

    public static function getActiveWithCompanies(): array
    {
        $sql = "SELECT announcements.*, companies.name as company FROM announcements 
                JOIN companies ON companies.id = announcements.company_id
                WHERE announcements.deleted = 0 
                ORDER BY announcements.created_at DESC";

        $stmt = self::$db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function find($id): ?array
    {
    $sql = "SELECT announcements.*, companies.name AS company
            FROM announcements
            JOIN companies ON companies.id = announcements.company_id
            WHERE announcements.id = :id";

    $stmt = self::$db->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
}


    public static function getArchived(): array
    {
        $sql = "SELECT announcements.*, companies.name as company FROM announcements 
                JOIN companies ON companies.id = announcements.company_id
                WHERE announcements.deleted = 1 
                ORDER BY announcements.created_at DESC";

        $stmt = self::$db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function countActive(): int
    {
        $sql = "SELECT COUNT(*) FROM announcements WHERE deleted = 0";
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
    
    public static function countArchived(): int
    {
        $sql = "SELECT COUNT(*) FROM announcements WHERE deleted = 1";
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
}
