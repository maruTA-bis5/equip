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

/**
 * Equip_AbstractEditAction
**/
abstract class Equip_AbstractEditAction extends Equip_AbstractAction
{
    public /*** XoopsSimpleObject ***/ $mObject = null;

    public /*** XoopsObjectGenericHandler ***/ $mObjectHandler = null;

    public /*** XCube_ActionForm ***/ $mActionForm = null;

    /**
     * _getId
     * 
     * @param   void
     * 
     * @return  int
     * 
     * TODO: factory生成コードではIDが取得できなかったのはなぜ？
    **/
    protected function _getId()
    {
        //$req = $this->mRoot->mContext->mRequest;
        //$dataId = $req->getRequest(_REQUESTED_DATA_ID);
        $dataId = isset($_GET['_id']) ? $_GET['_id'] : null;
        $dataId = ($dataId==null) ? (isset($_POST['items_id']) ? $_POST['items_id'] : $_POST['types_id']) : $dataId;
        return isset($dataId) ? intval($dataId) : 0;//intval($req->getRequest($this->_getHandler()->mPrimary));
    }

    /**
     * _setupActionForm
     * 
     * @param   void
     * 
     * @return  void
    **/
    protected function _setupActionForm()
    {
        $this->mActionForm =& $this->mAsset->getObject('form', $this->_getConst('DATANAME'), false, $this->_getActionName());
        $this->mActionForm->prepare();
    }

    /**
     * _getActionTitle
     * 
     * @param   void
     * 
     * @return  string
    **/
    protected function _getActionTitle()
    {
        return _EDIT;
    }

    /**
     * _getActionName
     * 
     * @param   void
     * 
     * @return  string
    **/
    protected function _getActionName()
    {
        return 'edit';
    }

    /**
     * _setupObject
     * 
     * @param   void
     * 
     * @return  void
    **/
    protected function _setupObject()
    {
        $id = $this->_getId();
    
        $this->mObjectHandler =& $this->_getHandler();
    
        $this->mObject =& $this->mObjectHandler->get($id);
    
        if($this->mObject == null && $this->_isEnableCreate())
        {
            $this->mObject =& $this->mObjectHandler->create();
        }
    }

    /**
     * _isEnableCreate
     * 
     * @param   void
     * 
     * @return  bool
    **/
    protected function _isEnableCreate()
    {
        return true;
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
        $this->_setupObject();
        $this->_setupActionForm();
    
        return true;
    }

    /**
     * getDefaultView
     * 
     * @param   void
     * 
     * @return  Enum
    **/
    public function getDefaultView()
    {
        if($this->mObject == null)
        {
            return EQUIP_FRAME_VIEW_ERROR;
        }
    
        $this->mActionForm->load($this->mObject);
    
        return EQUIP_FRAME_VIEW_INPUT;
    }

    /**
     * execute
     * 
     * @param   void
     * 
     * @return  Enum
    **/
    public function execute()
    {
        if ($this->mObject == null)
        {
            return EQUIP_FRAME_VIEW_ERROR;
        }
    
        if ($this->mRoot->mContext->mRequest->getRequest('_form_control_cancel') != null)
        {
            return EQUIP_FRAME_VIEW_CANCEL;
        }
    
        $this->mActionForm->load($this->mObject);
    
        $this->mActionForm->fetch();
        $this->mActionForm->validate();
    
        if ($this->mActionForm->hasError())
        {
            return EQUIP_FRAME_VIEW_INPUT;
        }
    
        $this->mActionForm->update($this->mObject);
    
        return $this->_doExecute();
    }

    /**
     * _doExecute
     * 
     * @param   void
     * 
     * @return  Enum
    **/
    protected function _doExecute()
    {
        if($this->mObjectHandler->insert($this->mObject))
        {
            return EQUIP_FRAME_VIEW_SUCCESS;
        }
    
        return EQUIP_FRAME_VIEW_ERROR;
    }

    /**
     * executeViewSuccess
     * 
     * @param   XCube_RenderTarget  &$render
     * 
     * @return  void
    **/
    public function executeViewSuccess(/*** XCube_RenderTarget ***/ &$render)
    {
        $this->mRoot->mController->executeForward($this->_getNextUri($this->_getConst('DATANAME')));
    }

    /**
     * executeViewError
     * 
     * @param   XCube_RenderTarget  &$render
     * 
     * @return  void
    **/
    public function executeViewError(/*** XCube_RenderTarget ***/ &$render)
    {
        $this->mRoot->mController->executeRedirect($this->_getNextUri($this->_getConst('DATANAME')), 1, _MD_EQUIP_ERROR_DBUPDATE_FAILED);
    }

    /**
     * executeViewCancel
     * 
     * @param   XCube_RenderTarget  &$render
     * 
     * @return  void
    **/
    public function executeViewCancel(/*** XCube_RenderTarget ***/ &$render)
    {
        $this->mRoot->mController->executeForward($this->_getNextUri($this->_getConst('DATANAME')));
    }
}

?>
