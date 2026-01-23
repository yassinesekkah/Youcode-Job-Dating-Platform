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

    public static function findAnnouncement($id)
    {
        return parent::find($id);
    
}

public static function filter($q = null, $company = null, $contract = null): array
{
    $sql = "SELECT announcements.*, companies.name AS company
            FROM announcements
            JOIN companies ON companies.id = announcements.company_id
            WHERE 1=1";
    $params = [];

    if ($q) {
        $sql .= " AND announcements.title LIKE ?";
        $params[] = "%$q%";
    }

    if ($company) {
        $sql .= " AND companies.name = ?";
        $params[] = $company;
    }

    if ($contract) {
        $sql .= " AND announcements.contract_type = ?";
        $params[] = $contract;
    }

    $sql .= " ORDER BY announcements.created_at DESC";

    $stmt = self::$db->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}



    
}
