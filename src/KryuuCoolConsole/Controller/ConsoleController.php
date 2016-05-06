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

namespace KryuuCoolConsole\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Adapter\AdapterInterface as Console;
use KryuuCoolConsole\View\Grid;
use KryuuCoolConsole\Control\Input;
use KryuuCoolConsole\Control\Label;
use KryuuCoolConsole\Container\Box;
use KryuuCoolConsole\Container\BoxInterface as Border;
use KryuuCoolConsole\Charset\ColorInterface as Color;

/**
 * @project Ryuu-ZF2
 * @authors spawn
 * @encoding UTF-8
 * @date Mar 15, 2016 - 2:28:40 AM
 * @package *
 * @todo *
 * @depends *
 * @note *
 */

class ConsoleController extends AbstractActionController
{    
    private $grid = null;
    
    public function __construct()
    {
    }
    
    public function allAction()
    {      
        $box = new Box(1, 1, Border::BORDER_DOUBLE);
        $box->setBgColor(Color::BC_DEEP_MARINE);
        
        $box->addChild(new Label('A fucking awesome label that is over complicated and insainly long way to long for a half screen box, and even at box is still wasnt tooo long'));
        
        $box->addChild(new Label('Another nice string'));
        
        $box->addChild(new Input('nice Input', 'Input something here: '));
        
        $box1 = new Box(1, 0, Border::BORDER_DOUBLE);
        $box1->setBgColor(Color::BC_PINK);
        
        $box1->addChild(new Label('A fucking awesome label that is over complicated and insainly long way to long for a half screen box, and even at box is still wasnt tooo long'));
        
        $box1->addChild(new Label('Another nice string'));
        
        $box1->addChild(new Input('nice Input2', 'Input something here: '));
        
        $box2 = new Box(1, 0, Border::BORDER_DOUBLE);
        $box2->setBgColor(Color::BC_LIGHT_RED);
        
        $box3 = new Box(1, 0, Border::BORDER_DOUBLE);
        $box3->setBgColor(Color::BC_PURPLE);
        
        $this->getGrid()->addChild($box);
        $this->getGrid()->addChild($box2,0,1);
        $this->getGrid()->addChild($box1,1,0);
        $this->getGrid()->addChild($box3,1,1);
        $this->getGrid()->show();
    }
    
    private function getGrid()
    {
        if ($this->grid == null) {
            $this->grid = new Grid(2, 2);
        }
        
        return $this->grid;
    }
}
