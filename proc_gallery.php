<html>
    <style>
    h4 {
        text-align:left;
        font-size:small;
    }
    h5 {
        text-align:center;
        font-size:small;
    }
    h6 {
        text-align:right;
        font-size:small;
    }
    </style>
</html>
<?php
    //gallery
    function proc_gallery($image_list_filename, $mode, $sort_mode) {
        //read the csv file
        $galleryfile = fopen($image_list_filename,"r") or die("Cannot open" .$image_list_filename);//open csv file
        $galleryarray = array();
        while ($gallerydata = fgets($galleryfile)) {
            $gallerycolumns = preg_split('/[,\n]/', $gallerydata);//split csv file by commas
            $galleryarray[] = $gallerycolumns[0];
            $galleryarray[] = $gallerycolumns[1];
        }
        $lengthofgalleryarray = count($galleryarray);
        # $sort_mode == "orig"  : original ordering in the CSV file
        if($sort_mode == "orig") {
            //Do nothing, csv is already in original order
        }
        # $sort_mode == "date_newest"  : newest images first
        else if($sort_mode == "date_newest") {
            $date = array();
            $desc = array();
            for($j=0; $j<$lengthofgalleryarray; $j+=2) {
                $galleryfilenameDN = $galleryarray[$j];
                $gallerydescriptionDN = $galleryarray[$j+1];
                $date[$galleryfilenameDN] = filemtime($galleryfilenameDN);
                $desc[$gallerydescriptionDN] = filemtime($galleryfilenameDN);
            }
            arsort($date);//sort the associative array by value in descending order
            arsort($desc);
            $k=0;
            foreach($date as $x => $x_value) {
                //echo "Key=" . $x . ", Value=" . $x_value;
                $galleryarray[$k] = $x;//reorder the galleryarray[] with the new order of images
                $k+=2;
            }
            $k=0;
            foreach($desc as $x => $x_value) {
                //echo "Key=" . $x . ", Value=" . $x_value;
                $galleryarray[$k+1] = $x;//reorder the galleryarray[] with the new order of images
                $k+=2;
            }
            // echo date("F d Y H:i:s.", $date[0]) ."\n". date("F d Y H:i:s.", $date[1]) ."\n";  
        }
        # $sort_mode == "date_oldest"  : oldest images first
        else if($sort_mode == "date_oldest") {
            $date = array();
            $desc = array();
            for($j=0; $j<$lengthofgalleryarray; $j+=2) {
                $galleryfilenameDO = $galleryarray[$j];
                $gallerydescriptionDO = $galleryarray[$j+1];
                $date[$galleryfilenameDO] = filemtime($galleryfilenameDO);
                $desc[$gallerydescriptionDO] = filemtime($galleryfilenameDO);
            }
            asort($date);//sort the associative array by value in ascending order
            asort($desc);
            $k=0;
            foreach($date as $x => $x_value) {
                //echo "Key=" . $x . ", Value=" . $x_value;
                $galleryarray[$k] = $x;//reorder the galleryarray[] with the new order of images
                $k+=2;
            }
            $k=0;
            foreach($desc as $x => $x_value) {
                //echo "Key=" . $x . ", Value=" . $x_value;
                $galleryarray[$k+1] = $x;//reorder the galleryarray[] with the new order of images
                $k+=2;
            }
        }
        # $sort_mode == "size_largest" : largest file size first
        else if($sort_mode == "size_largest") {
            $size = array();
            $desc = array();
            for($j=0; $j<$lengthofgalleryarray; $j+=2) {
                $galleryfilenameSL = $galleryarray[$j];
                $gallerydescriptionSL = $galleryarray[$j+1];
                $size[$galleryfilenameSL] = filesize($galleryfilenameSL);
                $desc[$gallerydescriptionSL] = filesize($galleryfilenameSL);
            }
            arsort($size);//sort the associative array by value in ascending order
            arsort($desc);
            $k=0;
            foreach($size as $x => $x_value) {
                //echo "Key=" . $x . ", Value=" . $x_value;
                $galleryarray[$k] = $x;//reorder the galleryarray[] with the new order of images
                $k+=2;
            }
            $k=0;
            foreach($desc as $x => $x_value) {
                //echo "Key=" . $x . ", Value=" . $x_value;
                $galleryarray[$k+1] = $x;//reorder the galleryarray[] with the new order of images
                $k+=2;
            }
        }
        # $sort_mode == "size_smallest": smallest file size first
        else if($sort_mode == "size_smallest") {
            $size = array();
            $desc = array();
            for($j=0; $j<$lengthofgalleryarray; $j+=2) {
                $galleryfilenameSS = $galleryarray[$j];
                $gallerydescriptionSS = $galleryarray[$j+1];
                $size[$galleryfilenameSS] = filesize($galleryfilenameSS);
                $desc[$gallerydescriptionSS] = filesize($galleryfilenameSS);
            }
            asort($size);//sort the associative array by value in ascending order
            asort($desc);
            $k=0;
            foreach($size as $x => $x_value) {
                //echo "Key=" . $x . ", Value=" . $x_value;
                $galleryarray[$k] = $x;//reorder the galleryarray[] with the new order of images
                $k+=2;
            }
            $k=0;
            foreach($desc as $x => $x_value) {
                //echo "Key=" . $x . ", Value=" . $x_value;
                $galleryarray[$k+1] = $x;//reorder the galleryarray[] with the new order of images
                $k+=2;
            }
        }
        # $sort_mode == "rand"  : random ordering
        else if($sort_mode == "rand") {
            $rand = array();
            for($j=0; $j<$lengthofgalleryarray; $j+=2) {
                $galleryfilenameR = $galleryarray[$j];
                $gallerydescriptionR = $galleryarray[$j+1];
                //$size[] = $galleryfilenameR;
                $rand[$galleryfilenameR] = $gallerydescriptionR;
            }
            //the following code up to the foreach() will implement the shuffle() function on an associative array while preserving key-value pairs
            $keys = array_keys($rand);
            shuffle($keys);
            foreach($keys as $key) {
                $new[$key] = $rand[$key];
            }
            $rand = $new;
            $k=0;
            foreach($rand as $x => $x_value) {
                //echo "Key=" . $x;
                $galleryarray[$k] = $x;//reorder the galleryarray[] with the new order of images
                $galleryarray[$k+1] = $x_value;
                $k+=2;
            }
        }
        else {
            exit("The given sort_mode is not supported.");
        }
        $incrementM=0;
        for($i=0; $i<$lengthofgalleryarray; $i+=2) {
            $galleryfilename = $galleryarray[$i];//galleryfilename is the name of the image file
            $gallerydescription = $galleryarray[$i+1];//gallerydescription is the description given on the image
            $imagesize = getimagesize($galleryfilename);//imagesize is an array containing the length and width of the given image
            $imagedate = filemtime($galleryfilename);//image date is the date an image was last modified
            $filesize = filesize($galleryfilename);//gets file size of image in bytes
            //echo $galleryarray[0] ."\n". $galleryarray[1] ."\n". $galleryarray[2] ."\n". $galleryarray[3];
            //list display mode
            if($mode == "list") {
                $imageidentifier = imagecreatefromjpeg($galleryfilename);
                $resizedimageidentifier = imagescale($imageidentifier, 1887, 1200);//image is scaled to fit within the browser window (Assumes browser width of <1890 and assigns a height of 1200)
                ob_start();
                imagejpeg($resizedimageidentifier);
                imagedestroy($resizedimageidentifier);
                $data = ob_get_contents();
                ob_end_clean();
                $image = "<img src='data:image/jpeg;base64,".base64_encode($data)."'>";//take the image string generated from imagejpeg() and convert it to a visable image
                echo $image;//output image to the browser
                echo "<h4>".$galleryarray[$i+1]."</h4>";
            }
            //matrix display mode
            else if($mode == "matrix") {
                $imageidentifier = imagecreatefromjpeg($galleryfilename);
                $resizedimageidentifier = imagescale($imageidentifier, 629, 400);//image is scaled to fit three columns of images (Assumes browser width of <1890)
                ob_start();
                imagejpeg($resizedimageidentifier);
                imagedestroy($resizedimageidentifier);
                $data = ob_get_contents();
                ob_end_clean();
                $image = "<img src='data:image/jpeg;base64,".base64_encode($data)."'>";//take the image string generated from imagejpeg() and convert it to a visable image
                echo $image;//output image to the browser
                $incrementM++;
                //standard output for three pictures per row
                if(($incrementM % 3) == 0) {
                    echo "<h4>".$galleryarray[$i-3]."</h4>";
                    echo "<h5>".$galleryarray[$i-1]."</h5>";
                    echo "<h6>".$galleryarray[$i+1]."</h6>";
                    echo "<br>";
                }
                //handle the case where there is only one image in the final row
                else if((($incrementM % 3) == 1) && ($i == ($lengthofgalleryarray-2))) {
                    echo "<br>";
                    echo "<h4>".$galleryarray[$i+1]."</h4>";
                    echo "<br>";
                }
                //handle the case where there are only two images in the final row
                else if((($incrementM % 3) == 2) && ($i == ($lengthofgalleryarray-2))) {
                    echo "<br>";
                    echo "<h4>".$galleryarray[$i-1]."</h4>";
                    echo "<h5>".$galleryarray[$i+1]."</h5>";
                    echo "<br>";
                }
            }
            //details display mode
            else if($mode == "details") {
                echo "<h4>".$galleryfilename." | ".$gallerydescription." | Last modified: ".date("F d Y H:i:s.", $imagedate)." | ".$filesize." bytes</h4>";

            }
        }
    }
?>