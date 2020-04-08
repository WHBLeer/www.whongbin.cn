<?php
namespace Sll\SllTimeline\Domain\Model;


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
class Event extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * 标题
     * 
     * @var string
     */
    protected $title = '';

    /**
     * 事件链接
     * 
     * @var string
     */
    protected $eventLink = '';

    /**
     * 事件
     * 
     * @var string
     */
    protected $description = '';

    /**
     * 开始事件
     * 
     * @var int
     */
    protected $startDate = '';

    /**
     * 结束事件
     * 
     * @var int
     */
    protected $endDate = '';

    /**
     * 格式化
     * 
     * @var string
     */
    protected $format = '';

    /**
     * 侧
     * 
     * @var int
     */
    protected $side = false;

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
     * Returns the eventLink
     * 
     * @return string eventLink
     */
    public function getEventLink()
    {
        return $this->eventLink;
    }

    /**
     * Sets the eventLink
     * 
     * @param string $eventLink
     * @return void
     */
    public function setEventLink($eventLink)
    {
        $this->eventLink = $eventLink;
    }

    /**
     * Returns the description
     * 
     * @return string description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     * 
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the startDate
     * 
     * @return int startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Sets the startDate
     * 
     * @param string $startDate
     * @return void
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Returns the endDate
     * 
     * @return int endDate
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Sets the endDate
     * 
     * @param string $endDate
     * @return void
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Returns the format
     * 
     * @return string format
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Sets the format
     * 
     * @param string $format
     * @return void
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * Returns the side
     * 
     * @return int side
     */
    public function getSide()
    {
        return $this->side;
    }

    /**
     * Sets the side
     * 
     * @param bool $side
     * @return void
     */
    public function setSide($side)
    {
        $this->side = $side;
    }
}
