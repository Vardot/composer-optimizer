<?php

namespace Vardot\ComposerOptimizer\Util;

use Vardot\ComposerOptimizer\TestCase;
use function yaml_parse_file;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class NormalizerTest extends TestCase
{
    /**
     * @return array
     */
    public static function cases()
    {
        $cases = array();
        $normalizer = new CategoryNormalizer();
        foreach (glob(self::getNormalizerTestCasePath()
                . 'category' . DIRECTORY_SEPARATOR
                . '*' . DIRECTORY_SEPARATOR) as $folder) {
            $cases[] = array($normalizer, $folder);
        }
        return $cases;
    }

    /**
     * @test
     * @dataProvider cases
     *
     * @param NormalizerInterface $normalizer
     * @param string $folder
     */
    public function normalize(NormalizerInterface $normalizer, $folder)
    {
        $testCase = array_replace_recursive(
            array(
                'title' => 'unknown test',
                'message' => 'unknown test message',
                'description' => 'unknown test description',
                'extra' => array(
                    'dev-files' => array(),
                ),
            ),
            yaml_parse_file($folder . 'setup.yml')
        );

        $expected = yaml_parse_file($folder . 'expected.yml');
        $test = $normalizer->normalize($testCase['extra']['dev-files']);
        ksort($expected);
        ksort($test);

        self::assertEquals(
            $expected,
            $test,
            sprintf('%s (%s: %s)', $testCase['message'], $testCase['title'], $testCase['description'])
        );
    }
}
