<?php
use qpf\deunit\TestUnit;
use phtml\html\Div;

include 'boot.php';

class DivTest extends TestUnit
{
    public function testBase()
    {
        $div = new Div();
        
        $div->addDiv()->html('1');
        
        return $div->end();
    }
}

echor(DivTest::runTestUnit());