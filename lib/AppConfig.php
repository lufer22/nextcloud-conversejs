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
namespace OCA\ConverseJs;

use OCP\IConfig;
use OCP\ILogger;

class AppConfig
{
	private $predefBoshUrl = "https://conversejs.org/http-bind/";
	private $predefL = "auto";

	protected $appName;
	public $config;
	private $logger;

	// The config keys
	private $_boshUrl = "boshUrl";
	private $_l = "l";

	public function __construct($AppName)
	{
		$this->appName = $AppName;
		$this->config = \OC::$server->getConfig();
		$this->logger = \OC::$server->getLogger();
	}

	public function SetBoshUrl($boshUrl)
	{
		$boshUrl = strtolower(rtrim(trim($boshUrl), "/"));
		if (strlen($boshUrl) > 0 && !preg_match("/^https?:\/\//i", $boshUrl)) {
			$boshUrl = "http://" . $boshUrl;
		}
		$this->logger->info("SetBoshUrl: " . $boshUrl, array(
			"app" => $this->appName
		));
		$this->config->setAppValue($this->appName, $this->_boshUrl, $boshUrl);
	}
	public function GetBoshUrl()
	{
		$val = $this->config->getAppValue($this->appName, $this->_boshUrl);
		if (empty($val)) {
			$val = $this->predefBoshUrl;
		}
		return $val;
	}

	public function SetL($l)
	{
		$this->logger->info("SetL: " . $l, array("app" => $this->appName));
		$this->config->setAppValue($this->appName, $this->_l, $l);
	}
	public function GetL()
	{
		$val = $this->config->getAppValue($this->appName, $this->_l);
		if (empty($val)) {
			$val = $this->predefL;
		}
		return $val;
	}
}
