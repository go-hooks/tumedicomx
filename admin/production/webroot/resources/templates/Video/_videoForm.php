<div class="row">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo url_format('video/aplicar') ?>" method="post">
        <div class="col-sm-6">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php if (!isset($video['id'])): ?>
                            Nuevo video
                        <?php else: ?>
                            Edición de video
                        <?php endif; ?>
                    </div>
                </div>

                <div class="panel-body">
                    <?php if (isset($video['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo $video['id'] ?>">
                    <?php endif; ?>                                               
                        
                    <div class="form-group">
                        <label for="video" class="col-sm-2 control-label">Video*</label>
                        <div class="col-sm-8">
                            <input value="<?php echo @$video['video'] ?>" type="text" required="" class="form-control input-sm" name="video" id="video" placeholder="Ejemplo: //www.youtube.com/embed/eEgYUMWqzTQ">
                        </div>
                    </div>
                       

                </div>
            </div>
            
            <?php if (hasPermission('acceso_video')): ?>
                <button type="submit" class="btn btn-success  btn-sm">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Aplicar
                </button>
            <?php endif; ?>            
            
        </div>
        
    </form>
</div>
