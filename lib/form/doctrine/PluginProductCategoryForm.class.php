<?php

/**
 * PluginProductCategory form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginProductCategoryForm extends BaseProductCategoryForm
{
	public function setup()
	{
		parent::setup();

		$this->useFields(array(
            'id', 'name', 'description'
        ));
	}

    protected function doSave($con = null)
    {
        parent::doSave($con);

        if($this->isNew())
        {
	        $node = $this->object->getNode();
	        $parent = $this->object->getTable()->getTree()->fetchRoot();
	        
	        if($parent)
	        {
	            $method = ($node->isValidNode() ? 'move' : 'insert') . 'AsLastChildOf';
	            $node->$method($parent); //calls $this->object->save internally
	        }
        }
    }
}
