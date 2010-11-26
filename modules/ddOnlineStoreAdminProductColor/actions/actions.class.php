<?php

require_once dirname(__FILE__).'/../lib/ddOnlineStoreAdminProductColorGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ddOnlineStoreAdminProductColorGeneratorHelper.class.php';

/**
 * online_store_admin_product_color actions.
 *
 * @package    ddOnlineStorePlugin
 * @subpackage online_store_admin_product_color
 * @author     Diego Damico
 */
class ddOnlineStoreAdminProductColorActions extends autoDdOnlineStoreAdminProductColorActions
{
	public function executeSetProductFilter(sfWebRequest $request)
	{
		if($request->hasParameter('product_id'))
		{
			$this->setFilters(array('product_id' => $request->getParameter('product_id')));
		}

		$this->redirect('@online_store_admin_product_color');
	}
	
	/**
	 * Moves an item up in the list.
	 *
	 * @param sfWebRequest $request
	 */
	/*public function executeMoveUp(sfWebRequest $request)
	{
		$this->item = $this->getRoute()->getObject();
		$this->item->promote();

		$this->redirect('@online_store_admin_product_color');
	}*/

	/**
	 * Moves an item down in the list.
	 *
	 * @param sfWebRequest $request
	 */
	/*public function executeMoveDown(sfWebRequest $request)
	{
		$this->item = $this->getRoute()->getObject();
		$this->item->demote();

		$this->redirect('@online_store_admin_product_color');
	}*/
}
