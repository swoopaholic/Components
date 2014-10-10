<?php
namespace Swoopaholic\Component\Table\Twig;

use Swoopaholic\Component\Table\TableRenderer;

class TwigRenderer extends TableRenderer implements TwigRendererInterface
{
    /**
     * @var TwigRendererEngineInterface
     */
    private $engine;

    public function __construct(TwigRendererEngineInterface $engine)
    {
        parent::__construct($engine);

        $this->engine = $engine;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnvironment(\Twig_Environment $environment)
    {
        $this->engine->setEnvironment($environment);
    }
}
