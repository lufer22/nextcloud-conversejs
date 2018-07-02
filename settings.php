<?php
namespace OCA\ConverseJs;

use OCP\User;

use OCA\ConverseJs\AppInfo\Application;

User::checkAdminUser();

$app = new Application();
$container = $app->getContainer();
$response = $container->query("\OCA\ConverseJs\Controller\SettingsController")->index();

return $response->render();
