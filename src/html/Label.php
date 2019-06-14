<?php
namespace phtml\html;

/**
 * label 标签
 * 
 * label增加了触摸的区域, label内容一般是文字描述, 通过绑定
 * 一个元素的id即可, 点击label的内容可以让该元素获得焦点.
 * 
 * 显式的联系：
 * <label for="SSN">Social Security Number:</label>
 * 隐式的联系：
 * <label>Date of Birth: <input type="text" name="DofB" /></label>
 */
class Label extends Element
{
    /**
     * 元素名称
     * @var string
     */
    protected $name = 'label';
    
    /**
     * 关联指定元素
     * @param string $id 元素ID值
     * @return Label
     */
    public function for(string $id): Label
    {
        $this->attr('for', $id);
        return $this;
    }
    
    /**
     * 关联指定`form`表单
     * @param string $id 表单元素的ID值
     * @return Label
     */
    public function form(string $id): Label
    {
        $this->attr('form', $id);
        return $this;
    }
}