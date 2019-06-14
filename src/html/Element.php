<?php
namespace phtml\html;

/**
 * HTML元素
 */
class Element implements ElementInterface
{
    use GlobalAttrs;
    use ElementEvent;
    use ElementIndent;
    
    /**
     * 元素属性
     * @var array
     */
    private $_attrs = [];

    /**
     * 元素名称
     * @var string
     */
    protected $name;
    /**
     * 是否为闭合元素
     * @var string
     */
    protected $end = true;
    
    /**
     * 是否支持布尔属性
     * - true : `attr`
     * - false : `attr="attr"`
     * @var string
     */
    protected $boolAttr = true;
    /**
     * 元素内容
     * @var string
     */
    protected $content = '';
    
    /**
     * 空元素列表
     * @var array
     */
    public static $void = [
        'area' => 1,
        'base' => 1,
        'br' => 1,
        'col' => 1,
        'command' => 1,
        'embed' => 1,
        'hr' => 1,
        'img' => 1,
        'input' => 1,
        'keygen' => 1,
        'link' => 1,
        'meta' => 1,
        'param' => 1,
        'source' => 1,
        'track' => 1,
        'wbr' => 1,
    ];
    
    /**
     * 构造函数
     * @param string $name 元素名称
     * @param bool $isEnd 是否为闭合元素, 默认`true`
     */
    public function __construct(string $name = '', bool $isEnd = true)
    {
        if (!empty($name)) {
            $this->name = $name;
        }
        
        $this->end = $isEnd;
    }

    /**
     * 创建元素
     * 
     * - 会根据元素名称自动设置是否为闭合元素
     * @param string $name 元素名称
     * @param string $isEnd 是否闭合元素, 默认`null`自动检测
     * @return static
     */
    public static function create(string $name = '', bool $isEnd = null)
    {
        return new static($name, $isEnd ?? self::isEnd($name));
    }
    
    /**
     * 检查是否为闭合元素
     * @param string $name 元素名称
     * @return bool 返回true代表为成对标签, false代表单标签
     */
    public static function isEnd(string $name): bool
    {
        return isset(self::$void[$name]) ? false : true;
    }
    
    /**
     * 返回元素名称
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * 设置元素内容
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): Element
    {
        $this->content = $content;
        return $this;
    }
    
    /**
     * 获取元素内容
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
    
    /**
     * 设置元素的内容 - 可含HTML
     * @param string $value html代码
     * @return $this
     */
    public function html(string $value): Element
    {
        $this->content = $value;
        return $this;
    }
    
    /**
     * 设置元素的内容 - 不含HTML
     * @param string $value 纯文本, 会转义HTML代码
     * @return $this
     */
    public function text(string $value): Element
    {
        $this->content = self::htmlEncode($value);
        return $this;
    }
    
    /**
     * 设置或返回属性值
     * @param string $name 属性名
     * @param string $value 属性值
     * @return $this
     */
    public function attr(string $name, string $value): Element
    {
        $this->_attrs[$name] = $value;
        return $this;
    }
    
    /**
     * 设置多个属性
     * @param array $attrs `属性名 => 值`
     * @return $this
     */
    public function attrs(array $attrs): Element
    {
        $this->_attrs = array_merge($this->_attrs, $attrs);
        
        return $this;
    }
    
    /**
     * 属性名验证
     * @param string $name
     * @return bool
     */
    public static function attrCheck(string $name): bool
    {
        return preg_match('/(^|.*\])([\w\.\+]+)(\[.*|$)/u', $name) === 1;
    }

    /**
     * 解析元素属性
     * - 会忽略值为`null`的属性
     * @param array $attrs 属性数组
     * @param bool $boolAttr 是否合并布尔属性, 默认`true`
     * @return string
     */
    public static function parseAttr(array $attrs, bool $boolAttr = true): string
    {
        if (empty($attrs)) {
            return '';
        }
        
        $result = [];
        foreach ($attrs as $name => $value) {
            if ($boolAttr && $name == $value) {
                $result[] = $name;
            } elseif ($value !== null) {
                $result[] = $name . '=' . self::quote($value, 2);
            }
        }
        
        return ' ' . join(' ', $result);
    }
    
    /**
     * 生成元素的属性描述
     * @return string
     */
    protected function buildAttr(): string
    {
        return self::parseAttr($this->_attrs, $this->boolAttr);
    }
    
    /**
     * 返回元素的HTML代码
     * @return string
     */
    public function end(): string
    {
        $tag = $this->getLevelIndent();
        if ($this->end) {
            return $tag . "<{$this->name}{$this->buildAttr()}>{$this->content}</{$this->name}>";
        }
        
        return $tag . "<{$this->name}{$this->buildAttr()} />";
    }

    /**
     * 特殊字符转换为HTML实体, 例如 & > &amp;
     * @param string $string html代码
     * @param bool $double 是否转义HTML实体, 默认`true`
     */
    public static function htmlEncode(string $string, bool $double = true): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', $double);
    }
    
    /**
     * 将特殊HTML实体解码回相应的字符
     * @param string $string
     * @return string
     */
    public static function htmlDecode(string $string): string
    {
        return htmlspecialchars_decode($string, ENT_QUOTES);
    }
    
    /**
     * 引用字符串
     * @param string $string 内容
     * @param int|string|array $type 引号类型{默认0:``, 1:'', 2:"", '<>', '{}'}
     * @return string
     */
    public static function quote(string $string, $type = 0): string
    {
        if (is_numeric($type)) {
            $opt = ['`','\'','"'];
            $ql = $qr = (isset($opt[$type]) ? $opt[$type] : '\'');
        } elseif (is_array($type)) {
            if (isset($type['1'])) {
                $ql = $type['0'];
                $qr = $type['1'];
            } else {
                $ql = $qr = $type['0'];
            }
        } else {
            $len = strlen($type);
            if ($len > 2) {
                $avg = intval($len / 2);
                $ql = substr($type, 0, $avg);
                $qr = substr($type, $avg);
            } else {
                $ql = substr($type, 0, 1);
                $qr = substr($type, 1);
            }
        }
        
        return $ql . $string . $qr;
    }
    
    /**
     * 解释是否 true|false
     * @param bool $bool
     * @return string
     */
    public static function parseBoolean(bool $bool): string
    {
        return $bool ? 'true' : 'false';
    }
    
    /**
     * 解析是否 yes|no
     * @param bool $bool
     * @return string
     */
    public static function parseWhether(bool $bool): string
    {
        return $bool ? 'yes' : 'no';
    }
    
    /**
     * 解析开关 on|off
     * @param bool $bool
     * @return string
     */
    public static function parseSwitch(bool $bool): string
    {
        return $bool ? 'on' : 'off';
    }
}