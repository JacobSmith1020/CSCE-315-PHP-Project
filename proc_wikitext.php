<?php
//Simplified Wikitext
    function proc_wikitext ($filename) {
        $WikiHandle = fopen($filename,"r") or die("Cannot open");
        $isdescriptionlist = false;
        while ($Wikidata = fgets($WikiHandle)) {
            //section headings
            preg_match_all('/=/', $Wikidata, $matches, PREG_PATTERN_ORDER);
            preg_match_all('/-/', $Wikidata, $matchesHorizontal, PREG_PATTERN_ORDER);
            preg_match_all('/:/', $Wikidata, $matchesIndent, PREG_PATTERN_ORDER);
            preg_match_all('/\*/', $Wikidata, $matchesUnordered, PREG_PATTERN_ORDER);
            preg_match_all('/\#/', $Wikidata, $matchesOrdered, PREG_PATTERN_ORDER);
            preg_match_all('/\'/', $Wikidata, $matchesApostro, PREG_PATTERN_ORDER);
            preg_match_all('/http/', $Wikidata, $matchesHttp, PREG_PATTERN_ORDER);
            $ulrepeatedStart = str_repeat("<ul>", count($matchesUnordered[0]));
            $ulrepeatedEnd = str_repeat("</ul>", count($matchesUnordered[0]));
            $olrepeatedStart = str_repeat("<ol>", count($matchesOrdered[0]));
            $olrepeatedEnd = str_repeat("</ol>", count($matchesOrdered[0]));
            $Outputstring = str_replace('=', '', $Wikidata);
            $OutputstringIndent = str_replace(':', '', $Wikidata);
            $OutputstringUnordered = str_replace('*', '', $Wikidata);
            $OutputstringOrdered = str_replace('#', '', $Wikidata);
            $Outputstringdesclist = str_replace(';', '', $Wikidata);
            $OutputstringItalicBold = str_replace('\'', '', $Wikidata);
            $OutputstringUrlNamed = str_replace(['[',']'], '', $Wikidata);
            $OutputstringUrlNamedArray = preg_split('/ /', $OutputstringUrlNamed);
            if(($isdescriptionlist == true) && ($Wikidata[0] != ':')) {
                $isdescriptionlist = false;
            }
            if(count($matches[0]) == 12) {
                echo '<span style="font-weight: bold; font-size: 15px;">';
                echo $Outputstring;
                echo nl2br("\n");
            }
            else if(count($matches[0]) == 10) {
                echo '<span style="font-weight: bold; font-size: 20px;">';
                echo $Outputstring;
                echo nl2br("\n");
            }
            else if(count($matches[0]) == 8) {
                echo '<span style="font-weight: bold; font-size: 25px;">';
                echo $Outputstring;
                echo nl2br("\n");
            }
            else if(count($matches[0]) == 6) {
                echo '<span style="font-weight: bold; font-size: 30px;">';
                echo $Outputstring;
                echo nl2br("\n");
                
            }
            else if(count($matches[0]) == 4) {
                echo '<span style="font-weight: bold; font-size: 35px;">';
                echo $Outputstring;
                echo '<hr style="width:100%;text-align:left;margin-left:0">';
            }
            else if(count($matches[0]) == 2) {
                echo '<span style="font-weight: bold; font-size: 40px;">';
                echo $Outputstring;
                echo '<hr style="width:100%;text-align:left;margin-left:0">';
            }

            //horizontal rule
            else if(count($matchesHorizontal[0]) >= 4) {
                echo '<hr style="width:100%;text-align:left;margin-left:0">';
            }

            //line breaks
            else if(ctype_space($Wikidata)) {
                echo nl2br("\n\n");
            }

            //part of description list
            else if($isdescriptionlist == true) {
                echo '<span style="font-weight: normal; font-size: 15px;">';
                echo "<dl><dd>{$OutputstringIndent}</dd></dl>";

            }

            //indentation
            else if($Wikidata[0] == ':') {
                echo '<span style="font-weight: normal; font-size: 15px;">';
                echo str_repeat('&nbsp;', (3 * count($matchesIndent[0])));
                echo $OutputstringIndent;
            }

            //block quote
            else if(strpos($Wikidata, '{{Quote') !== false) {
                $Quote = true;
                $locationofauthor = strpos($Wikidata, '|author=');//index of first occurance of |author=
                $authortext = substr($Wikidata, $locationofauthor);
                $OutputstringQuote = str_replace(['|text=','{{Quote','}}','|author=',$authortext], '', $Wikidata);
                echo '<span style="font-weight: normal; font-size: 15px;">';
                echo str_repeat('&nbsp;', 5);
                echo $OutputstringQuote;
                echo nl2br("\n");
            }
            else if($Quote == true) {
                $locationofauthor = strpos($Wikidata, '|author=');//index of first occurance of |author=
                $authortext = substr($Wikidata, $locationofauthor);
                $OutputstringQuote = str_replace(['|text=','{{Quote','}}','|author='], '', $Wikidata);
                echo '<span style="font-weight: normal; font-size: 15px;">';
                echo str_repeat('&nbsp;', 5);
                echo $OutputstringQuote;
                echo nl2br("\n");
                if(strpos($Wikidata, '}}') !== false) {
                    $Quote = false;
                }
            }
            
            //unordered list
            else if($Wikidata[0] == '*') {
                echo '<span style="font-weight: normal; font-size: 15px;">';
                echo "{$ulrepeatedStart}";
                echo "<li>{$OutputstringUnordered}</li>";
                echo "{$ulrepeatedEnd}";
            }

            //ordered list
            else if($Wikidata[0] == '#') {
                echo '<span style="font-weight: normal; font-size: 15px;">';
                echo "{$olrepeatedStart}";
                echo "<li>{$OutputstringOrdered}</li>";
                echo "{$olrepeatedEnd}";
            }

            //description list
            else if($Wikidata[0] == ';') {
                $isdescriptionlist = true;
                echo '<span style="font-weight: normal; font-size: 15px;">';
                echo $Outputstringdesclist;
                echo "<dl><dt>{$outputstringdesclist}</dt></dt>";
            }

            //italics and bold
            else if($Wikidata[0] == "'") {
                $ApostroCount = count($matchesApostro[0]);
                if($ApostroCount == 4) { //italic
                    echo '<span style="font-weight: normal; font-size: 15px;">';
                    echo "<i>{$OutputstringItalicBold}</i>";
                }
                else if($ApostroCount == 6) { //bold
                    echo "<b>{$OutputstringItalicBold}</b>";
                }
                else if($ApostroCount == 10) { //both
                    echo "<i><b>{$OutputstringItalicBold}</b></i>";
                }
                echo nl2br("\n");
            }

            //links
            else if($Wikidata[0] == '[') {
                $url = '<a href=';
                $url .= $OutputstringUrlNamedArray[0];
                $url .= '>';
                $url .= $OutputstringUrlNamedArray[1];
                $url .= '</a>';
                echo $url;
                echo nl2br("\n");
            }
            else if(strpos($Wikidata, 'http') != false) {
                $url = '<a href=';
                $url .= $OutputstringUrlNamed;
                $url .= '>';
                $url .= $OutputstringUrlNamed;
                $url .= '</a>';
                echo $url;
                echo nl2br("\n");
            }
            else {
                echo '<span style="font-weight: normal; font-size: 15px;">';
                echo $Wikidata;
            }

        }
    }
?>