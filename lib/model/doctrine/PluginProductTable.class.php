<?php

/**
 * PluginProductTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginProductTable extends Doctrine_Table
{
	/**
	 * @return Doctrine_Query
	 */
	public function getOrderByFeaturedProductQuery()
	{
		return $this->createQuery('p')
			->orderBy('p.is_featured DESC');
	}
	
	/**
	 * @return Doctrine_Query
	 */
	public function getFeaturedProductQuery()
	{
		return $this->createQuery('p')
			->where('p.is_featured = ?', true);
	}
	
	/**
	 * @param Doctrine_Query $query
	 * @return Doctrine_Query
	 */
	public function addWithImagesQuery($query = null)
	{
		if($query == null) $query = $this->createQuery('p');
		
		return $query->leftJoin('p.images i')
			->addOrderBy('i.position ASC');
	}
	
	/**
	 * @param int $limit
	 * @return Doctrine_Collection
	 */
	public function getRandomProductsWithLimit($limit)
	{
		$q = $this->createQuery('p');
		
		return $this->addRandomProductsWithLimitQuery($q, $limit)
			->execute();
	}
	
	/**
	 * @param Doctrine_Query $q
	 * @param int $limit
	 * @return Doctrine_Query
	 */
	public function addRandomProductsWithLimitQuery($q, $limit)
	{
		return $q->orderBy('RAND()')
			->limit($limit);
	}
	
 /**
     * @return Doctrine_Query
     */
    public function getSortedProductsQuery()
    {
    	$q = $this->createQuery('p')
    		->where('p.is_available = ?', true)
    		->orderBy('p.id');
    	
    	return $this->addWithImagesQuery($q);
    }
    
    /**
     * @return Doctrine_Query
     */
    public function addFilterByCategoryQuery(Doctrine_Query $q, ProductCategory $category)
    {
    	$q = $this->getSortedProductsQuery()
    		->addWhere('p.category_id = ?', $category->getId());
    		
    	return $q;
    }
}