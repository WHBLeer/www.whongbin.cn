<?php
declare(strict_types = 1);
namespace GeorgRinger\News\Utility;

/**
 * This file is part of the "news" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */
use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Page Utility class
 *
 */
class PageTitleProvider extends AbstractPageTitleProvider
{
    public function __construct()
    {
        $this->title = '三里林-页面';
    }

    /**
     * @param string $title
     */
     public function setTitle(string $title)
     {
         $this->title = $title;
     }
}