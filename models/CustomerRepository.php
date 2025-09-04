<?php

namespace App\Models;
use App\Libs\ModelBase;
use PDO;

class CustomerRepository extends ModelBase
{
  private \PDO $pdo;

  /** @var string */
  private string $table = 'cas_customer';

  public function __construct(\PDO $pdo)
  {
      $this->pdo = $pdo;
  }

  /**
   * Obtiene todos los clientes activos.
   * @return array
   */
  public function findActiveCustomers(): array
  {
      $sql = "SELECT id_customer, label_customer FROM cas_customer WHERE customer_status = 1 ORDER BY label_customer ASC";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}