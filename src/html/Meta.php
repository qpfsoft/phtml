<?php
namespace phtml\html;

/**
 * Meta 代表单个`meta`标签
 */
class Meta extends Element
{
    /**
     * 元素名称
     * @var string
     */
    protected $name = 'meta';
    
    /**
     * 设置网页编码
     * @param string $value 字符集
     * - utf-8 : 支持国际语言
     * - gbk : gbk是gb2312的扩展,并且向后兼容，具有更好的兼容性
     * - gb2312 : 支持中文和英文
     * @return $this
     */
    public function charset(string $value = 'utf-8')
    {
        $this->attr('charset', $value);
        return $this;
    }
    
    /**
     * http-equiv属性
     * @param string $value
     * @return $this
     */
    public function httpEquiv(string $value)
    {
        $this->attr('http-equiv', $value);
        return $this;
    }
    
    /**
     * name属性
     * @param string $value
     * @return $this
     */
    public function nameAttr(string $value)
    {
        $this->attr('name', $value);
        return $this;
    }
    
    /**
     * content属性
     * @param string $value
     * @return $this
     */
    public function contentAttr(string $value)
    {
        $this->attr('content', $value);
        return $this;
    }
}