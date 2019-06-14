<?php
namespace phtml\html;

/**
 * 元素嵌套特性
 */
trait ElementNesting
{
    use ElementIndent;
    /**
     * 子内容
     * @var array
     */
    private $_subContent = [];
    /**
     * 元素内容
     * @var string
     */
    protected $content = '';
    
    /**
     * 添加内容到元素
     * @param Element|\Closure|string $content
     * @param $this
     */
    public function add($content)
    {
        if ($content instanceof ElementInterface) {
            $this->addSubElement($content);
        } elseif ($content instanceof \Closure) {
            $this->add($content());
        } elseif (is_string($content)) {
            $this->addSubContent($content);
        } 
        
        return $this;
    }

    /**
     * 添加子元素
     * @param ElementInterface $element
     */
    protected function addSubElement(ElementInterface $element): void
    {
        $this->_subContent[] = $element;
    }
    
    /**
     * 添加子内容
     * @param string $string 内容文本
     * @param bool $tab 是否自动缩进
     */
    protected function addSubContent(string $string): void
    {
        $this->_subContent[] = $string;
    }
     
    /**
     * 生成标签开始
     * @return string
     */
    public function tagStart(): string
    {
        return $this->getLevelIndent() . "<{$this->getName()}{$this->buildAttr()}>";
    }
    
    /**
     * 生成闭合标签
     * @return string
     */
    public function tagEnd(): string
    {
        return $this->getLevelIndent() . "</{$this->getName()}>";
    }
    
    /**
     * 解析子内容并设置到元素内容中
     * @return string
     */
    protected function parseSubContent(): void
    {
        if (!empty($this->_subContent)) {
            // 将元素转换为html代码
            foreach ($this->_subContent as $row => $content) {
                if ($content instanceof ElementInterface) {
                    // 设置子元素的缩进级别
                    $content->setLevel($this->getLevel() + 1);
                    // 生成内容
                    $this->_subContent[$row] = $content->end();
                } elseif(is_string($content)) {
                    $this->_subContent[$row] = $this->getLevelIndent(1) . $content;
                } else {
                    throw new \Exception('sbu content type error!');
                }
            }
            
            if (empty($this->content)) {
                $this->content = implode(PHP_EOL, $this->_subContent);
            } else {
                $this->content = implode('', $this->_subContent) . PHP_EOL . $this->content;
            }
        }
    }
    
    /**
     * 设置元素内容
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): Element
    {
        $this->content = $content;
        return $this;
    }
    
    /**
     * 获取元素内容
     * @return string
     */
    public function getContent(): string
    {
        // 确保在生成时应用正确的缩进级别
        if (!empty($this->content)) {
            $this->content = $this->getLevelIndent(1) . $this->content;
        }
        // 解析子内容
        $this->parseSubContent();
        return $this->content;
    }

    /**
     * 返回元素HTML代码
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
        $html = [];

        // 开始标签
        $html[] = $this->tagStart();

        // 获取元素内容
        $html[] = $this->getContent();
        
        // 结束标签
        $html[] = $this->tagEnd();
        
        return $html;
    }
}