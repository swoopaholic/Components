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


interface NavigationInterface extends \ArrayAccess, \Iterator, \Countable
{
    /**
     * @param NavigationInterface $parent
     * @return mixed
     */
    public function setParent(NavigationInterface $parent = null);

    /**
     * @return NavigationInterface
     */
    public function getParent();

    /**
     * @param $child
     * @return $this
     */
    public function add($child);

    /**
     * Returns the child with the given name.
     *
     * @param string $name The name of the child
     *
     * @return NavigationInterface The child form
     *
     * @throws \OutOfBoundsException If the named child does not exist.
     */
    public function get($name);

    /**
     * Returns whether a child with the given name exists.
     *
     * @param string $name The name of the child
     *
     * @return Boolean
     */
    public function has($name);

    /**
     * Removes a child from the form.
     *
     * @param  string $name The name of the child to remove
     *
     * @return NavigationInterface The form instance
     */
    public function remove($name);

    /**
     * Returns all children in this group.
     *
     * @return NavigationInterface[] An array of FormInterface instances
     */
    public function all();

    /**
     * Returns the name by which the form is identified in forms.
     *
     * @return string The name of the form.
     */
    public function getName();

    /**
     * Returns whether this navigation element is disabled.
     *
     * The content of a disabled element is displayed, but not allowed to be
     * used in the interface.
     *
     * Navigation elements whose parents are disabled are considered disabled regardless of
     * their own state.
     *
     * @return Boolean
     */
    public function isDisabled();

    /**
     * Creates a view.
     *
     * @param NavigationView $parent The parent view
     *
     * @return NavigationView The view
     */
    public function createView(NavigationView $parent = null);
}
