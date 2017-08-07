<?php 

function adddotstring($strNum) {
 
        $len = strlen($strNum);
        $counter = 3;
        $result = "";
        while ($len - $counter >= 0)
        {
            $con = substr($strNum, $len - $counter , 3);
            $result = '.'.$con.$result;
            $counter+= 3;
        }
        $con = substr($strNum, 0 , 3 - ($counter - $len) );
        $result = $con.$result;
        if(substr($result,0,1)=='.'){
            $result=substr($result,1,$len+1);   
        }
        return $result;
}

function removeComma($strNum) {
    $len = strlen($strNum);
    for($i=0; $i<$len ;$i++)
    {
        if($strNum[$i] == ',')
        {
            $strNum[$i] = $strNum[$i+1];
            $len -= 1;
            $strNum[$len] = '\0';
            $i = 0;

        }
    }
}

 function stripUnicode($str){
      if(!$str) return false;
      $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ',
            'D'=>'Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '' =>'?|(|)|[|]|{|}|#|%|-|<|>|,|:|;|.|&|–|/'
      );

      foreach($unicode as $khongdau=>$codau) {
         $arr=explode("|",$codau);
         $str = str_replace($arr,$khongdau,$str);
      }
      return $str;
   }

               
function changeTitle($str){
   $str = trim($str);
   if ($str=="") return "";
      $str =str_replace('"','',$str);
      $str =str_replace("'",'',$str);
      $str = stripUnicode($str);
      $str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');    // MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
      $str = str_replace(' ','-',$str);
      
   return $str;
}

function cate_parent($data, $parent = 0, $str="--", $select=0){
   foreach ($data as $key => $value) {
      $id = $value->id;
      $name = $value->name;
      if($value->parent_id == $parent){
         if($select != 0 && $id = $select)
         {
            echo "<option value='$id' selected='selected'> $str $name </option>";
         }
         else{
            echo "<option value='$id'> $str $name </option>";
         }
         cate_parent($data, $id, $str.'--');
      }
   }

}

?>﻿