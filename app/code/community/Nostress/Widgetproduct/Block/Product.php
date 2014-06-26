<?php
/** 
 * Magento Module developed by NoStress Commerce 
 * 
 * NOTICE OF LICENSE 
 * 
 * This source file is subject to the Open Software License (OSL 3.0) 
 * that is bundled with this package in the file LICENSE.txt. 
 * It is also available through the world-wide-web at this URL: 
 * http://opensource.org/licenses/osl-3.0.php 
 * If you did of the license and are unable to 
 * obtain it through the world-wide-web, please send an email 
 * to info@nostresscommerce.cz so we can send you a copy immediately. 
 * 
 * @copyright Copyright (c) 2012 NoStress Commerce (http://www.nostresscommerce.cz) 
 * 
 */
/**
 * 
 * Enter description here ...
 * @author xyz
 *
 */
class Nostress_Widgetproduct_Block_Product 
	extends Mage_Catalog_Block_Product implements Mage_Widget_Block_Interface 
{
	private function _prepareCollection() {
		
		if( empty( $this->collection ) ) 
		{
			$this->collection = Mage::getResourceModel('catalog/product_collection')
				->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
				->addMinimalPrice()
				->addFinalPrice()
				->addTaxPercents()
				->addUrlRewrite();
		}
		
		return $this->collection;
	}
	
	public function getProduct(){
		
		if(empty($this->product)){
			$this->_prepareCollection()
				->getSelect()
				->where('sku=?', $this->getSku())
				->limit(1);
			
			$this->product = $collection->getFirstItem();	
		}
		
		return $this->product;
	}
	
	
}
