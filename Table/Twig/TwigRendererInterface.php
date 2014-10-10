<?php
namespace Swoopaholic\Component\Table\Twig;

use Swoopaholic\Component\Table\TableRendererInterface;

interface TwigRendererInterface extends TableRendererInterface
{
    /**
     * Sets Twig's environment.
     *
     * @param \Twig_Environment $environment
     */
    public function setEnvironment(\Twig_Environment $environment);
}
