<?php

namespace App\Facades;

use RealRashid\SweetAlert\Facades\Alert as SAlert;

/**
 *
 */
class Alert extends SAlert {

    /**
     * @param string $message
     * @return void
     */
    public static function success(string $message): void {
        SAlert::success(__('messages.success.title'), $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public static function tSuccess(string $message): void {
        self::success(__($message));
    }

    /**
     * @param string $message
     * @return void
     */
    public static function error(string $message): void {
        SAlert::error(__('messages.errors.title'), $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public static function tError(string $message): void {
        self::error(__($message));
    }

}