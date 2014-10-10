<?php
namespace Swoopaholic\Component\Table\Twig;

use Swoopaholic\Component\Table\TableRendererEngineInterface;

interface TwigRendererEngineInterface extends TableRendererEngineInterface
{
    /**
     * Sets Twig's environment.
     *
     * @param \Twig_Environment $environment
     */
    public function setEnvironment(\Twig_Environment $environment);
}
