<?php
namespace phtml\html;

/**
 * Link
 * 
 * 链接外部样式表
 */
class Link extends Element
{
    protected $name = 'link';
    
    /**
     * 链接资源的URL
     * @param string $value
     * @return $this
     */
    public function href(string $value): Link
    {
        $this->attr('href', $value);
        return $this;
    }
    
    /**
     * 链接资源的语言
     * 这纯粹是建议性的。允许值由BCP47确定。
     * @param string $value
     * @return Link
     */
    public function hreflang(string $value): Link
    {
        $this->attr('hreflang', $value);
        return $this;
    }
    
    /**
     * 关系
     * @param string $value
     * @return Link
     */
    public function rel(string $value): Link
    {
        $this->attr('rel', $value);
        return $this;
    }
    
    /**
     * 媒体类型
     * 
     * - 只有在媒体条件为真时才会加载此资源
     * @param string $value 媒体类型条件, 例如`screen and(max-width：600px)`
     * @return $this
     */
    public function media(string $value): Link
    {
        $this->attr('media', $value);
        return $this;
    }
    
    /**
     * 资源的MIME类型
     * @param string $value MIME类型, 例如`image/png`
     * @return $this
     */
    public function type(string $value): Link
    {
        $this->attr('type', $value);
        return $this;
    }
    
    /**
     * 图标大小
     * @param string $value 例如`64x64`
     * @return $this
     */
    public function sizes(string $value): Link
    {
        $this->attr('sizes', $value);
        return $this;
    }
    
    /**
     * 是否应使用CORS请求获取资源
     * @param string $value 可能的值:
     * - anonymous : 执行跨源请求, 不发送凭证
     * - use-credentials : 执行跨源请求, 发送凭证
     * @return $this
     */
    public function crossorigin(string $value): Link
    {
        $this->attr('crossorigin', $value);
        return $this;
    }
    
    /**
     * 特定类内容被获取的属性
     * 
     * 仅在rel="preload"元素上设置时使用此属性,
     * 它指定由内容加载的内容类型`link`，这对于内容优先级排序，请求匹配
     * @param string $value
     * @return $this
     */
    public function as(string $value): Link
    {
        $this->attr('as', $value);
        return $this;
    }
    
    /**
     * 指示资源的相对重要性
     * 
     * 属性仅可用于`link`元素。rel="preload"rel="prefetch"
     * 
     * @param string $value 使用以下值委派优先级提示：
     * - auto：表示没有首选项。浏览器可以使用其自己的启发式来确定资源的优先级。
     * - high：向浏览器指示资源具有高优先级。
     * - low：向浏览器指示资源具有低优先级。
     * @return $this
     */
    public function importance(string $value): Link
    {
        $this->attr('importance', $value);
        return $this;
    }
    
    /**
     * 指示在获取资源时要使用的引用者
     * @param string $value
     * - 'no-referrer'表示Referer不会发送标头。
     * - 'no-referrer-when-downgrade'表示在没有RefererTLS（HTTPS）
     * 的情况下导航到原点时不会发送标头。如果未指定任何策略，则这是用户代理的默认行为。
     * - 'origin' 表示引用者将是页面的来源，大致是方案，主机和端口。
     * - 'origin-when-cross-origin' 意味着导航到其他来源将仅限于方案，
     * 主机和端口，而在同一原点上导航将包括引用者的路径。
     * - 'unsafe-url'表示引荐来源将包括原点和路径（但不包括片段，密码或用户名）。
     * 这种情况是不安全的，因为它可能泄漏从受TLS保护的资源到不安全来源的起源和路径。
     * @return Link
     */
    public function referrerpolicy(string $value): Link
    {
        $this->attr('referrerpolicy', $value);
        return $this;
    }
}