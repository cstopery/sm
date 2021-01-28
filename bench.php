<?php
// 性能测试
// composer require ch4o5/sm3-php
// 下面是随便一段话
//SM3是中华人民共和国政府采用的一种密码散列函数标准，由国家密码管理局于2010年12月17日发布。相关标准为“GM/T 0004-2012 《SM3密码杂凑算法》”。
//在商用密码体系中，SM3主要用于数字签名及验证、消息认证码生成及验证、随机数生成等，其算法公开。据国家密码管理局表示，其安全性及效率与SHA-256相当。
//中文名SM3外文名SM3领    域密码学
//目录
//1 简介
//2 密码散列函数
//▪ 特性
//3 SHA-2
//简介编辑
//SM3是中华人民共和国政府采用的一种密码散列函数标准，由国家密码管理局于2010年12月17日发布。相关标准为“GM/T 0004-2012 《SM3密码杂凑算法》”。
//在商用密码体系中，SM3主要用于数字签名及验证、消息认证码生成及验证、随机数生成等，其算法公开。据国家密码管理局表示，其安全性及效率与SHA-256相当。 [1]
//密码散列函数编辑
//密码散列函数（英语：Cryptographic hash function），又译为加密散列函数、密码散列函数、加密散列函数，是散列函数的一种。它被认为是一种单向函数，也就是说极其难以由散列函数输出的结果，回推输入的数据是什么。这样的单向函数被称为“现代密码学的驮马”。这种散列函数的输入数据，通常被称为消息（message），而它的输出结果，经常被称为消息摘要（message digest）或摘要（digest）。
//在信息安全中，有许多重要的应用，都使用了密码散列函数来实现，例如数字签名，消息认证码。
//特性
//一个理想的密码散列函数应该有四个主要的特性：
//对于任何一个给定的消息，它都很容易就能运算出散列数值。
//难以由一个已知的散列数值，去推算出原始的消息。
//在不更动散列数值的前提下，修改消息内容是不可行的。
//对于两个不同的消息，它不能给与相同的散列数值。 [1]
//SHA-2编辑
//SHA-2，名称来自于安全散列算法2（英语：Secure Hash Algorithm 2）的缩写，一种密码散列函数算法标准，由美国国家安全局研发，由美国国家标准与技术研究院（NIST）在2001年发布。属于SHA算法之一，是SHA-1的后继者。其下又可再分为六个不同的算法标准，包括了：SHA-224、SHA-256、SHA-384、SHA-512、SHA-512/224、SHA-512/256。 [2]
//参考资料
require __DIR__ . '/vendor/autoload.php';

$str = file_get_contents(__FILE__);

$t = microtime(true);
// 字符串签名
echo 'openssl:' . trim(str_replace('(stdin)=', '', exec('cat ' . __FILE__ . ' | openssl dgst -SM3'))) . PHP_EOL;;


$t1 = microtime(true);
// 字符串签名
echo 'one-sm3:' . \OneSm\Sm3::sign($str) . PHP_EOL;


$t2 = microtime(true);

echo 'SM3-PHP:' . sm3($str) . PHP_EOL;

$t3 = microtime(true);

echo 'openssl time:'.($t1 - $t) * 1000 . 'ms' . PHP_EOL;
echo 'one-sm3 time:'.($t2 - $t1) * 1000 . 'ms' . PHP_EOL;
echo 'SM3-PHP time:'.($t3 - $t2) * 1000 . 'ms' . PHP_EOL;

// 文件签名
//echo \OneSm\Sm3::signFile(__FILE__) . PHP_EOL;
