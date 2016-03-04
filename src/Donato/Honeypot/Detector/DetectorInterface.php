<?php

namespace Donato\Honeypot\Detector;

interface DetectorInterface
{
    const DETECT_IF_BLACKLIST     = 'blacklist';
    const DETECT_IF_NOT_WHITELIST = 'not_whitelist';

    /**
     * @return boolean
     */
    public function detected();
}
