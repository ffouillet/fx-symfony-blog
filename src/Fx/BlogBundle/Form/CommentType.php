<?php

namespace Fx\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userName',     TextType::class, array('label' => 'Votre nom'))
            ->add('content',   TextareaType::class,
                array('label' => 'Votre commentaire',
                    'attr' => array('rows' => 8)
                ))
            ->add('save',      SubmitType::class,
                array('label' => 'Envoyer',
                    'attr' => array('class' => 'btn-bordered')
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fx\BlogBundle\Entity\Comment'
        ));
    }
}
