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

use OCP\AppFramework\App;
use OCP\IContainer;

use OCA\ConverseJs\AppConfig;
use OCA\ConverseJs\Controller\SettingsController;
use OCA\ConverseJs\Controller\PageController;

class Application extends App
{
	public $appConfig;

	public function __construct(array $urlParams = array())
	{
		$appName = 'conversejs';

		parent::__construct($appName, $urlParams);

		$this->appConfig = new AppConfig($appName);

		$container = $this->getContainer();

		/** Controllers */
		$container->registerService("L10N", function ($c) {
			return $c->query("ServerContainer")->getL10N($c->query("AppName"));
		});
		// $container->registerService("RootStorage", function($c)
		//  {
		//      return $c->query("ServerContainer")->getRootFolder();
		//  });
		//  $container->registerService("UserSession", function($c)
		//  {
		//      return $c->query("ServerContainer")->getUserSession();
		//  });
		$container->registerService("Logger", function ($c) {
			return $c->query("ServerContainer")->getLogger();
		});

		$container->registerService("SettingsController", function ($c) {
			return new SettingsController(
				$c->query("AppName"),
				$c->query("Request"),
				$c->query("L10N"),
				$c->query("Logger"),
				$this->appConfig
			);
		});
		$container->registerService("PageController", function ($c) {
			return new PageController(
				$c->query("AppName"),
				$c->query("Request"),
				$c->query("L10N"),
				$c->query("Logger"),
				$this->appConfig
			);
		});
	}
}
