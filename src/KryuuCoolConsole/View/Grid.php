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

namespace KryuuCoolConsole\View;

use Zend\Stdlib\ArrayUtils;
use Zend\Console\Console;
use KryuuCoolConsole\Graphic\Frame as Frame;
use KryuuCoolConsole\Utils\DisplayArray as DA;

/**
 * @project Ryuu-ZF2
 * @authors spawn
 * @encoding UTF-8
 * @date Apr 9, 2016 - 9:21:08 PM
 * @package *
 * @todo *
 * @depends *
 * @note *
 */

class Grid
{
    private $cols;
    private $rows;
    
    private $height = 1;
    private $width = 1;
    
    private $children = [];
    
    private $parent = null;
    
    private $contentArray = [];
    private $interactive = [];
    
    public function __construct($cols = 1, $rows = 1)
    {
        $this->cols = $cols;
        $this->rows = $rows;
        
        for ($col = 0; $col < $this->cols; $col++) {
           for ($row = 0; $row < $this->rows; $row++) {
               $this->children[$row][] = [];
            } 
        }
    }
    
    public function addChild($item, $xPos = 0, $yPos = 0)
    {
        $this->children[$yPos][$xPos][] = $item;
    }
    
    public function show()
    {
        $parent = $this->getParent();
        $parent->setView($this);
        $parent->show();        
    }
    
    public function getContent()
    {
        if (empty($this->contentArray)) {
            $parent = $this->getParent();

            $this->width = (int) ($parent->getWidth() / $this->cols);
            $this->height= (int) ($parent->getHeight() / $this->rows);

            $widthDiff = $parent->getWidth() % $this->cols;
            $heightDiff = $parent->getHeight() % $this->rows;

            $lastArray = end($this->children);
            end($lastArray);
            $xLast = key($lastArray);
            $yLast = key($this->children);
            reset($this->children);
            reset($lastArray);

            $content = [];
            foreach ($this->children as $y => $row) {
                foreach ($row as $x => $children) {
                    $wDiff = ($x == $xLast) ? $widthDiff : 0;
                    $hDiff = ($y == $yLast) ? $heightDiff : 0;
                    $content = ArrayUtils::merge($content, $this->mergeChildren($children, $x, $y, $wDiff, $hDiff), true);
                }
            }
            $this->contentArray = $content;
        }
        
        return $this->contentArray;
    }
    
    public function mergeChildren($children, $x, $y, $widthDiff = 0, $heightDiff = 0)
    {
        $xOffset = ($x * $this->width);
        $yOffset = ($y * $this->height);
        $content = [];
        $xStart = $yStart = 0;
        foreach ($children as $child) {
            $child->setHeight(($this->height+$heightDiff-1))
                    ->setWidth(($this->width+$widthDiff-1));
            $child->setStart($xStart, $yStart);
            $childContent = DA::addOffset($child->getContent(), $xOffset, $yOffset);         
            $this->interactive = ArrayUtils::merge($this->interactive, 
                    DA::inputOffset(
                            $child, 
                            $xOffset+1, 
                            $yOffset)
                    ,true);
            $content = ArrayUtils::merge($content, $childContent, true);
            list($xStart, $yStart) = $child->getEnd();
        }
        return $content;
    }
    
    public function getInteractive()
    {
        if (empty($this->contentArray)) {
            $this->getContent();
        }
        
        return $this->interactive;
    }
    
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
    
    public function getParent()
    {
        if ($this->parent == null) {
            $this->parent = new Frame();
        }
        
        return $this->parent;
    }

}
