<?php
namespace Nitsan\NsNewsComments\ViewHelpers;

/**
 *  Get last comment of news record
 */
class LastCommentViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * commentRepository
     *
     * @var \Nitsan\NsNewsComments\Domain\Repository\CommentRepository
     */
    protected $commentRepository = null;

    /**
     * Inject a news repository to enable DI
     *
     * @param \Nitsan\NsNewsComments\Domain\Repository\CommentRepository $commentRepository
     */
    public function injectCommentRepository(\Nitsan\NsNewsComments\Domain\Repository\CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Initialize
     *
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('newsuid', 'int', 'news uid', true);
    }

    /**
     * Last Comment
     *
     */
    public function render()
    {
        $newsuid = $this->arguments['newsuid'];

        // Get last comment of news
        $newscommentData = $this->commentRepository->getLastCommentOfNews($newsuid);
        return $newscommentData;
    }
}
