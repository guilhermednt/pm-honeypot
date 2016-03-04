<?php
require_once './vendor/autoload.php';

use Donato\Configuration\YamlConfig;
use Donato\Honeypot\Detector\UserAgentDetector;
use Donato\Honeypot\Detector;

$config = new YamlConfig('parameters.yml');

function register($message, $file)
{
    file_put_contents($file, $message.PHP_EOL, FILE_APPEND);
}
//

register(sprintf('%s - %s - %s', date('Y-m-d H:i:s'), $_SERVER['REMOTE_ADDR'],
        json_encode($_REQUEST)), $config->get('log.access'));

$userAgent       = $_SERVER['HTTP_USER_AGENT'];
$whitelist       = $config->get('detectors.user-agent.whitelist');
$blacklist       = $config->get('detectors.user-agent.blacklist');
$detectCondition = $config->get('detectors.user-agent.detect_condition');

$detectors = [
    new UserAgentDetector($userAgent, $blacklist, $whitelist, $detectCondition)
];
$detector  = new Detector($detectors);

if ($detector->detected()) {
    register(sprintf('%s - %s - %s', date('Y-m-d H:i:s'), $_SERVER['REMOTE_ADDR'],
            json_encode($_REQUEST)), $config->get('log.detections'));
}
