<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils\Exception;

/**
 * @deprecated catch {@see CouldNotDecompressData}
 *
 * @todo remove it
 */
final class XzCouldNotDecompressData extends CouldNotDecompressData implements XzException
{
}
