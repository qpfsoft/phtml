<?php
namespace phtml\css\tools;

use phtml\Css;

/**
 * CSS代码库 - 片段
 * 
 * 该类集合了所有CSS代码片段
 * 
 * @author qiun
 */
class Tools extends ToolsBase
{

    /**
     * 清除浮动工具
     * @return ClearFloat
     */
    public function clearFloat()
    {
        return new ClearFloat();
    }
    
    /**
     * 按钮生成
     * @return ButtonDivA
     */
    public function buttonDivA()
    {
        return new ButtonDivA();
    }

    /**
     * 定位 - 垂直居中 - 代码段
     *
     * 生成属性:
     * - 宽度,高度,定位方式,间距
     * - 注意 : 生成的属性不要在重复设置了.
     *
     * @param string $width 定位元素的宽度
     * @param string $height 定位元素的高度
     * @return string
     */
    public function position_vertical_center($width, $height)
    {
        $css = Css::layout()->position('absolute');
        $css .= Css::layout()->top('50%');
        $css .= Css::layout()->left('50%');
        $css .= Css::layout()->width($width);
        $css .= Css::layout()->height($height);
        $top = '-' . (intval($height) / 2) . 'px';
        $left = '-' . (intval($width) / 2) . 'px';
        $right = $bottom = 0;
        $css .= Css::layout()->margin($top, $right, $bottom, $left);
        return $css;
    }
}