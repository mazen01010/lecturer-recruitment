<?php
class TileContainer
{

    public $tiles;

    public function addTile(CreateTile $tile)
    {
        $this->tiles[] = $tile;
    }
    public function render()
    {
        $tiles = $this->tiles;
        $count = count($tiles);
        $iterations = (int) ($count / 3) + 1;
        $counter = 0;
        $countdown = $count;

        for ($i = 0; $i < $iterations; $i++) {

            try {



                echo '</br>
             
             <div class=" justify-content-center">
             <div class="row text-center  justify-content-center">';
                for ($j = 0; $j < 3; $j++) {
                    if (!isset($tiles[$counter])) {
                        break;
                    }
                    echo '<div class="col-lg-4">';
                    echo '<div class="card shadow mb-4 text-dark bg-light" style="min-width: 320px; height : 260px;">';
                    echo '<div class="card-header btn-outline-' . $tiles[$counter]->color . '">';
                    echo '<h4 class="my-0 font-weight-normal">' . $tiles[$counter]->title . '</h4> </div>';
                    echo '<div class="card-body">
                       <ul class="list-unstyled mt-2 mb-4 h-50">';
                    foreach ($tiles[$counter]->listElement as $element) {
                        echo '<li>' . $element . '</li>';
                    }
                    echo '</ul>
                       <form action="' . $tiles[$counter]->buttonURL . '">
                       <button type="submit"  class="btn btn-lg btn-block btn-' . $tiles[$counter]->color . '"> <i class="' . $tiles[$counter]->buttonIcon . '"></i> ' . $tiles[$counter]->buttonName . ' </button>
                       </form>
                   </div>
                   </div></div>';
                    $counter++;
                }
                echo '</div></div> ';
            } catch (Exception $e) {
            }
        }
    }
};

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