<?php
class Security{
  public static function checkName($v){
    $e = "/^[A-zÁ-ü ]{2,20}$/";
    $a = preg_match($e, $v);
    if ($a == 1) {
      return $v;
    }
    return 'inválido';
  }

  public static function checkStuffName($v){
    $e = "/^[A-zÁ-ü ]{2,50}$/";
    $a = preg_match($e, $v);
    if ($a == 1) {
      return $v;
    }
    return 'inválido';
  }

  public static function checkVendor($v){
    $e = "/^[A-zÁ-ü ]{2,50}$/";
    $a = preg_match($e, $v);
    if ($a == 1) {
      return $v;
    }
    return 'inválido';
  }

  public static function checkRG($v){
    $e = "/^[0-9]{7,15}$/";
    $a = preg_match($e, $v);
    if ($a == 1) {
      return $v;
    }
    return 'inválido';
  }

  public static function checkCPF($v){
    $e = "/^[0-9]{11}$/";
    $a = preg_match($e, $v);
    if ($a == 1) {
      return $v;
    }
    return 'inválido';
  }

  public static function checkTurn($v){
    $e = "/^(Manhã|Tarde)$/";
    $a = preg_match($e, $v);
    if ($a == 1) {
      return $v;
    }
    return 'inválido';
  }

  public static function checkQTD($v){
    $e = "/^[0-9]{0,5}$/";
    $a = preg_match($e, $v);
    if ($a == 1) {
      return $v;
    }
    return 'inválido';
  }

  public static function checkCRO($v){
    $e = "/^[0-9]{5,20}$/";
    $a = preg_match($e, $v);
    if ($a == 1) {
      return $v;
    }
    return 'inválido';
  }

  public static function checkType($v){
    $e = "/^(Limpeza|Higiêne|Hospitalar|Estrutura)$/";
    $a = preg_match($e, $v);
    if ($a == 1) {
      return $v;
    }
    return 'inválido';
  }

  public static function checkPhone($v){
    $e = "/^[0-9]{9,16}$/";
    $a = preg_match($e, $v);
    if ($a == 1) {
      return $v;
    }
    return 'inválido';
  }

  public static function checkDate($m, $d, $y){
    if (checkdate($m, $d, $y)) {
      $array = array($d, $m, $y);
      $date = implode('/',$array);
      return $date;
    }
    return "inválida";
  }

  public static function antiXSS($v){
    return htmlspecialchars($v);
  }
}
