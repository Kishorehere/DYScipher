<?php
require_once 'webcamClass.php';
$webcamClass=new webcamClass();
echo $webcamClass->showImage();
echo $webcamClass->saveImageToDatabase($webcamClass->showImage());