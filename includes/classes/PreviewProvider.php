<?php
class PreviewProvider {

    private $con, $username;

    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }

    public function createPreviewVideo($entity) {
        if($entity == null){
            $entity = $this->randomEntity();
        }

        $id = $entity->getId();
        $name = $entity->getName();
        $thumbnail = $entity->getThumbnail();
        $preview = $entity->getPreview();

        return "<div class='previewContainer'>

        <img src='$thumbnail' class='previewImage' hidden>

        <video autoplay muted class='previewVideo'>
            <source src='$preview' type='video/mp4'>
        </video>

        <div class='previewOverlay'>
        hello
        </div>
        
        
        </div>";
        
    }

    private function randomEntity(){
        $query = $this->con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        return new Entity($this->con, $row);

    }

    

}
?>