<?php
namespace Sll\SllTimeline\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 三里林 <wanghongbin816@gmail.com>
 */
class EventTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Sll\SllTimeline\Domain\Model\Event
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Sll\SllTimeline\Domain\Model\Event();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'title',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEventLinkReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEventLink()
        );
    }

    /**
     * @test
     */
    public function setEventLinkForStringSetsEventLink()
    {
        $this->subject->setEventLink('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'eventLink',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'description',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getStartDateReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getStartDate()
        );
    }

    /**
     * @test
     */
    public function setStartDateForIntSetsStartDate()
    {
        $this->subject->setStartDate(12);

        self::assertAttributeEquals(
            12,
            'startDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEndDateReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getEndDate()
        );
    }

    /**
     * @test
     */
    public function setEndDateForIntSetsEndDate()
    {
        $this->subject->setEndDate(12);

        self::assertAttributeEquals(
            12,
            'endDate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFormatReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFormat()
        );
    }

    /**
     * @test
     */
    public function setFormatForStringSetsFormat()
    {
        $this->subject->setFormat('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'format',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSideReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getSide()
        );
    }

    /**
     * @test
     */
    public function setSideForIntSetsSide()
    {
        $this->subject->setSide(12);

        self::assertAttributeEquals(
            12,
            'side',
            $this->subject
        );
    }
}
