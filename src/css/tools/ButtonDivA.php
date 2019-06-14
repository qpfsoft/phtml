<?php
namespace phtml\css\tools;

use phtml\html\Div;
use phtml\Htm;
use phtml\Css;

/**
 * DIV+A标签的按钮
 * 
 * 通过div的边框和背景来装饰按钮, a标签来实现文字和点击.
 * 
 * - 所有样式在a标签上, div只居中显示
 * 
 * @author qiun
 *
 */
class ButtonDivA extends ToolsBase
{
    /**
     * 配置数组
     * - 改变class名称
     * - 改变文本大小, 按钮内填充
     * @var array
     */
    public $config = [
        'class-div' => 'btn-box', // 包裹a标签的div的class名称
        'class-a'   => 'btn', // a标签-按钮的class名
        
        'text'      => '按钮文本', //a标签-按钮文本
        'btn-font-size'  => '14px', // 字体大小
        'btn-padding-tb'     => '4px', // 上下内填充
        'btn-padding-lr'    =>  '10px', // 左右内填充
    ];
    
    public function getCss()
    {
        $style = '';
        // div标签-按钮居中
        $style .= $this->createClass($this->config['class-div'], Css::text()->text_align_center());
        // a标签-按钮基础样式
        $style .= $this->createClass(".{$this->config['class-a']}",
            Css::background()->background_color('#0084CC'),
            Css::layout()->display('inline-block'),
            //Css::IE67_Hack .  Css::layout()->display('inline'),
            Css::layout()->padding2($this->config['btn-padding-tb'], $this->config['btn-padding-lr']),
            Css::border()->border('1px', 'solid', '#cccccc'),
            // 边框透明?
            Css::border()->border_color('rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)', 'rgba(0, 0, 0, 0.1)'),
            Css::text()->color('#ffffff'),
            Css::text()->font_size($this->config['btn-font-size']),
            Css::text()->text_align_center(),
            Css::text()->text_decoration_none(),
            // 按钮美化样式
            Css::css2()->cursor('pointer'),
            Css::border()->border_radius('6px'),
            Css::text()->vertical_align_middle(),
            Css::background()->background_image_linear_gradient('#0088cc', '#0055cc', 'top'),
            Css::background()->background_repeat('repeat-x'),
            Css::text()->text_shadow('0', '-1px', '0', 'rgba(0, 0, 0, 0.25)'));
        
        
        // a标签-按钮-鼠标指针悬浮状态
        $style .= $this->createClass(".{$this->config['class-a']}:hover",
            // 纯色背景颜色+背景颜色偏移
            Css::background()->background_color('#0055cc'),
            Css::background()->background_position('0', '-15px'),
            Css::transition()->transitions('background-position', '0.1s', 'linear'));
        
        // a标签-按钮- 点击效果
        $style .= $this->createClass(".{$this->config['class-a']}:active",
            Css::background()->background_color('#004ab3'),
            // 去除渐变的背景
            Css::background()->background_image('none'),
            // 去除链接 虚线框
            Css::border()->outline_none(),
            // 自动叠加色
            Css::text()->color('rgba(255, 255, 255, 0.75)'),
            // 内阴影
            Css::background()->box_shadow('0', '0', '2px', '4px', 'rgba(0, 0, 0, 0.15)', 'inset'));
        // a标签-获得焦点
        $style .= $this->createClass(".{$this->config['class-a']}:focus",
            Css::border()->outline('thin', 'dotted', '#333'),
            Css::border()->outline('5px', 'auto', '-webkit-focus-ring-color'),
            Css::border()->outline_offset('-2px'));
        
        return $style;
    }
    
    public function getHtml()
    {
        return Div::create()->classAttr($this->config['class-div'])
        ->add(Htm::a($this->config['text'], ['class'=> $this->config['class-a'], 'href' => 'Javascript::void(0)']))->end();
    }
}