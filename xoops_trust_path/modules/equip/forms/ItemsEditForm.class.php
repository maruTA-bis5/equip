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
 * Equip_ItemsEditForm
**/
class Equip_ItemsEditForm extends XCube_ActionForm
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
		return "module.equip.ItemsEditForm.TOKEN";
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
        $this->mFormProperties['items_id'] = new XCube_IntProperty('items_id');
        $this->mFormProperties['name'] = new XCube_StringProperty('name');
        $this->mFormProperties['types_id'] = new XCube_IntProperty('types_id');
        $this->mFormProperties['info'] = new XCube_StringProperty('info');
        $this->mFormProperties['count'] = new XCube_IntProperty('count');
        $this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
       $this->mFieldProperties['items_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['items_id']->setDependsByArray(array('required'));
$this->mFieldProperties['items_id']->addMessage('required', _MD_EQUIP_ERROR_REQUIRED, _MD_EQUIP_LANG_ITEMS_ID);
       $this->mFieldProperties['name'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['name']->setDependsByArray(array('required','maxlength'));
        $this->mFieldProperties['name']->addMessage('required', _MD_EQUIP_ERROR_REQUIRED, _MD_EQUIP_LANG_NAME);
        $this->mFieldProperties['name']->addMessage('maxlength', _MD_EQUIP_ERROR_MAXLENGTH, _MD_EQUIP_LANG_NAME, '255');
        $this->mFieldProperties['name']->addVar('maxlength', '255');
       $this->mFieldProperties['types_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['types_id']->setDependsByArray(array('required'));
$this->mFieldProperties['types_id']->addMessage('required', _MD_EQUIP_ERROR_REQUIRED, _MD_EQUIP_LANG_TYPES_ID);
       $this->mFieldProperties['info'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['info']->setDependsByArray(array('required','maxlength'));
        $this->mFieldProperties['info']->addMessage('required', _MD_EQUIP_ERROR_REQUIRED, _MD_EQUIP_LANG_INFO);
        $this->mFieldProperties['info']->addMessage('maxlength', _MD_EQUIP_ERROR_MAXLENGTH, _MD_EQUIP_LANG_INFO, '255');
        $this->mFieldProperties['info']->addVar('maxlength', '255');
       $this->mFieldProperties['count'] = new XCube_FieldProperty($this);
$this->mFieldProperties['count']->setDependsByArray(array('required'));
$this->mFieldProperties['count']->addMessage('required', _MD_EQUIP_ERROR_REQUIRED, _MD_EQUIP_LANG_COUNT);
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
        $this->set('items_id', $obj->get('items_id'));
        $this->set('name', $obj->get('name'));
        $this->set('types_id', $obj->get('types_id'));
        $this->set('info', $obj->get('info'));
        $this->set('count', $obj->get('count'));
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
        $obj->set('types_id', $this->get('types_id'));
        $obj->set('info', $this->get('info'));
        $obj->set('count', $this->get('count'));
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
