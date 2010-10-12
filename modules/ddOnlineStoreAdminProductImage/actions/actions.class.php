<?php

require_once dirname(__FILE__).'/../lib/ddOnlineStoreAdminProductImageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ddOnlineStoreAdminProductImageGeneratorHelper.class.php';

/**
 * online_store_admin_product_image actions.
 *
 * @package    ddOnlineStorePlugin
 * @subpackage online_store_admin_product_image
 * @author     Diego Damico
 */
class ddOnlineStoreAdminProductImageActions extends autoDdOnlineStoreAdminProductImageActions
{
	public function executeSetProductFilter(sfWebRequest $request)
	{
		if($request->hasParameter('product_id'))
		{
			$this->setFilters(array('product_id' => $request->getParameter('product_id')));
		}

		$this->redirect('@online_store_admin_product_image');
	}
	
	/**
	 * Moves an item up in the list.
	 *
	 * @param sfWebRequest $request
	 */
	public function executeMoveUp(sfWebRequest $request)
	{
		$this->item = $this->getRoute()->getObject();
		$this->item->promote();

		$this->redirect($this->getModuleName());
	}

	/**
	 * Moves an item down in the list.
	 *
	 * @param sfWebRequest $request
	 */
	public function executeMoveDown(sfWebRequest $request)
	{
		$this->item = $this->getRoute()->getObject();
		$this->item->demote();

		$this->redirect($this->getModuleName());
	}
}
