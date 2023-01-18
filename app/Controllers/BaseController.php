<?php

namespace App\Controllers;

abstract class BaseController {

    protected string $content = '';

    public abstract function display();

    public function setContent(string $content): void{
        $this->content = $content;
    }
    
    public function getContent(): string{
        return $this->content;
    }
}