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

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

/**
 * Equip_ItemsDeleteForm
**/
class Equip_ItemsDeleteForm extends XCube_ActionForm
{
    /**
     * getTokenName
     * 
     * @param   void
     * 
     * @return  string
    **/
    public function getTokenName()
    {
        return "module.equip.ItemsDeleteForm.TOKEN";
    }

    /**
     * prepare
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function prepare()
    {
        //
        // Set form properties
        //
        $this->mFormProperties['items_id'] = new XCube_IntProperty('items_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['items_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['items_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['items_id']->addMessage('required', _MD_EQUIP_ERROR_REQUIRED, _MD_EQUIP_LANG_ITEMS_ID);
    }

    /**
     * load
     * 
     * @param   XoopsSimpleObject  &$obj
     * 
     * @return  void
    **/
    public function load(/*** XoopsSimpleObject ***/ &$obj)
    {
        $this->set('items_id', $obj->get('items_id'));
    }

    /**
     * update
     * 
     * @param   XoopsSimpleObject  &$obj
     * 
     * @return  void
    **/
    public function update(/*** XoopsSimpleObject ***/ &$obj)
    {
        $obj->set('items_id', $this->get('items_id'));
    }
}

?>
