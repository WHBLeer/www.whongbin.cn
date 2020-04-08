<?php
namespace Sll\SllSnow\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author 三里林 <wanghongbin816@gmail.com>
 */
class SnowTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Sll\SllSnow\Domain\Model\Snow
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Sll\SllSnow\Domain\Model\Snow();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function dummyTestToNotLeaveThisFileEmpty()
    {
        self::markTestIncomplete();
    }
}
