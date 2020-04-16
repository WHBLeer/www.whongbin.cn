<?php
// redirect requests to dynamic to their keyword rich versions
require_once '/fileadmin/sitemap/Sitemap.inc.php';
define('SITE_DOMAIN', 'http://www.jbxue.com');
// create the Sitemap object
$s = new Sitemap();
// add sitemap items
$s->addItem(SITE_DOMAIN);
$s->addItem(SITE_DOMAIN."/aboutus.html");
$s->addItem(SITE_DOMAIN."/whatnew.php");


// 连接数据库，生成URL并通过条用$s->addItem()加入到sitemap中。
// output sitemap
if (isset($_GET['target']))
{
    // generate Google sitemap
    if (($target = $_GET['target']) == 'google'){
        echo $s->getGoogle();
    }
}
?>

![](https://gitee.com/whongbin/FigureBed/raw/master/img/20200414073455.png)