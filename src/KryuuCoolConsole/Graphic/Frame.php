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

namespace KryuuCoolConsole\Graphic;

use Zend\Stdlib\ArrayUtils;
use Zend\Console\Console;

/**
 * @project Ryuu-ZF2
 * @authors spawn
 * @encoding UTF-8
 * @date Apr 22, 2016 - 10:26:33 PM
 * @package *
 * @todo *
 * @depends *
 * @note *
 */

Class Frame
{
    static private $frame = [];
    static private $console = null;
    static private $view = [];
    
    public function __construct()
    {
        ;
    }
    
    public function show()
    {
        $this->clear();
        $this->getConsole()->clear();
        Frame::$frame = ArrayUtils::merge(Frame::$frame, Frame::$view->getContent(), true);
        ksort(Frame::$frame);
        end(Frame::$frame);
        $lastLine = key(Frame::$frame);
        foreach(Frame::$frame as $y => $rows) {
            ksort($rows);
            if ($lastLine == $y) {
                $this->getConsole()->write(implode('', $rows));
            } else {
                $this->getConsole()->writeLine(implode('', $rows));
            }
        }
        
        $inter = Frame::$view->getInteractive();
        
        foreach ($inter as $in) {
            Interactive::add($in['x'], $in['y'], $in['length'], $in['id'], $in['bgColor'], $in['enum']);
        }
        
        $this->processInteractives();
        Interactive::reset();
    }
    
    public function getFrame()
    {
        return Frame::$frame;
    }
    
    public function clear()
    {
        for ($y = 0; $y < $this->getHeight(); $y++) {
            for ($x = 0; $x < $this->getWidth(); $x++) {
                Frame::$frame[$y][$x] = ' ';
            }
        }
    }
    
    public function getHeight()
    {
        return $this->getConsole()->getHeight();
    }
    
    public function getWidth()
    {
        return $this->getConsole()->getWidth();
    }

    public function setView($view)
    {
        Frame::$view = $view;
        return $this;
    }
    
    private function processInteractives()
    {   
        $inputs = Interactive::getAll();
        foreach ($inputs as $input) {
            if (!isset($input['allowEmpty'])) {
                $input['allowEmpty'] = true;
            }
            do {
                $content = $this->getInteractiveContent($input);
            } while (!$input['allowEmpty'] && !$content);
            Interactive::set($input['id'], $content);
        }
    }
    
    private function getInteractiveContent($input)
    {
        $this->getConsole()->setPos($input['x'], $input['y']);
        if (isset($input['bgColor'])) {
            $this->getConsole()->write($input['bgColor']);  
        }
        $content = $this->getConsole()->readLine($input['length']);
        if (is_array($input['enum']) && !isset($input['enum'][$content])) {
            return $this->getInteractiveContent($input);
        } elseif (is_array($input['enum']) && isset($input['enum'][$content])) {
            return $input['enum'][$content];
        }
        return $content;
    }
    
    /**
     * Return console adapter to use when showing prompt.
     *
     * @return Zend\Console\Adapter\AbstractAdapter;
     */
    private function getConsole()
    {
        if (Frame::$console == null) {
            Frame::$console = Console::getInstance();
        }

        return Frame::$console;
    }
    
    
}
