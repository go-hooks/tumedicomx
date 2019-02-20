<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('medicos/agregarAseguradora') ?>" method="post">
        <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                            Aseguradoras
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($medico['id'])): ?>
                        <input type="hidden" name="registro_id" value="<?php echo $medico['id'] ?>">
                    <?php endif; ?>
                        
                    <?php if (isset($buscar['p'])): ?>
                        <input type="hidden" name="p" value="<?php echo $buscar['p'] ?>">
                    <?php endif; ?>                              
                                                                        
                    <div class="form-group">
                        <label for="aseguradora_id" class="col-sm-2 control-label">Catalogo</label>
                        <div class="col-sm-6">

                            <select class="validate-dropdown dropDown large" id="aseguradora_id" name="aseguradora_id">
                                
                                <?php foreach ($aseguradoras as $aseguradora): ?>
                                    <option value="<?php echo $aseguradora['id'] ?>">
                                        <?php echo $aseguradora['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>     
                                                                
                            </select>   

                            <button type="submit" class="btn btn-success  btn-sm">
                                <span class="glyphicon glyphicon-ok"></span> 
                                Agregar
                            </button>

                        </div>
                    </div>
                        
                    <table class="table table-striped">

                        <thead>
                            <tr>                                    
                                <th>Aseguradora</th>
                                <th> </th>      
                            </tr>
                        </thead>

                       <tbody>

                   <?php foreach ($medico_aseguradoras as $aseguradoras): ?> 
                           <tr>

                           <td>    
                               <label> <?php echo $aseguradoras['nombre'] ?> </label>
                           </td> 

                            <td>        
                                <a class="btn btn-danger btn-xs" title="Borrar" 
                                        href="<?php echo url_format('medicos/deleteAseguradora', array('aseguradora_id' => $aseguradoras['id'],'registro_id' => $medico['id'], 'p' => $buscar['p'])); ?>">
                                        <span class="glyphicon glyphicon-remove"></span> Borrar
                                </a>
                            </td>

                            </tr>

                   <?php endforeach; ?>

                    </tbody>
                    </table>
                        
                        
                        
                </div>
            </div>

                <?php if (hasPermission('acceso_medicos')): ?>

                <a href="<?php echo url_format('medicos', $buscar) ?>" class="btn btn-danger  btn-sm">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancelar 
                </a>
            <?php endif; ?>
        
            
        </div>
    </form>
    
                

    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('medicos/agregarTarjeta') ?>" method="post">
        <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                            Tarjetas
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($medico['id'])): ?>
                        <input type="hidden" name="registro_id" value="<?php echo $medico['id'] ?>">
                    <?php endif; ?>
                        
                    <?php if (isset($buscar['p'])): ?>
                        <input type="hidden" name="p" value="<?php echo $buscar['p'] ?>">
                    <?php endif; ?>                           
                                                                        
                    <div class="form-group">
                        <label for="tarjeta_id" class="col-sm-2 control-label">Catalogo</label>
                        <div class="col-sm-6">

                            <select class="validate-dropdown dropDown large" id="tarjeta_id" name="tarjeta_id">
                                
                                <?php foreach ($tarjetas as $tarjeta): ?>
                                    <option value="<?php echo $tarjeta['id'] ?>">
                                        <?php echo $tarjeta['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>     
                                                                
                            </select>   

                            <button type="submit" class="btn btn-success  btn-sm">
                                <span class="glyphicon glyphicon-ok"></span> 
                                Agregar
                            </button>

                        </div>
                    </div>
                        
                    <table class="table table-striped">

                        <thead>
                            <tr>                                    
                                <th>Tarjetas</th>
                                <th> </th>      
                            </tr>
                        </thead>

                       <tbody>

                   <?php foreach ($medico_tarjetas as $tarjetas): ?> 
                           <tr>

                           <td>    
                               <label> <?php echo $tarjetas['nombre'] ?> </label>
                           </td> 

                            <td>        
                                <a class="btn btn-danger btn-xs" title="Borrar" 
                                        href="<?php echo url_format('medicos/deleteTarjeta', array('tarjeta_id' => $tarjetas['id'],'registro_id' => $medico['id'], 'p' => $buscar['p'])); ?>">
                                        <span class="glyphicon glyphicon-remove"></span> Borrar
                                </a>
                            </td>

                            </tr>

                   <?php endforeach; ?>

                    </tbody>
                    </table>
                        
                        
                        
                </div>
            </div>
        </div>
    </form>    


</div>
