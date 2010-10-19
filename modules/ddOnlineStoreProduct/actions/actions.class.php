<?php

/**
 * ddOnlineStoreProduct actions.
 *
 * @package    ddOnlineStorePlugin
 * @subpackage ddOnlineStoreProduct
 * @author     Diego Damico <songecko@gmail.com>
 */
class ddOnlineStoreProductActions extends sfActions
{	
	public function executeIndex(sfWebRequest $request)
	{
		// sorting
		if($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
		{
			$this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
		}

		// pager
		if($request->getParameter('page'))
		{
			$this->setPage($request->getParameter('page'));
		}

		$this->pager = $this->getPager();
		$this->sort = $this->getSort();
		
		$this->attributes = array('includeSort' => true, 'route_name' => 'localized_homepage');
	}

	public function executeFilter(sfWebRequest $request)
	{
		$this->setPage(1);

		if ($request->hasParameter('_reset'))
		{
			$this->setFilters(array());

			$this->redirect('@online_store_admin_product');
		}

		$this->filters = $this->configuration->getFilterForm($this->getFilters());
		$this->filters->bind($request->getParameter($this->filters->getName()));
		if ($this->filters->isValid())
		{
			$this->setFilters($this->filters->getValues());
			$this->redirect('@online_store_admin_product');
		}

		$this->pager = $this->getPager();
		$this->sort = $this->getSort();

		$this->setTemplate('index');
	}
  
	protected function getFilters()
	{
		return $this->getUser()->getAttribute('ddOnlineStoreProduct.filters', array(), 'product_module');
	}

	protected function setFilters(array $filters)
	{
		return $this->getUser()->setAttribute('ddOnlineStoreProduct.filters', $filters, 'product_module');
	}

	protected function getPager()
	{
		$pager = new sfDoctrinePager('Product', 8);
		$pager->setQuery($this->buildQuery());
		$pager->setPage($this->getPage());
		$pager->init();

		return $pager;
	}
  
	protected function setPage($page)
	{
		$this->getUser()->setAttribute('ddOnlineStoreProduct.page', $page, 'product_module');
	}

	protected function getPage()
	{
		return $this->getUser()->getAttribute('ddOnlineStoreProduct.page', 1, 'product_module');
	}

	/**
	 * @return Doctrine_Query
	 */
	protected function buildQuery()
	{
		//Filters
		if (null === $this->filters)
		{
			$this->filters = new ProductFormFilter($this->getFilters(), array());
		}
		
		$this->filters->setTableMethod('');
		$query = $this->filters->buildQuery($this->getFilters());

		
		//Sort
		$this->addSortQuery($query);

		return $query;
	}

	protected function addSortQuery($query)
	{
		if (array(null, null) == ($sort = $this->getSort()))
		{
			return;
		}

		if (!in_array(strtolower($sort[1]), array('asc', 'desc')))
		{
			$sort[1] = 'asc';
		}

		$query->addOrderBy($sort[0] . ' ' . $sort[1]);
	}
  
	protected function getSort()
	{
		if (null !== $sort = $this->getUser()->getAttribute('ddOnlineStoreProduct.sort', null, 'product_module'))
		{
			return $sort;
		}

		$this->setSort(array('is_featured', 'desc'));

		return $this->getUser()->getAttribute('ddOnlineStoreProduct.sort', null, 'product_module');
	}

	protected function setSort(array $sort)
	{
		if (null !== $sort[0] && null === $sort[1])
		{
			$sort[1] = 'asc';
		}

		$this->getUser()->setAttribute('ddOnlineStoreProduct.sort', $sort, 'product_module');
	}
	
	protected function isValidSortColumn($column)
	{
		return ProductTable::getInstance()->hasColumn($column);
	}
}
