<?php
include "config.php";


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 if (isset ($_GET["hid"])){echo disp_producers($_GET["hid"]);}else {echo disp_producers(0);}
 
 