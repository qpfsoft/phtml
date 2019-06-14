<?php
namespace phtml\html;

/**
 * Abbr 简写标签
 * 
 * - 通过title设置全称, 鼠标经过事显示.
 * 
 * 示例:
 * ```html
 * <abbr title="QIUN PHP Frame">QPF</abbr> 是一款框架
 * ```
 */
class Abbr extends Element
{
    /**
     * 标签名称
     * @var string
     */
    protected $name = 'abbr';
}