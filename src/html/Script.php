<?php
namespace phtml\html;

use phtml\Htm;

/**
 * Script 元素
 *
 * 用于嵌入或引用的可执行代码; 这通常用于嵌入或引用JavaScript代码.
 * 
 * # 异步执行
 * ```html
 * <script async src="file.js"></script>
 * ```
 * 或者，通过脚本来做同样的事情：
 * ```html
 * var script = document.createElement('script');
 * script.src = "file.js";
 * document.body.appendChild(script);
 * ```
 * 从脚本中创建的脚本默认为异步;
 */
class Script extends Element
{
    use ElementNesting;
    
    /**
     * 元素名称
     * @var string
     */
    protected $name = 'script';
    
    
    /**
     * 添加代码到标签内
     * @param mixed $code 代码段
     * @return Script
     */
    public function addCode($code): Script
    {
        if ($code instanceof ElementInterface) {
            $this->addSubElement($code);
        } elseif ($code instanceof \Closure) {
            $this->addCode($code());
        } elseif (is_string($code)) {
            $row = explode(Htm::eol(), $code);
            foreach ($row as $i => $val) {
                $this->addSubContent($val);
            }
        }
        
        return $this;
    }
    
    /**
     * 指示异步加载脚本 - h5
     * - 注意: `src`属性不存在时, 不得使用此属性
     * @return $this
     */
    public function async(): Script
    {
        $this->attr('async', 'async');
        return $this;
    }
    
    /**
     * CORS设置属性
     * 
     * - 在跨域请求时,是否发送Cookie
     * - IE : 不支持, Edge支持
     * @param string $value 关键字:
     * - anonymous : 对此元素的CORS请求不会设置凭据标志
     * - use-credentials : 对此元素的CORS请求将设置凭证标志; 这意味着请求将提供凭据。
     * @return Script
     */
    public function crossorigin(string $value): Script
    {
        $this->attr('crossorigin', $value);
        return $this;
    }
    
    /**
     * 指示解析文档后在执行
     * - 注意: `src`属性不存在时, 不得使用此属性
     * @return $this
     */
    public function defer(): Script
    {
        $this->attr('defer', 'defer');
        return $this;
    }
    
    /**
     * 验证脚本完整性 - 只有一致才能执
     * @param string $value 文件的哈希值
     * @return Script
     */
    public function integrity(string $value): Script
    {
        $this->attr('integrity', $value);
        return $this;
    }
    
    /**
     * 指示不在支持ES2015模块的浏览器中执行脚本
     * - 注意: `src`属性不存在时, 不得使用此属性
     * @return $this
     */
    public function nomodule(): Script
    {
        $this->attr('nomodule', 'nomodule');
        return $this;
    }
    
    /**
     * 密码随机数
     * 
     * - 使用`Content-Security-Policy: script-src` CSP标头 控制页面脚本是否允许执行
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy/script-src
     * @param string $value 一次使用的数字
     * @return $this
     */
    public function nonce(string $value): Script
    {
        $this->attr('nonce', $value);
        return $this;
    }
    
    /**
     * 指定外部脚本的URL
     * @param string $value
     * @return Script
     */
    public function src(string $value): Script
    {
        $this->attr('src', $value);
        return $this;
    }
    
    /**
     * 指示脚本类型
     * - h5建议忽略该属性
     * @param string $value 默认值`text/javascript`, 可能的值:
     * - module
     * @return Script
     */
    public function type(string $value = 'text/javascript'): Script
    {
        $this->attr('type', $value);
        return $this;
    }
    
    /**
     * 脚本字符集
     * - 不需要,因为H5限定页面为utf-8编码, 会自动继承
     * @param string $value
     */
    public function charset(string $value = 'utf-8'): Script
    {
        $this->attr('type', $value);
        return $this;
    }
}