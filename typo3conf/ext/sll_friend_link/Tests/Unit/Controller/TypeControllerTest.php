<?php
namespace Sll\SllFriendLink\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 三里林 <wanghongbin816@gmail.com>
 */
class TypeControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Sll\SllFriendLink\Controller\TypeController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Sll\SllFriendLink\Controller\TypeController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllTypesFromRepositoryAndAssignsThemToView()
    {

        $allTypes = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $typeRepository = $this->getMockBuilder(\Sll\SllFriendLink\Domain\Repository\TypeRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $typeRepository->expects(self::once())->method('findAll')->will(self::returnValue($allTypes));
        $this->inject($this->subject, 'typeRepository', $typeRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('types', $allTypes);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenTypeToView()
    {
        $type = new \Sll\SllFriendLink\Domain\Model\Type();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('type', $type);

        $this->subject->showAction($type);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenTypeToTypeRepository()
    {
        $type = new \Sll\SllFriendLink\Domain\Model\Type();

        $typeRepository = $this->getMockBuilder(\Sll\SllFriendLink\Domain\Repository\TypeRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $typeRepository->expects(self::once())->method('add')->with($type);
        $this->inject($this->subject, 'typeRepository', $typeRepository);

        $this->subject->createAction($type);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenTypeToView()
    {
        $type = new \Sll\SllFriendLink\Domain\Model\Type();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('type', $type);

        $this->subject->editAction($type);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenTypeInTypeRepository()
    {
        $type = new \Sll\SllFriendLink\Domain\Model\Type();

        $typeRepository = $this->getMockBuilder(\Sll\SllFriendLink\Domain\Repository\TypeRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $typeRepository->expects(self::once())->method('update')->with($type);
        $this->inject($this->subject, 'typeRepository', $typeRepository);

        $this->subject->updateAction($type);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenTypeFromTypeRepository()
    {
        $type = new \Sll\SllFriendLink\Domain\Model\Type();

        $typeRepository = $this->getMockBuilder(\Sll\SllFriendLink\Domain\Repository\TypeRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $typeRepository->expects(self::once())->method('remove')->with($type);
        $this->inject($this->subject, 'typeRepository', $typeRepository);

        $this->subject->deleteAction($type);
    }
}
