<?php
namespace Sll\SllFriendLink\Domain\Model;


/***
 *
 * This file is part of the "Friendly link" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 三里林 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * 链接分类
 */
class Type extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 名称
     * 
     * @var string
     */
    protected $title = '';

    /**
     * 别名
     * 
     * @var string
     */
    protected $slug = '';

    /**
     * Returns the title
     * 
     * @return string title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the slug
     * 
     * @return string slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the slug
     * 
     * @param string $slug
     * @return void
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}
