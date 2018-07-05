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

namespace OCA\ConverseJs\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IL10N;
use OCP\ILogger;
use OCP\IRequest;

use OCA\ConverseJs\AppConfig;

class SettingsController extends Controller
{
	protected $appName;
	private $l;
	private $logger;
	private $config;
	/**
	 * @param string $AppName - application name
	 * @param IRequest $request - request object
	 * @param IL10N $l - l10n service
	 * @param ILogger $logger - logger
	 * @param OCA\ConverseJs\AppConfig $config - application configuration
	 */
	public function __construct(
		$AppName,
		IRequest $request,
		IL10N $l,
		ILogger $logger,
		AppConfig $config
	) {
		parent::__construct($AppName, $request);
		$this->appName = $AppName;
		$this->l = $l;
		$this->logger = $logger;
		$this->config = $config;
	}
	/**
	 * Config page
	 *
	 * @return TemplateResponse
	 */
	public function index()
	{
		$data = [
			"boshUrl" => $this->config->GetBoshUrl(),
			"l" => $this->config->GetL()
		];
		return new TemplateResponse($this->appName, "settings", $data, "blank");
	}
	public function settings($boshUrl)
	{
		$boshUrl = trim($_POST['boshUrl']);
		$l = trim($_POST['l']);
		$this->config->SetBoshUrl($boshUrl);
		$this->config->SetL($l);
		return [
			"boshUrl" => $this->config->GetBoshUrl(),
			"l" => $this->config->GetL()
		];
	}
	/**
	 * Get supported formats
	 *
	 * @return array
	 *
	 * @NoAdminRequired
	 */
	public function getsettings()
	{
		$data = array();
		return $data;
	}
}
