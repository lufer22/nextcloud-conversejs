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
// use OCP\IUserSession;

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
    private $l;
    private $logger;
    private $config;
    /**
     * @param string $AppName - application name
     * @param IRequest $request - request object
     * @param IRootFolder $root - root folder
     * @param IUserSession $userSession - current user session
     * @param IURLGenerator $urlGenerator - url generator service
     * @param IL10N $l - l10n service
     * @param ILogger $logger - logger
     * @param OCA\ConverseJs\AppConfig $config - app config
     */
    public function __construct($AppName,
                                IRequest $request,
                                // IRootFolder $root,
                                // IUserSession $userSession,
                                // IURLGenerator $urlGenerator,
                                IL10N $l,
                                ILogger $logger,
                                AppConfig $config
                                )
    {
        parent::__construct($AppName, $request);
        // $this->userSession = $userSession;
        // $this->root = $root;
        // $this->urlGenerator = $urlGenerator;
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
    public function index() {
        $boshUrl = $this->config->GetBoshUrl();
        // $theme = $this->config->GetTheme();
        // $overrideXml = $this->config->GetOverrideXml();
        $l = $this->config->GetL();
        $l = trim(strtolower($l));
        if ($l=="auto")
        {
            $l = \OC::$server->getL10NFactory("")->get("")->getLanguageCode();
        }
        if (empty($boshUrl))
        {
            $this->logger->error("boshUrl is empty", array("app" => $this->appName));
            return ["error" => $this->l->t("ConverseJs app not configured! Please contact admin.")];
        }
        // $boshUrlArray = explode("?",$drawioUrl);
        // if (count($drawioUrlArray) > 1){
        //     $drawioUrl = $drawioUrlArray[0];
        //     $drawioUrlArgs = $drawioUrlArray[1];
        // } else {
        //     $drawioUrlArgs = "";
        // }

        // $uid = $this->userSession->getUser()->getUID();
        // $baseFolder = $this->root->getUserFolder($uid);
        $params = [
            "boshUrl" => $boshUrl,
            // "theme" => $theme,
            "l" => $l,
            // "overrideXml" => $overrideXml,
            // "filePath" => $baseFolder->getRelativePath($file->getPath())
        ];
        $response = new TemplateResponse($this->appName, "index", $params);
        $csp = new ContentSecurityPolicy();
        $csp->allowInlineScript(true);
        if (isset($boshUrl) && !empty($boshUrl))
        {
            $csp->addAllowedScriptDomain($boshUrl);
            $csp->addAllowedFrameDomain($boshUrl);
            $csp->addAllowedFrameDomain("blob:");
            $csp->addAllowedChildSrcDomain($boshUrl);
            $csp->addAllowedChildSrcDomain("blob:");
        }
        $response->setContentSecurityPolicy($csp);
        return $response;
    }
}
