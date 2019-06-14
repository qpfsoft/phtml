<?php
namespace phtml;

use phtml\css\Selector;
use phtml\css\SelectorComplex;
use phtml\css\attr\Layout;
use phtml\css\attr\Text;
use phtml\css\attr\Border;
use phtml\css\attr\Table;
use phtml\css\attr\Background;
use phtml\css\attr\FlexBox;
use phtml\css\attr\Transform;
use phtml\css\attr\Transition;
use phtml\css\attr\IE;
use phtml\css\attr\Css3;
use phtml\css\attr\Css2;
use phtml\css\attr\Webkit;
use phtml\css\tools\Tools;

/**
 * CSS 快捷类
 * 
 * 该类集合了所有css样式分类生成器
 * 
 * 前缀:
 * -moz代表firefox浏览器私有属性
 * -ms代表ie浏览器私有属性
 * -webkit代表safari、chrome私有属性
 * IE css hack:
 * ie6: `_` 和 `*`
 * ie7: `*`
 */
class Css
{
    /* css hack前缀  */
    const IE6_Hack = '_';
    const IE67_Hack = '*';
    
    /**
     * 引入外部CSS样式表
     * @param string $href 资源地址
     * @return string
     */
    public static function linkCss(string $href): string
    {
        return '<link rel="stylesheet" href="'. $href .'" type="text/css">';
    }
    
    /**
     * 创建样式类
     * @param string $name css选择器
     * @param ... $option css属性集合
     * @return string
     */
    public static function createClass($name, ...$option): string
    {
        $row = [];
        $row[] = $name . '{';

        foreach ($option as $i => $val) {
            $row[] = '    '. $val;
        }
        
        $row[] .= '}';
        
        return join(PHP_EOL, $row);
    }
    
    /**
     * css选择器生成
     * @var Selector
     */
    private static $query;
    
    /**
     * 元素选择器
     * @return Selector
     */
    public static function query(): Selector
    {
        if (self::$query === null) {
            self::$query = new Selector();
        }
        
        return self::$query;
    }
    
    /**
     * css复合选择器
     * @var SelectorComplex
     */
    private static $selector;
    
    /**
     * 元素复合选择器
     * @return SelectorComplex
     */
    public static function selector(): SelectorComplex
    {
        if (self::$selector === null) {
            self::$selector = new SelectorComplex();
        }
        
        return self::$selector;
    }
    
    /**
     * 布局css分类
     * @var Layout
     */
    private static $layout;
    
    /**
     * 布局css分类
     * 
     * - 宽高,显示类型,边距,填充,定位,浮动,溢出,隐藏,透明;
     * @return Layout
     */
    public static function layout(): Layout
    {
        if (self::$layout === null) {
            self::$layout = new Layout();
        }
        
        return self::$layout;
    }
    
    /**
     * 布局css分类
     * @var Text
     */
    private static $text;
    
    /**
     * 文本css分类
     *
     * - 颜色,大小,字体,对齐,行高,间距,换行,英文换行;<br>
     * - 下划线,阴影,英文大小写,图文排版,文本溢出;<br>
     * - ul列表符号,符号类型,图片符号;
     * - 垂直对齐,
     * @return Text
     */
    public static function text(): Text
    {
        if (self::$text === null) {
            self::$text = new Text();
        }
        
        return self::$text;
    }
    
    /**
     * 边框css分类
     * @var Border
     */
    private static $border;
    
    /**
     * 边框css分类
     *
     * - 设置边框样式,粗细,颜色,
     * - 圆角, 表格边框合并, 表格单元格间距
     * - 轮廓描边，在边看的外边不占用占用体积
     * @return Border
     */
    public static function border(): Border
    {
        if (self::$border === null) {
            self::$border = new Border();
        }
        
        return self::$border;
    }
    
    /**
     * 表格css分类
     * @var Table
     */
    private static $table;
    
    /**
     * 表格css分类
     *
     * - 表格显示算法，单元格无内容时显示边框
     * @return Table
     */
    public static function table(): Table
    {
        if (self::$table === null) {
            self::$table = new Table();
        }
        
        return self::$table;
    }
    
    /**
     * 背景css分类
     * @var Background
     */
    private static $background;
    
    /**
     * 背景css分类
     *
     * - 背景颜色, 渐变颜色
     * - 图片背景: 设置,定位,固定,大小,区域,重复,
     * - 背景阴影, 渐变背景颜色
     * - rgba颜色属性值代码段
     * @return Background
     */
    public static function background(): Background
    {
        if (self::$background === null) {
            self::$background = new Background();
        }
        
        return self::$background;
    }
    
    /**
     * 伸缩盒子css分类
     * @var FlexBox
     */
    private static $flexBox;
    
    /**
     * 伸缩盒子css分类
     * @return FlexBox
     */
    public static function flexBox(): FlexBox
    {
        if (self::$flexBox === null) {
            self::$flexBox = new FlexBox();
        }
        
        return self::$flexBox;
    }
    
    /**
     * 元素变换形状 - 扭曲
     * @var Transform
     */
    private static $transform;
    
    /**
     * 元素变换形状 - 扭曲
     * @return Transform
     */
    public static function transform(): Transform
    {
        if (self::$transform === null) {
            self::$transform = new Transform();
        }
        
        return self::$transform;
    }
    
    /**
     * css3 过度动画效果
     * @var Transition
     */
    private static $transition;
    
    /**
     * css3 过度动画效果
     * @return Transition
     */
    public static function transition(): Transition
    {
        if (self::$transition === null) {
            self::$transition = new Transition();
        }
        
        return self::$transition;
    }
    
    /**
     * 动画效果
     * @todo 未实现
     */
    public function aniation()
    {
        
    }
    
    /**
     * 媒体查询
     * @todo 未实现
     */
    public function mediaQueries()
    {
        
    }
    
    /**
     * IE 私有属性
     * @var IE
     */
    private $ie;
    
    /**
     * IE 私有属性
     * @return IE
     */
    public static function onlyIE(): IE
    {
        if (self::$ie === null) {
            self::$ie = new IE();
        }
        
        return self::$ie;
    }
    
    /**
     * Firefox私有属性
     * @todo 未实现
     */
    public static function onlyFirefox()
    {
        
    }
    
    /**
     * Webkit私有属性
     * @var Webkit
     */
    private static $webkit;
    
    /**
     * Webkit私有属性
     * @return Webkit
     */
    public static function onlyWebkit(): Webkit
    {
        if (self::$webkit === null) {
            self::$webkit = new Webkit();
        }
        
        return self::$webkit;
    }
    
    
    /**
     * css3 兼容性一般的属性
     * @var Css3
     */
    private static $css3;
    
    /**
     * css3 兼容性一般的属性
     * @return Css3
     */
    public static function css3(): Css3
    {
        if (self::$css3 === null) {
            self::$css3 = new Css3();
        }
        
        return self::$css3;
    }
    
    /**
     * css2 未归类的属性
     * @var Css2
     */
    private static $css2;
    
    /**
     * css2 未归类的属性
     * @return Css2
     */
    public static function css2(): Css2
    {
        if (self::$css2 === null) {
            self::$css2 = new Css2();
        }
        
        return self::$css2;
    }
    
    /**
     * CSS代码段工具 - 计算生成代码
     * @var Tools
     */
    private static $tools;
    
    /**
     * CSS代码段工具 - 计算生成代码
     * @return Tools
     */
    public static function tools(): Tools
    {
        if (self::$tools === null) {
            self::$tools = new Tools();
        }
        
        return self::$tools;
    }
    
}