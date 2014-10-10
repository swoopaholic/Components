<?php
namespace Swoopaholic\Component\Table\Extension\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class TableTemplatePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('twig.loader.filesystem')) {
            return;
        }

        // table template...
        $templatePath = $container->getParameter('kernel.root_dir') . '/../vendor/swoopaholic/components/Swoopaholic/Component/Table/Resources/views/Table';
        $loader = $container->getDefinition('twig.loader.filesystem');
        $loader->addMethodCall('addPath', array($templatePath));
    }
}
