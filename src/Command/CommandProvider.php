<?php

namespace Vardot\ComposerOptimizer\Command;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
final class CommandProvider implements \Composer\Plugin\Capability\CommandProvider
{
    /**
     * @return \Composer\Command\BaseCommand[]
     *
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function getCommands()
    {
        return array(
            new ClearCommand(),
        );
    }
}
