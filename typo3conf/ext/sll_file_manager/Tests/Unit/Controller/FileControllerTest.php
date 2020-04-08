<?php
namespace Sll\SllFileManager\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 三里林 <info@whongbin.cn>
 */
class FileControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Sll\SllFileManager\Controller\FileController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Sll\SllFileManager\Controller\FileController::class)
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
    public function listActionFetchesAllFilesFromRepositoryAndAssignsThemToView()
    {

        $allFiles = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $fileRepository = $this->getMockBuilder(\Sll\SllFileManager\Domain\Repository\FileRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $fileRepository->expects(self::once())->method('findAll')->will(self::returnValue($allFiles));
        $this->inject($this->subject, 'fileRepository', $fileRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('files', $allFiles);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenFileToView()
    {
        $file = new \Sll\SllFileManager\Domain\Model\File();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('file', $file);

        $this->subject->showAction($file);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenFileToFileRepository()
    {
        $file = new \Sll\SllFileManager\Domain\Model\File();

        $fileRepository = $this->getMockBuilder(\Sll\SllFileManager\Domain\Repository\FileRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $fileRepository->expects(self::once())->method('add')->with($file);
        $this->inject($this->subject, 'fileRepository', $fileRepository);

        $this->subject->createAction($file);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenFileToView()
    {
        $file = new \Sll\SllFileManager\Domain\Model\File();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('file', $file);

        $this->subject->editAction($file);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenFileInFileRepository()
    {
        $file = new \Sll\SllFileManager\Domain\Model\File();

        $fileRepository = $this->getMockBuilder(\Sll\SllFileManager\Domain\Repository\FileRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $fileRepository->expects(self::once())->method('update')->with($file);
        $this->inject($this->subject, 'fileRepository', $fileRepository);

        $this->subject->updateAction($file);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenFileFromFileRepository()
    {
        $file = new \Sll\SllFileManager\Domain\Model\File();

        $fileRepository = $this->getMockBuilder(\Sll\SllFileManager\Domain\Repository\FileRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $fileRepository->expects(self::once())->method('remove')->with($file);
        $this->inject($this->subject, 'fileRepository', $fileRepository);

        $this->subject->deleteAction($file);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenFileFromFileRepository()
    {
        $file = new \Sll\SllFileManager\Domain\Model\File();

        $fileRepository = $this->getMockBuilder(\Sll\SllFileManager\Domain\Repository\FileRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $fileRepository->expects(self::once())->method('remove')->with($file);
        $this->inject($this->subject, 'fileRepository', $fileRepository);

        $this->subject->deleteAction($file);
    }
}
