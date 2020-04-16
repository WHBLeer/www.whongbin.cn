<?php

/**
 * 生成站点地图
 *
 * @author wanghongbin
 * tstamp: 2020-04-13
 */
class Sitemap{
    // constructor receives the list of URLs to include in the sitemap
    public function Sitemap($items = array())
    {
        $this->_items = $items;
    }

    // add a new sitemap item
    public function addItem($url, $lastmod ='', $changefreq = '', $priority = '',$additional_fields = array())
    {
        $this->_items[] = array_merge(
            array(
                'loc' => $url,
                'lastmod' => $lastmod,
                'changefreq' => $changefreq,
                'priority' => $priority
            ),
            $additional_fields
        );
    }
    // get Google sitemap
    public function getGoogle()
    {
        ob_start();
        header('Content-type: text/xml');
        echo '<?xml version="1.0″ encoding="UTF-8″?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9″
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        foreach ($this->_items as $i){
            echo '<url>';
            foreach ($i as $index => $_i){
                if (!$_i) continue;
                echo "<$index>" . $this->_escapeXML($_i) . "</$index>";
            }
            echo '</url>';
        }
        echo '</urlset>';
        return ob_get_clean();
    }

    // escape string characters for inclusion in XML structure
    public function _escapeXML($str)
    {
        $translation = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        foreach ($translation as $key => $value){
            $translation[$key] = '&#' . ord($key) . ';';
        }
        $translation[chr(38)] = '&';
        return preg_replace("/&(?![A-Za-z]{0,4}\w{2,3};|#[0-9]{2,3};)/","&#38;",strtr($str, $translation));
    }
}
