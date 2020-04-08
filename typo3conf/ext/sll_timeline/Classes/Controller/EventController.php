<?php
namespace Sll\SllTimeline\Controller;


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
 * EventController
 */
class EventController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * eventRepository
     * 
     * @var \Sll\SllTimeline\Domain\Repository\EventRepository
     * @inject
     */
    protected $eventRepository = null;

    /**
     * action list
     * 
     * @param Sll\SllTimeline\Domain\Model\Event
     * @return void
     */
    public function listAction()
    {
        $linkss = $this->linksRepository->findAll();
        $this->view->assign('linkss', $linkss);
    }

    /**
     * action new
     * 
     * @param Sll\SllTimeline\Domain\Model\Event
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param Sll\SllTimeline\Domain\Model\Event
     * @return void
     */
    public function createAction(\Sll\SllTimeline\Domain\Model\Event $event)
    {
        $this->addFlashMessage('链接已添加!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->linksRepository->add($links);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param Sll\SllTimeline\Domain\Model\Event
     * @ignorevalidation $event
     * @return void
     */
    public function editAction(\Sll\SllTimeline\Domain\Model\Event $event)
    {
        $this->view->assign('links', $links);
    }

    /**
     * action update
     * 
     * @param Sll\SllTimeline\Domain\Model\Event
     * @return void
     */
    public function updateAction(\Sll\SllTimeline\Domain\Model\Event $event)
    {
        $this->addFlashMessage('连接已更新!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->linksRepository->update($links);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param Sll\SllTimeline\Domain\Model\Event
     * @return void
     */
    public function deleteAction(\Sll\SllTimeline\Domain\Model\Event $event)
    {
        $this->addFlashMessage('链接已删除!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->linksRepository->remove($links);
        $this->redirect('list');
    }

    /**
     * action index
     * 
     * @return void
     */
    public function indexAction()
    {
    }
}
