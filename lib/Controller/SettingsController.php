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
use OCP\AppFramework\Http\DataResponse;
use OCP\IUserSession;
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
	protected $user;
	/**
	 * @param string $AppName - application name
	 * @param IRequest $request - request object
	 * @param IUserSession $userSession
	 * @param IL10N $l - l10n service
	 * @param ILogger $logger - logger
	 * @param OCA\ConverseJs\AppConfig $config - application configuration
	 */
	public function __construct(
		$AppName,
		IRequest $request,
		IUserSession $userSession,
		IL10N $l,
		ILogger $logger,
		AppConfig $config
	) {
		parent::__construct($AppName, $request);
		$this->appName = $AppName;
		$this->l = $l;
		$this->logger = $logger;
		$this->config = $config;
		$this->user = $userSession->getUser()->getUID();
	}
	/**
	 * Config page
	 *
	 * @return TemplateResponse
	 */
	public function index()
	{
		$data = [
			"boshUrl" =>
				$this->config->config->getAppValue($this->appName, 'boshUrl', ''),
			"l" => $this->config->GetL()
		];
		return new TemplateResponse($this->appName, "settings", $data, "blank");
	}

	public function personal($jid = false, $pass = false)
	{
		if ($jid !== false) {
			$this->config->config->setUserValue(
				$this->user,
				$this->appName,
				'jid',
				$jid
			);
		}
		if ($pass !== false) {
			$this->config->config->setUserValue(
				$this->user,
				$this->appName,
				'pass',
				$pass
			);
		}

		return new DataResponse(array(
			'message' => (string) $this->l->t('Changed user settings'),
			'data' =>
				array(
					'jid' =>
						(string) $this->config->config->getUserValue(
							$this->user,
							$this->appName,
							'jid',
							''
						),
					'pass' =>
						(string) $this->config->config->getUserValue(
							$this->user,
							$this->appName,
							'pass',
							''
						),
					'boshUrl' =>
						(string) $this->config->config->getAppValue($this->appName, 'boshUrl', '')
				)
		));
	}

	/**
	 * Get supported formats
	 * @param string $boshUrl
	 * @return array
	 *
	 * @NoAdminRequired
	 */
	public function admin($boshUrl = false)
	{
		if ($boshUrl !== false) {
			$this->config->config->setAppValue($this->appName, 'boshUrl', $boshUrl);
		}
		// $this->logger->error("posted", array("app" => $this->appName));
		return new DataResponse(array(
			'message' => (string) $this->l->t('Changed bosh url'),
			'data' =>
				array(
					'boshUrl' =>
						(string) $this->config->config->getAppValue($this->appName, 'boshUrl', '')
				)
		));
	}
}
