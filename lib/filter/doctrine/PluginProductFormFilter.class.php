<?php

/**
 * PluginProduct form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginProductFormFilter extends BaseProductFormFilter
{
    public function setup() 
    {
        parent::setup();
        
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
