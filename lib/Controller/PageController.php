<?php
/**
 *
 * @author Pawel Rojek <pawel at pawelrojek.com>
 * @author Ian Reinhart Geiser <igeiser at devonit.com>
 *
 * This file is licensed under the Affero General Public License version 3 or later.
 *
 */
namespace OCA\ConverseJs\Controller;

use OCP\App;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\ContentSecurityPolicy;
use OCP\AppFramework\Controller;
// use OCP\AutoloadNotAllowedException;
// use OCP\Files\FileInfo;
// use OCP\Files\IRootFolder;
use OCP\IL10N;
use OCP\ILogger;
use OCP\IRequest;
// use OCP\IURLGenerator;
use OCP\IUserSession;

// use OC\Files\Filesystem;
// use OC\Files\View;
// use OC\User\NoUserException;

// use OCA\Files\Helper;
// use OCA\Files_Versions\Storage;
use OCA\ConverseJs\AppConfig;

class PageController extends Controller
{
	// private $userSession;
	// private $root;
	// private $urlGenerator;
	protected $appName;
	protected $l;
	protected $logger;
	protected $config;
	protected $user;
	/**
	 * @param string $AppName - application name
	 * @param IRequest $request - request object
	 * @param IUserSession $userSession - current user session
	 * @param IL10N $l - l10n service
	 * @param ILogger $logger - logger
	 * @param OCA\ConverseJs\AppConfig $config - app config
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
		$this->user = $userSession->getUser()->getUID();
		$this->l = $l;
		$this->logger = $logger;
		$this->config = $config;
	}
	/**
	 * This comment is very important, CSRF fails without it
	 *
	 * @param integer $fileId - file identifier
	 *
	 * @return TemplateResponse
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index()
	{
		$jid = $this->config->config->getUserValue(
			$this->user,
			$this->appName,
			'jid',
			''
		);
		$boshUrl = $this->config->GetBoshUrl();
		$l = $this->config->GetL();
		$l = trim(strtolower($l));
		if ($l == "auto") {
			$l = \OC::$server
				->getL10NFactory("")
				->get("")
				->getLanguageCode();
		}
		if (empty($boshUrl)) {
			$this->logger->error("boshUrl is empty", array("app" => $this->appName));
			return [
				"error" =>
					$this->l->t(
						"ConverseJs app not configured! Please contact admin. (no bosh url)"
					)
			];
		}

		$params = ["boshUrl" => $boshUrl, "l" => $l, 'jid' => $jid];
		$response = new TemplateResponse($this->appName, "index", $params);
		return $response;
	}
}
