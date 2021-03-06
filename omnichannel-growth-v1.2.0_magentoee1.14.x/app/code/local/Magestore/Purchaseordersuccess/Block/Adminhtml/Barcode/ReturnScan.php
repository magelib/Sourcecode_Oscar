<?php

/**
 *
 *  Magestore
 *   NOTICE OF LICENSE
 *
 *   This source file is subject to the Magestore.com license that is
 *   available through the world-wide-web at this URL:
 *   http://www.magestore.com/license-agreement.html
 *
 *   DISCLAIMER
 *
 *   Do not edit or add to this file if you wish to upgrade this extension to newer
 *   version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Purchaseordersuccess3
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 *
 *
 */
use Magestore_Purchaseordersuccess_Model_Purchaseorder_Options_Status as PurchaseorderStatus;

class Magestore_Purchaseordersuccess_Block_Adminhtml_Barcode_ReturnScan extends Mage_Adminhtml_Block_Abstract
{
    /** @var  Magestore_Purchaseordersuccess_Model_Return */
    protected $returnRequest;

    /**
     * Internal constructor, that is called from real constructor
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->returnRequest = Mage::registry('current_return_request');
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!Mage::helper('purchaseordersuccess')->isModuleEnabled('Magestore_Barcodesuccess')) {
            return '';
        }
        return parent::_toHtml();
    }

    public function getLoadBarcodeUrl()
    {
        return $this->getUrl(
            'adminhtml/purchaseordersuccess_return_item/loadBarcode',
            array(
                'id' => $this->returnRequest->getReturnOrderId(),
                'warehouse_id' => $this->returnRequest->getWarehouseId(),
                'supplier_id' => $this->returnRequest->getSupplierId()
            )
        );
    }

    public function getSubmitBarcodeUrl()
    {
        return $this->getUrl(
            'adminhtml/purchaseordersuccess_return_item/save',
            array(
                'id' => $this->returnRequest->getReturnOrderId(),
                'supplier_id' => $this->returnRequest->getSupplierId(),
                'modal' => 'scanbarcode'
            )
        );
    }

    /**
     * @return string
     */
    public function getJsParentObjectName(){
        return $this->getLayout()
            ->createBlock('purchaseordersuccess/adminhtml_return_edit_tab_returnsummary_grid')
            ->getJsObjectName();
    }

    /**
     * Add child element
     *
     * if $after parameter is false - then element adds to end of collection
     * if $after parameter is null - then element adds to befin of collection
     * if $after parameter is string - then element adds after of the element with some id
     *
     * @param   string $elementId
     * @param   string $type
     * @param   array $config
     * @param   mixed $after
     * @return Varien_Data_Form_Element_Abstract
     */
    public function addField($elementId, $type, $config, $after = false)
    {
        if ($type == 'date')
            $className = 'Magestore_Purchaseordersuccess_Block_Adminhtml_Form_Field_Element_Date';
        else
            $className = 'Varien_Data_Form_Element_' . ucfirst(strtolower($type));
        $element = new $className($config);
        $element->setId($elementId);
        $element->setForm($this->getForm());
        return $element->toHtml();
    }


    public function getTabContainer(){
        return 'return_request_tabsJsTabs';
    }

    public function getReloadTabs(){
        return Zend_Json::encode($this->reloadTabs);
    }
}