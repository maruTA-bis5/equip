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

require_once EQUIP_TRUST_PATH . '/class/AbstractDeleteAction.class.php';
require_once EQUIP_TRUST_PATH . '/actions/TypesListAction.class.php';

/**
 * Equip_ItemsDeleteAction
**/
class Equip_ItemsDeleteAction extends Equip_AbstractDeleteAction
{
	const DATANAME = 'items';



	/**
	 * hasPermission
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public function hasPermission()
	{
		return $this->mRoot->mContext->mUser->isInRole('Site.RegisteredUser') ? true : false;
	}

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
	 * executeViewInput
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
	{
        $types = new Equip_TypesListAction;
        $types->execute();
        $tobj = $types->mObjects;
        $tid = $this->mObject->get('types_id');
        foreach ($tobj as $obj) {
            if ($obj->get('types_id') == $tid) {
                $render->setAttribute('typename', $obj->get('name'));
                break;
            }
        }
		$render->setTemplateName($this->mAsset->mDirname . '_items_delete.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
	}
}

?>
