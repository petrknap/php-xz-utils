<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils\Exception;

use PetrKnap\Shorts\Exception\CouldNotProcessData;

/**
 * @extends CouldNotProcessData<string>
 */
abstract class CouldNotCompressData extends CouldNotProcessData implements Exception
{
}
