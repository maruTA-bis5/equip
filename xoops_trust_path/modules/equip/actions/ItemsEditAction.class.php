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

require_once EQUIP_TRUST_PATH . '/class/AbstractEditAction.class.php';
require_once EQUIP_TRUST_PATH . '/actions/TypesListAction.class.php';

/**
 * Equip_ItemsEditAction
**/
class Equip_ItemsEditAction extends Equip_AbstractEditAction
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
     * @param   void
     * 
     * @return  bool
    **/
    public function prepare()
    {
        parent::prepare();
        if($this->mObject->isNew()){

        }
     return true;
    }

    /**
     * executeViewInput
     * 
     * @param   XCube_RenderTarget  &$render
     * 
     * @return  void
    **/
    public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
    {
        $tact = new Equip_TypesListAction;
        $tact->execute();
        $types = $tact->mObjects;
        $typelist = array();
        foreach ($types as $type) {
            $obj = new XoopsSimpleObject;
            $obj->initVar('name', XOBJ_DTYPE_STRING, $type->get('name'));
            $obj->initVar('value', XOBJ_DTYPE_INT, $type->get('types_id'));
            $typelist[$type->get('types_id')] = $obj;
        }
        $render->setTemplateName($this->mAsset->mDirname . '_items_edit.html');
        $render->setAttribute('actionForm', $this->mActionForm);
        $render->setAttribute('object', $this->mObject);
        $render->setAttribute('typelist', $typelist);
        $render->setAttribute('type_default', $this->mObject->get('types_id'));
        $render->setAttribute('dirname', $this->mAsset->mDirname);
        $render->setAttribute('dataname', self::DATANAME);

  }

}
?>
