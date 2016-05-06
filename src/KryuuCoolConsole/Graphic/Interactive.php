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

/**
 * @project Ryuu-ZF2
 * @authors spawn
 * @encoding UTF-8
 * @date Apr 25, 2016 - 11:14:07 PM
 * @package *
 * @todo *
 * @depends *
 * @note *
 */

Class Interactive
{
    static private $position = [];
    static private $content = [];
    static private $processed = [];
    
    static public function add($x, $y, $length = 10, $id = null, $bgcolor = null, $enum = null)
    {
        $id = isset($id) ? $id : uniqid();
        if (array_key_exists($id, Interactive::$content)) {
            throw new \Exception('The item id already exists');
        }
        static::$position[] = ['id' => $id, 'x' => $x, 'y' => $y, 
            'length' => $length, 'bgColor' => $bgcolor, 'enum' => $enum];
        static::$content[$id] = null;
        
        return $id;
    }
    
    static public function get($id)
    {
        if (array_key_exists($id, static::$content)) {  
            return static::$content[$id];
        }
        return null;
    }
    
    static public function getAll()
    {
        return static::$position;
    }
    
    static public function next()
    {
        $lastId = end(static::$processed);
        foreach (static::$position as $input) {
            if ($lastId == $input['id']) {
                next(static::$position);
                return [current(static::$position)];
            }
        }
        return null;
    }
    
    static public function set($id, $value)
    {
        static::$content[$id] = $value;
        static::$processed[] = $id;
    }
    
    static public function reset()
    {
        static::$position = [];
    }
}
