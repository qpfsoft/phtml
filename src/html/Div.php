<?php
namespace phtml\html;

/**
 * DIV 标签
 */
class Div extends Element
{
    use ElementNesting;
    
    /**
     * 标签名称
     * @var string
     */
    protected $name = 'div';

    /**
     * 添加一个子DIV元素.
     *
     * - 子元素不能使用[[tagStart()]]和[[tagEnd()]]2个方法.
     * @return $this 返回一个新div对象
     */
    public function addDiv()
    {
        $div = new static();
        $this->addSubElement($div);
        return $div;
    }
}