<?php

/**
 * PluginProductCategory
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginProductCategory extends BaseProductCategory
{
	public function getParentId()
	{
		if (!$this->getNode()->isValidNode() || $this->getNode()->isRoot())
		{
			return null;
		}

		$parent = $this->getNode()->getParent();

		return $parent['id'];
	}
	
	/**
	 * @param Boolean $deepSearch
	 * @param Boolean $randomized
	 * @param int $limit
	 */
	public function getAvailableProducts($deepSearch = false, $randomized = false, $limit = false)
	{
		$q = ProductTable::getInstance()->getProductsInCategoryQuery($this, $deepSearch, $randomized, $limit);
		
		return $q->execute();
	}
}