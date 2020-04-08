<?php
namespace Sll\Common\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
/***
 *
 * This file is part of the "通用配置" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 三里林 <wanghongbin816@gmail.com>, 三里林
 *
 ***/
/**
 * ConfigController
 */
class ConfigController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * configRepository
     * 
     * @var \Sll\Common\Domain\Repository\ConfigRepository
     * @inject
     */
    protected $configRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $this->view->assign('hash', uniqid(microtime()));
        $this->view->assign('TYPO3_CONF_VARS', $GLOBALS['TYPO3_CONF_VARS']);
        // dump($GLOBALS['TYPO3_CONF_VARS']);
        // list($width, $height) = getimagesize($certificateFile);
    }

    /**
     * action update
     * 
     * @param \Sll\Common\Domain\Model\Config $config
     * @return void
     */
    public function updateAction()
    {
        // dump($this->request->getArguments());exit;
        $errorArray = array();
        $fileConfArr = array();
        if ($this->request->hasArgument('label') && $this->request->getArgument('label')=='file') {
            // dump($_FILES);
            //favicon
            $faviconFile = 'fileadmin/static_file/img/favicon.ico';
            if(!empty($_FILES['favicon']['tmp_name'])){
                if(is_writeable($faviconFile)){
                    GeneralUtility::upload_copy_move($_FILES['favicon']['tmp_name'], $faviconFile);
                    //图片进行了压缩处理，在上传时，删除缓存文件
                    exec("pwd",$output);
                    $path = $output[0]."/fileadmin/_processed_/*";
                    exec("rm -rf ".$path,$out);
                    $fileConfArr['FILE']['favicon'] = $faviconFile;
                }else{
                    $errorArray[] = 'Favicon文件无写入权限';
                }
            }
            //logo_sm
            $logoSmFile = 'fileadmin/static_file/img/logo_sm.svg';
            if(!empty($_FILES['logo_sm']['tmp_name'])){
                if(is_writeable($logoSmFile)){
                    GeneralUtility::upload_copy_move($_FILES['logo_sm']['tmp_name'], $logoSmFile);
                    //图片进行了压缩处理，在上传时，删除缓存文件
                    exec("pwd",$output);
                    $path = $output[0]."/fileadmin/_processed_/*";
                    exec("rm -rf ".$path,$out);
                    $fileConfArr['FILE']['logo_sm'] = $logoSmFile;
                }else{
                    $errorArray[] = 'Logo_sm文件无写入权限';
                }
            }

            //logo
            $logoFile = 'fileadmin/static_file/img/logo.svg';
            if(!empty($_FILES['logo']['tmp_name'])){
                if(is_writeable($logoFile)){
                    GeneralUtility::upload_copy_move($_FILES['logo']['tmp_name'], $logoFile);
                    //图片进行了压缩处理，在上传时，删除缓存文件
                    exec("pwd",$output);
                    $path = $output[0]."/fileadmin/_processed_/*";
                    exec("rm -rf ".$path,$out);
                    $fileConfArr['FILE']['logo'] = $logoFile;
                }else{
                    $errorArray[] = 'Logo文件无写入权限';
                }
            }
            
            //loginlogo
            $loginLogoFile = 'fileadmin/static_file/img/login_logo.svg';
            if(!empty($_FILES['login_logo']['tmp_name'])){
                if(is_writeable($loginLogoFile)){
                    GeneralUtility::upload_copy_move($_FILES['login_logo']['tmp_name'], $loginLogoFile);
                    //图片进行了压缩处理，在上传时，删除缓存文件
                    exec("pwd",$output);
                    $path = $output[0]."/fileadmin/_processed_/*";
                    exec("rm -rf ".$path,$out);
                    $fileConfArr['FILE']['login_logo'] = $loginLogoFile;
                }else{
                    $errorArray[] = '登录页Logo文件无写入权限';
                }
            }

            //banner_index
            if(!empty($_FILES['banner_index']['tmp_name'][0])){
                for ($i=0; $i < count($_FILES['banner_index']['name']); $i++) { 
                    $bannerFilePath = 'fileadmin/static_file/img/';
                    if(file_exists($bannerFilePath)){
                        $bannerFile = $bannerFilePath.'banner_index_' . ($i+1) . '.jpg';
                        GeneralUtility::upload_copy_move($_FILES['banner_index']['tmp_name'][$i], $bannerFile);
                        $fileConfArr['FILE']['banner_index'][] = $bannerFile;
                    }else{
                        $errorArray[] = '首页Banner大图无写入权限';
                    }
                }
            }

            //banner_inner
            $bannerFile = 'fileadmin/static_file/img/banner_inner.jpg';
            if(!empty($_FILES['banner_inner']['tmp_name'])){
                if(is_writeable($bannerFile)){
                    GeneralUtility::upload_copy_move($_FILES['banner_inner']['tmp_name'], $bannerFile);
                    $fileConfArr['FILE']['banner_inner'] = $bannerFile;
                }else{
                    $errorArray[] = '内页Banner大图无写入权限';
                }
            }

            //login_bg
            $loginBgFile = 'fileadmin/static_file/img/login_bg.jpg';
            if(!empty($_FILES['login_bg']['tmp_name'])){
                if(is_writeable($loginBgFile)){
                    GeneralUtility::upload_copy_move($_FILES['login_bg']['tmp_name'], $loginBgFile);
                    $fileConfArr['FILE']['login_bg'] = $loginBgFile;
                }else{
                    $errorArray[] = '登录页背景图无写入权限';
                }
            }
        }
        // dump($fileConfArr);
        // exit;
        // site title
        $this->updateValue([ 'sitetitle' => GeneralUtility::_GP('sitename') ], 'sys_template', [ 'uid' => 1 ]);
            
        //################################switch template begin##############################
        //查询config和constants
        $ts = $this->getValue(['config', 'constants'], 'sys_template', [ 'uid' => 1 ]);
        //循环处理config的数据
        $tsArray = GeneralUtility::trimExplode(chr(10), $ts['config']);
        foreach ($tsArray as $key=>$val) {
            if(preg_match("/FILE\:EXT\:common\/Configuration\/TypoScript\/plugin\.typoscript/is", $val)){
                unset($tsArray[$key]);
            }
            if(preg_match("/config\.baseURL/is", $val)){
                unset($tsArray[$key]);
            }
        }
        array_unshift($tsArray, 'config.baseURL = ' . $_POST['TYPO3_CONF_VARS']['FE']['baseURL']);
        array_unshift($tsArray, '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:common/Configuration/TypoScript/plugin.typoscript">');
        //修改config的数据
        $this->updateValue([ 'config'=>implode(chr(10), $tsArray)], 'sys_template', [ 'uid' => 1 ]);
        //################################switch template end################################

        //TYPO3_CONF_VARS Config
        if(!empty($_POST['TYPO3_CONF_VARS'])){
            $configurationManager = $this->objectManager->get(\TYPO3\CMS\Core\Configuration\ConfigurationManager::class);
            $configurationManager->updateLocalConfiguration($_POST['TYPO3_CONF_VARS']);
        }
        if(!empty($fileConfArr)){
            $configurationManager = $this->objectManager->get(\TYPO3\CMS\Core\Configuration\ConfigurationManager::class);
            $configurationManager->updateLocalConfiguration($fileConfArr);
        }
        
        if(!empty($errorArray)){
            foreach($errorArray as $error){
                $this->addFlashMessage($error, '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            }
        }else{
            $this->addFlashMessage('配置更新成功', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        }
        
        $CacheManager = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Cache\CacheManager::class);
        $CacheManager->flushCachesInGroup('pages');
        
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Sll\Common\Domain\Model\Config $config
     * @return void
     */
    public function deleteAction(\Sll\Common\Domain\Model\Config $config)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->configRepository->remove($config);
        $this->redirect('list');
    }
    
    /**
     * 获取数据
     *
     * @param [type] $field
     * @param [type] $table
     * @param [type] $where
     * @return void
     * @author wanghongbin <wanghongbin@ngoos.org>
     * @since
     */
    private function getValue($field, $table, $where){
        $result = GeneralUtility::makeInstance(ConnectionPool::class)
        ->getConnectionForTable($table)
        ->select(
            $field, // array fields to select 
            $table, // from
            $where // array where
        )
        ->fetch();
        return $result;
    }

    /**
     * 更新数据
     *
     * @param [type] $field
     * @param [type] $table
     * @param [type] $where
     * @return void
     * @author wanghongbin <wanghongbin@ngoos.org>
     * @since
     */
    private function updateValue($field, $table, $where){
        $result = GeneralUtility::makeInstance(ConnectionPool::class)
        ->getConnectionForTable($table)
        ->update(
            $table, // from
            $field, // array set
            $where  // array where
        );
        return ;
    }
}
