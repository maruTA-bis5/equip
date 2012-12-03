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
 * Equip_TypesEditForm
**/
class Equip_TypesEditForm extends XCube_ActionForm
{
	/**
	 * getTokenName
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getTokenName()
	{
		return "module.equip.TypesEditForm.TOKEN";
	}

	/**
	 * prepare
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function prepare()
	{
		//
		// Set form properties
		//
        $this->mFormProperties['types_id'] = new XCube_IntProperty('types_id');
        $this->mFormProperties['name'] = new XCube_StringProperty('name');
        $this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
       $this->mFieldProperties['types_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['types_id']->setDependsByArray(array('required'));
$this->mFieldProperties['types_id']->addMessage('required', _MD_EQUIP_ERROR_REQUIRED, _MD_EQUIP_LANG_TYPES_ID);
       $this->mFieldProperties['name'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['name']->setDependsByArray(array('required','maxlength'));
        $this->mFieldProperties['name']->addMessage('required', _MD_EQUIP_ERROR_REQUIRED, _MD_EQUIP_LANG_NAME);
        $this->mFieldProperties['name']->addMessage('maxlength', _MD_EQUIP_ERROR_MAXLENGTH, _MD_EQUIP_LANG_NAME, '255');
        $this->mFieldProperties['name']->addVar('maxlength', '255');
        $this->mFieldProperties['posttime'] = new XCube_FieldProperty($this);
	}

	/**
	 * load
	 * 
	 * @param	XoopsSimpleObject  &$obj
	 * 
	 * @return	void
	**/
	public function load(/*** XoopsSimpleObject ***/ &$obj)
	{
        $this->set('types_id', $obj->get('types_id'));
        $this->set('name', $obj->get('name'));
        $this->set('posttime', $obj->get('posttime'));
	}

	/**
	 * update
	 * 
	 * @param	XoopsSimpleObject  &$obj
	 * 
	 * @return	void
	**/
	public function update(/*** XoopsSimpleObject ***/ &$obj)
	{
        $obj->set('name', $this->get('name'));
	}

	/**
	 * _makeDateString
	 *
	 * @param	string	$key
	 * @param	XoopsSimpleObject	$obj
	 *
	 * @return	string
	 **/
	protected function _makeDateString($key, $obj)
	{
		return $obj->get($key) ? date(_PHPDATEPICKSTRING, $obj->get($key)) : '';
	}

	/**
	 * _makeUnixtime
	 * 
	 * @param	string	$key
	 * 
	 * @return	unixtime
	**/
	protected function _makeUnixtime($key)
	{
		if(! $this->get($key)){
			return 0;
		}
		$timeArray = explode('-', $this->get($key));
		return mktime(0, 0, 0, $timeArray[1], $timeArray[2], $timeArray[0]);
	}
}

?>
