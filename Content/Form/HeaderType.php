<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 17/03/14
 * Time: 20:53
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