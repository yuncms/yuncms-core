<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\core\helpers;

use Yii;

/**
 * UUID Generator Class provides static methods for creating or validating UUIDs.
 * Class UUIDHelper
 * @package yuncms\core\helpers
 */
class UUIDHelper
{

    /**
     * Creates an v4 UUID
     *
     * @return string
     * @throws \yii\base\Exception
     */
    public static function v4()
    {
        return
            // 32 bits for "time_low"
            bin2hex(Yii::$app->security->generateRandomKey(4)) . "-" .
            // 16 bits for "time_mid"
            bin2hex(Yii::$app->security->generateRandomKey(2)) . "-" .
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            dechex(mt_rand(0, 0x0fff) | 0x4000) . "-" .
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            dechex(mt_rand(0, 0x3fff) | 0x8000) . "-" .
            // 48 bits for "node"
            bin2hex(Yii::$app->security->generateRandomKey(6));
    }

    /**
     * Validates a given UUID
     *
     * @param String $uuid
     * @return boolean
     */
    public static function isValid($uuid)
    {
        return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?' . '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1;
    }

}