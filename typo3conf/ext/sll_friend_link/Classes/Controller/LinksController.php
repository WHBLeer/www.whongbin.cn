<?php
namespace Sll\SllFriendLink\Controller;


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
 * LinksController
 */
class LinksController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * linksRepository
     * 
     * @var \Sll\SllFriendLink\Domain\Repository\LinksRepository
     * @inject
     */
    protected $linksRepository = null;

    /**
     * action list
     * 
     * @param Sll\SllFriendLink\Domain\Model\Links
     * @return void
     */
    public function listAction()
    {
        $linkss = $this->linksRepository->findAll();
        $this->view->assign('linkss', $linkss);
    }

    /**
     * action show
     * 
     * @param Sll\SllFriendLink\Domain\Model\Links
     * @return void
     */
    public function showAction(\Sll\SllFriendLink\Domain\Model\Links $links)
    {
        $this->view->assign('links', $links);
    }

    /**
     * action new
     * 
     * @param Sll\SllFriendLink\Domain\Model\Links
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param Sll\SllFriendLink\Domain\Model\Links
     * @return void
     */
    public function createAction(\Sll\SllFriendLink\Domain\Model\Links $links)
    {
        $this->addFlashMessage('链接已添加!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->linksRepository->add($links);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param Sll\SllFriendLink\Domain\Model\Links
     * @ignorevalidation $links
     * @return void
     */
    public function editAction(\Sll\SllFriendLink\Domain\Model\Links $links)
    {
        $this->view->assign('links', $links);
    }

    /**
     * action update
     * 
     * @param Sll\SllFriendLink\Domain\Model\Links
     * @return void
     */
    public function updateAction(\Sll\SllFriendLink\Domain\Model\Links $links)
    {
        $this->addFlashMessage('连接已更新!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->linksRepository->update($links);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param Sll\SllFriendLink\Domain\Model\Links
     * @return void
     */
    public function deleteAction(\Sll\SllFriendLink\Domain\Model\Links $links)
    {
        $this->addFlashMessage('链接已删除!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->linksRepository->remove($links);
        $this->redirect('list');
    }

    /**
     * action footer
     * 
     * @param Sll\SllFriendLink\Domain\Model\Links
     * @return void
     */
    public function footerAction()
    {
    }

    /**
     * action qlist
     * 
     * @param Sll\SllFriendLink\Domain\Model\Links
     * @return void
     */
    public function qlistAction()
    {
    }
}
