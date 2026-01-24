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
            $sql .= " AND (announcements.title LIKE ? OR announcements.description LIKE ? OR companies.name LIKE ?)";
            $params[] = "%$q%";
            $params[] = "%$q%";
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

    public static function getRecent(int $limit): array
    {
        $sql = "
        SELECT a.id, a.title, a.created_at, c.name AS company
        FROM announcements a
        JOIN companies c ON c.id = a.company_id
        WHERE a.deleted = 0
        ORDER BY a.created_at DESC
        LIMIT :limit
        ";

        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function search(string $q): array
    {
        $sql = "
        SELECT 
            announcements.*,
            companies.name AS company
        FROM announcements
        INNER JOIN companies 
            ON companies.id = announcements.company_id
        WHERE announcements.deleted = 0
          AND announcements.title LIKE :q
        ORDER BY announcements.created_at DESC
        ";

        $stmt = self::$db->prepare($sql);
        $stmt->bindValue(':q', '%' . $q . '%', \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
