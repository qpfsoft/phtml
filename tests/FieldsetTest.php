<?php
use qpf\deunit\TestUnit;
use phtml\html\Fieldset;

include 'boot.php';

class FieldsetTest extends TestUnit
{
    public function testBase1()
    {
        $e = new Fieldset();
        echo $e->legend('表单分组')->end();
    }
    
    public function testBase2()
    {
        $e = new Fieldset();
        echo $e->legend('表单分组', [
            'class' => 'foo',
        ])->name('abc')->disabled()->end();
    }
}

(FieldsetTest::runTestMethod('testBase2'));