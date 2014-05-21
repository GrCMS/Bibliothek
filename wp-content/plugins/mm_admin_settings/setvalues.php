<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$customvaulue = new customValue();

// Default values
$customvaulue->createIdentifier('Frontpage Headline', 'myMovies');
$customvaulue->createIdentifier('Frontpage Subheadline', 'Das ist die Subheadline');
$customvaulue->createIdentifier('Frontpage Text', 'Das ist der Text der da mal hinsoll');
$customvaulue->createIdentifier('Watchlist Button Text', 'Watchlist');
$customvaulue->createIdentifier('Rent Button Text', 'Rent');
$customvaulue->createIdentifier('SignUp Button Text', 'Sign Up');
$customvaulue->createIdentifier('Login Button Text', 'Login');

$allvalues = $customvaulue->getAllValues();

?>
<div class="wrap">
    <h2>Interface values</h2>
    <form id="mm_values_form">

<table class="wp-list-table widefat fixed">
    <thead>
        <tr>
            <th class="column-identifier">
                Identifier
            </th>
            <th>
                Value
            </th>
        </tr>
    </thead>
<?php
    $alternate = 'alternate';
    
    foreach ($allvalues as $value){
        if($alternate == 'alternate') $alternate = '';else $alternate = 'alternate';
        echo "<tr class='$alternate'>";
        echo "<td><label for='$value->identifier'>$value->identifier</label></td>";
        echo "<td><input type='text' name='$value->identifier' id='$value->identifier' value='$value->value'></td>";
        echo '</tr>';
    }
?>
    </table>
    <div class="tablenav bottom">
        <input type="submit" class="button action" value="Apply">
    </div>
    </form>
</div>