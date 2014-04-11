<?php
namespace Swoopaholic\Component\Navigation;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AbstractType
 * @package Swoopaholic\Component\Navigation
 */
class AbstractType implements NavigationTypeInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildNavigation(array $options)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(NavigationView $view, NavigationInterface $navigation, array $options)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
    }
}
