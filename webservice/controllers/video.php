<?php

require(dirname(__DIR__) . "\\model\\Video.php");

class video {

    public function convert($data) {
        $data = file_get_contents('php://input');
        $data = json_decode($data);
        $video = new \webservice\models\Video();
        $video->clientID = $data->clientID;
        $video->requestDate = $data->requestDate;
        $video->requestCompletionDate = date("d/m/Y, h:i:s A");
        $video->originalFormat = ".mp4";
        $video->targetFormat = ".avi";
        $video->inputFile = $data->inputFile;
        $video->outputFile = "C:\\xampp\htdocs\\testvideo1.avi";
        $video->APIKey = $data->APIKey;
        exec("ffmpeg -i $data->inputFile $video->outputFile");
        $video->insert();
    }
}
