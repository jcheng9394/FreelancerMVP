<?php

namespace TGC\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TGC\AdminBundle\Form\DataTransformer\UserToIntTransformer;
use TGC\AdminBundle\Form\DataTransformer\ProjectToIntTransformer;

class ProposalType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $UserTransformer = new UserToIntTransformer($options["em"]);
        $ProjectTransformer = new ProjectToIntTransformer($options["em"]);

        $builder
            ->add('coverletter')
            ->add('hourlyrate')
            // ->add('duration')
            // ->add('registrationtimestamp')
            // ->add('status')
            ->add($builder->create('userid', 'hidden')->addModelTransformer($UserTransformer))
            ->add($builder->create('projectid', 'hidden')->addModelTransformer($ProjectTransformer))
            // ->add('userid')
            // ->add('projectid')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TGC\AdminBundle\Entity\Proposal'
        ));
        $resolver->setRequired(array(
            'em',
        ));
        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tgc_adminbundle_proposal';
    }
}
