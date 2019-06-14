<?php
namespace phtml\html;

/**
 * 元素缩进特性
 */
trait ElementIndent
{
    /**
     * 缩进级别
     * - 等于设置几个`\t`的缩进
     * @var int
     */
    private $level = 0;
    /**
     * 转换空格
     * - 将一个制表符转换为4个空格键
     * @var string
     */
    private $convertSpaces = true;
    
    /**
     * 是否转换缩进为空格
     * @param bool $bool
     */
    protected function convertSpaces(bool $bool): void
    {
        $this->convertSpaces = $bool;
    }
    
    /**
     * 设置缩进级别
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
    }
    
    /**
     * 获取缩进级别
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }
    
    /**
     * 递增缩进级别
     * @param int $number 递增的级别数
     * @return int 返回当前最新的缩进级别值
     */
    protected function addLevel(int $number): int
    {
        return $this->level += $number;
    }
    
    /**
     * 递减缩进级别
     * - 始终最小不会小于0
     * @param int $number 递减的级别数
     * @return int 返回当前最新的缩进级别值
     */
    protected function lessLevel(int $number): int
    {
        return $this->level = max(0, $this->level - $number);
    }
    
    /**
     * 获取级别缩进的符号
     * @return string
     */
    protected function getLevelSymbol(): string
    {
        return $this->convertSpaces ? '    ' : "\t";
    }
    
    /**
     * 获取当前级别的缩进
     * @param string $add 临时增加缩进级别
     * @return string
     */
    protected function getLevelIndent(int $add = 0): string
    {
        if ($this->level > 0 || $add > 0) {
            return str_repeat($this->getLevelSymbol(), $this->level + $add);
        }
        return '';
    }
}