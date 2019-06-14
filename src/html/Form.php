<?php
namespace phtml\html;

/**
 * 表单元素
 */
class Form extends Element
{
    use ElementNesting;
    
    /**
     * 元素名称
     * @var string
     */
    protected $name = 'form';
    
    /**
     * 服务器接受的以逗号分隔的内容类型列表 - h4
     * @deprecated 此属性已在HTML5中删除，不应再使用
     * @return $this
     */
    public function accept()
    {
        return $this;
    }
    
    /**
     * 服务器接受的字符编码列表
     * 
     * - h5 : 只允许使用空格作为分隔符 (禁用逗号)
     * 
     * @param string $value 字符编码列表,
     * - `UTF-8` : Unicode 字符编码
     * - `gb2312` : 简体中文字符集
     * @return Form
     */
    public function acceptCharset(string $value): Form
    {
        $this->attr('accept-charset', $value);
        return $this;
    }
    
    /**
     * 指定处理表单信息程序的URL
     * 
     * - 元素上的`formaction`属性可覆盖该值
     * 
     * @param string $url 接收表单的URL地址
     * @return Form
     */
    public function action(string $url): Form
    {
        $this->attr('action', $url);
        return $this;
    }
    
    /**
     * 文本输入时是否自动大写
     * 
     * - iOS Safari Mobile使用的非标准属性
     * 
     * @param string $type 可能的值:<br>
     * - none : 完全禁用自动大写<br>
     * - sentences : 自动将句子的第一个字母大写<br>
     * - words : 自动大写单词的第一个字母<br>
     * - characters : 自动大写所有字符<br>
     * - on : 自iOS 5以来已弃用<br>
     * - off : 自iOS 5以来已弃用<br>
     * @return Form
     */
    public function autocapitalize(string $type): Form
    {
        $this->attr('autocapitalize', $type);
        return $this;
    }
    
    /**
     * 游览器自动完成其值 - h5
     * @param bool $bool 是否使用历史输入
     * @return Form
     */
    public function autocomplete(bool $bool): Form
    {
        $this->attr('autocapitalize', self::parseSwitch($bool));
        return $this;
    }
    
    /**
     * 指定POST提交给服务器的内容MIME类型
     * @param string $mime 可能的值: <br>
     * - default : 如果未指定属性，则为默认值, 发送前编码所有字符串<br>
     * - upload : 包含文件上传的表单, 即`multipart/form-data`, 不对字符编码<br>
     * - txt : 纯文本格式, 空格转换为`+`加号, 但不对特殊字符编码<br>
     * @return Form
     */
    public function enctype(string $mime = 'upload'): Form
    {
        $allow = [
            'default'   => 'application/x-www-form-urlencoded',
            'upload'    => 'multipart/form-data',
            'txt'       => 'text/plain',
        ];
        $this->attr('enctype', isset($allow[$mime]) ? $allow[$mime] : $allow['default']);
        return $this;
    }
    
    /**
     * 表单提交方法
     * @param string $type 默认`get`类型, 可能的值:<br>
     * - post : 对应HTTP POST方法<br>
     * - get : 对应HTTP GET方法<br>
     * @return Form
     */
    public function method(string $type = 'get'): Form
    {
        $this->attr('method', $type);
        return $this;
    }
    
    /**
     * POST提交表单
     * @return Form
     */
    public function post(): Form
    {
        $this->attr('method', 'post');
        return $this;
    }

    /**
     * 表单的名称 - h4
     * @deprecated 请使用ID属性替代它
     * @param string $string
     * @return Form
     */
    public function name(string $value): Form
    {
        $this->attr('name', $value);
        return $this;
    }
    
    /**
     * 关闭表单提交时的验证 - h5
     * 
     * - 未指定此属性会进行验证
     * @return Form
     */
    public function novalidate(): Form
    {
        $this->attr('novalidate', 'novalidate');
        return $this;
    }
    
    /**
     * 提交表单时窗口打开的位置
     * @param string $value 可能的值:<br>
     * - _self : 在同一框架中打开, 默认<br>
     * - _blank : 在新窗口或选项卡中打开<br>
     * - _parent : 在父框架中打开<br>
     * - _top : 在整个窗口中打开<br>
     * @return Form
     */
    public function target(string $value): Form
    {
        $this->attr('target', $value);
        return $this;
    }
}