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
 * @module     Webpos
 * @author      Magestore Developer
 *
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 *
 */

/**
 * Webpos Config Field Separator Block
 *
 * @category    Magestore
 * @package     Magestore_Webpos
 * @author      Magestore Developer
 */
class Magestore_Webpos_Block_Adminhtml_System_Config_Form_Field_Abstract extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    public $config = "";
    public $type = 'text';

    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        if (!$this->isShow()) {
            return '';
        }
        return parent::render($element);
    }

    /**
     * @return bool
     */
    protected function isShow()
    {
        if ($this->config) {
            $configValue = Mage::helper('customer/address')->getConfig($this->config);
            if ($configValue) {
                return true;
            }
        }
        return false;
    }

    public function getOptions()
    {
        return array();
    }

    public function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $elementHtml = '';
        $this->modifyType();
        switch ($this->type) {
            case 'select':
                $select = new Varien_Data_Form_Element_Select();
                $data = array(
                    'name' => $element->getName(),
                    'html_id' => $element->getId(),
                    'values' => $this->getOptions()
                );
                $select->setData($data);
                $select->setValue($element->getValue());
                $select->setForm($element->getForm());
                $elementHtml = $select->getElementHtml();
                break;
            default:
                $elementHtml = parent::_getElementHtml($element);
        }
        return $elementHtml;
    }

    protected function modifyType()
    {
        if (!empty($this->getOptions())) {
            $this->type = 'select';
        }
    }

}