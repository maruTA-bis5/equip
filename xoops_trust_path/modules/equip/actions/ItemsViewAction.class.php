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

require_once EQUIP_TRUST_PATH . '/class/AbstractViewAction.class.php';
require_once EQUIP_TRUST_PATH . '/actions/TypesListAction.class.php';

/**
 * Equip_ItemsViewAction
**/
class Equip_ItemsViewAction extends Equip_AbstractViewAction
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
	 * executeViewSuccess
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewSuccess(/*** XCube_RenderTarget ***/ &$render)
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
		$render->setTemplateName($this->mAsset->mDirname . '_items_view.html');
		$render->setAttribute('object', $this->mObject);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('dataname', self::DATANAME);
	}
}

?>
