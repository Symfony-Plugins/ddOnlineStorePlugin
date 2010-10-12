<?php

/**
 * PluginProductImage form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginProductImageForm extends BaseProductImageForm
{
	public function setup()
	{
		parent::setup();
		
		unset($this['position']);
		$user = sfContext::getInstance()->getUser();
	
		//Product id
		$filters = $user->getAttribute('ddOnlineStoreAdminProductImage.filters', array(), 'admin_module');
		if(isset($filters['product_id']))
		{
			$this->setDefault('product_id', $filters['product_id']);
		}
		
		//Image file
		$this->getObject()->configureJCropWidgets($this);
  		$this->getObject()->configureJCropValidators($this);
	}
}
