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
 * Class Magestore_Webpos_Helper_Currency
 */
class Magestore_Webpos_Helper_Currency extends Mage_Core_Helper_Abstract {

    /**
     * Currency cache
     *
     * @var array
     */
    protected $_currencyCache = array();

    /**
     * @param $amount
     * @param $from
     * @param $to
     * @return float
     */
    public function currencyConvert($amount, $from, $to){
        if (empty($this->_currencyCache[$to])) {
            $this->_currencyCache[$to] = Mage::getModel('directory/currency')->load($to);
        }
        return Mage::helper('directory')->currencyConvert($amount, $from, $this->_currencyCache[$to]);
    }

}
