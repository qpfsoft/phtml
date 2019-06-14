<?php
use qpf\deunit\TestUnit;
use phtml\Phtml;
use phtml\Htm;
use phtml\html\Div;
use phtml\html\gather\Divs;
use phtml\html\Element;
use phtml\Css;

include 'boot.php';

/**
 * Phtml 测试
 */
class PhtmlTest extends TestUnit
{
    public function testBuild1()
    {
        $ph = new Phtml();
        echo $ph->end();
    }
    
    public function testBuild2()
    {
        $ph = new Phtml();
        $ph->head()->metas()
        ->charset('UTF-8')
        ->contentType()
        ->compatible()
        ->webkit()
        ->title('迷你小站')
        ->keywords('迷站,迷你,迷你小站,迷你小网站')
        ->description('一个迷你小小的网址, 用于测试Phtml的网址!')
        ->author('phtml')
        ->dnsPrefetch(true)
        
        ->appModel('phtml')
        ->email()
        ->telephone()
        ->generator('qpfsoft-phtml')
        ->notBaidu()
        ->appItunes('aaa', 'bbb', 'ccc')
        ->win8_color('#333')
        ->win8_ico('icon.png');
        
        $ph->head()->links()
        ->dns('http://quiun.com')
        ->css('//qpf-ui.com/api.php')
        ->icon('favicon.ico')
        ->iconShortcut('favicon.ico');
        
        $ph->head()->js('//qpf-ui.com/js/qpf.js');
        
        echo $ph->end();
    }
    
    public function testBuild3()
    {
        $ph = new Phtml();
        
        // 写入一行内容 : 标签文本
        $ph->row(Htm::div('div元素1', ['id' => 'item1']));
        
        // 写入一行内容 : 元素对象
        $div = Div::create()->add('div3');
        $div->addDiv()->html('子对象');
        $ph->row($div);
        
        $ph->row('文本内容');
        
        echo $ph->end();
    }
    
    public function testBuildQPF()
    {
        $ph = new Phtml();
        
        // 使用闭包的方式 , 写入css代码到页面
        $ph->addStyle(function(){
            return <<<TPL
.demo {
    color: #333;
}
TPL;
        });
        
        // 使用css快捷类, 来生成css代码, 并添加到页面
        $ph->addStyle(Css::createClass('.demo-abc', 
            Css::background()->background_color('#333'),
            Css::text()->font_size('1.6rem')
        ));

        // head 相关设置
        $ph->head()->metas()->charset()->contentType()->viewport()->webkit()->compatible();

        $ph->head()->title('日志')->css('//qpf-ui.com/api.php')->js('//qpf-ui.com/js/qpf.js');
        
        
        // body 相关设置
        $ph->body()->classAttr('bg');
        
        // 在body底部引入外部脚本, 书写顺序无要求
        $ph->body()->js('//qpf-ui.com/lib/jquery/jquery-1.11.3.js');
        $ph->body()->js('//qpf-ui.com/lib/jquery/jquery.cookie.js');
        
        // 在body最底部, 编写js代码
        $ph->body()->addScript('var tmp = "ok";');
        
        $ph->body()->addScript(function(){
            return <<<TPL
qpf.echor(tmp);
TPL;
        });
        
        Divs::div('root')->classAttr('g-box')
        ->add(Htm::h1('日志标题 ' . Htm::small(date('Y-m-d')), ['class' => 'mt-3']))
        ->add(Htm::hr());
        
        $ph->row(Divs::div('root'));
        
        Divs::div('root')->addDiv()
        ->add(Htm::p('内容区域, 您可以在这里编写文章内容...'))
        ->classAttr('p-3 bk bk-me bg-disabled txt-hei')
        ->style('height: 300px')
        ->contenteditable();
        
        Divs::div('root')->addDiv()
        ->add(Htm::hr())
        ->add(Element::create('button')->html('提交')->classAttr('qpf btn black')->onClick('qpf.print.show(\'提交成功\');'));

        echo $ph->end();
    }
}
$err = PhtmlTest::runTestMethod('testBuildQPF');
//echor($err);