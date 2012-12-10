<?php
/**
 * @file
 * @package equip
**/

if (!defined('XOOPS_ROOT_PATH'))
{
    exit();
}

require_once EQUIP_TRUST_PATH . '/class/AbstractAction.class.php';
require_once EQUIP_TRUST_PATH . '/actions/ItemsListAction.class.php';
require_once EQUIP_TRUST_PATH . '/class/AssetManager.class.php';

/**
 * Equip_StatusBlock
**/
class Equip_StatusBlock extends Legacy_BlockProcedure {

    public function __construct(&$block) {
        parent::Legacy_BlockProcedure($block);
    }
    public $mObjects = null;
    protected $mListAction = null;
    /**
     * prepare
     *
     * @param void
     *
     * @return bool
     *
     * @public
    **/
    public function prepare() {
        return parent::prepare();
    }

    /**
     * execute
     *
     * @param void
     *
     * @return void
     *
     * @public
    **/
    public function execute() {
        $root = XCube_Root::getSingleton();
        $render =& $this->getRenderTarget();
        $render->setTemplateName($this->_mBlock->get('template'));
        $act = new Equip_ItemsListAction;$act->mAsset = new Equip_AssetManager('equip');
        $act->execute();
        $this->mObjects = $act->mObjects;

        $warn = array(); $emp = array();
        foreach ($this->mObjects as $obj) {
            if ($obj->get('count') == 0) {
                $emp[] = $obj;
            } else if ($obj->get('count') <= 3) {
                $warn[] = $obj;
            }
        }
        $render->setAttribute('warn', $warn);
        $render->setAttribute('emp', $emp);
        $renderSystem = $root->getRenderSystem($this->getRenderSystemName());
        $renderSystem->renderBlock($render);
    }
}

