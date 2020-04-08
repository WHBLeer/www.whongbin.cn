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
 * 友情链接
 */
class Links extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 站点名称
     * 
     * @var string
     */
    protected $title = '';

    /**
     * 站长名称
     * 
     * @var string
     */
    protected $webmaster = '';

    /**
     * 站点链接
     * 
     * @var string
     */
    protected $links = '';

    /**
     * 站点介绍
     * 
     * @var string
     */
    protected $introduction = '';

    /**
     * 站点图标
     * 
     * @var string
     */
    protected $icon = '';

    /**
     * nofollow
     * 
     * @var bool
     */
    protected $nofollow = false;

    /**
     * 链接分类
     * 
     * @var \Sll\SllFriendLink\Domain\Model\Type
     */
    protected $type = null;

    /**
     * 联系邮箱
     * 
     * @var string
     */
    protected $email = '';

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
     * Returns the webmaster
     * 
     * @return string webmaster
     */
    public function getWebmaster()
    {
        return $this->webmaster;
    }

    /**
     * Sets the webmaster
     * 
     * @param string $webmaster
     * @return void
     */
    public function setWebmaster($webmaster)
    {
        $this->webmaster = $webmaster;
    }

    /**
     * Returns the links
     * 
     * @return string links
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Sets the links
     * 
     * @param string $links
     * @return void
     */
    public function setLinks($links)
    {
        $this->links = $links;
    }

    /**
     * Returns the introduction
     * 
     * @return string introduction
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * Sets the introduction
     * 
     * @param string $introduction
     * @return void
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;
    }

    /**
     * Returns the icon
     * 
     * @return string icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Sets the icon
     * 
     * @param string $icon
     * @return void
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * Returns the nofollow
     * 
     * @return bool nofollow
     */
    public function getNofollow()
    {
        return $this->nofollow;
    }

    /**
     * Sets the nofollow
     * 
     * @param bool $nofollow
     * @return void
     */
    public function setNofollow($nofollow)
    {
        $this->nofollow = $nofollow;
    }

    /**
     * Returns the boolean state of nofollow
     * 
     * @return bool nofollow
     */
    public function isNofollow()
    {
        return $this->nofollow;
    }

    /**
     * Returns the type
     * 
     * @return \Sll\SllFriendLink\Domain\Model\Type type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     * 
     * @param \Sll\SllFriendLink\Domain\Model\Type $type
     * @return void
     */
    public function setType(\Sll\SllFriendLink\Domain\Model\Type $type)
    {
        $this->type = $type;
    }

    /**
     * Returns the email
     * 
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     * 
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}
