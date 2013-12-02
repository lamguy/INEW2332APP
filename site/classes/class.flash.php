<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Flash
 *
 * @author me
 */
final class Flash {

    const FLASHES_KEY = '_flashes';

    private static $flashes = null;


    private function __construct() {
    }

    public static function hasFlashes() {
        self::initFlashes();
        return (self::$flashes != null);
    }

    public static function addFlash($flashType, $message) {
        if (!strlen(trim($message))) {
            throw new Exception('Cannot insert empty flash message.');
        }
        self::initFlashes();
        $flashPanel = '<div class="alert alert-dismissable alert-' .$flashType.'">';
        $flashPanel .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        $flashPanel .= $message;
        $flashPanel .= '</div>';
        self::$flashes = $flashPanel;
    }

    /**
     * Get flash messages and clear them.
     * @return array flash messages
     */
    public static function getFlashes() {
        self::initFlashes();
        $copy = self::$flashes;
        self::$flashes=null;
        $_SESSION['errors'] = null;
        return $copy;
    }

    private static function initFlashes() {
        if (self::$flashes !== null) {
            return;
        }
        if (!array_key_exists(self::FLASHES_KEY, $_SESSION)) {
            $_SESSION[self::FLASHES_KEY] = null;
        }
        self::$flashes = &$_SESSION[self::FLASHES_KEY];
    }

}

?>
