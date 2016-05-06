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

namespace KryuuCoolConsole\Control;

/**
 * @project Ryuu-ZF2
 * @authors spawn
 * @encoding UTF-8
 * @date Apr 25, 2016 - 9:11:19 PM
 * @package *
 * @todo *
 * @depends *
 * @note *
 */

Class Label implements ControlInterface
{
    private $text = '';
    private $height = 0;
    private $width = 0;
    private $xStart = 0;
    private $yStart = 0;
    private $contentArray = [];
    private $bgColor = null;
    
    public function __construct($text)
    {
        $this->setText($text);
    }
    
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }
    
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }
    
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }
    
    public function setBgColor($color)
    {
        $this->bgColor = $color;
    }
    
    public function getBgColor()
    {
        return $this->bgColor;
    }
    
    public function setStart($x, $y)
    {
        $this->xStart = $x;
        $this->yStart = $y;
        return $this;
    }
    
    public function getEnd()
    {
        $y = max(array_keys($this->contentArray));
        end($this->contentArray);
        $x = max(array_keys($this->contentArray[key($this->contentArray)]));
        return [$x, $y];
    }
    
    public function getContent()
    {
        $y = $this->yStart;
        $this->text .= ' ';
        for ($x = 0; $x < strlen($this->text); $x++) {
            $xp =  ($x+$this->xStart) % $this->width;
            if ($x > 0 && $x % $this->width == 0) {
                $y++;
            }
            $this->contentArray[$y][$xp] = $this->getBgColor() . $this->text[$x];
        }
        
        return $this->contentArray;
    } 
    
    public function getInteractive()
    {
        return [];
    }
     
}
