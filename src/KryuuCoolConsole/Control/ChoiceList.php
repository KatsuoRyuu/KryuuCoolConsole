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

use KryuuCoolConsole\Control\ChoiceList;

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

Class ChoiceList implements ControlInterface
{
    private $id = null;
    private $headline = '';
    private $items = [];
    private $height = 0;
    private $width = 0;
    private $xStart = 0;
    private $yStart = 0;
    private $contentArray = [];
    private $bgColor = null;
    
    public function __construct($id, $text = null)
    {
        $this->setId($id);
        $this->setHeadline($text);
    }
    
    public function setId($text)
    {
        $this->id = $text;
        return $this;
    }
    
    public function setHeadline($text)
    {
        $this->headline = $text;
        return $this;
    }
    
    public function setItems($items)
    {
        $this->items = $items;
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
        $ymax = 0;
        $xmax = 0;
        foreach ($this->contentArray as $y => $xArray) {
            if ($ymax < $y) {
                $ymax = $y;
            }
            foreach ($xArray as $x => $val) {    
                if ($xmax < $x) {
                    $xmax = $x;
                }
            }
        }
        return [$xmax, ($ymax+1)];
    }
    
    public function getContent()
    {
        $y = $this->yStart;
        $this->headline .= ' ';
        for ($x = 0; $x < strlen($this->headline); $x++) {
            $xp =  ($x+$this->xStart) % $this->width;
            if ($x > 0 && $x % $this->width == 0) {
                $y++;
            }
            $this->contentArray[$y][$xp] = $this->getBgColor() . $this->headline[$x];
        }
        
        $y++;
        $y++;
        
        $txt = '---------------- ';
        for ($x = 0; $x < strlen($txt); $x++) {
            $xp =  ($x+$this->xStart) % $this->width;
            if ($x > 0 && $x % $this->width == 0) {
                $y++;
            }
            $this->contentArray[$y][$xp] = $this->getBgColor() . $txt[$x];
        }
        
        $y++;
        $y++;
        foreach( $this->items as $key => $item) {
            $text = $key . '.  ' . $item;
            for ($x = 0; $x < strlen($text); $x++) {
                $cxp =  ($x+$this->xStart) % $this->width;
                if ($x > 0 && $x % $this->width == 0) {
                    $y++;
                }
                $this->contentArray[$y][$cxp] = $this->getBgColor() . $text[$x];
            }
        }
        
        $y++;
        $y++;
        
        for ($x = 0; $x < strlen($txt); $x++) {
            $xp =  ($x+$this->xStart) % $this->width;
            if ($x > 0 && $x % $this->width == 0) {
                $y++;
            }
            $this->contentArray[$y][$xp] = $this->getBgColor() . $txt[$x];
        }
        
        $y++;
                
        $this->contentArray[$y][0] = $this->getBgColor() . ':';
        
        return $this->contentArray;
    } 
    
    public function getInteractive()
    {
        if (empty($this->contentArray)) {
            $this->getContent();
        }
        list($x, $y) = $this->getEnd();
        
        return [$this->id => ['x' => 2, 'y' => $y, 'length' => 3, 'id' => $this->id, 'enum' => $this->items]];
    }
    
    public function getValue()
    {
        return \KryuuCoolConsole\Graphic\Interactive::get($this->id);
    }
     
}
