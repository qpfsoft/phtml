<?php
namespace phtml\html;

/**
 * 元素接口
 */
interface ElementInterface
{
    /**
     * 闭合元素并返回标签代码
     * @return string
     */
    public function end();
}