<?php
namespace phtml;

use phtml\html\Element;

/**
 * HTML 标签集合
 * 
 * 该类提供所有标签快速生成的静态方法
 * 
 * # accesskey
 * 自定义快捷键的使用方法:
 * - firefix : win(alt+shift+key), mac(control+alt+key)
 * - ie : win(alt+key)
 * - chrome|opera : win(alt+key), mac(control+alt+key)
 * - safari : win(alt+key), mac(control+alt+key)
 * ie只能焦点到按钮, 其它游览器会正确的按下激活
 */
class Htm
{
    /**
     * HTML代码换行
     * @return string
     */
    public static function eol()
    {
        return "\n";
    }
    
    /**
     * HTML注解
     * @param string $string 注解描述
     * @return string
     */
    public static function htmlComment(string $string): string
    {
        return '<!-- ' . $string . ' -->';
    }
    
    /**
     * CSS注解
     * @param string $string 注解描述
     * @return string
     */
    public static function cssComment(string $string): string
    {
        return '/* ' . $string . ' */';
    }
    
    /**
     * HTML条件注解
     * 
     * - IE5 ~ IE9版本的条件注解
     * 
     * @param string $html 包裹内容
     * @param string $if 条件, 默认`IE`,
     * - IE : 是IE游览器就有效
     * - IE 8 : 等于IE8, 仅在IE8版本有效
     * - lt IE 8 : 小于IE8, IE8以下的版本有效
     * - lte IE 8 : 小于等于IE8, IE8以及以下版本有效
     * - gt IE 7 : 大于IE7, IE7以上版本有效
     * - gte IE 7 : 大于等于IE7, IE7以及以上版本有效
     * @return string
     */
    public static function ifIE($html, $if = 'IE')
    {
        return "<!--[if $if]>\n" . $html . "\n<![endif]-->";
    }
    
    /**
     * 不是IE显示注解内代码
     * @param string $html 内容
     * @return string
     */
    public static function ifNotIE($html)
    {
        return "<!--[if !IE]>\n" . $html . "\n<![endif]-->";
    }
    
    /**
     * 超链接标签
     * @return string
     */
    public static function a(string $content = '', array $attrs = []): string
    {
        return self::tag('a', $content, $attrs);
    }
    
    /**
     * 缩写或首字母缩写
     * @return string
     */
    public static function abbr(string $content = '', array $attrs = []): string
    {
        return self::tag('abbr', $content, $attrs);
    }
    
    /**
     * 联系信息
     * 
     * 用于包裹以下信息:
     * - 物理地址
     * - URL
     * - 电子邮箱
     * - 电话号码
     * - 社交媒体句柄
     * - 地理坐标
     * @return string
     */
    public static function address(string $content = '', array $attrs = []): string
    {
        return self::tag('address', $content, $attrs);
    }
    
    /**
     * 图片的可点击区域
     * @return string
     */
    public static function area(array $attrs = []): string
    {
        return self::tag('area', '', $attrs);
    }
    
    /**
     * 文章
     * 
     * 用于包裹文章内容
     * - 论坛帖子, 杂志, 报纸文章, 博客条目
     * @return string
     */
    public static function article(string $content = '', array $attrs = []): string
    {
        return self::tag('article', $content, $attrs);
    }
    
    /**
     * aside(预留)
     * 
     * 表示文档的一部分, 经常作为侧边栏或标注框出现
     * @return string
     */
    public static function aside(string $content = '', array $attrs = []): string
    {
        return self::tag('aside', $content, $attrs);
    }
    
    /**
     * 音频
     * @return string
     */
    public static function audio(string $content = '', array $attrs = []): string
    {
        return self::tag('audio', $content, $attrs);
    }
    
    /**
     * 加粗文本的标签
     * @return string
     */
    public static function b(string $content = '', array $attrs = []): string
    {
        return self::tag('b', $content, $attrs);
    }
    
    /**
     * 基本URL
     * 
     * 作为文档中的所有相对URL的根
     * @return string
     */
    public static function base(array $attrs = []): string
    {
        return self::tag('base', '', $attrs);
    }
    
    /**
     * 文本与其周围文本隔离标签
     * 
     * @deprecated 游览器支持低
     * @return string
     */
    public static function bdi(string $content = '', array $attrs = []): string
    {
        return self::tag('bdi', $content, $attrs);
    }
    
    /**
     * 指定文本的呈现方向
     * 
     * 可用于实现镜像(背面)文本效果
     * 
     * - ltr : 表示文本应按从左到右的方向进行
     * - rtl : 表示文本应按从右到左的方向进行
     * @return string
     */
    public static function bdo(string $content = '', array $attrs = []): string
    {
        return self::tag('bdo', $content, $attrs);
    }
    
    /**
     * 引用元素标签
     * @return string
     */
    public static function blockquote(string $content = '', array $attrs = []): string
    {
        return self::tag('blockquote', $content, $attrs);
    }
    
    /**
     * HTML文档的内容
     * @return string
     */
    public static function body(string $content = '', array $attrs = []): string
    {
        return self::tag('body', $content, $attrs);
    }
    
    /**
     * 文本（回车）换行符
     * @return string
     */
    public static function br(array $attrs = []): string
    {
        return self::tag('br', '', $attrs);
    }
    
    /**
     * 可点击的按钮
     * @param string $content 按钮内容
     * @return string
     */
    public static function button(string $content = '按钮', array $attrs = []): string
    {
        return self::tag('button', $content, $attrs);
    }
    
    /**
     * 绘制图形和动画的画布
     * @return string
     */
    public static function canvas(string $content = '', array $attrs = []): string
    {
        return self::tag('canvas', $content, $attrs);
    }
    
    /**
     * 表格的标题
     * @return string
     */
    public static function caption(string $content = '', array $attrs = []): string
    {
        return self::tag('caption', $content, $attrs);
    }
    
    /**
     * 引用的来源
     * 
     * - 默认效果文本斜体
     * - 用于指定引用内容的来源
     * @return string
     */
    public static function cite(string $content = '', array $attrs = []): string
    {
        return self::tag('cite', $content, $attrs);
    }
    
    /**
     * 包含代码文本
     * @return string
     */
    public static function code(string $content = '', array $attrs = []): string
    {
        return self::tag('code', $content, $attrs);
    }
    
    /**
     * 表内定义的列
     * 
     * - 它通常在`colgroup`元素中
     * @return string
     */
    public static function col(array $attrs = []): string
    {
        return self::tag('col', '', $attrs);
    }
    
    /**
     * 表内定义一组列
     * ```html
     * <colgroup>
     *      <col span="2" class="batman">
     *      <col span="2" class="flash">
     * </colgroup>
     * ```
     * 
     * - 备注: 可用来设定不同列的样式
     * @return string
     */
    public static function colgroup(string $content = '', array $attrs = []): string
    {
        return self::tag('colgroup', $content, $attrs);
    }
    
    /**
     * 链接给定的内容与机器可读的翻译
     * 
     * 将内容与id绑定
     * @return string
     */
    public static function data(string $content = '', array $attrs = []): string
    {
        return self::tag('data', $content, $attrs);
    }
    
    /**
     * 数据列表
     * 
     * - 包含一组`option`元素
     * - 用于输入提示与联想列表
     * @return string
     */
    public static function datalist(string $content = '', array $attrs = []): string
    {
        return self::tag('datalist', $content, $attrs);
    }
    
    /**
     * 描述定义
     * 
     * - 包含再`dl`元素内
     * @return string
     */
    public static function dd(string $content = '', array $attrs = []): string
    {
        return self::tag('dd', $content, $attrs);
    }
    
    /**
     * 文本删除
     * @return string
     */
    public static function del(string $content = '', array $attrs = []): string
    {
        return self::tag('del', $content, $attrs);
    }
    
    /**
     * 创建显示与隐藏的小部件
     * 
     * ```
     * <details>
     * <summary>产品介绍详情</summary>
     * 详细的文本描述...
     * </details>
     * ```
     * 
     * - 内部用`summary`描述标题
     * @return string
     */
    public static function details(string $content = '', array $attrs = []): string
    {
        return self::tag('details', $content, $attrs);
    }
    
    /**
     * 定义的短语或句子的上下文中所定义的术语
     * @return string
     */
    public static function dfn(string $content = '', array $attrs = []): string
    {
        return self::tag('dfn', $content, $attrs);
    }
    
    /**
     * 对话框或其他交互式组件
     * @return string
     */
    public static function dialog(string $content = '', array $attrs = []): string
    {
        return self::tag('dialog', $content, $attrs);
    }
    
    /**
     * 流内容容器
     * @return string
     */
    public static function div(string $content = '', array $attrs = []): string
    {
        return self::tag('div', $content, $attrs);
    }
    
    /**
     * 词汇表
     * @return string
     */
    public static function dl(string $content = '', array $attrs = []): string
    {
        return self::tag('dl', $content, $attrs);
    }
    
    /**
     * 词汇表中的术语标题
     * @return string
     */
    public static function dt(string $content = '', array $attrs = []): string
    {
        return self::tag('dt', $content, $attrs);
    }
    
    /**
     * 重点标记文本
     * 
     * - 文本斜体
     * @return string
     */
    public static function em(string $content = '', array $attrs = []): string
    {
        return self::tag('em', $content, $attrs);
    }
    
    /**
     * 嵌入在文档中的指定点外的内容
     * 
     * @deprecated
     * @return string
     */
    public static function embed(array $attrs = []): string
    {
        return self::tag('embed', '', $attrs);
    }
    
    /**
     * 表单分组标签
     * @return string
     */
    public static function fieldset(string $content = '', array $attrs = []): string
    {
        return self::tag('fieldset', $content, $attrs);
    }
    
    /**
     * 图片展示组件 - 图片描述标题
     * 
     * - figure元素内部包含一个`img` 与`figcaption`元素
     * @return string
     */
    public static function figcaption(string $content = '', array $attrs = []): string
    {
        return self::tag('figcaption', $content, $attrs);
    }
    
    /**
     * 图片展示组件
     * 
     * - figure元素内部包含一个`img` 与`figcaption`元素
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function figure(string $content = '', array $attrs = []): string
    {
        return self::tag('figure', $content, $attrs);
    }
    
    /**
     * 页脚
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function footer(string $content = '', array $attrs = []): string
    {
        return self::tag('footer', $content, $attrs);
    }
    
    /**
     * 表单
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function form(string $content = '', array $attrs = []): string
    {
        return self::tag('form', $content, $attrs);
    }
    
    /**
     * h6标题
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function h1(string $content = '', array $attrs = []): string
    {
        return self::tag('h1', $content, $attrs);
    }
    
    /**
     * h2标题
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function h2(string $content = '', array $attrs = []): string
    {
        return self::tag('h2', $content, $attrs);
    }
    
    /**
     * h3标题
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function h3(string $content = '', array $attrs = []): string
    {
        return self::tag('h3', $content, $attrs);
    }
    
    /**
     * h4标题
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function h4(string $content = '', array $attrs = []): string
    {
        return self::tag('h4', $content, $attrs);
    }
    
    /**
     * h5标题
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function h5(string $content = '', array $attrs = []): string
    {
        return self::tag('h5', $content, $attrs);
    }
    
    /**
     * h6标题
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function h6(string $content = '', array $attrs = []): string
    {
        return self::tag('h6', $content, $attrs);
    }
    
    /**
     * 包括它的标题和链接到它的脚本和样式表
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function head(string $content = '', array $attrs = []): string
    {
        return self::tag('head', '', $attrs);
    }
    
    /**
     * 代表介绍的内容
     * 
     * - 通常是一组的介绍或辅助的导航
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function header(string $content = '', array $attrs = []): string
    {
        return self::tag('header', $content, $attrs);
    }
    
    /**
     * 横线
     * @param array $attrs
     * @return string
     */
    public static function hr(array $attrs = []): string
    {
        return self::tag('hr', '', $attrs);
    }
    
    /**
     * html根标签
     * @param string $content
     * @param array $attrs
     * @return string
     */
    public static function html(string $content = '', array $attrs = []): string
    {
        return self::tag('i', $content, $attrs);
    }
    
    /**
     * 斜体
     * 
     * - 外语短语或虚构人物想法
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function i(string $content = '', array $attrs = []): string
    {
        return self::tag('i', '', $attrs);
    }
    
    /**
     * 镶嵌HTML页面
     * @param string $content 内容
     * @param array $attrs 属性集合
     * @return string
     */
    public static function iframe(string $content = '', array $attrs = []): string
    {
        return self::tag('iframe', $content, $attrs);
    }
    
    /**
     * 镶嵌图片到文档
     * 
     * ```
     * < img
     * src="clock-demo-thumb-200.png" 
     * srcset="clock-demo-thumb-200.png 200w,
     *    clock-demo-thumb-400.png 400w"
     * sizes="(max-width: 600px) 200px, 50vw" >
     * ```
     * @param string $src 图片链接
     * @param array $attrs 属性集合
     * - alt : 描述图片
     * - srcset : 指定可选高分辨版本 `logo-HD.png 2x`
     * - sizes : 指定加载媒体条件
     * @return string
     */
    public static function img(string $src, array $attrs = []): string
    {
        $attrs['src'] = $src;
        return self::tag('img', '', $attrs);
    }
    
    /**
     * 输入控件
     * 
     * @param array $attrs 属性集合, 可用属性:<br>
     * - type : 输入类型
     * - value : 初始值
     * - autocomplete : 自动输入历史值
     * - autofocus : (bool) 获得焦点
     * - disabled : (bool) 禁用元素
     * - form : 关联表单的ID
     * - list : 关联输入建议列表, hidden,password,checkbox,radio,file,btn不支持
     * - name : 提交的变量名称
     * - required : (bool) 必须输入
     * - tabindex : (int) Tag键获得焦点
     * # h5新增控件的属性<br>
     * - maxlength : (int)限定输入的最大字符数<br>
     * - minlength : (int)限定最少要输入的字符数<br>
     * - pattern : (string)输入验证的正则表达式<br>
     * - placeholder : (string)未输入时的示例值<br>
     * - readonly : (bool)启用不可编辑<br>
     * - size : (int)字符宽度表示输入框的显示宽度, 默认值为20, 无输入限制功能<br>
     * - spellcheck : (true|false|'')启用元素的拼写检查<br>
     * @return string
     */
    public static function input(array $attrs = []): string
    {
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入按钮
     * 
     * @param string $value 按钮文本
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * # 常用属性<br>
     * - value : 按钮上的文本
     * - accesskey : 自定义快捷键
     * - disabled : (bool) 禁用元素
     * @return string
     */
    public static function inputButton(string $value, array $attrs = []): string
    {
        $attrs['type'] = 'text';
        $attrs['value'] = $value;
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入多选
     * @param string $value 选中后提交的值
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * # 常用属性<br>
     * - name : 多选组设定格式`arr[]`<br>
     * - checked : 选中<br>
     * @return string
     */
    public static function inputCheckbox(string $value, array $attrs = []): string
    {
        $attrs['type'] = 'checkbox';
        $attrs['value'] = $value;
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入颜色
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * - value : 执行默认颜色`#ff000`
     * @return string
     */
    public static function inputColor(array $attrs = []): string
    {
        $attrs['type'] = 'color';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入时间
     * 
     * - pattern "[0-9]{4}-[0-9]{2}-[0-9]{2}"
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * @return string
     */
    public static function inputDate(array $attrs = []): string
    {
        $attrs['type'] = 'date';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入本地日期与时间
     * 
     * 让用户可以轻松输入日期和时间，包括年，月
     * 和日以及小时和分钟的时间
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * @return string
     */
    public static function inputDatetimeLocal(array $attrs = []): string
    {
        $attrs['type'] = 'datetime-local';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入邮箱地址
     * - pattern ".+@globex.com"
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * @return string
     */
    public static function inputEmail(array $attrs = []): string
    {
        $attrs['type'] = 'email';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 上传文件
     * 
     * 文件类型
     * ```
     * `image/*, audio/*, video/*` 有效MIME类型字符串任何图片,视频,音乐
     * `.jpg, .pdf, .doc` 可指定文件扩展名
     * ```
     * 注意表单的enctype属性需要指定为`multipart/form-data`
     * 
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * - accept : 限制允许的文件类型`image/png, image/jpeg`
     * - capture : 捕捉图像或视频数据
     * - files : 列出每个所选文件对象, 需指定multiple属性
     * - multiple : (bool) 允许选择多个文件
     * @return string
     */
    public static function inputFile(string $content = '', array $attrs = []): string
    {
        $attrs['type'] = 'file';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入隐藏元素
     * @param string $name 提交变量名
     * @param string $value 隐藏值
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * @return string
     */
    public static function inputHidden(string $name, string $value, array $attrs = []): string
    {
        $attrs['type'] = 'hidden';
        $attrs['name'] = $name;
        $attrs['value'] = $value;
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 图形提交按钮
     * @param string $src 图片地址
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * - alt : 描述图片<br>
     * - width,height : 宽高属性
     * @return string
     */
    public static function inputImage(string $src, array $attrs = []): string
    {
        $attrs['type'] = 'image';
        $attrs['src'] = $src;
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入月份
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * - value : 默认值<br>
     * - min,max : 范围限制, `2018-05`<br>
     * @return string
     */
    public static function inputMonth(array $attrs = []): string
    {
        $attrs['type'] = 'month';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入数字 - h5, IE10+
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * - value : 默认值<br>
     * - min,max : 范围限制, `10`<br>
     * - placeholder : 输入提示<br>
     * - step : 递增间隔, `0.01`, `10`<br>
     * @return string
     */
    public static function inputNumber(array $attrs = []): string
    {
        $attrs['type'] = 'number';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入密码
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * - minlength|maxlength : (int)限定密码长度
     * - size : (int)密码框显示长度
     * - required : (bool)必须输入
     * - autocomplete : 允许密码管理器自动输入密码
     *      - 'on' 允许自动填写密码
     *      - 'off' : 不允许自动填写密码
     *      - 'current-password' : 输入当前密码
     *      - 'new-password' : 输入新密码, 游览器会提示新密码并自动保存
     * - inputmode : 请求特定键盘, `numeric`
     * - pattern : 正则规则, 例`[0-9a-fA-F]{4,8}`
     * - title : 描述, `输入id由4~8个十六进制数字组成`
     * - disabled : 禁用元素
     * @return string
     */
    public static function inputPassword(array $attrs = []): string
    {
        $attrs['type'] = 'password';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入单选
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * - name : 单选组`arr[]`
     * @return string
     */
    public static function inputRadio(array $attrs = []): string
    {
        $attrs['type'] = 'radio';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入范围
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * - min,max
     * @return string
     */
    public static function inputRange(array $attrs = []): string
    {
        $attrs['type'] = 'range';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 重置表单
     * @param string $value 按钮文本
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * @return string
     */
    public static function inputReset(string $value, array $attrs = []): string
    {
        $attrs['type'] = 'reset';
        $attrs['value'] = $value;
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入搜索
     * 
     * - 游览器会自动列举出历史搜索
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * - placeholde : 输入提示
     * - aria-label : 屏幕阅读器的文本描述
     * @return string
     */
    public static function inputSearch(array $attrs = []): string
    {
        $attrs['type'] = 'search';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 提交表单
     * @param string $value 按钮文本
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * @return string
     */
    public static function inputSubmit(string $value, array $attrs = []): string
    {
        $attrs['type'] = 'submit';
        $attrs['value'] = $value;
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入电话号码
     * @param array $attrs 属性集合, 参考[[input()]]可用属性;<br>
     * - pattern : 正则`[0-9]{3}-[0-9]{3}-[0-9]{4}`
     * - required : 必须输入
     * - placeholder : 输入提示
     * @return string
     */
    public static function inputTel(array $attrs = []): string
    {
        $attrs['type'] = 'tel';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入单行文本
     * @param array $attrs 属性集合, 可用属性:<br>
     * - value : 指定默认值<br>
     * @return string
     */
    public static function inputText(array $attrs = []): string
    {
        $attrs['type'] = 'text';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入时间
     * @param array $attrs 属性集合, 可用属性:<br>
     * - value : 指定默认值, 格式`hh:mm:ss`, 例`13:30`<br>
     * - min : 最小值, 12:00<br>
     * - max : 最大值, 18:00<br>
     * - required : 是否必须输入<br>
     * - step : (int)递增间隔<br>
     * @return string
     */
    public static function inputTime(array $attrs = []): string
    {
        $attrs['type'] = 'time';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入网址
     * @param array $attrs 属性集合, 可用属性:<br>
     * - maxlength : (int)限定输入的最大字符数<br>
     * - minlength : (int)限定最少要输入的字符数<br>
     * - pattern : (string)输入验证的正则表达式, 例`https://.*`<br>
     * - placeholder : (string)未输入时的示例值, 例如`https://example.com`<br>
     * - readonly : (bool)启用不可编辑<br>
     * - size : (int)字符宽度表示输入框的显示宽度, 默认值为20, 无输入限制功能<br>
     * - spellcheck : (true|false|'')启用元素的拼写检查<br>
     * # 非标准属性<br>
     * - autocorrect : (on|off)否自动更正字符串, 仅限Safari<br>
     * - mozactionhint : 指示用户在编辑字段时按下Enter或Return键将采取何种操作<br>
     * @return string
     */
    public static function inputUrl(array $attrs = []): string
    {
        $attrs['type'] = 'url';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入一年的第几周
     * @param array $attrs 属性集合, 可用属性:<br>
     * - name : 表单提交变量名<br>
     * - min : 最短周, 2017-W01 代表 Week 01, 2017<br>
     * - max : 最长周, 2017-W52 代表 Week 52, 2017<br>
     * - required : 是否必须输入<br>
     * - readonly : 是否可编辑<br>
     * - step : (int)递增间隔, 默认值为1，表示1周<br>
     * - id : 元素ID<br>
     * @return string
     */
    public static function inputWeek(array $attrs = []): string
    {
        $attrs['type'] = 'week';
        return self::tag('input', '', $attrs);
    }
    
    /**
     * 输入的文本
     * @return string
     */
    public static function ins(string $content = '', array $attrs = []): string
    {
        return self::tag('ins', $content, $attrs);
    }
    
    /**
     * 键盘按键
     * @return string
     */
    public static function kbd(string $content = '', array $attrs = []): string
    {
        return self::tag('kbd', $content, $attrs);
    }
    
    /**
     * 用户界面中的项目的标题
     * @return string
     */
    public static function label(string $content = '', array $attrs = []): string
    {
        return self::tag('label', $content, $attrs);
    }
    
    /**
     * 代表其父级内容的标题`fieldset`
     * @return string
     */
    public static function legend(string $content = '', array $attrs = []): string
    {
        return self::tag('legend', $content, $attrs);
    }
    
    /**
     * 列表中的代表项目
     * @return string
     */
    public static function li(string $content = '', array $attrs = []): string
    {
        return self::tag('li', $content, $attrs);
    }
    
    /**
     * 链接外部资源
     * @return string
     */
    public static function link(array $attrs = []): string
    {
        return self::tag('link', '', $attrs);
    }
    
    /**
     * 文档的主要内容
     * @return string
     */
    public static function main(string $content = '', array $attrs = []): string
    {
        return self::tag('main', $content, $attrs);
    }
    
    /**
     * 图像映射可点击链接区域
     * @return string
     */
    public static function map(string $content = '', array $attrs = []): string
    {
        return self::tag('map', $content, $attrs);
    }
    
    /**
     * 标记文本突出显示
     * @return string
     */
    public static function mark(string $content = '', array $attrs = []): string
    {
        return self::tag('mark', $content, $attrs);
    }
    
    /**
     * 元数据
     * @return string
     */
    public static function meta(array $attrs = []): string
    {
        return self::tag('meta', '', $attrs);
    }
    
    /**
     * 进度
     * 
     * 表示已知范围内的标量值或小数值
     * @return string
     */
    public static function meter(string $content = '', array $attrs = []): string
    {
        return self::tag('meter', $content, $attrs);
    }
    
    /**
     * 导航菜单
     * @return string
     */
    public static function nav(string $content = '', array $attrs = []): string
    {
        return self::tag('nav', $content, $attrs);
    }
    
    /**
     * 不支持脚本将显示里的内容
     * @return string
     */
    public static function noscript(string $content = '', array $attrs = []): string
    {
        return self::tag('noscript', $content, $attrs);
    }
    
    /**
     * 外部资源
     * @return string
     */
    public static function object(string $content = '', array $attrs = []): string
    {
        return self::tag('object', $content, $attrs);
    }
    
    /**
     * 有序列表
     * @return string
     */
    public static function ol(string $content = '', array $attrs = []): string
    {
        return self::tag('ol', $content, $attrs);
    }
    
    /**
     * 下拉列表值分组`select`元素
     * @return string
     */
    public static function optgroup(string $content = '', array $attrs = []): string
    {
        return self::tag('optgroup', $content, $attrs);
    }
    
    /**
     * 下拉列表选项
     * @return string
     */
    public static function option(string $content = '', array $attrs = []): string
    {
        return self::tag('option', $content, $attrs);
    }
    
    /**
     * 输出元件
     * @return string
     */
    public static function output(string $content = '', array $attrs = []): string
    {
        return self::tag('output', $content, $attrs);
    }
    
    /**
     * 段落
     * @return string
     */
    public static function p(string $content = '', array $attrs = []): string
    {
        return self::tag('p', $content, $attrs);
    }
    
    /**
     * 该参数定义参数的`object`元件
     * @return string
     */
    public static function param(array $attrs = []): string
    {
        return self::tag('param', '', $attrs);
    }
    
    /**
     * 图像匹配组
     * @return string
     */
    public static function picture(string $content = '', array $attrs = []): string
    {
        return self::tag('picture', $content, $attrs);
    }
    
    /**
     * 预先格式化的文本
     * @return string
     */
    public static function pre(string $content = '', array $attrs = []): string
    {
        return self::tag('pre', $content, $attrs);
    }
    
    /**
     * 进度条
     * @return string
     */
    public static function progress(string $content = '', array $attrs = []): string
    {
        return self::tag('progress', $content, $attrs);
    }
    
    /**
     * 简短引号
     * 
     * - 不需要分段的引用
     * @return string
     */
    public static function q(string $content = '', array $attrs = []): string
    {
        return self::tag('q', $content, $attrs);
    }
    
    /**
     * 正被注释的文本
     * @return string
     */
    public static function rb(string $content = '', array $attrs = []): string
    {
        return self::tag('rb', $content, $attrs);
    }
    
    /**
     * 含注释文本的元素的左括号和右括号
     * @return string
     */
    public static function rp(string $content = '', array $attrs = []): string
    {
        return self::tag('rp', $content, $attrs);
    }
    
    /**
     * 包裹注音
     * @return string
     */
    public static function rt(string $content = '', array $attrs = []): string
    {
        return self::tag('rt', $content, $attrs);
    }
    
    /**
     * 内部使用的元素`ruby`的元素
     * @return string
     */
    public static function rtc(string $content = '', array $attrs = []): string
    {
        return self::tag('rtc', $content, $attrs);
    }
    
    /**
     * 显示东亚字符的发音
     * @return string
     */
    public static function ruby(string $content = '', array $attrs = []): string
    {
        return self::tag('ruby', $content, $attrs);
    }
    
    /**
     * 删除文本
     * @return string
     */
    public static function s(string $content = '', array $attrs = []): string
    {
        return self::tag('s', $content, $attrs);
    }
    
    /**
     * 等宽字体
     * @return string
     */
    public static function samp(string $content = '', array $attrs = []): string
    {
        return self::tag('samp', $content, $attrs);
    }
    
    /**
     * 嵌入或引用可执行代码
     * @return string
     */
    public static function script(string $content = '', array $attrs = []): string
    {
        return self::tag('script', $content, $attrs);
    }

    /**
     * 表示一个独立的部分
     * 
     * - 文章的标题与简介
     * @return string
     */
    public static function section(string $content = '', array $attrs = []): string
    {
        return self::tag('section', $content, $attrs);
    }
    
    /**
     * 选项菜单
     * @return string
     */
    public static function select(string $content = '', array $attrs = []): string
    {
        return self::tag('select', $content, $attrs);
    }
    
    /**
     * 网络组件
     * @return string
     */
    public static function slot(string $content = '', array $attrs = []): string
    {
        return self::tag('slot', $content, $attrs);
    }
    
    /**
     * 文本字体大小减小
     * @return string
     */
    public static function small(string $content = '', array $attrs = []): string
    {
        return self::tag('small', $content, $attrs);
    }
    
    /**
     * 媒体资源
     * @return string
     */
    public static function source(array $attrs = []): string
    {
        return self::tag('source', '', $attrs);
    }
    
    /**
     * 内联容器
     * @return string
     */
    public static function span(string $content = '', array $attrs = []): string
    {
        return self::tag('span', $content, $attrs);
    }
    
    /**
     * 加粗文本
     * 
     * - 非常重要的内容
     * @return string
     */
    public static function strong(string $content = '', array $attrs = []): string
    {
        return self::tag('strong', $content, $attrs);
    }
    
    /**
     * 文档样式
     * @return string
     */
    public static function style(string $content = '', array $attrs = []): string
    {
        return self::tag('style', $content, $attrs);
    }
    
    /**
     * 下标文本
     * @return string
     */
    public static function sub(string $content = '', array $attrs = []): string
    {
        return self::tag('sub', $content, $attrs);
    }
    
    /**
     * 概要切换内容框
     * @return string
     */
    public static function summary(string $content = '', array $attrs = []): string
    {
        return self::tag('summary', $content, $attrs);
    }

    /**
     * 上标文本
     * @return string
     */
    public static function sup(string $content = '', array $attrs = []): string
    {
        return self::tag('sup', $content, $attrs);
    }
    
    /**
     * 表格
     * @return string
     */
    public static function table(string $content = '', array $attrs = []): string
    {
        return self::tag('table', $content, $attrs);
    }
    
    /**
     * 表格Body元素
     * @return string
     */
    public static function tbody(string $content = '', array $attrs = []): string
    {
        return self::tag('tbody', $content, $attrs);
    }
    
    /**
     * 单元格
     * @return string
     */
    public static function td(string $content = '', array $attrs = []): string
    {
        return self::tag('td', $content, $attrs);
    }
    
    /**
     * 模板
     * 
     * 该内容在加载页面时不会呈现，
     * 但随后可以在运行时使用JavaScript进行实例化
     * @return string
     */
    public static function template(string $content = '', array $attrs = []): string
    {
        return self::tag('template', $content, $attrs);
    }
    
    /**
     * 文本域
     * @return string
     */
    public static function textarea(string $content = '', array $attrs = []): string
    {
        return self::tag('textarea', $content, $attrs);
    }
    
    /**
     * 表格注脚
     * @return string
     */
    public static function tfoot(string $content = '', array $attrs = []): string
    {
        return self::tag('tfoot', $content, $attrs);
    }
    
    /**
     * 表格的行
     * @return string
     */
    public static function th(string $content = '', array $attrs = []): string
    {
        return self::tag('th', $content, $attrs);
    }
    
    /**
     * 表的列的头行
     * @return string
     */
    public static function thead(string $content = '', array $attrs = []): string
    {
        return self::tag('thead', $content, $attrs);
    }
    
    /**
     * 代表在一段特定的时间
     * @return string
     */
    public static function time(string $content = '', array $attrs = []): string
    {
        return self::tag('time', $content, $attrs);
    }
    
    /**
     * 网址标题
     * @return string
     */
    public static function title(string $content = '', array $attrs = []): string
    {
        return self::tag('title', $content, $attrs);
    }
    
    /**
     * 单元的行
     * @return string
     */
    public static function tr(string $content = '', array $attrs = []): string
    {
        return self::tag('tr', $content, $attrs);
    }
    
    /**
     * 轨道
     * 
     * 用作媒体元素的子`audio`和`video`
     * @return string
     */
    public static function track(array $attrs = []): string
    {
        return self::tag('track', '', $attrs);
    }
    
    /**
     * 下划线
     * @return string
     */
    public static function u(string $content = '', array $attrs = []): string
    {
        return self::tag('u', $content, $attrs);
    }
    
    /**
     * 项目符号列表
     * @return string
     */
    public static function ul(string $content = '', array $attrs = []): string
    {
        return self::tag('ul', $content, $attrs);
    }
    
    /**
     * 数学表达式
     * 
     * - 字体的斜体
     * @return string
     */
    public static function var(string $content = '', array $attrs = []): string
    {
        return self::tag('video', $content, $attrs);
    }
    
    /**
     * 视频元素
     * @return string
     */
    public static function video(string $content = '', array $attrs = []): string
    {
        return self::tag('video', $content, $attrs);
    }
    
    /**
     * 字破门良机
     * @return string
     */
    public static function wbr(): string
    {
        return self::tag('wbr');
    }
    
    /**
     * 生成HTML标签
     * @param string $name 标签名称
     * @param string $content 标签内容
     * @param array $attrs 标签属性
     * @return string
     */
    public static function tag(string $name, string $content = '', array $attrs = []): string
    {
        return Element::create($name)->html($content)->attrs($attrs)->end();
    }
}