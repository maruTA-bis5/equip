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

require_once XOOPS_TRUST_PATH . '/modules/equip/preload/AssetPreload.class.php';
Equip_AssetPreloadBase::prepare(basename(dirname(dirname(__FILE__))));

?>
