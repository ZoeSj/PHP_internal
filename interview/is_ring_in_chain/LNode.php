<?php

/**
 * Ecos Platform
 *
 * @author     shengjia
 * @copyright  Copyright (c) 2005-2014 ShopEx Technologies Inc. (http://www.shopex.cn)
 * @license    http://ecos.shopex.cn/ ShopEx License
 * Date: 2020/10/27
 * Time: 11:20
 */
class LNode
{
    public $data = null;
    public $next = null;
}

function eatList(LNode $node)
{
    $fast = $slow = $node;
    $first_target = null;
    if ($node->data == null) {
        return false;
    }
    while (true) {
        if ($fast->next != null && $fast->next->next != null) {
            $fast = $fast->next->next;      // 快指针一次走两步
            $slow = $slow->next;            // 慢指针一次走一步
        } else {
            return false;
        }
        if ($fast == $slow) {                // 慢指针追上快指针,说明有环
            $p1 = $node;                    // p1指针指向head节点,p2指针指向它们第一次相交的点,
            // 然后两个指针每次移动一步,当它们再次相交,即为环的入口
            $p2 = $fast;
            while ($p1 != $p2) {
                $p1 = $p1->next;
                $p2 = $p2->next;
            }
            return $p1;                     // 环的入口节点
        }
    }
}