<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class RequestFormType extends AbstractEntityFormType
{
    public function __construct()
    {
        parent::__construct('request', 'Request', 'request', 'request');
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array('label' => 'Как тебя зовут?'))
            ->add('phone', 'text', array('label' => 'Твой номер мобильного телефона', 'required' => false))
            ->add('email', 'email', array('label' => 'Твой адрес электронной почты', 'required' => false))
            ->add('comment', 'textarea', array('label' => 'Комментарий к заявке', 'required' => false))
            ->add('submit', 'submit', array('label' => 'Отправить заявку'));
    }
} 