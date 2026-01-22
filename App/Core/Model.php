<?php

namespace App\Core;

abstract class Model
{
    protected static \PDO $db;
    protected static string $table;

    public static function setDatabase(\PDO $pdo): void
    {
        self::$db = $pdo;
    }

    ///fetch All
    public static function all(): array
    {
        $stmt = self::$db->prepare(
            "SELECT * FROM " . static::$table
        );
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    ///find By Id
    public static function find($id): ?array
    {
        $stmt = self::$db->prepare("SELECT * FROM " . static::$table . " WHERE id = :id");
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    ///insert into
    public static function create($data): bool
    {
        ///array_keys kat9ad array fih ghir l keys
        $fields = array_keys($data);
        ///implode katchad array katrado string par1 howa bach katefra9 binhoum par2 howa array
        $columns = implode(', ', $fields);
        $placeholders = ':' . implode(', :', $fields);

        $sql = "INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)";

        $stmt = self::$db->prepare($sql);

        return $stmt->execute($data);
    }

    ///update
    public static function update(int $id, array $data): bool
    {
        $fields = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }

        $fields[] = "updated_at = NOW()";

        $sql = "UPDATE " . static::$table . "
            SET " . implode(', ', $fields) . "
            WHERE id = :id";

        $data['id'] = $id;

        $stmt = self::$db->prepare($sql);
        return $stmt->execute($data);
    }

    //delete 
    public static function delete(int $id): bool
    {
        $stmt = self::$db->prepare(
            "DELETE FROM " . static::$table . " WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }

    ///archived
    public static function softDelete(int $id): bool
    {
        $sql = "UPDATE " . static::$table . "
            SET deleted = 1, updated_at = NOW()
            WHERE id = :id";

        $stmt = self::$db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    ///restore 
    public static function restore(int $id): bool
    {
        $sql = "UPDATE " . static::$table . "
            SET deleted = 0, updated_at = NOW()
            WHERE id = :id";

        $stmt = self::$db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    ///is email exists
    public static function emailExists(string $email): bool
    {
        $sql = "SELECT id FROM " . static::$table . " WHERE email = :email LIMIT 1";

        $stmt = self::$db->prepare($sql);
        $stmt->execute([
            'email' => $email
        ]);

        return (bool) $stmt->fetch();
    }

    public static function emailExistsExcept(string $email, int $id): bool
    {
        $sql = "SELECT id FROM " . static::$table . " WHERE email = :email AND id != :id LIMIT 1";

        $stmt = self::$db->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'id' => $id
        ]);
        
        return (bool) $stmt->fetch();
    }

}
