<?php

/**
 * PluginProductCategoryTable
 */
class PluginProductCategoryTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PluginProductCategoryTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginProductCategory');
    }
}