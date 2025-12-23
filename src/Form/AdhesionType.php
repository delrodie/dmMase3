<?php

namespace App\Form;

use App\Entity\Adhesion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdhesionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('civilite', ChoiceType::class,[
                'attr' => ['class' => 'form-select rounded-0'],
                'choices' => [
                    '-- Séléctionnez --' => '',
                    'M.' => 'M.',
                    'Mme' => 'Mme',
                    'Mlle' => 'Mlle'
                ],
                'label' => 'Civilité <sup class="text-danger">*</sup>',
                'label_html' => true,
                'label_attr' => ['class' => 'form-label sr-only'],
                'required' => true,
            ])
            ->add('nom', TextType::class,[
                'attr' =>['class' => 'form-control rounded-0', 'autocomplete'=>'off'],
                'label' => 'Nom de famille <sup class="text-danger">*</sup>',
                'label_html' => true,
                'label_attr' => ['class' => 'form-label sr-only'],
                'required' => true,
            ])
            ->add('prenom', TextType::class,[
                'attr' =>['class' => 'form-control rounded-0', 'autocomplete'=>'off'],
                'label' => 'Prénoms <sup class="text-danger">*</sup>',
                'label_html' => true,
                'label_attr' => ['class' => 'form-label sr-only'],
                'required' => true,
            ])
            ->add('email', EmailType::class,[
                'attr' =>['class' => 'form-control rounded-0', 'autocomplete'=>'off'],
                'label' => 'Adresse email <sup class="text-danger">*</sup>',
                'label_html' => true,
                'label_attr' => ['class' => 'form-label sr-only'],
                'required' => true,
            ])
            ->add('telephone', TelType::class,[
                'attr' => ['class' => 'form-control rounded-0', 'autocomplete'=>'off'],
                'label' => 'Numero de téléphone <sup class="text-danger">*</sup>',
                'label_html' => true,
                'label_attr' => ['class' => 'form-label sr-only'],
                'required' => true,
            ])
            ->add('entreprise', TextType::class,[
                'attr' => ['class' => 'form-control rounded-0', 'autocomplete' => 'off'],
                'label' => 'Entreprise <sup class="text-danger">*</sup>',
                'label_html' => true,
                'label_attr' => ['class' => 'form-label sr-only'],
                'required' => true,
            ])
            ->add('fonction', TextType::class,[
                'attr' => ['class' => 'form-control rounded-0', 'autocomplete' => 'off'],
                'label' => 'Fonction <sup class="text-danger">*</sup>',
                'label_html' => true,
                'label_attr' => ['class' => 'form-label sr-only'],
                'required' => true,
            ])
            ->add('pays', CountryType::class,[
                'attr' => ['class' => 'form-select rounded-0', 'autocomplete' => 'off'],
                'label' => 'Pays <sup class="text-danger">*</sup>',
                'label_html' => true,
                'label_attr' => ['class' => 'form-label sr-only'],
                'required' => true,
            ])
            ->add('ville', TextType::class,[
                'attr' => ['class' => 'form-control rounded-0', 'autocomplete' => 'off'],
                'label' => 'Ville <sup class="text-danger">*</sup>',
                'label_html' => true,
                'label_attr' => ['class' => 'form-label sr-only'],
                'required' => true,
            ])
            ->add('message', TextareaType::class,[
                'attr' => [ 'class' => 'form-control rounded-0', 'autocomplete' => 'off', 'rows' => 5],
                'label' => 'Message <sup class="text-danger">*</sup>',
                'label_html' => true,
                'label_attr' => ['class' => 'form-label sr-only'],
                'required' => true,
            ])
//            ->add('valid')
//            ->add('createdAt', null, [
//                'widget' => 'single_text',
//            ])
//            ->add('sendAt', null, [
//                'widget' => 'single_text',
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adhesion::class,
        ]);
    }
}
