<?php
/**
 * ImageUploadWidget represents an upload HTML input tag with the possibility
 * to upload a image file.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Diego Damico <songecko@gmail.com>
 */
class ImageUploadWidget extends sfWidgetFormInputFileEditable {

    /**
     * Constructor.
     *
     * Available options:
     *
     *  * folder_name: The folder name where the image will be uploaded
     *  * file_name:    The filename of flv video
     *  * partial_url:  Url to get a partial where as placed the link to show video using javascript popup
     *
     * @param array $options     An array of options
     * @param array $attributes  An array of default HTML attributes
     *
     * @see sfWidgetFormInputFile
     */
    protected function configure($options = array(), $attributes = array())
    {       
        parent::configure($options, $attributes);
        
        $this->addRequiredOption('folder_name');
        $this->addRequiredOption('file_name');
        $this->addOption('with_show_link', true);
        $this->setOption('with_show_link', isset($options['with_show_link'])?$options['with_show_link']&&$options['file_name']:false);
        
        $this->setOption('is_image', true);
        $this->setOption('edit_mode', true);
        $this->setOption('file_src', '/uploads/'.$options['folder_name'].'/'.$options['file_name']);
        $this->setOption('template', $this->getTemplate($this->getOption('file_src')));
    }

    public function getTemplate($fileSrc)
    {
        $output = '<div class="upload_file">%input%';
        if($this->getOption('with_show_link'))
        {
            $output .= '<a href="'.sfContext::getInstance()->getRequest()->getRelativeUrlRoot().$fileSrc.'" class="image_preview" target="_blank">Ver imagen</a>';
        }
        $output .= '</div>';
        
        if($this->getOption('with_delete'))
        {
            $output .= '<div class="image_delete">%delete% %delete_label% </div>';
        }
        $output .= '
        <script type="text/javascript">
            $(document).ready(function(){
                $(".image_preview").colorbox();
            });
        </script>
        ';

        return $output;
    }

}