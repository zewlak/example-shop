<?php
/**
 *  * Created by PhpStorm.
 * User: Tomasz Żewłakow <zewlak@gmail.com>
 * Date: 13.02.2018
 * Time: 23:21
 */

namespace App\Forms;

use App\Entity\DTO\ProductTypeDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * New Product form class.
 *
 * @author Tomasz Żewłakow <zewlak@gmail.com>
 */
class ProductType extends AbstractType
{
    /**
     * Prepare forms' fields.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('price', MoneyType::class)
            ->add('description', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Product'));
    }

    /**
     * Configure forms options.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductTypeDTO::class,
        ]);
    }
}
