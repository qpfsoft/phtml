<?php
use qpf\deunit\TestUnit;
use phtml\html\Head;
use phtml\html\Script;

include 'boot.php';

class HeadTest extends TestUnit
{
    public function testBase1()
    {
        $head = new Head();
        $head->title('网站标题');
        echo $head->end();
    }
    
    public function testBase2()
    {
        echo Head::create()
        ->title('网站标题')
        ->js('qpf-ui.com/js/qpf.js')
        ->js(Script::create()->src('//qpf-ui.com/js/qpf.conf.js')->type())
        ->css('qpf-ui.com/api.php')
        ->css('qpf-ui.com/api.php')
        ->css('qpf-ui.com/api.php')
        ->end();
    }
    
    public function testBase3()
    {
        $head = new Head();
        $head->title('网站标题')
        ->js('qpf-ui.com/js/qpf.js')
        ->js(Script::create()->src('//qpf-ui.com/js/qpf.conf.js')->type()) // 不要手动end
        ->css('qpf-ui.com/api.php')
        ->css('qpf-ui.com/api.php')
        ->css('qpf-ui.com/api.php');
        
        // 单独设置
        $head->metas()
        ->author('qpfsoft')
        ->appModel('test')
        ->charset('gbk')
        ->viewport()
        ->webkit()
        ->compatible()
        ->description('描述')
        ->keywords('关键字');
        
        echo $head->end();
    }
}


//echor(HeadTest::runTestUnit());

HeadTest::runTestMethod('testBase3');