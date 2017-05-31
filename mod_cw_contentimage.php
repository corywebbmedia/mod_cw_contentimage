<?php
/**
 * @copyright   Copyright (C) 2015-2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the helper functions only once
require_once __DIR__ . '/helper.php';

$item = ModCwContentImageHelper::getItem($params);

$image = $item->getImage();
$alt   = htmlspecialchars($item->getAlt());
$title = $item->getTitle();

require JModuleHelper::getLayoutPath('mod_cw_contentimage', $params->get('layout', 'default'));
