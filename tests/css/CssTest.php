<?php
use qpf\deunit\TestUnit;
use phtml\Css;
use phtml\Phtml;

include __DIR__ . '/../boot.php';

class CssTest extends TestUnit
{
    /**
     * 生成样式类
     */
    public function testBuild()
    {
        echo Css::createClass('demo', 
            Css::text()->color('#000'),
            css::text()->font_size('1.6rem')
        );
    }
    
    /**
     * 配合页面测试
     */
    public function testBuild2()
    {
        $ph = new Phtml();
        $ph->addStyle(Css::createClass('demo',
            Css::text()->color('#000'),
            css::text()->font_size('1.6rem')
            ));
        
        echo $ph->end();
    }
}

$err = CssTest::runTestMethod('testBuild2');
//echor($err);