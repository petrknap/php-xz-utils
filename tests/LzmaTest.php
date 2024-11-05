<?php

declare(strict_types=1);

namespace PetrKnap\XzUtils;

final class LzmaTest extends XzUtilsTestCase
{
    protected static function getInstance(): XzUtils
    {
        return new Lzma();
    }

    protected static function getCompressedDataAsBase64(): array
    {
        return [
            'default' => 'XQAAgAD//////////wBDvIsFc1oAW6cKbXYAkhFLW9tdnzH//3dgAAA=',
            '0' => 'XQAABAD//////////wBDvIsFc1oAW6cKbXYAkhFLW9tdnzH//3dgAAA=',
            '9' => 'XQAAAAT//////////wBDvIsFc1oAW6cKbXYAkhFLW9tdnzH//3dgAAA=',
        ];
    }
}
