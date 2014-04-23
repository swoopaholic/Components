<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
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
