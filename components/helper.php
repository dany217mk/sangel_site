<?php
class Helper
{


  public function outputCommonHead($title, $styles=[]){
    require_once   './views/common/head.html';
    require_once   './views/common/header.html';
  }

  public function outputCommonFoot($scripts=[]){
    require_once   './views/common/footer.html';
    require_once   './views/common/foot.html';
  }



}