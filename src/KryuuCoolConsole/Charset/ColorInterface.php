<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace KryuuCoolConsole\Charset;

use Zend\Console\Charset\CharsetInterface;

/**
 * UTF-8 box drawing
 *
 * @link http://en.wikipedia.org/wiki/Box-drawing_characters
 */
interface ColorInterface
{
    const BC_DEFAULT        = "\e[49m";
    const BC_BLACK          = "\e[48;5;0m";
    const BC_RED            = "\e[48;5;1m";
    const BC_GREEN          = "\e[48;5;2m";
    const BC_YELLOW         = "\e[48;5;3m";
    const BC_BABY_BLUE      = "\e[48;5;4m";
    const BC_PURPLE         = "\e[48;5;5m";
    const BC_CYAN           = "\e[48;5;6m";
    const BC_LIGHT_GREY     = "\e[48;5;7m";
    const BC_GREY           = "\e[48;5;8m";
    const BC_LIGHT_RED      = "\e[48;5;9m";
    const BC_LIGHT_GREEN    = "\e[48;5;10m";
    const BC_FADE_BLUE      = "\e[48;5;11m";
    const BC_PINK           = "\e[48;5;12m";
    const BC_LIGHT_CYAN     = "\e[48;5;13m";
    const BC_WHITE          = "\e[48;5;14m";
    const BC_BLACK_BLUE     = "\e[48;5;15m";
    const BC_DARK_MARINE    = "\e[48;5;16m";
    const BC_DEEP_MARINE    = "\e[48;5;17m";
    const BC_MARINE         = "\e[48;5;18m";
    const BC_DEEP_BLUE      = "\e[48;5;19m";
    const BC_BLUE           = "\e[48;5;20m";
    
    
    const C_DEFAULT        = "\e[39m";
    const C_BLACK          = "\e[38;5;0m";
    const C_RED            = "\e[38;5;1m";
    const C_GREEN          = "\e[38;5;2m";
    const C_YELLOW         = "\e[38;5;3m";
    const C_BABY_BLUE      = "\e[38;5;4m";
    const C_PURPLE         = "\e[38;5;5m";
    const C_CYAN           = "\e[38;5;6m";
    const C_LIGHT_GREY     = "\e[38;5;7m";
    const C_GREY           = "\e[38;5;8m";
    const C_LIGHT_RED      = "\e[38;5;9m";
    const C_LIGHT_GREEN    = "\e[38;5;10m";
    const C_FADE_BLUE      = "\e[38;5;11m";
    const C_PINK           = "\e[38;5;12m";
    const C_LIGHT_CYAN     = "\e[38;5;13m";
    const C_WHITE          = "\e[38;5;14m";
    const C_BLACK_BLUE     = "\e[38;5;15m";
    const C_DARK_MARINE    = "\e[38;5;16m";
    const C_DEEP_MARINE    = "\e[38;5;17m";
    const C_MARINE         = "\e[38;5;18m";
    const C_DEEP_BLUE      = "\e[38;5;19m";
    const C_BLUE           = "\e[38;5;20m";
}
