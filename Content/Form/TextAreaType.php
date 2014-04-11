<?php
/**
 * Created by PhpStorm.
 * User: danny
 * Date: 17/03/14
 * Time: 20:53
 */
namespace Swoopaholic\Component\Content\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TextAreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', 'textarea', array('label' => null));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Swoopaholic\Component\Content\Part\TextAreaType',
        ));
    }

    public function getName()
    {
        return 'content_textarea';
    }
} 