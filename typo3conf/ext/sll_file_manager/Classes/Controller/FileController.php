<?php
namespace Sll\SllFileManager\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/***
 *
 * This file is part of the "File Manager" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 三里林 <info@whongbin.cn>, 三里林
 *
 ***/
/**
 * FileController
 */
class FileController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * persistenceManager
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
     * @inject
     */
    protected $persistenceManager = null;

    /**
     * fileRepository
     * 
     * @var \Sll\SllFileManager\Domain\Repository\FileRepository
     * @inject
     */
    protected $fileRepository = null;

    /**
     * action list
     * 
     * @param Sll\SllFileManager\Domain\Model\File
     * @return void
     */
    public function listAction()
    {
        $files = $this->fileRepository->findAll();
        $this->view->assign('files', $files);
    }

    /**
     * action show
     * 
     * @param Sll\SllFileManager\Domain\Model\File
     * @return void
     */
    public function showAction(\Sll\SllFileManager\Domain\Model\File $file)
    {
        $this->view->assign('file', $file);
    }

    /**
     * action new
     * 
     * @param Sll\SllFileManager\Domain\Model\File
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param Sll\SllFileManager\Domain\Model\File
     * @return void
     */
    public function createAction(\Sll\SllFileManager\Domain\Model\File $newFile)
    {
        $this->addFlashMessage('添加成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->fileRepository->add($newFile);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param Sll\SllFileManager\Domain\Model\File
     * @ignorevalidation $file
     * @return void
     */
    public function editAction(\Sll\SllFileManager\Domain\Model\File $file)
    {
        $this->view->assign('file', $file);
    }

    /**
     * action update
     * 
     * @param Sll\SllFileManager\Domain\Model\File
     * @return void
     */
    public function updateAction(\Sll\SllFileManager\Domain\Model\File $file)
    {
        $this->addFlashMessage('更新成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->fileRepository->update($file);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param Sll\SllFileManager\Domain\Model\File
     * @return void
     */
    public function deleteAction(\Sll\SllFileManager\Domain\Model\File $file)
    {
        $this->addFlashMessage('删除成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->fileRepository->remove($file);
        $this->redirect('list');
    }

    /**
     * action interface
     * 
     * @param Sll\SllFileManager\Domain\Model\File
     * @return void
     */
    public function interfaceAction()
    {
    }

    /**
     * action ajax
     * 
     * @param Sll\SllFileManager\Domain\Model\File
     * @return void
     */
    public function ajaxAction()
    {
    }

    /**
     * action multidelete
     * 
     * @param Sll\SllFileManager\Domain\Model\File
     * @return void
     */
    public function multideleteAction()
    {
        $this->addFlashMessage('删除成功!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->fileRepository->remove($file);
        $this->redirect('list');
    }

    /**
     * 文件/附件保存
     * 
     * @param array $file
     * @param array $data
     * @author wanghongbin <wanghongbin@ngoos.org>
     * @since
     * @return void
     */
    public function addFile($file = [], $data = [])
    {
        dump($file);
        if ($file['error'] == 0) {
            $fI = GeneralUtility::split_fileref($file['name']);
            $slugtitle = date('Ymd') . time() . '.' . $fI['fileext'];
            if (GeneralUtility::upload_copy_move($file['tmp_name'], $data['path'] . $slugtitle)) {
                $fileObj = new \Sll\SllFileManager\Domain\Model\File();
                $fileObj->setTitle($file['name']);
                $fileObj->setSlug($slugtitle);
                $fileObj->setSize($file['size']);
                $fileObj->setTeaser($data['teaser']);
                $fileObj->setFileType($this->getFileType($fI['fileext']));
                $fileObj->setFileExtension($fI['fileext']);
                $fileObj->setAbsolutePath($data['path'] . $slugtitle);
                $fileObj->setRelativePath($data['link'] . $slugtitle);
                $this->fileRepository->add($fileObj);
                $persistenceManager = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class);
                $persistenceManager->persistAll();
                return $fileObj;
            } else {
                return json_encode(['code' => 1, 'msg' => '移动文件失败!请检查目标目录的读写权限!']);
            }
        } else {
            return json_encode(['code' => 2, 'msg' => '文件读取失败!请确保文件上传到服务端!']);
        }

        //使用方法:
        // /** @var Sll\SllFileManager\Controller\FileController $fileObj*/
        // $fileObj = $this->objectManager->get(Sll\SllFileManager\Controller\FileController::class);
        // $fileObj = $fileObj->addFile($_FILE,['path'=>'/var/.../html/file/','link'=>'file/']);
    }

    /**
     * 删除原文件
     * 
     * @param \Sll\SllFileManager\Domain\Model\File $file
     * @author wanghongbin <wanghongbin@ngoos.org>
     * @since
     * @return void
     */
    public function delFile(\Sll\SllFileManager\Domain\Model\File $file = null)
    {
        if ($file) {
            $path = $file->getAbsolutePath();
            if (file_exists($path)) {
                unlink($path);
            }
            $this->fileRepository->remove($file);
            $persistenceManager = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class);
            $persistenceManager->persistAll();
        }
    }

    /**
     * 返回文件类型
     * 
     * @param [type] $fileext
     * @author wanghongbin <wanghongbin@ngoos.org>
     * @since
     * @return void
     */
    private function getFileType($fileext)
    {

        // 图片
        $_1 = ['png', 'jpg', 'jpeg', 'svg', 'ico', 'gif', 'bmp'];

        // 文档
        $_2 = ['doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'pdf', 'srt', 'txt', 'csv'];

        // 压缩包
        $_3 = ['zip', 'zipx', '7z', 'rar', 'tar', 'gz', 'tgz'];

        // 媒体文件
        $_4 = ['mp3', 'mp4', 'ogg', 'wav', 'webm'];
        if (in_array($fileext, $_1)) return '1';
        if (in_array($fileext, $_2)) return '2';
        if (in_array($fileext, $_3)) return '3';
        if (in_array($fileext, $_4)) return '4';
        return '0';
    }
}
