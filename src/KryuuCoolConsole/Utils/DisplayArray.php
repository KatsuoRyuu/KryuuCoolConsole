<?php

/* 
 * @license The Ryuu Technology License
 * 
 * Copyright 2014 Ryuu Technology by
 * KatsuoRyuu <anders-github@drake-development.org>.
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * Ryuu Technology shall be visible and readable to anyone using the software
 * and shall be written in one of the following ways: 竜技術, Ryuu Technology
 * or by using the company logo.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * 
 * @link https://github.com/KatsuoRyuu/
 */

namespace KryuuCoolConsole\Utils;

use Zend\Stdlib\ArrayUtils;

/**
 * @project Ryuu-ZF2
 * @authors spawn
 * @encoding UTF-8
 * @date Apr 25, 2016 - 3:39:23 AM
 * @package *
 * @todo *
 * @depends *
 * @note *
 */


class DisplayArray
{
    static function addOffset($array, $xOffset, $yOffset)
    {
        $cleanContent = [];
        foreach($array as $y => $rows) {
            foreach ($rows as $x => $value) {
                $cleanContent[($y + $yOffset)][($x + $xOffset)] = $value;
            }
        }
        return $cleanContent;
    }
    
    static function inputOffset($child, $xOffset, $yOffset, $bgcolor = null)
    {
        $childInputs = $child->getInteractive();
        $tmp = [];
        foreach ($childInputs as $id => $input) {
            $tmp[$id] = $input;
            $tmp[$id]['length'] = $input['length'];
            $tmp[$id]['id'] = $input['id'];
            $tmp[$id]['x'] = $input['x']+$xOffset;
            $tmp[$id]['y'] = $input['y']+$yOffset; 
            if (isset($input['enum'])) {
                $tmp[$id]['enum'] = $input['enum'];
            } else {
                $tmp[$id]['enum'] = null;
            }
            if (!isset($input['bgColor'])) {
                $tmp[$id]['bgColor'] = $bgcolor;
            }
        }
        
        return $tmp;
    }
}
