<?php
namespace phtml\html;

use phtml\html\gather\Metas;
use phtml\html\gather\Links;

/**
 * Head 对象代表 HTML中的`head`标签
 * 
 * - 设置标题,描述,关键字等,
 * - 添加dns预解析
 * - webApp模式
 * - 载入外部JS,CSS.
 * 
 * 下面这些标签可用在 head 部分：
 * base, link, meta, script, style, 以及 title.
 * 
 * # seo
 * 关键一点是头部的title，description，keyword的设置
 * 1.title设置不宜过长，要简短，网站的名字与相关的小内容，一般为10-20个字。不能重复
 * 2.keywords设置10个关键词，每个词不能太长，简短且符合你网站的特点，不能重复
 * 3.description，50个字内描述你的网站,写原创的话，并包含2-3个关键词比较好
 * 
 * # 优化
 * - css放在头部，js放在尾部，尽量使用外链或者工具对css和js进行压缩
 * - 减少http的请求，使页面更快加载
 * - 为图片img加上alt属性，加了alt就不必加title了
 */
class Head extends Element
{
    use ElementNesting;
    
    protected $name = 'head';
    /**
     * 载入外部JS列表
     * @var array
     */
    protected $script = [];
    /**
     * 页面内嵌样式
     * @var array
     */
    protected $style = [];
    
    /**
     * base标签属性列表
     * @var array
     */
    private $base = [];
    /**
     * meta标签管理对象
     * @var Metas
     */
    private $metas;
    /**
     * link标签管理对象
     * @var array
     */
    private $links;
    
    /**
     * 返回meta标签管理对象
     * @return Metas
     */
    public function metas(): Metas
    {
        if ($this->metas === null) {
            $this->metas = new Metas();
        }
        
        return $this->metas;
    }
    
    /**
     * 返回link标签管理对象
     * @return Links
     */
    public function links(): Links
    {
        if ($this->links === null) {
            $this->links = new Links();
        }
        
        return $this->links;
    }
    
    /**
     * 设置网页标题
     * 
     * ```seo
     * 首页 : 主关键词-或一句含有主关键词的描述-网站名称
     * 栏目页 : 栏目名称-网站名称
     * 分类列表页 : 分类列表页名称-栏目名称-网站名称
     * 文章页 : 内容标题-栏目名称-网站名称
     * 文章标题-网站名称
     * 内容标题-栏目名称
     * ```
     * @param string $value
     */
    public function title(string $value): Head
    {
        $this->metas()->title($value);
        return $this;
    }
    
    /**
     * 设置网页编码
     * @param string $value 默认编码`utf-8`
     * @return $this
     */
    public function charset($value = 'utf-8'): Head
    {
        $this->metas()->charset($value);
        return $this;
    }
    
    /**
     * 引入外部CSS样式表
     * @param string $href URL地址
     * @return $this
     */
    public function css(string $href): Head
    {
        $this->links()->css($href);
        return $this;
    }
    
    /**
     * 设置viewport页面缩放比例
     * @return $this
     */
    public function viewport(): Head
    {
        $this->metas()->viewport();
        return $this;
    }
    
    /**
     * 基准网址标记 
     * - 每个网页只能有一个基本标记
     * @param string $href 基础URL地址
     * @param string $target 网页链接打开方式, 
     * - _blank：在新窗口打开链接页面
     * - _parent:在上一级窗口中打开链接
     * - _self： 在当前窗口打开链接,此为默认值，可以省略
     * - _top： 在浏览器的整个窗口打开链接，忽略任何框架
     * @return Head
     */
    public function base(string $href, string $target = null): Head
    {
        $this->base = [
            'href'  => $href,
            'target'    => $target,
        ];
        
        return $this;
    }
    
    /**
     * 设置所有相对链接的默认前缀
     *
     * - 作用于 `a、img、link、form` 标签中的 URL。
     * - 属性值替换了当前网址的基础url.
     * - 不会影响绝对url.
     * - base 标签必须位于 head 元素内部。
     *
     * @param string $url 例如`http://www.x.com/public/`
     * @return $this
     */
    public function baseHref($url)
    {
        $this->base['href'] = $url;
        return $this;
    }
    
    /**
     * 设置全局打开URL链接
     * @param string $value 可能的值:
     * - _blank : 浏览器总在一个新打开、未命名的窗口中载入目标文档。
     * - _self : 默认目标, 在相同的框架或者窗口中作为源文档
     * - _parent : 载入父窗口或者包含来超链接引用的框架的框架集
     * - _top : 目标将会清除所有被包含的框架并将文档载入整个浏览器窗口。
     * @return $this
     */
    public function baseTarget($value)
    {
        $this->base['target'] = $value;
        return $this;
    }
    
    /**
     * 添加图标
     * @param string $href 图标地址
     * @param string $mime 图片MIME类型
     * @return $this
     */
    public function icon(string $href, string $mime = null): Head
    {
        $this->links()->icon($href, $mime);
        return $this;
    }
    
    /**
     * 添加图标 - 兼容IE
     * @param string $href 图标地址
     * @return $this
     */
    public function iconShortcut(string $href = 'favicon.ico'): Head
    {
        $this->links()->iconShortcut($href);
        return $this;
    }
    
    /**
     * 引入可执行代码
     * 
     * - 注意传入的脚本对象不可手动end
     * @param string|Script $src 脚本URL或元素对象
     * @return $this
     */
    public function js(string $src): Head
    {
        return $this->scritp($src);
    }
    
    /**
     * 引入可执行代码
     * @param string|Script $script 脚本URL或元素对象
     */
    public function scritp(string $script): Head
    {
        $this->script[] = $script;
        return $this;
    }
    
    /**
     * 添加页面样式
     * @param string $css 样式字符串
     * @return Phtml
     */
    public function addStyle($css): Head
    {
        $this->style[] = $css;
        return $this;
    }

    /**
     * 获取HTML代码
     * @return array
     */
    public function getCode(): array
    {
        $this->addSubElement($this->metas());
        
        if (!empty($this->base)) {
            $this->addSubContent('<base' . Element::parseAttr($this->base) . '>');
        }

        $this->parseLink();
        $this->parseScript();
        $this->parseStyle();
        
        $html = [];
        $html[] = $this->tagStart();
        $html[] = $this->getContent();
        $html[] = $this->tagEnd();
        
        return $html;
    }

    /**
     * 解析引入样式
     * @return void
     */
    protected function parseLink(): void
    {
        if ($this->links !== null) {
            $this->addSubElement($this->links());
        }
    }
    
    /**
     * 解析引入脚本
     * @return void
     */
    protected function parseScript(): void
    {
        if (!empty($this->script)) {
            foreach ($this->script as $i => $src) {
                $this->addSubContent('<script type="text/javascript" src="' . $src . '"></script>');
            }
        }
    }
    
    /**
     * 解析页面样式
     * @return void
     */
    protected function parseStyle(): void
    {
        if (!empty($this->style)) {
            $style = new Style();
            foreach ($this->style as $i => $val) {
                $style->addCss($val);
            }
            $this->add($style);
        }
    }
    
    
}