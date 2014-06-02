<?php

$rentals = new movie_rentals();

$currentRentals = $rentals->getAllRentedMovies();
$currentRentalsCount = $rentals->getAllRentedMoviesCount();

$rentalsHistory = $rentals->getAllRentedMoviesHistory();
$rentalsHistoryCount = $rentals->getAllRentedMoviesHistoryCount();

$mostRented = $rentals->getMostRented();

?>

<style>
    
    th:hover {
        
        cursor:pointer;
    }
            
</style>

<div class="wrap">
    
    <!-- Add translation -->
    <h2><?php echo __('Rentals Overview', 'myMovies'); ?></h2>
    
    <div class="ionTabs" id="tabs_1" data-name="mm_admin_rentals_overview_tabs">
        
        <ul class="ionTabs__head">
            <li class="ionTabs__tab" data-target="mm-admin_rentals_tab_1">Current (<?php echo $currentRentalsCount; ?>)</li>
            <li class="ionTabs__tab" data-target="mm-admin_rentals_tab_2">History (<?php echo $rentalsHistoryCount; ?>)</li>
            <li class="ionTabs__tab" data-target="mm-admin_rentals_tab_3">Most rented</li>
        </ul>
        
        <div class="ionTabs__body">
            
            <div class="ionTabs__item" data-name="mm-admin_rentals_tab_1">
            
                <table id="mm-admin-rentals-overview-current-table" class="tablesorter">
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

                    foreach($currentRentals as $rental)
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
            
            <div class="ionTabs__item" data-name="mm-admin_rentals_tab_2">
                
                <table id="mm-admin-rentals-overview-history-table" class="tablesorter">
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

                    foreach($rentalsHistory as $rental)
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
            
            <div class="ionTabs__item" data-name="mm-admin_rentals_tab_3">
                
                <table id="mm-admin-rentals-overview-most-rented-table" class="tablesorter">
                    <thead>
                        <tr>
                            <th class="column-identifier">
                                <!-- Add translation -->
                                Anzahl
                            </th>
                            <th>
                                <!-- Add translation -->
                                Film
                            </th>
                        </tr>
                    </thead>
                    <tbody> 
            
                    <?php 

                    foreach($mostRented as $rental)
                    {
                        echo "<tr>";
                        echo "<td> $rental->Anzahl </td>";
                        
                        $post = get_post( $rental->movie);
                        
                        echo "<td> $post->post_title</td>";
                        echo "</tr>";
                    }

                    ?>
            
                    </tbody>
                </table>
                
            </div>
            
            <div class="ionTabs__preloader"></div>
            
        </div>
    </div>
                
</div>

<script>

(function($) {
    
    $(document).ready(function() {
        
        $('#mm-admin-rentals-overview-current-table').tablesorter();
        $('#mm-admin-rentals-overview-history-table').tablesorter();
        $('#mm-admin-rentals-overview-most-rented-table').tablesorter();
        $.ionTabs("#tabs_1");
    
    });
    
})(jQuery);

</script>

