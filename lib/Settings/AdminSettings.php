<?php
/**
 *
 * @author Pawel Rojek <pawel at pawelrojek.com>
 * @author Ian Reinhart Geiser <igeiser at devonit.com>
 * @author Lucian Last <li@last.nl>
 *
 * This file is licensed under the Affero General Public License version 3 or later.
 *
 */

namespace OCA\ConverseJs\Settings;

use OCP\Settings\ISettings;

use OCA\ConverseJs\AppInfo\Application;

class AdminSettings implements ISettings {

    public function __construct()
    {
    }

    public function getForm()
    {
        $app = new Application();
        $container = $app->getContainer();
        $response = $container->query("\OCA\ConverseJs\Controller\SettingsController")->index();
        return $response;
    }
    public function getSection()
    {
        return "server";
    }
    public function getPriority()
    {
        return 10;
    }
}
