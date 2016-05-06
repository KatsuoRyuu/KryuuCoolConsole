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

namespace KryuuCoolConsole\Container;

use KryuuCoolConsole\Charset\ColorInterface as Color;
use KryuuCoolConsole\Charset\Utf8 as Border;
use KryuuCoolConsole\Container\BoxInterface as BoxInterface;
use Zend\Stdlib\ArrayUtils;
use KryuuCoolConsole\Utils\DisplayArray as DA;

/**
 * @project Ryuu-ZF2
 * @authors spawn
 * @encoding UTF-8
 * @date Apr 9, 2016 - 9:32:12 PM
 * @package *
 * @todo *
 * @depends *
 * @note *
 */

class Box implements BoxInterface, ContainerInterface
{    
    private $height = 1;
    private $width = 1;
    private $border = null;
    private $padding = null;
    private $margin = 0;
    private $xOffset = 0;
    private $yOffset = 0;
    private $bgColor = null;
    private $bgDefaultColor = null;
    private $contentArray = [];
    private $interactive = [];
    private $children = [];
    
    public function __construct($padding = 0, $margin = 0, $border = 0)
    {
        $this->setBorder($border);
        $this->padding = $padding;
        $this->margin = $margin;
    }
    
    public function setMargin($size)
    {
        $this->margin = $size;
    }

    public function setPadding($size)
    {
        $this->padding = $size;
    }
    
    public function addChild($item)
    {
        $this->children[] = $item;
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
    
    public function setBgColor($colorCode)
    {
        $this->bgColor = $colorCode;
    }
    
    public function getBgColor()
    {
        if ($this->bgColor == null) {
            $this->bgColor = Color::BC_DEFAULT;
        }
        return $this->bgColor;
    }
    
    public function setDefaultBgColor($colorCode)
    {
        $this->bgDefaultColor = $colorCode;
    }
    
    public function getDefaultBgColor()
    {
        if ($this->bgDefaultColor == null) {
            $this->bgDefaultColor = Color::BC_DEFAULT;
        }
        return $this->bgDefaultColor;        
    }
    
    
    public function setBorder($borderCode) 
    {
        switch ($borderCode) {
            case BoxInterface::BORDER_SINGLE:
                $border['n'] = Border::LINE_SINGLE_N;
                $border['e'] = Border::LINE_SINGLE_E;
                $border['w'] = Border::LINE_SINGLE_W;
                $border['s'] = Border::LINE_SINGLE_S;
                $border['nw'] = Border::LINE_SINGLE_NW;
                $border['ne'] = Border::LINE_SINGLE_NE;
                $border['se'] = Border::LINE_SINGLE_SE;
                $border['sw'] = Border::LINE_SINGLE_SW;
                $border['nt'] = Border::LINE_SINGLE_NT;
                $border['wt'] = Border::LINE_SINGLE_WT;
                $border['et'] = Border::LINE_SINGLE_ET;
                $border['st'] = Border::LINE_SINGLE_ST;
                $border['c'] = Border::LINE_SINGLE_CROSS;
                break;
            case BoxInterface::BORDER_DOUBLE:
                $border['n'] = Border::LINE_DOUBLE_N;
                $border['e'] = Border::LINE_DOUBLE_E;
                $border['w'] = Border::LINE_DOUBLE_W;
                $border['s'] = Border::LINE_DOUBLE_S;
                $border['nw'] = Border::LINE_DOUBLE_NW;
                $border['ne'] = Border::LINE_DOUBLE_NE;
                $border['se'] = Border::LINE_DOUBLE_SE;
                $border['sw'] = Border::LINE_DOUBLE_SW;
                $border['nt'] = Border::LINE_DOUBLE_NT;
                $border['wt'] = Border::LINE_DOUBLE_WT;
                $border['et'] = Border::LINE_DOUBLE_ET;
                $border['st'] = Border::LINE_DOUBLE_ST;
                $border['c'] = Border::LINE_DOUBLE_CROSS;
                break;
            case BoxInterface::BORDER_BLOCK:
                $border['n'] = Border::LINE_BLOCK_N;
                $border['e'] = Border::LINE_BLOCK_E;
                $border['w'] = Border::LINE_BLOCK_W;
                $border['s'] = Border::LINE_BLOCK_S;
                $border['nw'] = Border::LINE_BLOCK_NW;
                $border['ne'] = Border::LINE_BLOCK_NE;
                $border['se'] = Border::LINE_BLOCK_SE;
                $border['sw'] = Border::LINE_BLOCK_SW;
                $border['nt'] = Border::LINE_BLOCK_NT;
                $border['wt'] = Border::LINE_BLOCK_WT;
                $border['et'] = Border::LINE_BLOCK_ET;
                $border['st'] = Border::LINE_BLOCK_ST;
                $border['c'] = Border::LINE_BLOCK_CROSS;
                break;
            default:
                $border['n'] = $border['e'] = $border['w'] = 
                    $border['s'] = $border['nw'] = $border['ne'] = 
                    $border['se'] = $border['sw'] = $border['nt'] = 
                    $border['wt'] = $border['et'] = $border['st'] = 
                    $border['c'] = ' ';
        }
        $this->border = $border;
    }
    
    public function getContent()
    {
        $this->contentArray = [];
        
        $xStart = $this->getMargin();
        $xStop = ($this->width);
        
        $yStart = $this->getMargin();
        $yStop = ($this->height);
        
        for ($x = $xStart+$this->xOffset; $x < $xStop; $x++) {
            for ($y = $yStart+$this->xOffset; $y < $yStop; $y++) {
                
                $this->contentArray[$y][$x] = $this->getBgColor() . ' ' . $this->getDefaultBgColor();
                
                if ($this->xOffset > 0) {
                    $this->xOffset = 0;
                }
                if ($this->yOffset > 0) {
                    $this->yOffset = 0;
                }
            }
        }
        
        $childContents = $this->mergeChildren(
                $this->children, 
                ($xStart),
                ($yStart)
            );
        
        $this->buildBorder($xStart, $xStop, $yStart, $yStop);
        
        return ArrayUtils::merge($this->contentArray, $childContents, true);
    }
    
    public function getInteractive()
    {
        if (empty($this->contentArray)) {
            $this->getContent();
        }
        
        return $this->interactive;
    }
    
    public function setStart($x, $y)
    {
        $this->xOffset = $x;
        $this->yOffset = $y;
    }
    
    public function getEnd()
    {
        $y = max(array_keys($this->contentArray));
        end($this->contentArray);
        $x = max(array_keys($this->contentArray[key($this->contentArray)]));
        return [$x, $y];
    }
    
    private function buildBorder($xStart, $xStop, $yStart, $yStop) 
    {
        for ($x = 1; $x < $xStop; $x++) {
            if ($x <= $this->getMargin() || ($xStop-$x) <= $this->getMargin()) {
                $this->contentArray[$yStart][$x] = $this->getDefaultBgColor() . ' ';
                $this->contentArray[$yStop][$x] = $this->getDefaultBgColor() . ' ';
            } else {
                $this->contentArray[$yStart][$x] = $this->getBgColor() . $this->border['n'] . $this->getDefaultBgColor(); 
                $this->contentArray[$yStop-$this->getMargin()][$x] = $this->getBgColor() . $this->border['s'] . $this->getDefaultBgColor(); 
            }
        } 
        for ($y = 1; $y < $yStop; $y++) {
            if ($y <= $this->getMargin() || ($yStop-$y) <= $this->getMargin()) {
                $this->contentArray[$y][$xStart] = $this->getDefaultBgColor() . ' ';
                $this->contentArray[$y][$xStop] = $this->getDefaultBgColor() . ' ';
            } else {
                $this->contentArray[$y][$xStart] = $this->getBgColor() . $this->border['w'] . $this->getDefaultBgColor();
                $this->contentArray[$y][$xStop-$this->getMargin()] = $this->getBgColor() . $this->border['e'] . $this->getDefaultBgColor();
            }
        } 
        
        $this->contentArray[$yStart][$xStart] = $this->getBgColor() . $this->border['nw'] . $this->getDefaultBgColor();
        $this->contentArray[$yStop-$this->getMargin()][$xStart] = $this->getBgColor() . $this->border['sw'] . $this->getDefaultBgColor();
        $this->contentArray[$yStart][$xStop-$this->getMargin()] = $this->getBgColor() . $this->border['ne'] . $this->getDefaultBgColor();
        $this->contentArray[$yStop-$this->getMargin()][$xStop-$this->getMargin()] = $this->getBgColor() . $this->border['se'] . $this->getDefaultBgColor();
    }
    
    private function getMargin()
    {
        if ($this->margin == null) {
            $this->margin = 0;
        }
        
        return $this->margin;
    }
    
    private function getPadding()
    {
        if ($this->padding == null) {
            $this->padding = 0;
        }
        
        return $this->padding;
    }
    
    public function mergeChildren($children, $x, $y, $widthDiff = 0, $heightDiff = 0)
    {
        $xOffset = ($x + $this->getPadding()+1);
        $yOffset = ($y + $this->getPadding()+1);
        $content = [];
        $xStart = $yStart = 0;
        
        foreach ($children as $child) {
            $child->setHeight(($this->height+$heightDiff-(1+($this->getPadding()*2)+($this->getMargin()*2))))
                    ->setWidth(($this->width+$widthDiff-(1+($this->getPadding()*2)+($this->getMargin()*2))));
            $child->setStart($xStart, $yStart);
            if (!$child->getBgColor()) {
                $child->setBgColor($this->getBgColor());
            }
            $childContent = DA::addOffset($child->getContent(), $xOffset, $yOffset);
            $this->interactive = ArrayUtils::merge($this->interactive, 
                    DA::inputOffset(
                            $child, 
                            $xOffset+1, 
                            $yOffset, 
                            $this->getBgColor())
                    );
            $content = ArrayUtils::merge($content, $childContent, true);
            list($xStart, $yStart) = $child->getEnd();
        }
        return $content;
    }
}
