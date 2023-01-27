<?php

namespace App\Controllers;
use App\DB\DBPDO;

abstract class BaseController {

    protected string $content = '';
    protected $layout = 'layout/index.tpl.php';
    protected string $tplDir = 'app/Views/';

    public function __construct(
        protected DBPDO $conn
    ) {
    } 

    public abstract function display();

    public function setContent(string $content): void{
        $this->content = $content;
    }
    
    public function getContent(): string{
        return $this->content;
    }

    public function setTplDir(string $dir): void{
        $this->tplDir = $dir;
    }
    
    public function getTplDir(): string{
        return $this->tplDir;
    }

    public function redirect($where): void {
        header("Location: $where");
        die();
    }
}