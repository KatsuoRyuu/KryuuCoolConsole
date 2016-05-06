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
class Utf8 implements CharsetInterface
{
    const ACTIVATE          = "";
    const DEACTIVATE        = "";

    const BLOCK = "█";
    const SHADE_LIGHT = "░";
    const SHADE_MEDIUM = "▒";
    const SHADE_DARK = "▓";

    const LINE_SINGLE_N = "─";
    const LINE_SINGLE_E = "│";
    const LINE_SINGLE_W = "─";
    const LINE_SINGLE_S = "│";
    const LINE_SINGLE_NW = "┌";
    const LINE_SINGLE_NE = "┐";
    const LINE_SINGLE_SE = "┘";
    const LINE_SINGLE_SW = "└";
    const LINE_SINGLE_NT = "┬";
    const LINE_SINGLE_WT = "├";
    const LINE_SINGLE_ET = "┤";
    const LINE_SINGLE_ST = "┴";
    const LINE_SINGLE_CROSS = "┼";

    const LINE_DOUBLE_N = "═";
    const LINE_DOUBLE_E = "║";
    const LINE_DOUBLE_W = "║";
    const LINE_DOUBLE_S = "═";
    const LINE_DOUBLE_NW = "╔";
    const LINE_DOUBLE_NE = "╗";
    const LINE_DOUBLE_SE = "╝";
    const LINE_DOUBLE_SW = "╚";
    const LINE_DOUBLE_NT = "╦";
    const LINE_DOUBLE_WT = "╠";
    const LINE_DOUBLE_ET = "╣";
    const LINE_DOUBLE_ST = "╩";
    const LINE_DOUBLE_CROSS = "╬";
    

    const LINE_BLOCK_N = "▀";
    const LINE_BLOCK_E = "▌";
    const LINE_BLOCK_W = "▐";
    const LINE_BLOCK_S = "▄";
    const LINE_BLOCK_NW = "▐";
    const LINE_BLOCK_NE = "▌";
    const LINE_BLOCK_SE = "▌";
    const LINE_BLOCK_SW = "▐";
    const LINE_BLOCK_CROSS = "█";
    const LINE_BLOCK_NT = "█";
    const LINE_BLOCK_WT = "▐";
    const LINE_BLOCK_ET = "▌";
    const LINE_BLOCK_ST = "█";
}
