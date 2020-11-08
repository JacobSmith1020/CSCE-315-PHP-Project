<?php
    function proc_csv($filename, $delimiter, $quote, $columns_to_show) {
            $handle = fopen($filename,"r") or die("Cannot open");
            $newdelimiter = "/";
            $newdelimiter .= $delimiter;
            $newdelimiter .= "/";//delimiter to input into the preg_split on the csv data

            if(!(($columns_to_show == "ALL") or ($columns_to_show == "all"))) {//if $columns_to_show is not ALL then parse columns string by the ':' delimiter
                $columns_to_show_array = preg_split('/:/', $columns_to_show);
            }
            else {
                $ALL = true;//if all columns are to be shown, set ALL to true for use later
            }
            $header_is_done = false;
            $h = 0;
            echo "<table  border=\"1\">\n";


            while ($data = fgets($handle)) {//construct the table from the csv data
                echo "<tr>\n";
                $data_cols = preg_split($newdelimiter, $data);//split incoming csv file string by its specified delimiter
                if($ALL == true) {
                    for($j=0; $j<count($data_cols); ++$j) {//since "ALL" is input instead of a delimited set of numbers, $columns_to_show_array must be populated with all column numbers from 1 to n
                        $columns_to_show_array[$j] = $j+1;
                    }
                }
                for ($k=0; $k<count($data_cols); ++$k) {
                    for($i=0; $i<count($columns_to_show_array); ++$i) {
                        if($k+1 == $columns_to_show_array[$i]) {
                            if($header_is_done == false) {
                                echo "  <td><b><font color=\"red\"> ".$data_cols[$k]." </b></td>\n";
                                $h += 1;
                                if($h == count($columns_to_show_array)) {
                                    $header_is_done = true;
                                }
                            }
                            else {
                                echo "  <td> ".$data_cols[$k]." </td>\n";

                            }
                        }
                    }
                }
            }
            echo "</tr>\n";

            fclose($handle);

            echo "</table>\n<p/>";
        }
?>