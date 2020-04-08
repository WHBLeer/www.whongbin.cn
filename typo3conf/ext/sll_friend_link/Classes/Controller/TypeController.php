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
 * TypeController
 */
class TypeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * typeRepository
     * 
     * @var \Sll\SllFriendLink\Domain\Repository\TypeRepository
     * @inject
     */
    protected $typeRepository = null;

    /**
     * action list
     * 
     * @param Sll\SllFriendLink\Domain\Model\Type
     * @return void
     */
    public function listAction()
    {
        $types = $this->typeRepository->findAll();
        $this->view->assign('types', $types);
    }

    /**
     * action show
     * 
     * @param Sll\SllFriendLink\Domain\Model\Type
     * @return void
     */
    public function showAction(\Sll\SllFriendLink\Domain\Model\Type $type)
    {
        $this->view->assign('type', $type);
    }

    /**
     * action new
     * 
     * @param Sll\SllFriendLink\Domain\Model\Type
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param Sll\SllFriendLink\Domain\Model\Type
     * @return void
     */
    public function createAction(\Sll\SllFriendLink\Domain\Model\Type $type)
    {
        $this->addFlashMessage('分类已添加!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->typeRepository->add($newType);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param Sll\SllFriendLink\Domain\Model\Type
     * @ignorevalidation $type
     * @return void
     */
    public function editAction(\Sll\SllFriendLink\Domain\Model\Type $type)
    {
        $this->view->assign('type', $type);
    }

    /**
     * action update
     * 
     * @param Sll\SllFriendLink\Domain\Model\Type
     * @return void
     */
    public function updateAction(\Sll\SllFriendLink\Domain\Model\Type $type)
    {
        $this->addFlashMessage('分类已更新!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->typeRepository->update($type);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param Sll\SllFriendLink\Domain\Model\Type
     * @return void
     */
    public function deleteAction(\Sll\SllFriendLink\Domain\Model\Type $type)
    {
        $this->addFlashMessage('分类已删除!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->typeRepository->remove($type);
        $this->redirect('list');
    }
}
