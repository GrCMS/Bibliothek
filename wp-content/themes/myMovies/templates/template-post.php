<div class="container">

    <h3 class="color-primary"><?php echo the_title(); ?></h3>
    
    <div class="row">
        
        <div class="col-xs-12">
            
            <?php 
            echo __('Published', 'myMovies').": ";
            echo the_date('d.m.y'); 
            ?>
            
        </div>
        
    </div>
    
    <br/>
    
    <div class="row">
        
        <div class="col-xs-12">
            
            <?php echo the_content(); ?>
        
        </div>
        
    </div>
                    
</div>

<div class="movie-divider"></div>

