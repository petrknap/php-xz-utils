<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils\Exception;

use PetrKnap\Shorts\Exception\CouldNotProcessData;

/**
 * @extends CouldNotProcessData<string>
 */
final class LzmaCouldNotCompressData extends CouldNotProcessData implements LzmaException
{
}
