<?php

/**
 * ddOnlineStoreProduct components.
 *
 * @package    ddOnlineStorePlugin
 * @subpackage ddOnlineStoreProduct
 * @author     Diego Damico <songecko@gmail.com>
 */
class ddOnlineStoreProductComponents extends sfComponents
{
	/**
	 * Executes products/list component
	 */
	public function executeProductList()
	{		
		$this->attributes = $this->getVarHolder()->getAll();
		
		$this->pager = new sfDoctrinePager('Product', 8);
		$this->pager->setQuery(isset($this->pagerQuery)?$this->pagerQuery():$this->buildQuery());
		$this->pager->setPage(isset($this->page)?$this->page:1);
		$this->pager->init();
	}
	
	protected function buildQuery()
	{
		$q = ProductTable::getInstance()->getFeaturedProductQuery();
		if($this->getRequest()->hasParameter('category_id'))
		{
			$q->where('p.category_id = ?', $this->getRequest()->getParameter('category_id'));
		}
		
		return $q;
	}
}
