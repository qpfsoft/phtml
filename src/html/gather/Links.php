<?php
namespace phtml\html\gather;

use phtml\html\ElementInterface;
use phtml\html\Element;
use phtml\html\ElementIndent;

/**
 * link元素收集器
 */
class Links implements ElementInterface
{
    use ElementIndent;
    
    /**
     * 链路集合
     * @var string
     */
    private $_links = [];
    
    /**
     * 链接外部样式表
     * @param string $href 样式文件地址
     * @param string $media 媒体条件, 为真时才会加载此资源,
     * 例`screen and(max-width：600px)`
     * @return $this
     */
    public function css($href, $media = null): Links
    {
        $this->_links[] = [
            'rel'   => 'stylesheet',
            'href'  => $href,
            'media' => $media,
            'type'  => 'text/css',
        ];
        return $this;
    }
    
    /**
     * 网站favicon图标链接 - h5
     * @param string $href 图标类型, `favicon.ico`
     * @param string $mime 指定图标类型, 游览器会自动选择
     * @return $this
     */
    public function icon($href, $mime = null): Links
    {
        $this->_links[] = [
            'rel'   => 'icon',
            'href'  => $href,
        ];
        return $this;
    }
    
    /**
     * 网站favicon图标链接 - 旧版
     * @param string $href 图标类型, `favicon.ico`
     * @param string $mime 指定图标类型, 游览器会自动选择
     * @return $this
     */
    public function iconShortcut($href): Links
    {
        $this->_links[] = [
            'rel'   => 'shortcut icon',
            'href'  => $href,
        ];
        return $this;
    }
    
    /**
     * 移动平台特殊图标类型
     * @param string $rel 例`apple-touch-icon-precomposed`
     * @param string $href  例`apple-icon-114.png`
     * @param string $type 例`image/png`
     * @param string $sizes 例`114x114`
     * @return $this
     */
    public function appIcon(string $rel, string $href, string $type = null, string $sizes = null): Links
    {
        $this->_links[] = [
            'rel'   => $rel,
            'sizes' => $sizes,
            'href'  => $href,
            'type'  => $type,
        ];
        
        return $this;
    }
    
    /**
     * 预加载
     * @param string $href 资源链接
     * @param string $type mime类型
     * @param string $as 特定类内容被获取的属性
     * @param string $crossorigin 是否应使用CORS请求获取资源
     * @return $this
     */
    public function preload(string $href, string $type = null, string $as = null, string $crossorigin = null): Links
    {
        $this->_links[] = [
            'rel'   => 'preload',
            'sizes' => $sizes,
            'href'  => $href,
            'type'  => $type,
            'as'    => $as,
            'crossorigin'   => $crossorigin,
        ];
        
        return $this;
    }
    
    /**
     * 添加DNS预解析
     * @param string $href 域名地址
     * @return Links
     */
    public function dns(string $href): Links
    {
        $this->_links[] = [
            'rel'   => 'dns-prefetch',
            'href'  => $href,
        ];
        
        return $this;
    }
    
    /**
     * 生成元素的HTML代码
     * @return string
     */
    public function end(): string
    {
        if (empty($this->_links)) {
            return '';
        }
        
        return join(PHP_EOL, $this->getCode());
    }
    
    /**
     * 获取元素代码集合
     * @return array
     */
    public function getCode(): array
    {
        $html = [];
        $tab = $this->getLevelIndent();
        foreach ($this->_links as $row => $link) {
            $html[] = $tab . '<link' . Element::parseAttr($link) . '>';
        }
        
        return $html;
    }
}