<?php
/*
 * This file is part of the Swoopaholic Component package.
 *
 * (c) Danny Dörfel <danny@swoopaholic.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Swoopaholic\Component\Content\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HeaderType extends TextType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'level',
            'choice',
            array('choices' => array('h1'=> 'H1', 'h2'=> 'H2', 'h3'=> 'H3', 'h4'=> 'H4', 'h5'=> 'H5', 'h6'=> 'H6',))
        );
        $builder->add('content', 'text');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Swoopaholic\Component\Content\Part\HeaderType',
        ));
    }

    public function getName()
    {
        return 'content_header';
    }
} 