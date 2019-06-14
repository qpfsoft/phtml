<?php
namespace phtml\html;

/**
 * Fieldset 表单元素分组标签
 * 
 * 一个form表单中可有多个分组，每个分组中嵌套`legend`元素为该分组提供了一个标题
 */
class Fieldset extends Element
{
    use ElementNesting;
    
    /**
     * 元素名称
     * @var string
     */
    protected $name = 'fieldset';
    /**
     * 内置`legend`元素
     * @var array
     */
    private $legend = [];
    
    /**
     * 启用不可编辑 - h5
     * @return Fieldset
     */
    public function disabled(): Fieldset
    {
        $this->attr('disabled', 'disabled');
        return $this;
    }
    
    /**
     * 所属表单  - h5
     * 
     * 指定后不必再元素内
     * @param string $value 元素的id属性值
     * @return Fieldset
     */
    public function form(string $value): Fieldset
    {
        $this->attr('form', $value);
        return $this;
    }
    
    /**
     * 与组关联的名称
     * @param string $value
     * @return Fieldset
     */
    public function name(string $value): Fieldset
    {
        $this->attr('name', $value);
        return $this;
    }

    /**
     * 设置内置的legend元素
     * @param string $content 元素内容
     * @param array $attrs 该标签的属性
     * @return Fieldset
     */
    public function legend(string $content, array $attrs = null): Fieldset
    {
        $this->legend = [
            'content' => $content,
            'attrs' => $attrs,
        ];
        
        return $this;
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
     * 获取元素代码
     * @return array
     */
    public function getCode(): array
    {
        $html = [];
        if (!empty($this->legend)) {
            $this->addSubElement(Element::create('legend')
                ->setContent($this->legend['content'])
                ->attrs($this->legend['attrs'] ?? []));
        }
        
        $html[] = $this->tagStart();
        $html[] = $this->getContent();
        $html[] = $this->tagEnd();

        return $html;
    }
}