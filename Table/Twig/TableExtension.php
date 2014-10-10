<?php
namespace Swoopaholic\Component\Table\Twig;

use Swoopaholic\Component\Table\Twig\TokenParser\TableThemeTokenParser;

class TableExtension extends \Twig_Extension
{
    /**
     * This property is public so that it can be accessed directly from compiled
     * templates without having to call a getter, which slightly decreases performance.
     *
     * @var TwigRendererInterface
     */
    public $renderer;

    public function __construct(TwigRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->renderer->setEnvironment($environment);
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return array(
            // {% table_theme table "SomeBundle::widgets.twig" %}
            new TableThemeTokenParser(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        $searchNodeParams = array('node_class' => 'Swoopaholic\Component\Table\Twig\Node\TableSearchAndRenderBlockNode', 'is_safe' => array('html'));
        $renderNodeParams = array('node_class' => 'Swoopaholic\Component\Table\Twig\Node\TableRenderBlockNode', 'is_safe' => array('html'));

        return array(
            new \Twig_SimpleFunction('table_widget', null, $searchNodeParams),
//            new \Twig_SimpleFunction('form_label', null, $nodeParams),
            new \Twig_SimpleFunction('table_row', null, $searchNodeParams),
            new \Twig_SimpleFunction('table_rest', null, $searchNodeParams),
            new \Twig_SimpleFunction('table', null, $renderNodeParams),
            new \Twig_SimpleFunction('table_start', null, $renderNodeParams),
            new \Twig_SimpleFunction('table_end', null, $renderNodeParams),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
//            new \Twig_SimpleFilter('humanize', array($this, 'humanize')),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'table';
    }
}
