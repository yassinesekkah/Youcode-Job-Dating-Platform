<?php

namespace App\Models;

use App\Core\Model;

class Application extends Model
{
    protected static string $table = 'applications';

    public static function getByAnnouncement($announcementId): array
    {
        $sql = "
        SELECT 
            a.id,
            a.motivation,
            a.cv_path,
            a.status,
            a.created_at,
            u.name,
            u.email,
            u.promotion,
            u.specialization
        FROM applications a
        JOIN users u ON u.id = a.student_id
        WHERE a.announcement_id = :announcement_id
        ORDER BY a.created_at DESC
        ";

        $stmt = self::$db->prepare($sql);
        $stmt->execute([
            'announcement_id' => $announcementId
        ]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function updateStatus($id, $status): bool
    {
        $sql = "UPDATE applications
                Set status = :status, updated_at = NOW()
                WHERE id = :id";

        $stmt = self::$db->prepare($sql);

        return $stmt->execute([
            'status' => $status,
            'id' => $id
        ]);
    }

    public static function exists(int $studentId, int $announcementId): bool
    {
        $sql = "SELECT id FROM applications 
            WHERE student_id = :student_id 
              AND announcement_id = :announcement_id
            LIMIT 1";

        $stmt = self::$db->prepare($sql);
        $stmt->execute([
            'student_id' => $studentId,
            'announcement_id' => $announcementId
        ]);

        return (bool) $stmt->fetch();
    }
}
