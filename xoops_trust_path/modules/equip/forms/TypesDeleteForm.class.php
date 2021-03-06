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
 * Equip_TypesDeleteForm
**/
class Equip_TypesDeleteForm extends XCube_ActionForm
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
        return "module.equip.TypesDeleteForm.TOKEN";
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
        $this->mFormProperties['types_id'] = new XCube_IntProperty('types_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['types_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['types_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['types_id']->addMessage('required', _MD_EQUIP_ERROR_REQUIRED, _MD_EQUIP_LANG_TYPES_ID);
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
        $this->set('types_id', $obj->get('types_id'));
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
        $obj->set('types_id', $this->get('types_id'));
    }
}

?>
