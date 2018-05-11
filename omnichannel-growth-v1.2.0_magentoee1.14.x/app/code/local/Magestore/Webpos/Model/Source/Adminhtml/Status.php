<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Webpos
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

class Magestore_Webpos_Model_Source_Adminhtml_Status extends Varien_Object {

    static public function getOptionArray()
    {
        return array(
            '1'    => Mage::helper('webpos')->__('Active'),
            '2'    => Mage::helper('webpos')->__('Inactive'),
        );
    }
    static public function toOptionArray() {
        $options = array(
            array('value' => '1', 'label' => Mage::helper('webpos')->__('Active')),
            array('value' => '2', 'label' => Mage::helper('webpos')->__('Inactive')),
        );
        return $options;
    }

}