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
class Magestore_Webpos_Block_Adminhtml_System_Config_Form_Field_Date extends Magestore_Webpos_Block_Adminhtml_System_Config_Form_Field_Abstract
{
    public function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $date = new Varien_Data_Form_Element_Date();
        $format = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $data = array(
            'name' => $element->getName(),
            'html_id' => $element->getId(),
            'image' => $this->getSkinUrl('images/grid-cal.gif')
        );
        $date->setData($data);
        $date->setValue($element->getValue(), $format);
        $date->setFormat(Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT));
        $date->setForm($element->getForm());
        $elementHtml = $date->getElementHtml();
        $style = 'style="border: 1px solid #afb3bb; border-radius: 0px; height: 30px; font-size: 14px;"';
        $elementHtml = str_replace('style="width:110px !important;"', $style, $elementHtml);
        return $elementHtml;
    }
}