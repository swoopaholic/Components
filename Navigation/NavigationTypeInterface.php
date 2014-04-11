<?php
namespace Swoopaholic\Component\Navigation;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Danny Dörfel <ddorfel@netvlies.nl>
 */
interface NavigationTypeInterface
{
    /**
     * Builds the navigation.
     */
    public function buildNavigation(array $options);

    public function buildView(NavigationView $view, NavigationInterface $navigation, array $options);

    /**
     * Returns the name of the parent type.
     *
     * @return string|null The name of the parent type if any, null otherwise.
     */
    public function getParent();

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName();

    /**
     * @param OptionsResolverInterface $resolver
     * @return mixed
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver);
}
