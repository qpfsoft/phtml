<?php
namespace phtml;

use phtml\html\ElementInterface;
use phtml\html\Body;
use phtml\html\Head;
use phtml\html\ElementNesting;
use phtml\html\Element;
use phtml\html\Style;

/**
 * Phtml
 */
class Phtml implements ElementInterface
{
    use ElementNesting;
    
    /**
     * body标签对象
     * @var Body
     */
    private $body;
    /**
     * head标签对象
     * @var Head
     */
    private $head;

    /**
     * 语言环境
     * @var string
     */
    protected $lang = 'zh-CN';
    
    /**
     * 写入一行代码到body
     * @param mixed $content 内容, 元素, 闭包
     * @return Phtml
     */
    public function row($content): Phtml
    {
        $this->body()->row($content);
        return $this;
    }
    
    /**
     * 添加页面样式
     * 
     * - 建议采用闭包的形式
     * @param mixed $css 样式字符串
     * @return Phtml
     */
    public function addStyle($css): Phtml
    {
        $this->head()->addStyle($css);
        return $this;
    }
    
    /**
     * body标签元素
     * @param mixed $row
     * @return $this
     */
    public function body(): Body
    {
        if ($this->body === null) {
            $this->body = new Body();
        }
        return $this->body;
    }
    
    /**
     * head标签元素
     * @see Head
     * @return Head
     */
    public function head(): Head
    {
        if ($this->head === null) {
            $this->head = new Head();
        }
        
        return $this->head;
    }

    /**
     * 设置网页语言环境
     * @param string $lang
     */
    public function lang(string $lang)
    {
        $this->lang = $lang;
    }
    
    /**
     * 开始标签
     * @return string
     */
    public function tagStart(): string
    {
        return '<!doctype html>' . PHP_EOL .
        '<html lang="' . $this->lang . '">';
    }
    
    /**
     * 结束标签
     * @return string
     */
    public function tagEnd(): string
    {
        return '</html>';
    }
    
    /**
     * 生成HTML代码
     * @return string
     */
    public function end(): string
    {
        return join(PHP_EOL, $this->getCode());
    }
    
    /**
     * 获取HTML代码
     * @return array
     */
    public function getCode(): array
    {
        $this->addSubElement($this->head());
        $this->addSubContent('', false); // 空行
        $this->addSubElement($this->body());
        
        $html = [];
        $html[] = $this->tagStart();
        $html[] = $this->getContent();
        $html[] = $this->tagEnd();
        
        return $html;
    }
}