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
        $fields = array_keys($data);
        $setClause = implode(', ', array_map(
            fn($field) => "$field = :$field",
            $fields
        ));

        $sql = "UPDATE " . static::$table . " SET $setClause WHERE id = :id";
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
}
