<?php
namespace Sll\SllFileManager\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 三里林 <info@whongbin.cn>
 */
class FileTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Sll\SllFileManager\Domain\Model\File
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Sll\SllFileManager\Domain\Model\File();
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
    public function getSlugReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getSlug()
        );
    }

    /**
     * @test
     */
    public function setSlugForStringSetsSlug()
    {
        $this->subject->setSlug('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'slug',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSizeReturnsInitialValueForFloat()
    {
        self::assertSame(
            0.0,
            $this->subject->getSize()
        );
    }

    /**
     * @test
     */
    public function setSizeForFloatSetsSize()
    {
        $this->subject->setSize(3.14159265);

        self::assertAttributeEquals(
            3.14159265,
            'size',
            $this->subject,
            '',
            0.000000001
        );
    }

    /**
     * @test
     */
    public function getAbsolutePathReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAbsolutePath()
        );
    }

    /**
     * @test
     */
    public function setAbsolutePathForStringSetsAbsolutePath()
    {
        $this->subject->setAbsolutePath('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'absolutePath',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRelativePathReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getRelativePath()
        );
    }

    /**
     * @test
     */
    public function setRelativePathForStringSetsRelativePath()
    {
        $this->subject->setRelativePath('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'relativePath',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTeaserReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTeaser()
        );
    }

    /**
     * @test
     */
    public function setTeaserForStringSetsTeaser()
    {
        $this->subject->setTeaser('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'teaser',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDownloadReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getDownload()
        );
    }

    /**
     * @test
     */
    public function setDownloadForIntSetsDownload()
    {
        $this->subject->setDownload(12);

        self::assertAttributeEquals(
            12,
            'download',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFileTypeReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getFileType()
        );
    }

    /**
     * @test
     */
    public function setFileTypeForIntSetsFileType()
    {
        $this->subject->setFileType(12);

        self::assertAttributeEquals(
            12,
            'fileType',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFileExtensionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFileExtension()
        );
    }

    /**
     * @test
     */
    public function setFileExtensionForStringSetsFileExtension()
    {
        $this->subject->setFileExtension('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'fileExtension',
            $this->subject
        );
    }
}
