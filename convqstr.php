/**
 * 페이지 처리시 사용하는 get 으로 넘길 부분
 * $q : 주소창의 get 값. 대부분 $_SERVER['QUERY_STRING'] 을 넣으면 됨.
 * $g : 덧붙일 값. 페이지를 1로 넘기고 싶다면 이 부분에 page=1 이런식으로 입력
 * $m : 대부분 get 사용. form 으로 넘김 hidden 이 필요하다며 hidden 입력. <input type='hidden' 으로 넘김
 */
function convqstr($q='', $g='', $m='get'){
        if($g) $q .= (substr($g,0,1)!="&"?"&":"").$g;
        parse_str($q, $output);
        $t = array();
        $t1 = array();
        foreach($output as $k=>$v){
                if(is_array($v)){
                        foreach($v as $k2=>$v2){
                                $t[] = "{$k}%5B%5D=$v2";
                                $t1[] = "<input type='hidden' name='{$k}[]' value=\"".htmlspecialchars($v2)."\" />";
                        }
                }else{
                        $t[] = "$k=$v";
                        $t1[] = "<input type='hidden' name='{$k}' value=\"".htmlspecialchars($v)."\" />";
                }
        }

        $rtnStr = implode("&", $t);
        if($m=='hidden'){
                $rtnStr = implode("", $t1);
        }

        return $rtnStr;
}
