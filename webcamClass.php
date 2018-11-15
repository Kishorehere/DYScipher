<?php
    
    require_once( 'connectionClass.php' );
    require('server.php');
    $w=1;
    $userName = $_SESSION['userName'];

class webcamClass extends connectionClass{
    private $imageFolder="webcamImage/";

    private function getNameWithPath(){
        $name = $this->imageFolder.date('YmdHis').".jpg";
        return $name;
    }
    
    public function showImage(){
        $file = file_put_contents( $this->getNameWithPath(), file_get_contents('php://input') );
        if(!$file){
            return "ERROR: Failed to write data to ".$this->getNameWithPath().", check permissions\n";
        }
        else
        {
            $this->saveImageToDatabase($this->getNameWithPath());         
            return $this->getNameWithPath();
        }
        
    }
    
    
    public function changeImagetoBase64($image){
        $path = $image;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
    
    public function saveImageToDatabase($imageurl){
        $w=1;
        $userName = $_SESSION['userName'];
        $image=$imageurl;
//        $image=  $this->changeImagetoBase64($image);          
        if($image){
            $query="Insert into images (username, imgpath, web) values('$userName','$image','$w')";
            $result= $this->query($query);
            if($result){
                return "Image saved to database";
            }
            else{
                return "Image not saved to database";
            }
        }
    }
    
    
}