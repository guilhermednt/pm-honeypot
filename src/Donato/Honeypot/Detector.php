<?php

namespace Donato\Honeypot;

use Donato\Honeypot\Detector\DetectorInterface;

class Detector implements DetectorInterface
{
    /** @var DetectorInterface[] */
    private $detectors;

    public function __construct($detectors)
    {
        $this->detectors = $detectors;
    }

    public function detected()
    {
        foreach ($this->detectors as $detector) {
            if ($detector->detected()) {
                return true;
            }
        }

        return false;
    }
}
