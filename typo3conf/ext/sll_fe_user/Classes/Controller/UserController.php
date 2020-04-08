<?php
namespace Sll\SllFeUser\Controller;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Saltedpasswords\Salt\SaltFactory;
use TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility;

/***
 *
 * This file is part of the "用户管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 杨世昌 <yangshichang@ngoos.org>, 极益科技
 *
 ***/
/**
 * UserController
 */
class UserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * persistanceManager
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
     * @inject
     */
    protected $persistenceManager = null;

    /**
     * userRepository
     * 
     * @var \Sll\SllFeUser\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = null;

    /**
     * action initialize
     * 
     * @return void
     */
    public function initializeAction()
    {
        $this->persistenceManager->persistAll();
    }

    /**
     * action list
     * 
     * @param Sll\SllFeUser\Domain\Model\User
     * @return void
     */
    public function listAction()
    {
        $keyword = $this->request->hasArgument('keyword') ? $this->request->getArgument('keyword') : '';
        $users = $this->userRepository->findAlls($keyword, $this->settings['groups']);
        $this->view->assign('users', $users);
    }

    /**
     * action show
     * 
     * @param Sll\SllFeUser\Domain\Model\User
     * @return void
     */
    public function showAction(\Sll\SllFeUser\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
    }

    /**
     * action new
     * 
     * @param Sll\SllFeUser\Domain\Model\User
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param Sll\SllFeUser\Domain\Model\User
     * @return void
     */
    public function createAction(\Sll\SllFeUser\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was created. ', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $user->setPassword($this->getSaltedpaswords($user->getPassword()));
        $this->userRepository->add($user);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param Sll\SllFeUser\Domain\Model\User
     * @ignorevalidation $user
     * @return void
     */
    public function editAction(\Sll\SllFeUser\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
    }

    /**
     * action update
     * 
     * @param Sll\SllFeUser\Domain\Model\User
     * @return void
     */
    public function updateAction(\Sll\SllFeUser\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was updated. ', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->userRepository->update($user);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param Sll\SllFeUser\Domain\Model\User
     * @return void
     */
    public function deleteAction(\Sll\SllFeUser\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was deleted. ', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->userRepository->remove($user);
        $this->redirect('list');
    }

    /**
     * action interface
     * 
     * @param Sll\SllFeUser\Domain\Model\User
     * @return void
     */
    public function interfaceAction()
    {
    }

    /**
     * action ajax
     * 
     * @param Sll\SllFeUser\Domain\Model\User
     * @return void
     */
    public function ajaxAction()
    {
    }

    /**
     * 获取加密后的密码
     * 
     * @param string $password
     * @return string
     */
    private function getSaltedpaswords($password)
    {
        if (ExtensionManagementUtility::isLoaded('saltedpasswords') && SaltedPasswordsUtility::isUsageEnabled('FE')) {
            $objSalt = SaltFactory::getSaltingInstance(null);
            if (is_object($objSalt)) {
                return $objSalt->getHashedPassword($password);
            }
        }
        return $password;
    }

    /**
     * 密码比较
     * 
     * @param $submittedPassword 明文密码
     * @param $originalPassword $originalPassword
     */
    private function checkUserPassword($submittedPassword, $originalPassword)
    {
        $check = false;
        $saltedpasswords = \TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility::returnExtConf();
        if ($saltedpasswords['enabled']) {
            $tx_saltedpasswords = GeneralUtility::makeInstance($saltedpasswords['saltedPWHashingMethod']);
            if ($tx_saltedpasswords->checkPassword($submittedPassword, $originalPassword)) {
                $check = true;
            }
        }
        return $check;
    }
}
