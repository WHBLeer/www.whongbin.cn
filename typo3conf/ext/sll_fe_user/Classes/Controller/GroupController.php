<?php
namespace Sll\SllFeUser\Controller;


/***
 *
 * This file is part of the "用户管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 杨世昌 <yangshichang@ngoos.org>, 极益科技
 *           杨世昌 <yangshichang@ngoos.org>, 极益科技
 *
 ***/
/**
 * GroupController
 */
class GroupController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * groupRepository
     * 
     * @var \Sll\SllFeUser\Domain\Repository\GroupRepository
     * @inject
     */
    protected $groupRepository = null;

    /**
     * action list
     * 
     * @param Sll\SllFeUser\Domain\Model\Group
     * @return void
     */
    public function listAction()
    {
        $keyword = $this->request->hasArgument('keyword') ? $this->request->getArgument('keyword') : '';
        $groups = $this->groupRepository->findAlls($keyword);
        $this->view->assign('groups', $groups);
    }

    /**
     * action show
     * 
     * @param Sll\SllFeUser\Domain\Model\Group
     * @return void
     */
    public function showAction(\Sll\SllFeUser\Domain\Model\Group $group)
    {
        $this->view->assign('group', $group);
    }

    /**
     * action new
     * 
     * @param Sll\SllFeUser\Domain\Model\Group
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param Sll\SllFeUser\Domain\Model\Group
     * @return void
     */
    public function createAction(\Sll\SllFeUser\Domain\Model\Group $newGroup)
    {
        $this->addFlashMessage('The object was created.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->groupRepository->add($newGroup);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param Sll\SllFeUser\Domain\Model\Group
     * @ignorevalidation $group
     * @return void
     */
    public function editAction(\Sll\SllFeUser\Domain\Model\Group $group)
    {
        $this->view->assign('group', $group);
    }

    /**
     * action update
     * 
     * @param Sll\SllFeUser\Domain\Model\Group
     * @return void
     */
    public function updateAction(\Sll\SllFeUser\Domain\Model\Group $group)
    {
        $this->addFlashMessage('The object was updated.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->groupRepository->update($group);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param Sll\SllFeUser\Domain\Model\Group
     * @return void
     */
    public function deleteAction(\Sll\SllFeUser\Domain\Model\Group $group)
    {
        $this->addFlashMessage('The object was deleted.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->groupRepository->remove($group);
        $this->redirect('list');
    }
}
