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
			
		return parent::executeIndex($request);
	}

	public function executeManageTree(sfWebRequest $request)
	{
		$this->category = $this->getRoute()->getObject();
		$this->records = sfJqueryTreeDoctrineManager::getBranch("ProductCategory", $this->category->getId());
	}

	/**
	 * Performs the Ajax request, moves an category to a new position.
	 *
	 * @param sfWebRequest $request
	 */
	public function executeMove(sfWebRequest $request)
	{
		$this->forward404Unless($request->isXmlHttpRequest());
		$id = $this->getRequestParameter('id');
        $destNodeId = $this->getRequestParameter('destNodeId');
        $movetype = $this->getRequestParameter('movetype');
    
        $record = ProductCategoryTable::getInstance()->find($id);
        $destNode = ProductCategoryTable::getInstance()->find($destNodeId);
    
        if($movetype == 'after')
        {
            $record->getNode()->moveAsNextSiblingOf($destNode);
        }
        else if($movetype == 'before')
        {
            $record->getNode()->moveAsPrevSiblingOf($destNode);
        }
        
        $this->json = json_encode($record->toArray());
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $this->setTemplate('json');
	}

}
