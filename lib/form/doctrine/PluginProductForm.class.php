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
		
		$this->useFields(array('category_id', 'name', 'description', 'price', 'is_available', 'image_name'));
		
		//Category id
		$this->setWidget('category_id', new sfWidgetFormDoctrineChoiceCateogory(array(
			'model'         => $this->getRelatedModelName('category'),
			'table_method'  => 'getAllCategoriesExceptRoot',			
			'add_empty'     => false,
		    'shift_level'   => 1,
		    'strong_levels' => array('1'),
		    'renderer_class' => 'sfWidgetFormSelectCategory'		  
		)));
		
		//Image name
        $this->setWidget('image_name', new ImageUploadWidget(array(
            'folder_name'    => $this->getImageFolder(),
            'file_name'      => $this->getObject()->getImageName(),
            'with_delete'    => false,
            'with_show_link' => true
        )));
        $this->setValidator('image_name', new sfValidatorFile(array(
            'path'       => sfConfig::get('sf_upload_dir').'/'.$this->getImageFolder(),
            'required'   => false,
            'mime_types' => 'web_images'
        )));
	}
	
	
    protected function processUploadedFile($field, $filename = null, $values = null) 
    {
        $filename = parent::processUploadedFile($field, $filename, $values);
        
    	if($field == 'image_name' && $filename)
    	{
            try
            {
                //Original
                //$imgOriginal = new sfImage(sfConfig::get('sf_upload_dir')."/".$this->getImageFolder()."/".$filename);
                //$imgOriginal->resize(990, 467);
                //$imgOriginal->save();
                
                foreach(sfConfig::get('app_ddOnlineStore_images') as $key => $imagesType)
                {
                	$imgThumb = new sfImage(sfConfig::get('sf_upload_dir')."/".$this->getImageFolder()."/".$filename);
                    $imgThumb->thumbnail($imagesType['width'], $imagesType['height'], 'fit', '#FFFFFF');
                    $imgThumb->saveAs(sfConfig::get('sf_upload_dir')."/".$this->getImageFolder()."/".$key."/".$filename);
                }
            }catch(Exception $e)
            {
                throw $e;
            }
    	}
    	
        return $filename;
    }
    
    /**
     * Removes the current file for the field.
     *
     * @param string $field The field name
     */
    protected function removeFile($field)
    {
        parent::removeFile($field);
    	if($field == 'image_name')
    	{
            $directory = $this->validatorSchema[$field]->getOption('path');
            $this->getObject()->deleteAllImages($directory);
        }
    }
}
