<?php

namespace DominicJoas\Timeline\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class TimelineEvent extends AbstractEntity {
    
    /**
     * The title of the Event
     *
     * @var string
     * */
    protected $title = '';
    
    /**
     * The link for the title
     *
     * @var string
     * */
    protected $eventLink = '';
    
    /**
     * The description of the Event
     *
     * @var string
     * */
    protected $description = '';
    
    /**
     * The start-date of the Event
     *
     * @var int
     * */
    protected $startDate = 0;
    
    /**
     * The End-Date of the Event
     *
     * @var int
     * */
    protected $endDate = 0;
    
    /**
     * The format of the Event-Dates
     *
     * @var string
     * */
    protected $format = '';
    
    /**
     * The Direction of the event
     *
     * @var int
     * */
    protected $side = 0;

    public function __construct($title = '', $description = '', $startDate = null, $endDate = null, $format = '', $side = null) {
        $this->title = $title;
        $this->eventLink = "";
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->format = $format;
        $this->side = $side;
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }
    
    public function setEventLink($eventLink) {
        $this->eventLink = $eventLink;
    }

    public function getEventLink() {
        return $this->eventLink;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function setFormat($format) {
        $this->format = $format;
    }

    public function getFormat() {
        return $this->format;
    }

    public function setSide($side) {
        $this->side = $side;
    }

    public function getSide() {
        return $this->side;
    }

}

