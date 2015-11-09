<?php
namespace ClassExample;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 09/11/15
 * Time: 17:48
 */
class Mailer
{
    protected $options;

    public function __construct(array $options = array())
    {
        $resolver = new OptionsResolver();

        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            "host" => "smtp.example.org",
            "username" => "user",
            "password" => 'pa$$word',
            "port" => "25"
        ));

        $resolver->setRequired(array('host', 'username', 'password'));
    }

    public function getOptions()
    {
        return $this->options;
    }
}