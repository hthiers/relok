<?php

namespace App\Models;
use App\Libs\ModelBase;
use PDO;

class TypeRepository extends ModelBase
{
  private \PDO $pdo;
  private string $table = 'cas_type';

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Obtiene una lista de todos los tipos activos para usar en selectores.
     * @return array
     */
    public function findActiveForSelect(): array
    {
        $sql = "SELECT id_type, label_type 
                FROM {$this->table} 
                WHERE status_type = 1 
                ORDER BY label_type ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}