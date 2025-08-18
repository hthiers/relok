<?php
namespace App\Models;

use App\Libs\ModelBase;
use PDO;

class PanelModel extends ModelBase
{
    public function getDashboardData(int $id_tenant): \PDOStatement
    {
        // Usar una consulta preparada para evitar la inyección de SQL
        $consulta = $this->db->prepare("
            SELECT
                a.id_user,
                a.name_user,
                a.id_profile,
                a.genero,
                pro.label_profile,
                b.id_task,
                b.label_task,
                b.date_end,
                b.cas_customer_id_customer,
                cus.label_customer,
                b.id_type,
                c.label_type
            FROM cas_user a
            LEFT OUTER JOIN cas_task b
                ON a.id_user = b.id_user
                AND a.id_tenant = b.id_tenant
            LEFT OUTER JOIN cas_type c
                ON b.id_type = c.id_type
                AND b.id_tenant = c.id_tenant
            LEFT OUTER JOIN cas_customer cus
                ON b.cas_customer_id_customer = cus.id_customer
                AND b.id_tenant = cus.id_tenant
            LEFT OUTER JOIN cas_profile pro
                ON a.id_profile = pro.id_profile
                AND a.id_tenant = pro.id_tenant
            WHERE a.id_tenant = :id_tenant
        ");

        // Enlaza el parámetro para evitar inyecciones SQL
        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta;
    }

    public function goCustomQuery(string $sql): \PDOStatement
    {
        // Registra la consulta SQL en el log o muéstrala
        error_log("Executing SQL: " . $sql);
        // echo "Executing SQL: " . $sql;

        // Prepara la consulta sin usar atributos no apropiados para esta función
        $consulta = $this->db->prepare($sql);

        $consulta->execute();
        return $consulta;
    }
}
