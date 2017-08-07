<?php
	function removeComma($strNum) {

    $len = strlen($strNum);
    /*for($i=0; $i<$len ;$i++)
    {
        if($strNum[$i] == ',')
        {
            $strNum[$i] = $strNum[$i+1];
            $len -= 1;
            $strNum[$len] = '\0';
            $i = 0;

        }
    }*/
    return $len;
}

echo removeComma("fjdsfhsk,fdsf,fdsfsf,");