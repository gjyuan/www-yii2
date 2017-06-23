<?php
namespace common\service;

class EFe {
    public $feroot;
    public $version ;
    public function feroot($path) {
        return sprintf("%s/%s%s_v=%d", rtrim($this->feroot, "/"), ltrim($path, "/"), strpos($path, "?") === FALSE ? "?" : "&", $this->version );
    }
}