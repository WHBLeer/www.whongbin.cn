<?php
namespace Sll\SllFriendLink\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author 三里林 <wanghongbin816@gmail.com>
 */
class LinksControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Sll\SllFriendLink\Controller\LinksController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Sll\SllFriendLink\Controller\LinksController::class)
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
    public function listActionFetchesAllLinkssFromRepositoryAndAssignsThemToView()
    {

        $allLinkss = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $linksRepository = $this->getMockBuilder(\Sll\SllFriendLink\Domain\Repository\LinksRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $linksRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLinkss));
        $this->inject($this->subject, 'linksRepository', $linksRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('linkss', $allLinkss);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLinksToView()
    {
        $links = new \Sll\SllFriendLink\Domain\Model\Links();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('links', $links);

        $this->subject->showAction($links);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLinksToLinksRepository()
    {
        $links = new \Sll\SllFriendLink\Domain\Model\Links();

        $linksRepository = $this->getMockBuilder(\Sll\SllFriendLink\Domain\Repository\LinksRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $linksRepository->expects(self::once())->method('add')->with($links);
        $this->inject($this->subject, 'linksRepository', $linksRepository);

        $this->subject->createAction($links);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenLinksToView()
    {
        $links = new \Sll\SllFriendLink\Domain\Model\Links();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('links', $links);

        $this->subject->editAction($links);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenLinksInLinksRepository()
    {
        $links = new \Sll\SllFriendLink\Domain\Model\Links();

        $linksRepository = $this->getMockBuilder(\Sll\SllFriendLink\Domain\Repository\LinksRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $linksRepository->expects(self::once())->method('update')->with($links);
        $this->inject($this->subject, 'linksRepository', $linksRepository);

        $this->subject->updateAction($links);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenLinksFromLinksRepository()
    {
        $links = new \Sll\SllFriendLink\Domain\Model\Links();

        $linksRepository = $this->getMockBuilder(\Sll\SllFriendLink\Domain\Repository\LinksRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $linksRepository->expects(self::once())->method('remove')->with($links);
        $this->inject($this->subject, 'linksRepository', $linksRepository);

        $this->subject->deleteAction($links);
    }
}
