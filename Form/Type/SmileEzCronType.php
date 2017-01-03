<?php

namespace Smile\EzUICronBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SmileEzCronType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('expression')
            ->add('arguments')
            ->add('priority')
            ->add('enabled')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Smile\EzUICronBundle\Entity\SmileEzCron'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smile_ezuicronbundle_smileezcron';
    }
}
