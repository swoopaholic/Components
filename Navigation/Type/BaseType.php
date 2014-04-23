<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Navigation\Type;

use Swoopaholic\Component\Navigation\AbstractType;
use Swoopaholic\Component\Navigation\NavigationInterface;
use Swoopaholic\Component\Navigation\NavigationView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BaseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(NavigationView $view, NavigationInterface $navigation, array $options)
    {
        $config = $navigation->getConfig();
        $name = $navigation->getName();
        $blockName = $options['block_name'] ?: $navigation->getName();
//        $translationDomain = $options['translation_domain'];

        if ($view->parent) {
            if ('' !== ($parentFullName = $view->parent->vars['full_name'])) {
                $id = sprintf('%s_%s', $view->parent->vars['id'], $name);
                $fullName = sprintf('%s[%s]', $parentFullName, $name);
                $uniqueBlockPrefix = sprintf('%s_%s', $view->parent->vars['unique_block_prefix'], $blockName);
            } else {
                $id = $name;
                $fullName = $name;
                $uniqueBlockPrefix = '_'.$blockName;
            }

//            if (!$translationDomain) {
//                $translationDomain = $view->parent->vars['translation_domain'];
//            }
        } else {
            $id = $name;
            $fullName = $name;
            $uniqueBlockPrefix = '_'.$blockName;

            // Strip leading underscores and digits. These are allowed in
            // form names, but not in HTML4 ID attributes.
            // http://www.w3.org/TR/html401/struct/global.html#adef-id
            $id = ltrim($id, '_0123456789');
        }

        $blockPrefixes = array();
        for ($type = $config->getType(); null !== $type; $type = $type->getParent()) {
            array_unshift($blockPrefixes, $type->getName());
        }
        $blockPrefixes[] = $uniqueBlockPrefix;

//        if (!$translationDomain) {
//            $translationDomain = 'messages';
//        }

        $view->vars = array_replace($view->vars, array(
            'type'                => $config->getType()->getName(),
            'nav'                 => $view,
            'id'                  => $id,
            'name'                => $name,
            'full_name'           => $fullName,
            'disabled'            => $navigation->isDisabled(),
            'attr'                => $options['attr'],
            'block_prefixes'      => $blockPrefixes,
            'unique_block_prefix' => $uniqueBlockPrefix,
//            'translation_domain'  => $translationDomain,
            'cache_key'           => $uniqueBlockPrefix.'_'.$navigation->getConfig()->getType()->getName(),
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'block_name'         => null,
            'disabled'           => false,
            'attr'               => array(),
//            'translation_domain' => null,
        ));

        $resolver->setAllowedTypes(array(
            'attr'       => 'array',
        ));
    }

}
