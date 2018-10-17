<?php
class Security{
  public static function checkName($v){
    $e = "/^[A-zÁ-ù ]{2-20}$/";
    return preg_match($e, $v);
  }

  public static function checkStuffName($v){
    $e = "/^[A-zÁ-ù ]{2-50}$/";
    return preg_match($e, $v);
  }

  public static function checkVendor($v){
    $e = "/^[A-zÁ-ù ]{2-50}$/";
    return preg_match($e, $v);
  }

  public static function checkRG($v){
    $e = "/^[0-9]{7-15}$/";
    return preg_match($e, $v);
  }

  public static function checkCPF($v){
    $e = "/^[0-9]{11}$/";
    return preg_match($e, $v);
  }

  public static function checkTurn($v){
    $e = "/^(manha|tarde|noite)$/";
    return preg_match($e, $v);
  }

  public static function checkLogin($v){
    $e = "/^[a-z]{2,15}$/";
    return preg_match($e, $v);
  }

  public static function checkPass($v){
    $e = "/^[A-z0-9]{4,20}$/";
    return preg_match($e, $v);
  }

  public static function checkQTD($v){
    $e = "/^[0-9]{0-5}$/";
    return preg_match($e, $v);
  }

  public static function checkType($v){
    $e = "/^(limpeza|higiene|alimento|estrutura)$/";
    return preg_match($e, $v);
  }
}
