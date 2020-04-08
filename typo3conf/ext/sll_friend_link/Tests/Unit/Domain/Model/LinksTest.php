<?php
namespace Sll\SllFriendLink\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 三里林 <wanghongbin816@gmail.com>
 */
class LinksTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Sll\SllFriendLink\Domain\Model\Links
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Sll\SllFriendLink\Domain\Model\Links();
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
    public function getWebmasterReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getWebmaster()
        );
    }

    /**
     * @test
     */
    public function setWebmasterForStringSetsWebmaster()
    {
        $this->subject->setWebmaster('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'webmaster',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEmailReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailForStringSetsEmail()
    {
        $this->subject->setEmail('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'email',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLinksReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLinks()
        );
    }

    /**
     * @test
     */
    public function setLinksForStringSetsLinks()
    {
        $this->subject->setLinks('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'links',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getIntroductionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getIntroduction()
        );
    }

    /**
     * @test
     */
    public function setIntroductionForStringSetsIntroduction()
    {
        $this->subject->setIntroduction('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'introduction',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getIconReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getIcon()
        );
    }

    /**
     * @test
     */
    public function setIconForStringSetsIcon()
    {
        $this->subject->setIcon('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'icon',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNofollowReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getNofollow()
        );
    }

    /**
     * @test
     */
    public function setNofollowForBoolSetsNofollow()
    {
        $this->subject->setNofollow(true);

        self::assertAttributeEquals(
            true,
            'nofollow',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTypeReturnsInitialValueForType()
    {
        self::assertEquals(
            null,
            $this->subject->getType()
        );
    }

    /**
     * @test
     */
    public function setTypeForTypeSetsType()
    {
        $typeFixture = new \Sll\SllFriendLink\Domain\Model\Type();
        $this->subject->setType($typeFixture);

        self::assertAttributeEquals(
            $typeFixture,
            'type',
            $this->subject
        );
    }
}
