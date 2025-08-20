<?php
// models/UnitRepository.php

class UnitRepository
{
    private \PDO $pdo;
    private string $table = 'cas_unit';

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /** Devuelve 1 unidad por id o null */
    public function findById(int $id): ?array
    {
        $sql = "SELECT id, name, code, description, is_active, created_at, updated_at
                FROM {$this->table} WHERE id = :id";
        $st = $this->pdo->prepare($sql);
        $st->execute([':id' => $id]);
        $row = $st->fetch(\PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    /** Lista con paginación simple */
    public function findAll(int $page = 1, int $perPage = 20, ?string $q = null): array
    {
        $offset = max(0, ($page - 1) * $perPage);
        $params = [];
        $where = '';

        if ($q !== null && $q !== '') {
            $where = "WHERE name LIKE :q OR code LIKE :q";
            $params[':q'] = "%{$q}%";
        }

        $sql = "SELECT SQL_CALC_FOUND_ROWS id, name, code, description, is_active, created_at, updated_at
                FROM {$this->table} {$where}
                ORDER BY name ASC
                LIMIT :limit OFFSET :offset";
        $st = $this->pdo->prepare($sql);
        foreach ($params as $k => $v) $st->bindValue($k, $v, \PDO::PARAM_STR);
        $st->bindValue(':limit', $perPage, \PDO::PARAM_INT);
        $st->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $st->execute();
        $items = $st->fetchAll(\PDO::FETCH_ASSOC);

        $total = (int)$this->pdo->query("SELECT FOUND_ROWS()")->fetchColumn();
        return ['items' => $items, 'total' => $total, 'page' => $page, 'perPage' => $perPage];
    }

    /** Crear y devolver id insertado */
    public function create(array $data): int
    {
        $sql = "INSERT INTO {$this->table} (name, code, description, is_active, created_at, updated_at)
                VALUES (:name, :code, :description, :is_active, NOW(), NOW())";
        $st = $this->pdo->prepare($sql);
        $st->execute([
            ':name'        => trim((string)($data['name'] ?? '')),
            ':code'        => $data['code'] ?? null,
            ':description' => $data['description'] ?? null,
            ':is_active'   => isset($data['is_active']) ? (int) !!$data['is_active'] : 1,
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    /** Update por id; retorna filas afectadas */
    public function update(int $id, array $data): int
    {
        $sql = "UPDATE {$this->table}
                   SET name = :name,
                       code = :code,
                       description = :description,
                       is_active = :is_active,
                       updated_at = NOW()
                 WHERE id = :id";
        $st = $this->pdo->prepare($sql);
        $st->execute([
            ':id'          => $id,
            ':name'        => trim((string)($data['name'] ?? '')),
            ':code'        => $data['code'] ?? null,
            ':description' => $data['description'] ?? null,
            ':is_active'   => isset($data['is_active']) ? (int) !!$data['is_active'] : 1,
        ]);
        return $st->rowCount();
    }

    /** Borrar por id; retorna filas afectadas */
    public function delete(int $id): int
    {
        $st = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $st->execute([':id' => $id]);
        return $st->rowCount();
    }

    /** Comprobar unicidad de code */
    public function existsByCode(string $code, ?int $excludeId = null): bool
    {
        $sql = "SELECT id FROM {$this->table} WHERE code = :code";
        $params = [':code' => $code];
        if ($excludeId !== null) {
            $sql .= " AND id <> :exclude";
            $params[':exclude'] = $excludeId;
        }
        $st = $this->pdo->prepare($sql);
        $st->execute($params);
        return (bool)$st->fetchColumn();
    }
}
