<?php
namespace phtml\html;

use phtml\Htm;

/**
 * 页面内嵌样式
 */
class Style extends Element
{
    use ElementNesting;
    
    /**
     * 元素名称
     * @var string
     */
    protected $name = 'style';
    
    /**
     * 添加css样式到内部
     * @param mixed $content
     * @return $this
     */
    public function addCss($css): Style
    {
        if ($css instanceof ElementInterface) {
            $this->addSubElement($css);
        } elseif ($css instanceof \Closure) {
            $this->addCss($css());
        } elseif (is_string($css)) {
            $row = explode(Htm::eol(), $css);
            foreach ($row as $i => $val) {
                $this->addSubContent($val);
            }
        }
        
        return $this;
    }
}