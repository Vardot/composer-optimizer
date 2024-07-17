<?php

namespace OctoLab\Cleaner;

use function yaml_parse_file;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @return string
     */
    protected static function getFixturePath()
    {
        return __DIR__
            . DIRECTORY_SEPARATOR
            . 'fixtures' . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    protected static function getMatcherTestCasePath()
    {
        return self::getFixturePath()
            . 'testcases' . DIRECTORY_SEPARATOR
            . 'matcher' . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    protected static function getNormalizerTestCasePath()
    {
        return self::getFixturePath()
            . 'testcases' . DIRECTORY_SEPARATOR
            . 'normalizer' . DIRECTORY_SEPARATOR;
    }

    /**
     * @return array
     */
    protected static function getPackages()
    {
        return yaml_parse_file(self::getFixturePath() . 'packages.yml');
    }
}
