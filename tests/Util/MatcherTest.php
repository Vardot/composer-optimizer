<?php

namespace OctoLab\Cleaner\Util;

use OctoLab\Cleaner\TestCase;

use function yaml_parse_file;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class MatcherTest extends TestCase
{
    /**
     * @return array
     */
    public static function cases()
    {
        $cases = array();
        $matcher = new WeightMatcher();
        $normalizer = new CategoryNormalizer();
        foreach (glob(self::getMatcherTestCasePath()
                . 'weight' . DIRECTORY_SEPARATOR
                . '*' . DIRECTORY_SEPARATOR) as $folder) {
            $cases[] = array($matcher, $normalizer, $folder);
        }
        return $cases;
    }

    /**
     * @test
     * @dataProvider cases
     *
     * @param MatcherInterface $matcher
     * @param NormalizerInterface $normalizer
     * @param string $folder
     */
    public function match(MatcherInterface $matcher, NormalizerInterface $normalizer, $folder)
    {
        $testCase = array_replace_recursive(
            array(
                'title' => 'unknown test',
                'message' => 'unknown test message',
                'description' => 'unknown test description',
                'config' => array(
                    'octolab/cleaner' => array(
                        'clean' => array(),
                    ),
                ),
            ),
            yaml_parse_file($folder . 'setup.yml')
        );
        $matcher->setRules($testCase['config']['octolab/cleaner']['clean']);
        $expected = yaml_parse_file($folder . 'expected.yml');
        ksort($expected);

        foreach (self::getPackages() as $package => $devFiles) {
            self::assertEquals(
                $expected[$package],
                $matcher->match($package, array_keys($normalizer->normalize($devFiles))),
                sprintf('%s: %s (%s: %s)', $package, $testCase['message'], $testCase['title'], $testCase['description'])
            );
        }
    }
}
