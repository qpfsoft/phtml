<?php
namespace phtml\html\gather;

use phtml\html\Div;

/**
 * Div元素收集器
 * 
 * 方便操作
 */
class Divs
{
    /**
     * div元素集合
     * @var Div[]
     */
    private static $_div = [];
    
    /**
     * 创建或获取Div元素实例
     * @param string $id 标识ID, 全局唯一
     * @param bool $set 是否设置为元素ID属性, 默认`false`
     * 该参数仅在首次创建调用时有效
     * @return Div
     */
    public static function div(string $id, $set = false): Div
    {
        if (!isset(self::$_div[$id])) {
            self::$_div[$id] = new Div();
           if ($set) {
               self::$_div[$id]->id($id);
           }
        }

        return self::$_div[$id];
    }
    
    /**
     * 删除指定div元素
     * @param string $id 标识ID
     * @return void
     */
    public static function del(string $id): void
    {
        if (key_exists($id, self::$_div)) {
            unset(self::$_div[$id]);
        }
    }
    
    /**
     * 删除所有div元素
     */
    public static function delAll(): void
    {
        self::$_div = [];
    }
    
    /**
     * 获取所有DIV元素
     * @return Div[]
     */
    public static function getAll(): array
    {
        return self::$_div;
    }
}