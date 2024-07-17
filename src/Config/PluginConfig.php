<?php

namespace Vardot\ComposerOptimizer\Config;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
final class PluginConfig extends \ArrayObject
{
    /**
     * @param array $config
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(array $config)
    {
        $default = array(
            'clear' => null,
            'debug' => false,
            'cleaner' => '\Vardot\ComposerOptimizer\Util\FileCleaner',
            'matcher' => '\Vardot\ComposerOptimizer\Util\WeightMatcher',
            'normalizer' => '\Vardot\ComposerOptimizer\Util\CategoryNormalizer',
        );
        parent::__construct(
            $this->validate(array_merge(
                $default,
                array_intersect_key($config, $default)
            ))
        );
    }

    /**
     * @return \Vardot\ComposerOptimizer\Util\CleanerInterface
     */
    public function getCleaner()
    {
        return new $this['cleaner']();
    }

    /**
     * @return \Vardot\ComposerOptimizer\Util\MatcherInterface
     */
    public function getMatcher()
    {
        /** @var \Vardot\ComposerOptimizer\Util\MatcherInterface $matcher */
        $matcher = new $this['matcher']();
        return $matcher->setRules((array)$this['clear']);
    }

    /**
     * @return \Vardot\ComposerOptimizer\Util\NormalizerInterface
     */
    public function getNormalizer()
    {
        return new $this['normalizer']();
    }

    /**
     * @return bool
     */
    public function isDebug()
    {
        return (bool)$this['debug'];
    }

    /**
     * @param array $config
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    private function validate(array $config)
    {
        $isValid = (int)!is_array($config['clear']);
        $interfaces = array(
            'cleaner' => 'Vardot\ComposerOptimizer\Util\CleanerInterface',
            'matcher' => 'Vardot\ComposerOptimizer\Util\MatcherInterface',
            'normalizer' => 'Vardot\ComposerOptimizer\Util\NormalizerInterface',
        );
        foreach ($interfaces as $key => $interface) {
            $isValid |= (int)!is_subclass_of($config[$key], $interface, true);
        }
        if ($isValid === 1) {
            throw new \InvalidArgumentException('The plugin configuration is invalid.');
        }
        return $config;
    }
}
