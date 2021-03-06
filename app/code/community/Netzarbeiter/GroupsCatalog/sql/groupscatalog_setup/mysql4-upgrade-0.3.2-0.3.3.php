<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this Module to newer
 * versions in the future.
 *
 * @category   Netzarbeiter
 * @package    Netzarbeiter_GroupsCatalog
 * @copyright  Copyright (c) 2011 Vinai Kopp http://netzarbeiter.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$this->startSetup();

$this->updateAttribute('catalog_product', 'groupscatalog_hide_group', 'is_configurable', '0');

$this->updateAttribute('catalog_category', 'groupscatalog_hide_group', 'is_configurable', '0');

$this->updateAttribute('catalog_product', 'groupscatalog_hide_group', 'used_in_product_listing', '1');

$this->updateAttribute('catalog_category', 'groupscatalog_hide_group', 'used_in_product_listing', '1');

$this->endSetup();