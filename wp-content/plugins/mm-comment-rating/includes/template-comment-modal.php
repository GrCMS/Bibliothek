<!-- MODAL: mm-comment-movie-modal (triggerd from 'bewerten' link) -->
<div class="modal fade" id="mm-comment-movie-modal" tabindex="-1" role="dialog" aria-labelledby="mm-comment-movie-modal-label" aria-hidden="true">
  		
    <div class="modal-dialog">
    		
        <div class="modal-content">
      			
            <div class="modal-header">
        			
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="mm-comment-movie-modal-label">Film: <span id="mm-comment-movie-modal-title"></span></h4>

            </div>
      			
            <div class="modal-body">
                
                <div class="row">
            
                    <div class="col-xs-12">
              
                        <div id="mm-comment-response-output"></div>

                    </div>

                </div>

                <div class="row">
                
                    <div class="col-xs-12">

                        <h5>Bewertung:</h5>

                    </div>                

                </div>

                <div class="row">

                    <div id="mm-comment-movie-rating" class="col-xs-12">
                        
                        <span class="comment-rating-stars"></span>
                                                                        
                    </div>

                </div>

                <div class="row">
                
                    <div class="col-xs-12">

                        <h5>Kommentar (optional):</h5>

                    </div>                

                </div>
            
                <div class="row">

                    <div class="col-xs-12">
                                    
                        <textarea id="mm-comment-movie-content" rows="6" maxlength="500"></textarea> 

                    </div>
                    
                </div>
					
            </div>
      			
            <div class="modal-footer">
        			
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        			
                <!-- button triggers ajax call -->
                <button type="button" class="btn btn-primary" id="mm-comment-movie-ajax">Bewerten</button>
      			
            </div>
        
        </div>
        
    </div>
      
</div><!-- end of mm-comment-movie-modal -->
