# typo3-mpdf

## MPDF library for TYPO3: 8.0.0

mPDF is a PHP library which generates PDF files from UTF-8 encoded HTML. It is based on FPDF and HTML2FPDF with a number of enhancements. More: https://mpdf.github.io/

# Real life action controller function usage example

* This example uses "t3helpers" extension for getting a template, parsed by fluid. Get t3helpers here: https://extensions.typo3.org/extension/t3helpers/
* This example demonstrates the use of an own ttf font
* This example will protect the PDF (only readable)

Use "exit;" in your function, otherwise MAC/Safari users will not get a pdf file.

```

namespace Vendor\ExtensionName\Controller;

use Mpdf;

class DocumentsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{


    /**
     * @param Project $project
     * @param Licencee $licencee
     * @return mixed
     */
    public function documentAction(Project $project, Licencee $licencee)
    {
    
        $licencenumber = 'MUGR-2728182721';
    
        $template = t3h::Template()->render(
            'se_music_userarea',
            'Resources/Private/Templates/Projects/Document.html',
            ['project' => $project, 'licencee' => $licencee, 'licencenumber' => $licencenumber]
        );
    
        ob_clean(); // set to remove wrong headers which crashed some files (e.g. xls, dot, ...)
    
        /** @var \Mpdf\Mpdf $mpdf */
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => [
                PATH_typo3conf . 'ext/se_music_userarea/Resources/Private/Fonts',
            ],
            'fontdata' => [
                    'sfpro' => [
                        'R' => 'SF-Pro-Display-Regular.ttf',
                        'B' => 'SF-Pro-Display-Bold.ttf'
                    ]
                ],
            'default_font' => 'sfpro'
        ]);
        $mpdf->setFooter('{PAGENO}');
        $mpdf->writeHTML($template);
        $mpdf->SetProtection(array('print'));
        $mpdf->Output($licencenumber . '.pdf', Mpdf\Output\Destination::DOWNLOAD);
    
        exit;
    }

}
```

