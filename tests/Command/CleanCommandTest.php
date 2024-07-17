<?php

namespace OctoLab\Cleaner\Command;

use OctoLab\Cleaner\TestCase;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class CleanCommandTest extends TestCase
{
    /**
     * @test
     */
    public function execute()
    {
        $command = new ClearCommand();

        $pluginManager = $this->getMockBuilder('Composer\Plugin\PluginManager')
            ->disableOriginalConstructor()
            ->getMock();
        $pluginManager->method('getPlugins')
            ->willReturn([]);

        $repo = $this->createMock('Composer\Repository\WritableRepositoryInterface');
        $repo->method('getPackages')
            ->willReturn([]);

        $repositoryManager = $this->getMockBuilder('Composer\Repository\RepositoryManager')
            ->disableOriginalConstructor()
            ->getMock();

        $composer = $this->createMock('Composer\Composer');
        $composer->method('getPluginManager')
            ->willReturn($pluginManager);
        $composer->method('getRepositoryManager')
            ->willReturn($repositoryManager);

        /** @var \Composer\Composer $composer */
        $command->setComposer($composer);

        $reflection = new \ReflectionObject($command);
        $method = $reflection->getMethod('execute');
        $method->setAccessible(true);

        $input = $this->getMockBuilder('Symfony\Component\Console\Input\ArgvInput')->getMock();
        $input->method('getArgument')
            ->willReturn('');
        $output = new BufferedOutput();
        self::assertEquals(0, $method->invoke($command, $input, $output));
    }
}
