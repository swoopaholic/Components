Swoopaholic Components
======================

This bundle of components is used for decoupling logic with view rendering. Using code independent of rendering creates as more flexible way of using different templates or even front-end templates like mustache.

Usage
-----

Will be here soon...

For now, to enable dependency injectino for the table component:

in the BundleNameExtension class:

``` php 
$tableLoader = new Loader\XmlFileLoader($container, new FileLocator($container->getParameter('kernel.root_dir') . '/../vendor/swoopaholic/components/Swoopaholic/Component/Table/Resources/config'));
$tableLoader->load('twig.xml');
$tableLoader->load('table.xml');
```

in the Bundle class

``` php
...
use Swoopaholic\Component\Table\Extension\DependencyInjection\Compiler\TablePass;
use Swoopaholic\Component\Table\Extension\DependencyInjection\Compiler\TableTemplatePass;
...
public function build(ContainerBuilder $container)
{
    $container->addCompilerPass(new TablePass());
    $container->addCompilerPass(new TableTemplatePass());
}
```

To define the crud table:

``` php
<?php
namespace Namespace\Bundle\MyBundle\CrudTable;

use Swoopaholic\Component\Table\Extension\Crud\Type\TableType;
use Swoopaholic\Component\Table\TableBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends TableType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setRequired(array('data'));
    }

    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $this
            ->addColumn('username', 'text', array('label' => 'Naam', 'sort' => 'username'))
            ->addColumn('email', 'text', array('label' => 'E-mail', 'sort' => 'email'))
            ->addColumn('enabled', 'text', array('label' => 'Enabled'))
            ->addColumn('last_login', 'datetime', array('label' => 'Ingelogd op', 'sort' => 'lastLogin'));

        parent::buildTable($builder, $options);
    }

    public function buildRowActions($builder, $cell, $item, array $options)
    {
        $group = $builder->create('group', 'crud_action_group', array());
        $group->add('show', 'crud_action', array(
            'icon' => 'eye-open',
            'url' => $this->router->generate('nvs_framework_user_show', array('id' => $item->getId())),
            'label' => 'Bekijken',
            'attr' => array('data-rowclick' => '')
        ));

        $group->add('edit', 'crud_action', array(
            'icon' => 'eye-open',
            'url' => $this->router->generate('nvs_framework_user_edit', array('id' => $item->getId())),
            'label' => 'Bewerken',
            'attr' => array('data-rowclick' => '')
        ));

        $cell->add($group);
    }

    public function getParent()
    {
        return 'table';
    }

    public function getName()
    {
        return 'user';
    }
}
```

To use the new crud table, in the controller/action:

``` php
$data = $this->getData()
$tableFactory = $this->get('table.factory');

$table = $tableFactory->create(
    'user',
    $data,
    array('table_route' => $route, 'responsive' => true)
);
```