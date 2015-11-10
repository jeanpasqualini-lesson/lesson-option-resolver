<?php
namespace ClassExample;

use Symfony\Component\OptionsResolver\Options;
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
        // Les valeurs par défault
        $resolver->setDefaults(array(
            "host" => "smtp.example.org",
            "username" => "user",
            "password" => 'pa$$word',
            "port" => "25",
            'encryption' => null,
        ));

        // Les options obligatoire
        $resolver->setRequired(array('host', 'username', 'password'));

        // Les type de valeur autorisé pour le port
        $resolver->setAllowedTypes("port", array("int"));

        // Les valeur autorisé pour l'username
        $resolver->setAllowedValues("username", array("john", "doe", "johndoe"));

        // On normalise le host en fornction de l'encryption ssl ou non
        $resolver->setNormalizer("host", function(Options $options, $value)
        {
           if(!in_array(substr($value, 0, 7), array("http://", "https://")))
           {
               if("ssl" === $options["encryption"])
               {
                   $value = "https://".$value;
               }
               else
               {
                   $value = "http://".$value;
               }

               return $value;
           }
        });

        // On change la valeur par défault du port en fonction de l'encryption ssl ou non
        $resolver->setDefault("port", function(Options $options)
        {
           if("ssl" === $options["encryption"])
           {
               return 465;
           }

            return 25;
        });
    }

    public function getOptions()
    {
        return $this->options;
    }
}