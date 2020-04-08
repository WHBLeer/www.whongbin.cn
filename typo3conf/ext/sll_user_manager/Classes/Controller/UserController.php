<?php
namespace Sll\SllUserManager\Controller;


/***
 *
 * This file is part of the "User Manager" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 三里林 <info@whongbin.cn>, 三里林
 *
 ***/
/**
 * UserController
 */
class UserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * userRepository
     * 
     * @var \Sll\SllUserManager\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;

    /**
     * action list
     * 
     * @param Sll\SllUserManager\Domain\Model\User
     * @return void
     */
    public function listAction()
    {
        $author = $this->userRepository->findByUid(1);
        // dump($author);
        $users = $this->userRepository->findAll();
        $this->view->assign('users', $users);
    }

    /**
     * action show
     * 
     * @param Sll\SllUserManager\Domain\Model\User
     * @return void
     */
    public function showAction(\Sll\SllUserManager\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
    }

    /**
     * action new
     * 
     * @param Sll\SllUserManager\Domain\Model\User
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param Sll\SllUserManager\Domain\Model\User
     * @return void
     */
    public function createAction(\Sll\SllUserManager\Domain\Model\User $newUser)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->add($newUser);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param Sll\SllUserManager\Domain\Model\User
     * @ignorevalidation $user
     * @return void
     */
    public function editAction(\Sll\SllUserManager\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
    }

    /**
     * action update
     * 
     * @param Sll\SllUserManager\Domain\Model\User
     * @return void
     */
    public function updateAction(\Sll\SllUserManager\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->update($user);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param Sll\SllUserManager\Domain\Model\User
     * @return void
     */
    public function deleteAction(\Sll\SllUserManager\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->remove($user);
        $this->redirect('list');
    }

    /**
     * action repassword
     * 
     * @param Sll\SllUserManager\Domain\Model\User
     * @return void
     */
    public function repasswordAction()
    {
    }
}
