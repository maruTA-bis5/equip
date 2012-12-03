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

require_once EQUIP_TRUST_PATH . '/class/AbstractFilterForm.class.php';

define('EQUIP_ITEMS_SORT_KEY_ITEMS_ID', 1);
define('EQUIP_ITEMS_SORT_KEY_NAME', 2);
define('EQUIP_ITEMS_SORT_KEY_TYPES_ID', 3);
define('EQUIP_ITEMS_SORT_KEY_INFO', 4);
define('EQUIP_ITEMS_SORT_KEY_COUNT', 5);
define('EQUIP_ITEMS_SORT_KEY_POSTTIME', 6);

define('EQUIP_ITEMS_SORT_KEY_DEFAULT', EQUIP_ITEMS_SORT_KEY_ITEMS_ID);

/**
 * Equip_ItemsFilterForm
**/
class Equip_ItemsFilterForm extends Equip_AbstractFilterForm
{
    public /*** string[] ***/ $mSortKeys = array(
 	   EQUIP_ITEMS_SORT_KEY_ITEMS_ID => 'items_id',
 	   EQUIP_ITEMS_SORT_KEY_NAME => 'name',
 	   EQUIP_ITEMS_SORT_KEY_TYPES_ID => 'types_id',
 	   EQUIP_ITEMS_SORT_KEY_INFO => 'info',
 	   EQUIP_ITEMS_SORT_KEY_COUNT => 'count',
 	   EQUIP_ITEMS_SORT_KEY_POSTTIME => 'posttime',

    );

    /**
     * getDefaultSortKey
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function getDefaultSortKey()
    {
        return EQUIP_ITEMS_SORT_KEY_DEFAULT;
    }

    /**
     * fetch
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function fetch()
    {
        parent::fetch();
    
        $root =& XCube_Root::getSingleton();
    
		if (($value = $root->mContext->mRequest->getRequest('items_id')) !== null) {
			$this->mNavi->addExtra('items_id', $value);
			$this->_mCriteria->add(new Criteria('items_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('name')) !== null) {
			$this->mNavi->addExtra('name', $value);
			$this->_mCriteria->add(new Criteria('name', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('types_id')) !== null) {
			$this->mNavi->addExtra('types_id', $value);
			$this->_mCriteria->add(new Criteria('types_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('info')) !== null) {
			$this->mNavi->addExtra('info', $value);
			$this->_mCriteria->add(new Criteria('info', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('count')) !== null) {
			$this->mNavi->addExtra('count', $value);
			$this->_mCriteria->add(new Criteria('count', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('posttime')) !== null) {
			$this->mNavi->addExtra('posttime', $value);
			$this->_mCriteria->add(new Criteria('posttime', $value));
		}

    
        $this->_mCriteria->addSort($this->getSort(), $this->getOrder());
    }
}

?>
