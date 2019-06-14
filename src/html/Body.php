<?php
namespace phtml\html;

use phtml\Htm;

/**
 * HTML文档内容
 */
class Body extends Element
{
    use ElementNesting;
    
    /**
     * 元素名称
     * @var string
     */
    protected $name = 'body';
    
    /**
     * 引入外部脚本
     * @var array
     */
    protected $js = [];
    /**
     * 页面内嵌脚本标签
     * @var array
     */
    protected $script = [];
    
    /**
     * 写入一行代码
     * @param mixed $content 内容
     * @return Body
     */
    public function row($content): Body
    {
        if ($content instanceof \Closure) {
            $this->row($content());
        } elseif ($content instanceof ElementInterface) {
            $this->addSubElement($content);
        } elseif (is_string($content)) {
            $this->addSubContent($content);
        } else {
            throw new \Exception('param type error!');
        }
        
        return $this;
    }
    
    /**
     * 引入外部JS脚本到页面底部
     * @param string $src 资源地址
     * @return Body
     */
    public function js(string $src): Body
    {
        $this->js[] = $src;
        return $this;
    }
    
    /**
     * 添加页面脚本代码
     * @param string|\Closure $script 代码段
     * @return Body
     */
    public function addScript($script): Body
    {
        $this->script[] = $script;
        return $this;
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
        
        // 底部引入js与添加js代码
        $this->parseScirpt($html);
                
        // 结束标签
        $html[] = $this->tagEnd();
        
        return $html;
    }
    
    /**
     * 解析脚本
     * @param array $html 代码写入器
     */
    private function parseScirpt(array &$html)
    {
        $tab_sub = $this->getLevelIndent(1);
        
        // 内容底部引入脚本
        if (!empty($this->js)) {
            foreach ($this->js as $i => $src) {
                $html[] = $tab_sub . '<script type="text/javascript" src="' . $src . '"></script>';
            }
        }
        
        // 最底部的script标签
        if (!empty($this->script)) {
            
            $script = new Script();
            $script->type()->setLevel($this->getLevel() + 1);

            foreach ($this->script as $i => $code) {
                $script->addCode($code);
            }
            
            $html[] = $script->end();
        }
    }
}