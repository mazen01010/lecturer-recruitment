<?php
class TileContainer {

    public $tiles =[];

    public function addTile( CreateTile $tile) {
        $this->tiles[] = $tile;
    }
    public function render() {
        $tiles = $this->tiles;
        echo '<div class="d-flex flex-wrap p-2 bd-highlight"></div>
              <div class="container ">
              <div class="row  justify-content-left">
              <div class="card-deck col-sm-12 text-center">';
        foreach ($tiles as $tile=>$val){
            echo '<div class="card mb-4  shadow-sm text-dark bg-light" style="min-width: 23%; height : 270px;">';
            echo '<div class="card-header btn-outline-'.$val->color.'">';
            echo '<h4 class="my-0 font-weight-normal">'.$val->title.'</h4> </div>';
            echo '<div class="card-body ">
                        <ul class="list-unstyled mt-3 mb-4 h-50">';

            echo'</ul>
                        <form action="'.$val->buttonURL.'">
                        <button type="submit"  class="btn btn-lg btn-block btn-'.$val->color.'"> <i class="'.$val->buttonIcon.'"></i> '.$val->buttonName.' </button>
                        </form>
                    </div>
                    </div>';
        }
        echo '</div></div></div> ';
    }
}

/* This class creates Bootstrap Cards (Tiles)*/

class CreateTile {

    public $title;
    public $buttonName;
    public $buttonURL;
    public $buttonIcon = 'fa fa-angle-double-right';
    public $listElement;
    public $color = 'primary';


    /*This function sets a title */
    public function setTitle($param) {
        $this->title = $param;
    }
    /*This function sets button name */
    public function setButtonName($param) {
        $this->buttonName = $param;
    }
    /*This function sets the URL*/
    public function setButtonURL($param) {
        $this->buttonURL = $param;
    }
    /* Bootstrap Icon default is fa fa-user */
    public function setButtonIcon($param) {
        $this->buttonIcon = $param;
    }
    /*This function  adds an HTML unordered list element*/
    public function addListElement($param) {
        $this->listElement[] = $param;
    }
    /*This function sets the color of header and button of the tile. Default color is danger 'Bootstrap' */
    public function setColor($param){
        $this->color = $param;
    }
    public function setGlobal($Role){

    }
}