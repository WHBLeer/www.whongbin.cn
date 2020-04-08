<?php
namespace Sll\SllSnow\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 三里林 <wanghongbin816@gmail.com>
 */
class SnowControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Sll\SllSnow\Controller\SnowController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Sll\SllSnow\Controller\SnowController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

}
