<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Statistics;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class StatisticsType
 * @package App\Form
 */
class StatisticsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('estimated_revenue')
            ->add('ad_impression')
            ->add('ad_ecpm')
            ->add('clicks')
            ->add('ad_ctr')
            ->add('site');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Statistics::class,
        ]);
    }
}
