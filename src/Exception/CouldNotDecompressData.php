<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils\Exception;

use PetrKnap\Shorts\Exception\CouldNotProcessData;

/**
 * @extends CouldNotProcessData<string>
 */
abstract class CouldNotDecompressData extends CouldNotProcessData implements Exception
{
}
