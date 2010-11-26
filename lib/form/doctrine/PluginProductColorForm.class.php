<?php

/**
 * PluginProductColor form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginProductColorForm extends BaseProductColorForm
{
	public function setup()
	{
		parent::setup();
		
		//unset($this['position']);
		$user = sfContext::getInstance()->getUser();
	
		//Product id
		$filters = $user->getAttribute('ddOnlineStoreAdminProductColor.filters', array(), 'admin_module');
		if(isset($filters['product_id']))
		{
			$this->setDefault('product_id', $filters['product_id']);
		}
		
		//Color
		$this->widgetSchema['color'] = new ddWidgetFormColorPicker();
		$this->validatorSchema['color'] = new ddValidatorColorPicker();
		
	}
}
