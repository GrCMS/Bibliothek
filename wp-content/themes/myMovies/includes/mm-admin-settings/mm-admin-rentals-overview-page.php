<?php

$rentals = new movie_rentals();

$allRentals = $rentals->getAllRentedMovies();

?>

<style>
    
    th:hover {
        
        cursor:pointer;
    }
            
</style>

<div class="wrap">
    
    <div id="mm-admin-rentals-overview-tabs"></div>
    
    <!-- Add translation -->
    <h2><?php echo __('Frontapage text', 'myMovies'); ?></h2>
        
    <table id="mm-admin-rentals-overview-table" class="tablesorter">
        <thead>
            <tr>
                <th class="column-identifier">
                    <!-- Add translation -->
                    Film
                </th>
                <th>
                    <!-- Add translation -->
                    User
                </th>
                <th>
                    <!-- Add translation -->
                    Rented date:
                </th>
                <th>
                    <!-- Add translation -->
                    Return date:
                </th>
                                
            </tr>
        </thead>
        <tbody> 
            
            <?php 
            
            foreach($allRentals as $rental)
            {
                echo "<tr>";
                echo "<td> $rental->post_title </td>";
                
                $user_info = get_userdata($rental->user);
                
                echo "<td> $user_info->display_name</td>";
                echo "<td> $rental->rental_date </td>";
                echo "<td> $rental->return_date </td>";
                echo "</tr>";
            }
            
            ?>
            
        </tbody>
    </table>    
</div>

<script>

(function($) {
    
    $(document).ready(function() {
        
        $('#mm-admin-rentals-overview-table').tablesorter();
    
    });
    
})(jQuery);

</script>

