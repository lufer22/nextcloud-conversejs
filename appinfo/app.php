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
use OCP\AppFramework\Http\EmptyContentSecurityPolicy;

App::registerAdmin('conversejs', 'settings/admin');
$app = new Application();

$manager = \OC::$server->getContentSecurityPolicyManager();
$policy = new \OCP\AppFramework\Http\EmptyContentSecurityPolicy();
$policy->addAllowedStyleDomain('\'self\'');
$policy->addAllowedStyleDomain('\'unsafe-inline\'');
$policy->addAllowedScriptDomain('\'self\'');
$policy->addAllowedImageDomain('\'self\'');
$policy->addAllowedImageDomain('data:');
$policy->addAllowedImageDomain('blob:');
$policy->addAllowedMediaDomain('\'self\'');
$policy->addAllowedMediaDomain('blob:');
$policy->addAllowedChildSrcDomain('\'self\'');
$policy->addAllowedConnectDomain('\'self\'');
// $policy->addAllowedConnectDomain('conversejs.org');
$boshUrl = \OC::$server
	->getConfig()
	->getAppValue('conversejs', 'boshUrl', '');
if (
	preg_match(
		'/^((https?:\/\/)?[a-z0-9][a-z0-9\-.]*[a-z0-9](:[0-9]+)?)/i',
		$boshUrl,
		$matches
	)
) {
	$boshDomain = $matches[1];
	$policy->addAllowedConnectDomain($boshDomain);
}
$manager->addDefaultPolicy($policy);
