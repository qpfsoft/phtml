<?php
namespace phtml\css;

/**
 * CSS 复杂选择器
 * 
 * 该类代表一条css选择符
 */
class SelectorComplex
{
    /**
     * 复合选择符
     * @var array
     */
    private $_option = [];
    
    /**
     * 选择符采集器
     * @param string $e
     * @return void
     */
    private function add($e): void
    {
        $this->_option[] = $e;
    }
    
    /**
     * 生成css选择符
     * @return string
     */
    public function build(): string
    {
        return implode(' ', $this->_option);
    }

    /**
     * 通配选择器 - css1
     * 
     * @param string $css 应用于所有元素的样式
     * @return $this
     */
    public function qAll()
    {
        $this->add('*');
        return $this;
    }
    
    /**
     * 标签选择器 - css1
     * @param string $name
     * @return $this
     */
    public function qTage($name)
    {
        $this->add($name);
        return $this;
    }
    
    /**
     * ID选择器 - css1
     * @param string $name id名称，自动前缀`#`
     * @return $this
     */
    public function qId($name)
    {
        $this->add('#' . $name);
        return $this;
    }
    
    /**
     * 类选择器 - css1
     * 
     * ~~~说明
     * .a{} .b{} : 定义多个类
     * .a.b{} ：多类选择符，但IE6不支持，只应用b类
     *          - 命中同时拥有.a和.b两个类的元素
     *          - 类选择器直接不存在上下级
     * p.a{} : 命中< p class=`a`>标签
     *          - 类选择可作为标签的下级
     * ~~~
     * @param string $name class名称，自动前缀`.`
     * @param string $css
     * @return $this
     */
    public function qClass($name)
    {
        $this->add('.' . $name);
        return $this;
    }
    
    /**
     * 属性选择器 - 选择具有指定属性的元素 - css2
     * 
     * ~~~
     * <img src="a.png" alt="ps">
     * 选择img元素中指定了`alt`属性的图片，即`img[alt]`
     * ~~~
     *  
     * @param string $name 标签名称
     * @param string $att 属性名称
     * @return string
     */
    public function qAtt($name, $att)
    {
        $this->add($name . '[' . $att . ']');
        return $this;
    }
    
    /**
     * 属性选择器 - 具有指定属性值等于val的元素 - css2
     * 
     * ~~~
     * <img src="a.png" alt="ps">
     * 选择img元素中指定了`alt`属性的图片，并且值为`ps`，即`img[alt="ps"]`
     * ~~~ 
     * 
     * @param string $name 标签名称
     * @param string $attName 属性名称
     * @param string $attValue 属性值
     * @return $this
     */
    public function qAttEq(string $name, string $attName, string $attValue)
    {
        $this->add($name . "[{$attName}=\"{$attValue}\"]");
        return $this;
    }
    
    /**
     * 属性选择器 - 具有指定属性值为用空格分隔，并保护val元素 - css2
     *
     * ~~~
     * <img src="a.png" alt="ps" class="a"> - 命中
     * <img src="a.png" alt="ps" class="b">
     * <img src="a.png" alt="ps" class="a b"> - 命中
     * 选择img元素中指定了`class`属性的图片，并且值包含`a`，即`img[class~="a"]`
     * - 包含 即属性值中 用空格分割的值
     * ~~~
     *
     * @param string $name 标签名称
     * @param string $attName 属性名称
     * @param string $attValue 属性值
     * @return $this
     */
    public function qAttInclude(string $name, string $attName, string $attValue)
    {
        $this->add($name . "[{$attName}~=\"{$attValue}\"]");
        return $this;
    }
    
    /**
     * 属性选择器 - 具有指定属性值开头的元素 - css3
     *
     * ~~~
     * <img src="a.png" alt="ps" class="abc"> - 命中
     * <img src="a.png" alt="ps" class="acb"> - 命中
     * <img src="a.png" alt="ps" class="bac"> 
     * 选择img元素中指定了`class`属性的图片，并且值以`a`开头，即`img[class^="a"]`
     * ~~~
     *
     * @param string $name 标签名称
     * @param string $attName 属性名称
     * @param string $attValue 属性值
     * @return $this
     */
    public function qAttStart(string $name, string $attName, string $attValue)
    {
        $this->add($name . "[{$attName}^=\"{$attValue}\"]");
        return $this;
    }
    
    /**
     * 属性选择器 - 具有指定属性值结尾的元素 - css3
     *
     * ~~~
     * <img src="a.png" alt="ps" class="abc"> - 命中
     * <img src="a.png" alt="ps" class="acb"> 
     * <img src="a.png" alt="ps" class="bac"> - 命中
     * 选择img元素中指定了`class`属性的图片，并且值以`c`结尾，即`img[class$="a"]`
     * ~~~
     *
     * @param string $name 标签名称
     * @param string $attName 属性名称
     * @param string $attValue 属性值
     * @return $this
     */
    public function qAttEnd(string $name, string $attName, string $attValue)
    {
        $this->add($name . "[{$attName}$=\"{$attValue}\"]");
        return $this;
    }
    
    /**
     * 属性选择器 - 具有指定属性值包含的元素 - css3
     *
     * ~~~
     * <img src="a.png" alt="ps" class="abc"> - 命中
     * <img src="a.png" alt="ps" class="acb"> - 命中
     * <img src="a.png" alt="ps" class="bac"> - 命中
     * 选择img元素中指定了`class`属性的图片，并且值包含`b`，即`img[class*="b"]`
     * ~~~
     *
     * @param string $name 标签名称
     * @param string $attName 属性名称
     * @param string $attValue 属性值
     * @return $this
     */
    public function qAttHave(string $name, string $attName, string $attValue)
    {
        $this->add($name . "[{$attName}*=\"{$attValue}\"]");
        return $this;
    }
    
    /**
     * 属性选择器 - 属性值以val开头并用连接符"-"分隔的字符串的E元素 - css3
     *
     * ~~~
     * <img src="a.png" alt="ps" class="a-bc"> - 命中
     * <img src="a.png" alt="ps" class="a-cb"> - 命中
     * <img src="a.png" alt="ps" class="b-ac">
     * 选择img元素中指定了`class`属性的图片，并且值以`a`开头，即`img[class|="a"]`
     * - 但也包括以`-`做分隔符的属性值，即匹配 `a` 和 `a-`
     * ~~~
     *
     * @param string $name 标签名称
     * @param string $attName 属性名称
     * @param string $attValue 属性值
     * @return $this
     */
    public function qAttSplit(string $name, string $attName, string $attValue)
    {
        $this->add($name . "[{$attName}|=\"{$attValue}\"]");
        return $this;
    }
    
    // ---生成选择符---
    
    /**
     * 未被访问前的样式
     * @param string $e E元素
     * @return $this
     */
    public function eLink(string $e)
    {
        $this->add($e . ':link');
        return $this;
    }
    
    /**
     * 
     * @param string $e
     * @return $this
     */
    public function eVisited(string $e)
    {
        $this->add($e . ':visited');
        return $this;
    }
}