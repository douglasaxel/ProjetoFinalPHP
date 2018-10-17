<?php
class Patterns{
  public static function toUpperLower($v){
    return ucwords(strtolower($v));
  }

  public static function toLower($v){
    return strtolower($v);
  }

  public static function uniteName($n, $s){
    $array = array($n, $s);
    $fullName = implode(" ", $array);
    return $fullName;
  }

  public static function checkDate($m, $d, $a){
    if (checkdate($m, $d, $a)) {
      $array = array($d, $m, $a);
      $date = implode('/',$array);
      return $date;
    }
    return "inválida";
  }
}
