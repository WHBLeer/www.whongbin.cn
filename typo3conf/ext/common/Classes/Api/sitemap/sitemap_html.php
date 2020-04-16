<?php header("Content-type: text/xml");header('HTTP/1.1 200 OK'); ?>
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.baidu.com/schemas/sitemap-mobile/1/">

<?php
$configArray = include_once ($_SERVER['DOCUMENT_ROOT']."/typo3conf/LocalConfiguration.php");
$configDB = $configArray['DB']['Connections']['Default'];
$baseURL = $configArray['FE']['baseURL'];
$con = new mysqli($configDB['host'],$configDB['user'],$configDB['password'],$configDB['dbname']);
if(!$con) die("connect error:".mysqli_connect_error());
?>
<?php
/* 单页面 */
$sql = "select pid,tstamp,title,slug from pages where pid<=1 and doktype=1 and nav_hide=0 and hidden=0";
$res = $con->query($sql);
if($res->num_rows > 0) {
    // 输出数据
    while($row = $res->fetch_assoc()){?>
<url>
    <loc><?php $loc = ($row['pid']==0) ? ($baseURL) : ($baseURL. ltrim($row['slug'],'/') .'.html'); echo $loc; ?></loc>
    <lastmod><?php echo date('Y-m-d\TH:i:s+00:00', $row['tstamp']); ?></lastmod>
    <changefreq><?php echo ($row['pid']==0) ? 'daily' : 'weekly'; ?></changefreq>
    <priority><?php echo ($row['pid']==0) ? '1.0' : '0.8'; ?></priority>
</url>
    <?php } /* 标签循环结束 */ ?>
<?php }

/* 分类页面 */
$sql2 = "select slug,tstamp from sys_category where parent<=1 and deleted=0 and hidden=0";
$res2 = $con->query($sql2);
if($res2->num_rows > 0) {
    // 输出数据
    while($row = $res2->fetch_assoc()){?>
<url>
    <loc><?php echo $baseURL. 'category/' . $row['slug'] .'.html'; ?></loc>
    <lastmod><?php echo date('Y-m-d\TH:i:s+00:00', $row['tstamp']); ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
</url>
    <?php } /* 标签循环结束 */ ?>
<?php }

/* 文章页面 */
$sql3 = "select uid,tstamp from tx_news_domain_model_news where deleted=0 and hidden=0";
$res3 = $con->query($sql3);
if($res3->num_rows > 0) {
    // 输出数据
    while($row = $res3->fetch_assoc()){?>
<url>
    <loc><?php echo $baseURL. 'article-detail/' . $row['uid'] .'.html'; ?></loc>
    <lastmod><?php echo date('Y-m-d\TH:i:s+00:00', $row['tstamp']); ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>
</url>
    <?php } /* 标签循环结束 */ ?>
<?php } ?> 
</urlset>