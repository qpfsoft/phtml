<?php
class Head
{
    /**
     * 标题
     * @var string
     */
    public $title = '网站标题';
    /**
     * 字符集
     * @var string
     */
    public $charset = 'utf-8';
    /**
     * favicon.ico路径
     * @var string
     */
    public $icon;
    /**
     * 兼容
     * @var string
     */
    public $compatible = true;
    
    
    public function titile()
    {
        return "<title>{$this->title}</title>";
    }
    
    public function charset()
    {
        return '<meta charset="' . $this->charset . '" />';
    }
    
    public function icon()
    {
        if (!empty($this->icon)) {
            if (is_string($this->icon)) {
                return '<link rel="shortcut icon" href="' . $this->icon .  '" type="image/x-icon">';
            }
        }
    }
    
    public function compatible()
    {
        if ($this->compatible) {
            return join(PHP_EOL, [
                '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">',
                '<meta http-equiv="Content-Type" content="text/html; charset='. $this->charset .'">'
            ]);
        }
    }

    
    public function build()
    {
        $row = [];
        $row[] = $this->charset();
        $row[] = $this->compatible();
        $row[] = $this->titile();
        $row[] = $this->icon();
        
        
        return join(PHP_EOL, $row);
    }
}