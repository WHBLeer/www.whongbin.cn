<?php
namespace Sll\SllSnow\Controller;


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
 * SnowController
 */
class SnowController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * action index
     * 
     * @return void
     */
    public function indexAction()
    {
        $flackcount     = $this->settings['flackcount'];
        $activeflackimg = $this->settings['activeflackimg'];
        $flackcolor     = $this->settings['flackcolor'];
        $minflacksize   = $this->settings['minflacksize'];
        $maxflacksize   = $this->settings['maxflacksize'];
        $minflackspeed  = $this->settings['minflackspeed'];
        $maxflackspeed  = $this->settings['maxflackspeed'];
        $roundflack     = $this->settings['roundflack'];
        $shadowflack    = $this->settings['shadowflack'];
        $disablesnow    = $this->settings['disablesnow'];    
        $desktoponly    = $this->settings['desktoponly'];
        // $flackimg       = $this->settings['flackimg'];
        $flackimg       = $this->getFlackImg();
        if (!$disablesnow) {
            if ($activeflackimg) {
                if($desktoponly) {
                       $GLOBALS['TSFE']->additionalFooterData['sll_snow'] .= "<script>
                                $(document).ready(function(){
                                    if ($(window).width() > 768) {
                                        $(document).snowfall();
                                        $('.collectonme').hide();
                                        $(document).snowfall('clear');                
                                        $(document).snowfall({image :'".$flackimg."', minSize: ".$minflacksize.", maxSize:".$maxflacksize.",minSpeed: ".$minflackspeed.", maxSpeed: ".$maxflackspeed.",flakeCount:".$flackcount."});
                                    }                      
                                });
                        </script>";
                } else {                    
                     $GLOBALS['TSFE']->additionalFooterData['sll_snow'] .= "<script>
                        $(document).ready(function(){
                            $(document).snowfall();
                            $('.collectonme').hide();
                            $(document).snowfall('clear');                
                            $(document).snowfall({image :'".$flackimg."', minSize: ".$minflacksize.", maxSize:".$maxflacksize.",minSpeed: ".$minflackspeed.", maxSpeed: ".$maxflackspeed.",flakeCount:".$flackcount."});
                        });
                    </script>";           
                }
            } else {
                if ($desktoponly) {
                       $GLOBALS['TSFE']->additionalFooterData['sll_snow'] .= "<script>  
                            $(document).ready(function(){                    
                                if ($(window).width() > 768) {
                                    $(document).snowfall();
                                    $('.collectonme').hide();
                                    $(document).snowfall('clear');
                                    $(document).snowfall({shadow : ".$shadowflack.", round : ".$roundflack.", flakeColor:'".$flackcolor."',  minSize: ".$minflacksize.", maxSize:".$maxflacksize.",minSpeed: ".$minflackspeed.", maxSpeed: ".$maxflackspeed.", flakeCount:".$flackcount."});
                                }                    
                            });
                        </script>";
                } else {
                    $GLOBALS['TSFE']->additionalFooterData['sll_snow'] .= "<script>  
                        $(document).ready(function(){                    
                            $(document).snowfall();
                            $('.collectonme').hide();
                            $(document).snowfall('clear');
                            $(document).snowfall({shadow : ".$shadowflack.", round : ".$roundflack.", flakeColor:'".$flackcolor."',  minSize: ".$minflacksize.", maxSize:".$maxflacksize.", minSpeed: ".$minflackspeed.", maxSpeed: ".$maxflackspeed.", flakeCount:".$flackcount."});
                        });
                    </script>";
                }
            }        
        }
    }

    public function getFlackImg()
    {
        if (in_array(date('n'), ['3','4','5'])) {
            //春季-桃花
            $flackimg = '/typo3conf/ext/sll_snow/Resources/Public/images/spring.png'; 
        }
        if (in_array(date('n'), ['6','7','8'])) {
            //夏季-荷花
            $flackimg = '/typo3conf/ext/sll_snow/Resources/Public/images/summer.png'; 
        }
        if (in_array(date('n'), ['9','10','11'])) {
            //秋季-菊花
            $flackimg = '/typo3conf/ext/sll_snow/Resources/Public/images/autumn.png'; 
        }
        if (in_array(date('n'), ['1','2','12'])) {
            //冬季-雪花
            $flackimg = '/typo3conf/ext/sll_snow/Resources/Public/images/winter.png'; 
        }
        return $flackimg;
    }
}
