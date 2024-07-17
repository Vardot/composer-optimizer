<?php

namespace Vardot\ComposerOptimizer\Util;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
interface FinderInterface
{
    /**
     * @param string[] $patterns
     *
     * @return string[]
     */
    public function find(array $patterns);
    
    /**
     * @param string $dir
     *
     * @return FinderInterface
     */
    public function setCurrentDir($dir);
}
