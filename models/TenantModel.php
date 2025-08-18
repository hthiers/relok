<?php
namespace App\Models;

use App\Libs\ModelBase;
use PDO;

class TenantModel extends ModelBase
{
    /********************************
    * Company
    ********************************/

    /**
     * Get company info account by tenant
     * @param int $id_tenant
     * @return pdo
     */
    public function getTenantInfoAccount($id_tenant)
    {
        $query = $this->db->prepare("select
                                    a.label_tenant as 'tenant',
                                    c.name as 'account_type',
                                    d.value as 'price',
                                    b.expiration_date,
                                    e.name as 'tenant_status',
                                    b.manager
                                    from cas_tenant a
                                    inner join cas_tenant_account b on a.id_tenant = b.id_tenant
                                    inner join cas_account_type c on b.id_account_type = c.id_account_type
                                    inner join cas_price d on b.id_price = d.id_price
                                    inner join cas_tenant_status e on b.id_tenant_status = e.id_tenant_status
                                    where b.id_tenant = $id_tenant
                                  ");
      $query->execute();
      return $query;
    }

    public function getPaymentsByTenant($id_tenant)
    {
      $query = $this->db->prepare("select
                                  a.period,
                                  a.billing_date,
                                  a.payment_ammount,
                                  a.expiration_date,
                                  a.paid_ammount,
                                  a.payment_date,
                                  b.name as status
                                  from cas_tenant_payment a
                                  inner join cas_payment_status b
                                  on a.id_status = b.id_payment_status
                                  where a.id_tenant = $id_tenant
                                  ");
      $query->execute();
      return $query;
    }
}
 ?>
