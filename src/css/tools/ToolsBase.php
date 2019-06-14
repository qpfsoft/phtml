<?php
namespace phtml\css\tools;

use phtml\css\CssBuilder;
use phtml\Phtml;
use phtml\Css;

/**
 * css工具类基础
 * 
 * 推荐使用方式:
 * - 子类通过{$this->css()->?}的方式来调用css属性集合
 * - 子类可通过{$this->createClass('.demo', $this->css()->?);}的方式来创建样式类.
 * 
 * 
 * @author qiun
 */
abstract class ToolsBase
{
    /**
     * phtml对象
     * @var Phtml
     */
    private $phtml;
    
    /**
     * phtml对象
     * @return Phtml
     */
    final protected function phtml()
    {
        if ($this->phtml === null) {
            $this->phtml = new Phtml();
        }
        return $this->phtml;
    }
    
    /**
     * 创建class格式css
     * @param string $name css样式字符串, 多个参数时第一参数作为class名称
     * @return string
     */
    final protected function createClass($name)
    {
        $arr = func_get_args();
        $string = '';
        
        // 判断1: 如果参数超过1个,第一个参数作为class名称
        if (func_num_args() > 1) {
            $string .= $arr[0] . '{' . PHP_EOL;
            unset($arr[0]);
        }
        
        // 从第二个参数开始后面的都认定为css属性
        foreach ($arr as $i => $val) {
            $string .= $val . PHP_EOL;
        }
        
        $string .= '}' . PHP_EOL;
        
        return $string;
    }
}