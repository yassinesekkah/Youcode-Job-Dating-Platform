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
    
}
