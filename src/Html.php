<?php
include(__DIR__ . '/head.php');

class Html
{
    public static $lang = 'zh-CN';
    /**
     * 头部信息
     * @var Head
     */
    public static $head;
    
    public static $body;
    /**
     * css加载
     * @var array
     */
    public static $css = [];
    /**
     * 页面style
     * @var string
     */
    public static $style;
    /**
     * js加载
     * @var array
     */
    public static $js = [];
    
    public static function style()
    {
        if (!empty(self::$style)) {
            $style = self::$style;
            return <<<STYLE
<style>
$style
</style>;
STYLE;
        }
    }
    
    public static function js()
    {
        if(!empty(self::$js) && is_array(self::$js)) {
            $list = [];
            foreach (self::$js as $src) {
                $list[] = '<script type="text/javascript src="'. $src .'"></script>';
            }
            return join(PHP_EOL, $list);
        }
    }
    
    public static function css()
    {
        if(!empty(self::$css) && is_array(self::$css)) {
            $list = [];
            foreach (self::$css as $href) {
                $list[] = '<link rel="stylesheet" href="' . $href . '" />';
            }
            return join(PHP_EOL, $list);
        }
    }
        
    /**
     * 生成头部信息
     * @param Head $head
     */
    public static function head()
    {
        return self::$head->build();
    }
    
    
    
    public static function body()
    {
        
    }
    
    public static function view($theme = 'main')
    {
        include(__DIR__ . '/'. $theme .'/html.php');
    }
}