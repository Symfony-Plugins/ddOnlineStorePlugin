<?php

require_once dirname(__FILE__).'/../lib/ddOnlineStoreAdminCategoryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ddOnlineStoreAdminCategoryGeneratorHelper.class.php';

/**
 * online_store_admin_category actions.
 *
 * @package    phwintel
 * @subpackage online_store_admin_category
 * @author     Diego Damico
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ddOnlineStoreAdminCategoryActions extends autoDdOnlineStoreAdminCategoryActions
{
	public function executeIndex(sfWebRequest $request)
	{
		if(!ProductCategoryTable::getInstance()->isTree())
		{
			throw new Exception('Model "'.$this->model.'" is not a NestedSet');
		}

		if(!sfJqueryTreeDoctrineManager::modelHasManyRoots('ProductCategory'))
		{
			$this->redirect($this->generateUrl('online_store_admin_category_manage_tree', array('root' => '1')));
		}
			
		return parent::executeIndex($request);
		
		//$this->records = $this->getTree($this->model, $request->getParameter('root'));
	}
}
