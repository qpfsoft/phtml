<?php
namespace phtml\html\gather;

use phtml\html\ElementInterface;
use phtml\html\Element;
use phtml\html\ElementIndent;

/**
 * meta元素收集器
 */
class Metas implements ElementInterface
{
    use ElementIndent;
    
    /**
     * 声明文档字符编码
     * @var string
     */
    private $charsetAttr = 'utf-8';
    /**
     * 把 content 属性关联到一个名称
     * @var array
     */
    private $nameAttr = [];
    /**
     * 把 content 属性关联到 HTTP 头部
     * @var array
     */
    private $httpEquivAttr = [];
    /**
     * 网站标题
     * @var string
     */
    private $title;

    /**
     * 设置网站标题
     * @param string $value
     * @return Metas
     */
    public function title(string $value): Metas
    {
        $this->title = $value;
        return $this;
    }
    
    /**
     * 设置文档字符编码
     * @param string $value
     */
    public function charset(string $value = 'utf-8'): Metas
    {
        $this->charsetAttr = $value;
        return $this;
    }
    
    /**
     * 设置内容类型
     * @param string $mime MIME类型, 默认`text/html`
     * @param string $charset 字符集, 默认`utf-8`
     */
    public function contentType(string $mime = 'text/html', string $charset = 'utf-8'): Metas
    {
        $this->httpEquivAttr['Content-Type'] = $mime . '; charset=' . $charset;
        return $this;
    }
    
    /**
     * 开启或关闭DNS预解析
     * @param bool $bool
     * @return $this
     */
    public function dnsPrefetch(bool $bool): Metas
    {
        $this->httpEquivAttr['X-dns-prefetch-control'] = Element::parseSwitch($bool);
        return $this;
    }
    
    /**
     * 设置网页作者
     * @param string $val author,email address
     * @return $this
     */
    public function author(string $value): Metas
    {
        $this->nameAttr['author'] = $value;
        return $this;
    }
    
    /**
     * 设置网页描述
     * 
     * ```seo
     * 一般不超过150个字符，描述内容要和页面内容相关
     *
     * 首页 : 将首页的标题、关键词和一些特殊栏目的内容融合到里面，写成简单的介绍
     * 栏目页 : 将栏目的标题、关键字、分类列表名称融合到里面，写成简单的介绍
     * 分类列表页 : 把分类列表的标题、关键词融合在一起，写成简单的介绍
     * 文章页 : 1文章标题、文章中的重要内容和关键词融合在一起，写成简单的介绍
     * 2在文章首段和标题中加入关键词,然后直接将文章首段的内容复制到description中即可
     * ```
     * @param string $val
     * @return $this
     */
    public function description(string $value): Metas
    {
        $this->nameAttr['description'] = $value;
        return $this;
    }

    /**
     * 设置网页关键字
     *
     * ```seo
     * 每个词都要能在内容中找到相应匹配
     * 一般不超过3个
     * 尽量将重要的关键字靠前放
     *
     * 首页 : 网站名称,主要栏目名,主要关键词
     * 栏目页 : 栏目名称,栏目关键字,栏目分类列表名称
     * 分类列表页 : 栏目中的主要关键字写入即可
     * 文章页 : 提取文章中的关键词,文章中出现比较多的词
     * ```
     *
     * @param string $val 多个用英文逗号分隔
     * @return $this
     */
    public function keywords(string $value): Metas
    {
        $this->nameAttr['keywords'] = $value;
        return $this;
    }

    /**
     * 设置网页文件是用什么工具生成
     * @param string $val 说明网站的采用的什么软件制作
     * @return $this
     */
    public function generator(string $value): Metas
    {
        $this->nameAttr['generator'] = $value;
        return $this;
    }

    /**
     * 设置页面的最新版本
     * @param string $val 格式: "作者名字, 年/月/日"
     */
    public function revised(string $value): Metas
    {
        $this->nameAttr['revised'] = $value;
        return $this;
    }

    /**
     * 设置页面搜索引擎索引方式
     * @param string $val 默认index,follow
     * - all : (默认)文件将被检索，且页面上的链接可以被查询；
     * - none : 文件将不被检索，且页面上的链接不可以被查询；
     * - index : 文件将被检索；
     * - follow : 页面上的链接可以被查询；
     * - noindex : 文件将不被检索，但页面上的链接可以被查询；
     * - nofollow : 文件将不被检索，页面上的链接可以被查询。
     * 多个使用英文逗号分隔
     * @return $this
     */
    public function robots($val = 'index,follow'): Metas
    {
        $this->nameAttr['robots'] = $val;
        return $this;
    }

    /**
     * 设置移动端视图
     * @param int|string $width 宽度(数值/device-width,范围从200 到10,000，默认为980 像素)
     * - 适配 iPhone 6 : width=375
     * - 适配 iPhone 6plus : width=414
     * - 4.7~5 寸安卓 : 360
     * - 5.5 寸安卓 : 400
     * @param int|string $height 高度(数值 /device-height,范围从223 到10,000）
     * @param int|string $initial_scale 初始的缩放比例 （范围从0.0 ~ 10.0)
     * - 即页面初始缩放程度。这是一个浮点值，是页面大小的一个乘数。
     * - 1.0 : 分辨率的1:1来展现
     * - 2.0 :那么这个页面就会放大为2倍
     * @param int $maximum_scale 允许用户缩放到的最小比例
     * - 这也是一个浮点值，用以指出页面大小与屏幕大小相比的最大乘数
     * - 例如2.0 ,这个页面与target size相比，最多能放大2倍
     * @param int $minimum_scale 允许用户缩放到的最大比例
     * @param bool $user_scalable 用户是否可以手动缩 (no,yes)
     * @param bool $minimal_ui iOS7.1beta 2 中新增属性，可以在页面加载时最小化上下状态栏。
     * iOS 8更新后则又取消了这个设置.
     * @return $this
     */
    public function viewport($width = 'device-width', $height = null, $initial_scale = '1.0', $maximum_scale = '1.0', $minimum_scale = '1.0', 
        $user_scalable = false, $minimal_ui = true): Metas
    {
        $conf = 'width=' . $width;
        $conf .= $height !== null ? ',height=' . $height : '';
        $conf .= $initial_scale !== null ? ',initial-scale=' . $initial_scale : '';
        $conf .= $maximum_scale !== null ? ',maximum-scale=' . $maximum_scale : '';
        $conf .= $minimum_scale !== null ? ',minimum-scale=' . $minimum_scale : '';
        $conf .= $user_scalable !== null ? ',user-scalable=' . Element::parseWhether($user_scalable) : '';
        $conf .= $minimal_ui === true ? ',minimal-ui' : '';
        $this->nameAttr['viewport'] = $conf;
        
        return $this;
    }

    /**
     * 启用webApp全屏模式 for IOS
     *
     * 注意:生成app时要关闭缓存<meta http-equiv="Pragma" content="no-cache">
     *
     * @param string $appName 添加到主屏后的标题,iOS 6 新增
     * @param string $statusStyle 状态栏的背景颜色
     * - default 默认值，网页内容从状态栏底部开始
     * - black 状态栏背景是黑色，网页内容从状态栏底部开始
     * - black-translucent 状态栏背景是黑色半透明，网页内容充满整个屏幕，顶部会被状态栏遮挡
     */
    public function appModel($appName, $statusStyle = 'defautl'): Metas
    {
        $this->nameAttr['apple-mobile-web-app-capable'] = 'yes';
        $this->nameAttr['apple-mobile-web-app-status-bar-style'] = $statusStyle;
        $this->nameAttr['apple-mobile-web-app-title'] = $appName;
        return $this;
    }

    /**
     * 添加智能 App 广告条 Smart App Banner（iOS 6+ Safari）
     *
     * 告诉游览器该网站对应的app,并显示下载提示
     *
     * @param string $appID
     * @param string $myAffiliateData
     * @param string $myURL
     * @return $this
     */
    public function appItunes($appID, $myAffiliateData, $myURL): Metas
    {
        $conf = 'app-id=' . $appID;
        $conf .= ', affiliate-data=' . $myAffiliateData;
        $conf .= ', app-argument=' . $myURL;
        $this->nameAttr['apple-itunes-app'] = $conf;
        
        return $this;
    }
    
    /**
     * 是否数字识别为电话号码
     * @param bool $status 默认`false`
     * @return string
     */
    public function telephone(bool $status = false): Metas
    {
        $this->nameAttr['format-detection'] = 'telephone=' . Element::parseWhether($status);
        return $this;
    }
    
     /**
     * 是否是识别邮箱
     * @param bool $status 默认`false`
     * @return $this
     */
    public function email(bool $status = false): Metas
    {
        $this->nameAttr['format-detection'] = 'email=' . Element::parseWhether($status);
        return $this;
    }
    
    /**
     * 启用游览器兼容内核
     * 
     * 优先使用IE最新版本和 Chrome
     * @param string $ie
     * @param string $chrome
     * @return $this
     */
    public function compatible($ie = 'edge', $chrome = '1'): Metas
    {
        $this->httpEquivAttr['X-UA-Compatible'] = "IE={$ie},chrome={$chrome}";
        return $this;
    }
    
    /**
     * 360使用快速内核
     * @return $this
     */
    public function webkit(): Metas
    {
        $this->nameAttr['renderer'] = 'webkit';
        return $this;
    }
    
    /**
     * 百度禁止转码
     *
     * 通过百度手机打开网页时，百度可能会对你的网页进行转码，
     * 脱下你的衣服，往你的身上贴狗皮膏药的广告
     * @return $this
     */
    public function notBaidu(): Metas
    {
        $this->httpEquivAttr['Cache-Control'] = 'no-siteapp';
        return $this;
    }

    /**
     * Windows 8 磁贴颜色
     * @param string $val 颜色,例如'#000'
     * @return $this
     */
    public function win8_color(string $value): Metas
    {
        $this->nameAttr['msapplication-TileColor'] = $value;
        return $this;
    }

    /**
     * Windows 8 磁贴图标
     * @param string $val 图标图片,例'icon.png'
     * @return $this
     */
    public function win8_ico(string $value): Metas
    {
        $this->nameAttr['msapplication-TileImage'] = $value;
        return $this;
    }
    
    /**
     * 解析网站标题
     * @return string
     */
    private function parseTitle(): string
    {
        return '<title>' . $this->title . '</title>';
    }
    
    /**
     * 解析页面字符集
     * @return string
     */
    private function parseCharset(): string
    {
        return '<meta charset="' . $this->charsetAttr . '">';
    }

    /**
     * 解析name属性集合
     * @param array $html 代码写入变量
     * @param string $tab 锁进符
     */
    private function parseNameAttr(&$html, $tab = '')
    {
        if (!empty($this->nameAttr)) {
            foreach ($this->nameAttr as $name => $content) {
                if (is_array($content)) {
                    
                    if (is_numeric($name)) {
                        foreach ($content as $key => $val) {
                            $html[] = $tab . '<meta name="' . $key . '" content="' . $val . '">';
                        }
                    } else {
                        $html[] = $tab . '<meta name="' . $key . '" content="' . Element::parseAttrValue($content) . '">';
                    }
                    
                } else {
                    $html[] = $tab . '<meta name="' . $name . '" content="' . $content . '">';
                }
            }
        }
    }
    
    /**
     * 解析http_equiv属性
     * @param array $html 代码写入变量
     * @param string $tab 锁进符
     */
    private function parseHttpEquiv(&$html, $tab = '')
    {
        if (!empty($this->httpEquivAttr)) {
            foreach ($this->httpEquivAttr as $equiv => $content) {
                $html[] = $tab . '<meta http-equiv="' . $equiv . '" content="' . $content . '">';
            }
        }
    }
   
    /**
     * 生成元素HTML文本代码
     * @return string
     */
    public function end(): string
    {
        return join(PHP_EOL, $this->getCode());
    }
    
    /**
     * 获取元素代码集合
     * @return array
     */
    public function getCode(): array
    {
        $tab = $this->getLevelIndent();
        
        $html = [];
        $html[] = $tab . $this->parseCharset();
        $this->parseHttpEquiv($html, $tab);
        $html[] = $tab . $this->parseTitle();
        $this->parseNameAttr($html, $tab);
        return $html;
    }
}