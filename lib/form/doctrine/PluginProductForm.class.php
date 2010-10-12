<?php

/**
 * PluginProduct form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginProductForm extends BaseProductForm
{
	public function getImageFolder()
	{
		return 'products';
	}
	
	public function setup() 
	{
		parent::setup();
		
		$this->useFields(array('category_id', 'name', 'subname', 'description', 'specifications', 'price', 'is_available', 'is_featured'));
		
		//Category id
		$this->setWidget('category_id', new sfWidgetFormDoctrineChoiceCateogory(array(
			'model'         => $this->getRelatedModelName('category'),
			'table_method'  => 'getAllCategoriesExceptRoot',			
			'add_empty'     => false,
		    'shift_level'   => 1,
		    'strong_levels' => array('1'),
		    'renderer_class' => 'sfWidgetFormSelectCategory'		  
		)));
	}
}
