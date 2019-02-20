<?php
   
    $sql = " SELECT * FROM timmer t";
    $timmer = get_one_sql($sql);    
    
    
//    $where = "elim = 0"
//            . " AND localizacion = '" . $ubicacion . "'"
//            . " AND tipo = 1"
//            . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
//            . " AND fecha_fin >= '" . date("Y/m/d") . "'" ;
//    $banners1 = get_all_actived_inactived('banners', $where, 'RAND()');     
    
    
    $sql = " SELECT * FROM banners"
            . " WHERE"
            . " elim = 0"
            . " AND localizacion = '" . $ubicacion . "'"
            . " AND tipo = 1"
 //           . " AND fecha_inicio <= '" . date("Y/m/d") . "'"
 //          . " AND fecha_fin >= '" . date("Y/m/d") . "'"
            . " ORDER BY RAND() LIMIT 1" ;
    $banners1 = get_sql($sql);    

    
    
    
?>


<div id="banner2">
    
    <div class="cycle-slideshow" data-cycle-slides='> a' data-cycle-timeout="<?php echo (int)($timmer['tiempo'] * 1000) ?>">
        
        <?php foreach ($banners1 as $banner): ?>
            
            <a href="<?php echo $banner['url']  ?>" target="_blank">
                <img src="<?php echo UP_IMG_PATH . $banner['imagen']  ?>" >
            </a>
        
        <?php endforeach; ?>
        
        <!--<img src="img/banner01.jpg" >-->
        <!--<img src="img/banner01.jpg" >-->
        <!--<img src="img/banner01.jpg" >-->
        
    </div>
</div>

