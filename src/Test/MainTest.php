<?php
/**
 * Created by PhpStorm.
 * User: prestataire
 * Date: 09/11/15
 * Time: 17:28
 */

namespace Test;

use ClassExample\DynamicPropertyExample;
use ClassExample\Mailer;
use ClassExample\PropertyExample;
use ClassExample\ReferenceExample;
use \Interfaces\TestInterface;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;

class MainTest implements TestInterface
{
    public function runTest()
    {
        $this->testOne();
        echo PHP_EOL."======= Test Two =============".PHP_EOL;
        $this->testTwo();
    }

    public function testOne()
    {
        try {
            $mailer = new Mailer(array(
                "usernme" => "jophndoe"
            ));
        }
        catch(UndefinedOptionsException $ex)
        {
            echo "Exception : ".$ex->getMessage().PHP_EOL;
        }
    }

    public function testTwo()
    {
        $mailer = new Mailer(array(
            "username" => "johndoe"
        ));

        echo print_r($mailer->getOptions(), true);
    }
}