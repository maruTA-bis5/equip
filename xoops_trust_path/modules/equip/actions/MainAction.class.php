<?php
/**
 * @file
 * @package equip
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
	exit;
}

require_once EQUIP_TRUST_PATH . '/class/AbstractListAction.class.php';
require_once EQUIP_TRUST_PATH . '/actions/TypesListAction.class.php';

/**
 * Equip_MainAction
**/
class Equip_MainAction extends Equip_AbstractListAction
{
	const DATANAME = 'items';


	/**
	 * prepare
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public function prepare()
	{
		parent::prepare();

		return true;
	}

	/**
	 * executeViewIndex
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewIndex(/*** XCube_RenderTarget ***/ &$render)
	{
        $types = new Equip_TypesListAction;
        $types->execute();
		$render->setTemplateName($this->mAsset->mDirname . '_main.html');
		$render->setAttribute('objects', $this->mObjects);
        $render->setAttribute('tobjects', $types->mObjects);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('dataname', self::DATANAME);
		$render->setAttribute('pageNavi', $this->mFilter->mNavi);
	}
}

