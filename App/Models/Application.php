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
}
