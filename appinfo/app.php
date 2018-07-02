<?php
/**
 *
 * @author Pawel Rojek <pawel at pawelrojek.com>
 * @author Ian Reinhart Geiser <igeiser at devonit.com>
 * @author Lucian Last <li@last.nl>
 *
 * This file is licensed under the Affero General Public License version 3 or later.
 *
 **/

namespace OCA\ConverseJs\AppInfo;

use OCP\App;

App::registerAdmin('conversejs', 'settings');
$app = new Application();
