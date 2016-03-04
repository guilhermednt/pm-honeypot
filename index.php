<?php
require_once './vendor/autoload.php';

use Donato\Configuration\YamlConfig;
use Donato\Honeypot\Detector\UserAgentDetector;

$config = new YamlConfig('parameters.yml');

$userAgent       = $_SERVER['HTTP_USER_AGENT'];
$whitelist       = $config->get('detectors.user-agent.whitelist');
$blacklist       = $config->get('detectors.user-agent.blacklist');
$detectCondition = $config->get('detectors.user-agent.detect_condition');

$detectors = [
    new UserAgentDetector($userAgent, $blacklist, $whitelist, $detectCondition)
];

foreach ($detectors as $detector) {
    if ($detector instanceof Donato\Honeypot\Detector\DetectorInterface) {
        if ($detector->detected()) {
            die("FAIL!");
        }
    }
}
die("ok");
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        /
    </body>
</html>
