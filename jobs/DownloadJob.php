<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\core\jobs;

use yii\base\BaseObject;
use yii\queue\RetryableJobInterface;

/**
 * Class DownloadJob
 * @package yuncms\core\jobs
 */
class DownloadJob extends BaseObject implements RetryableJobInterface
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $file;

    /**
     * @param \yii\queue\Queue $queue
     */
    public function execute($queue)
    {
        file_put_contents($this->file, file_get_contents($this->url));
    }

    /**
     * @inheritdoc
     */
    public function getTtr()
    {
        return 60;
    }

    /**
     * @inheritdoc
     */
    public function canRetry($attempt, $error)
    {
        return $attempt < 3;
    }
}