<?php
namespace App\Models;

use App\Core\Model;

class Company extends Model
{
    protected static string $table = 'companies';

    public static function generateAvatar(string $name): string
    {
        $encodedName = urlencode($name);

        return "https://ui-avatars.com/api/?name={$encodedName}&background=random&color=fff";
    }
    //                                                                       //               _O_
                                                                            //              _/ | \_
    ////Check wach kayen chi annonce bhad company for company condition before delete it   / _/ \_ \ 
    public static function hasAnnouncements(int $companyId): bool                    //     _|   |_
    {
        $sql = "SELECT COUNT(*) FROM announcements WHERE company_id = :company_id;";
        $stmt = self::$db -> prepare($sql);
        $stmt -> execute([
            'company_id' => $companyId
        ]);

        return (int) $stmt -> fetchColumn() > 0;
    }
}
