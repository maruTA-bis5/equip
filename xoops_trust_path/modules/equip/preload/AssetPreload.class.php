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

if(!defined('EQUIP_TRUST_PATH'))
{
    define('EQUIP_TRUST_PATH',XOOPS_TRUST_PATH . '/modules/equip');
}

require_once EQUIP_TRUST_PATH . '/class/EquipUtils.class.php';
//{{require::Enum}}
/**
 * Equip_AssetPreloadBase
**/
class Equip_AssetPreloadBase extends XCube_ActionFilter
{
    public $mDirname = null;

    /**
     * prepare
     * 
     * @param   string  $dirname
     * 
     * @return  void
    **/
    public static function prepare(/*** string ***/ $dirname)
    {
        static $setupCompleted = false;
        if(!$setupCompleted)
        {
            $setupCompleted = self::_setup($dirname);
        }
    }

    /**
     * _setup
     * 
     * @param   void
     * 
     * @return  bool
    **/
    public static function _setup(/*** string ***/ $dirname)
    {
        $root =& XCube_Root::getSingleton();
        $instance = new self($root->mController);
        $instance->mDirname = $dirname;
        $root->mController->addActionFilter($instance);
        return true;
    }

    /**
     * preBlockFilter
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function preBlockFilter()
    {
        $file = EQUIP_TRUST_PATH . '/class/callback/DelegateFunctions.class.php';
        $this->mRoot->mDelegateManager->add('Module.equip.Global.Event.GetAssetManager','Equip_AssetPreloadBase::getManager');
        $this->mRoot->mDelegateManager->add('Legacy_Utils.CreateModule','Equip_AssetPreloadBase::getModule');
        $this->mRoot->mDelegateManager->add('Legacy_Utils.CreateBlockProcedure','Equip_AssetPreloadBase::getBlock');
        $this->mRoot->mDelegateManager->add('Module.'.$this->mDirname.'.Global.Event.GetNormalUri','Equip_CoolUriDelegate::getNormalUri', $file);
  }

    /**
     * getManager
     * 
     * @param   Equip_AssetManager  &$obj
     * @param   string  $dirname
     * 
     * @return  void
    **/
    public static function getManager(/*** Equip_AssetManager ***/ &$obj,/*** string ***/ $dirname)
    {
        require_once EQUIP_TRUST_PATH . '/class/AssetManager.class.php';
        $obj = Equip_AssetManager::getInstance($dirname);
    }

    /**
     * getModule
     * 
     * @param   Legacy_AbstractModule  &$obj
     * @param   XoopsModule  $module
     * 
     * @return  void
    **/
    public static function getModule(/*** Legacy_AbstractModule ***/ &$obj,/*** XoopsModule ***/ $module)
    {
        if($module->getInfo('trust_dirname') == 'equip')
        {
            require_once EQUIP_TRUST_PATH . '/class/Module.class.php';
            $obj = new Equip_Module($module);
        }
    }

    /**
     * getBlock
     * 
     * @param   Legacy_AbstractBlockProcedure  &$obj
     * @param   XoopsBlock  $block
     * 
     * @return  void
    **/
    public static function getBlock(/*** Legacy_AbstractBlockProcedure ***/ &$obj,/*** XoopsBlock ***/ $block)
    {
        $moduleHandler =& Equip_Utils::getXoopsHandler('module');
        $module =& $moduleHandler->get($block->get('mid'));
        if(is_object($module) && $module->getInfo('trust_dirname') == 'equip')
        {
            require_once EQUIP_TRUST_PATH . '/blocks/' . $block->get('func_file');
            $className = 'Equip_' . substr($block->get('show_func'), 4);
            $obj = new $className($block);
        }
    }
}

?>
