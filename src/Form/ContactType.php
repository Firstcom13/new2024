<?php

// ContactType.php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', null, [
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Veuillez fournir votre nom.',
                ]),
                new Assert\Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Le nom doit comporter au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le nom doit comporter au maximum {{ limit }} caractères.',
                ]),
            ],
            'attr' => [
                'placeholder' => 'Nom*',
                'class' => 'form-control',
                'id' => 'name_input',
            ],
            'label_attr' => [
                'class' => 'sr-only',
            ],
        ])
        ->add('firstname', null, [
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Veuillez fournir votre prénom.',
                ]),
                new Assert\Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Le prénom doit comporter au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le prénom doit comporter au maximum {{ limit }} caractères.',
                ]),
            ],
            'attr' => [
                'placeholder' => 'Prénom*',
                'class' => 'form-control',
                'id' => 'firstname_input',
            ],
            'label_attr' => [
                'class' => 'sr-only',
            ],
        ])
        ->add('society', null, [
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Veuillez fournir le nom de la société.',
                ]),
            ],
            'attr' => [
                'placeholder' => 'Société*',
                'class' => 'form-control',
                'id' => 'society',
            ],
            'label_attr' => [
                'class' => 'sr-only',
            ],
        ])
        ->add('tel', null, [
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Veuillez fournir un numéro de téléphone.',
                ]),
                new Assert\Regex([
                    'pattern' => '/^\+?[0-9 ]+$/',
                    'message' => 'Veuillez fournir un numéro de téléphone valide.',
                ]),
            ],
            'attr' => [
                'placeholder' => 'Téléphone*',
                'class' => 'form-control',
                'id' => 'telephone_input',
            ],
            'label_attr' => [
                'class' => 'sr-only',
            ],
        ])
        ->add('email', null, [
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Veuillez fournir une adresse e-mail.',
                ]),
                new Assert\Email([
                    'message' => 'L\'adresse e-mail "{{ value }}" n\'est pas valide.',
                ]),
            ],
            'attr' => [
                'placeholder' => 'E-mail*',
                'class' => 'form-control',
                'id' => 'email_input',
            ],
            'label_attr' => [
                'class' => 'sr-only',
            ],
        ])
        ->add('message', TextareaType::class, [
            'constraints' => [
                new Assert\Length([
                    'max' => 1000,
                    'maxMessage' => 'Le message doit comporter au maximum {{ limit }} caractères.',
                ]),
            ],
            'attr' => [
                'placeholder' => 'Message',
                'class' => 'form-control',
                'id' => 'message_input',
            ],
            'label_attr' => [
                'class' => 'sr-only',
            ],
        ])
        ->add('agree', CheckboxType::class, [
            'label' => 'Je souhaite recevoir....',
            'required' => true,
        ])
        ->add('autorisation', CheckboxType::class, [
            'constraints' => [
                new Assert\IsTrue([
                    'message' => 'Vous devez autoriser le stockage de vos données pour soumettre ce formulaire.',
                ]),
            ],
            'label' => 'Pour répondre à ma demande d’information, j’autorise Firstcom à stocker mes données renseignées dans ce formulaire.',
            'required' => true,
        ])
        ->add('envoyer', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary',
                'id' => 'form_button',
            ],
        ])
    ;
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
