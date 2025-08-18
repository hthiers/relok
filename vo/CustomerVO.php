<?php
namespace App\VO;

/* Value Object para manejar datos de usuario */
class CustomerVO {

    private $id_customer;
    private $code_customer;
    private $id_tenant;
    private $label_customer;
    private $detail_customer;
    private $customer_dni;

    //ID Customer
    public function setIdCustomer($customerId)
    {
        $this->id_customer = $customerId;
    }

    public function getIdCustomer()
    {
        return $this->id_customer;
    }

    //CODE Customer
    public function setCodeCustomer($customerCode)
    {
        $this->code_customer = $customerCode;
    }

    public function getCodeCustomer()
    {
        return $this->code_customer;
    }

    //ID TENANT
    public function setIdTenant($id_tenant)
    {
        $this->id_tenant = $id_tenant;
    }

    public function getIdTenant()
    {
        return $this->id_tenant;
    }

    //Customer NAME|
    public function setLabelCustomer($customerLabel)
    {
        $this->label_customer = $customerLabel;
    }

    public function getLabelCustomer()
    {
        return $this->label_customer;
    }

    //Customer Detail
    public function setDetailCustomer($customerDetail)
    {
        $this->detail_customer = $customerDetail;
    }

    public function getDetailCustomer()
    {
        return $this->detail_customer;
    }

    // Customer DNI
    public function setCustomerDni($dni)
    {
        $this->customer_dni = $dni;
    }

    public function getCustomerDni()
    {
        return $this->customer_dni;
    }
}
