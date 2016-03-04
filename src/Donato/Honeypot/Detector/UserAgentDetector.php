<?php

namespace Donato\Honeypot\Detector;

class UserAgentDetector implements DetectorInterface
{
    /** @var string */
    private $userAgent;

    /** @var array|string */
    private $whitelist;

    /** @var array|string */
    private $blacklist;

    /** @var string */
    private $detectCondition;

    public function __construct($userAgent, $blacklist, $whitelist,
                                $detectCondition)
    {
        $this->userAgent = $userAgent;
        $this->blacklist = $blacklist;
        $this->whitelist = $whitelist;

        $this->detectCondition = $detectCondition;
    }

    public function detected()
    {
        $value = $this->userAgent;

        $blacklist = $this->processRule($this->blacklist, $value);
        $whitelist = $this->processRule($this->whitelist, $value);

        switch ($this->detectCondition) {
            case self::DETECT_IF_BLACKLIST:
                return $blacklist;
                break;
            case self::DETECT_IF_NOT_WHITELIST:
                return !$whitelist && $blacklist;
                break;
        }
    }

    private function processRule($rules, $value)
    {
        foreach ($rules as $rule) {
            if (preg_match($rule, $value) === 1) {
                return true;
            }
        }

        return false;
    }
}
