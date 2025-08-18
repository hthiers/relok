<?php
namespace App\Controllers;

use App\Libs\ControllerBase;
use App\Libs\FR_Session;
use App\Libs\Utils;
use App\Libs\Config;
use App\Models\TenantModel;
use PDO;

class TenantController extends ControllerBase
{
    /*******************************************************************************
    * Contexto de Empresa, características de la cuenta
    *******************************************************************************/

    public function tenantInfoForm()
    {
        $session = FR_Session::singleton();

        //incluye el modelo que corresponde
        require_once 'models/TenantModel.php';

        $company = new TenantModel();
        $companyInfo = $company->getTenantInfoAccount($session->id_tenant);

        $data['titulo'] = "Información de la cuenta";
        $data['controller'] = "tenant";
        $data['action'] = "tenantInfoForm";
        $data['company_info'] = $companyInfo->fetch(PDO::FETCH_ASSOC);

        $this->view->show("admin_tenant_info.php", $data);
    }

    //Obtiene el historial de pagos de la empresa
    public function getPaymentHistory()
    {
      $session = FR_Session::singleton();
      require_once 'models/TenantModel.php';

      $tenant = new TenantModel();
      $payments = $tenant->getPaymentsByTenant($session->id_tenant);

      $data['titulo'] = "Historial de Pagos";
      $data['constroller'] = "tenant";
      $data['action'] = "getPaymentHistory";
      $data['payments'] = $payments->fetch(PDO::FETCH_ASSOC);
      $data['payments_array'] = $payments;

      //print_r($data['payments']);
      //return false;

      $this->view->show("admin_payment_history.php", $data);
    }
}
