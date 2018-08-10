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

/**
 * Class Magestore_Webpos_Block_AbstractBlock
 */
class Magestore_Webpos_Block_AbstractBlock extends Mage_Core_Block_Template
{
    /**
     * @var array
     */
    protected $_jsLayout = array();

    const EVENT_WEBPOS_GET_JS_LAYOUT_AFTER = 'webpos_get_js_layout_after';
    const EVENT_WEBPOS_SET_JS_LAYOUT_AFTER = 'webpos_set_js_layout_after';
    const EVENT_WEBPOS_SET_JS_LAYOUT_BEFORE = 'webpos_set_js_layout_before';

    /**
     * Constructor
     */
    protected function _construct()
    {
        parent::_construct();
    }

    /**
     * @return mixed
     */
    public function _prepareLayout()
    {
        return parent::_prepareLayout(); // TODO: Change the autogenerated stub
    }

    /**
     * @param $params
     */
    public function addJsLayout($params){
        $jsLayout = $this->_jsLayout;
        if(!empty($params)){
//            $jsLayout = array_merge_recursive($jsLayout, $params);
            $this->mergeJsLayouts($jsLayout, $params);
        }
        $this->_jsLayout = $jsLayout;
    }

    /**
     * @return array
     */
    public function getJsLayout($type) {
        $jsLayout = (!empty($type) && isset($this->_jsLayout[$type]))?$this->_jsLayout[$type]:$this->_jsLayout;
        return $jsLayout;
    }

    /**
     * @return array
     */
    public function getWebposConfig() {
        return Mage::helper('webpos')->getWebposConfig();
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        if (Mage::app()->getStore()->isFrontUrlSecure()) {
            return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK, true);
        } else {
            return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK, false);
        }
    }

    /**
     * @param $parentLayout
     * @param $note
     */
    protected function mergeJsLayouts(&$parentLayout, $note){
        foreach ($note as $key => $value){
            if(($key == 'children') && !is_array($parentLayout[$key])){
                $parentLayout[$key] = array();
            }
            if(!isset($parentLayout[$key])){
                $parentLayout[$key] = $value;
            }else{
                if(is_array($value)){
                    $this->mergeJsLayouts($parentLayout[$key], $value);
                }else{
                    $parentLayout[$key] = $value;
                }
            }
        }
    }
}
