<?php

class customValue { 
    
    function getValue($identifier){
        global $wpdb;
        $table_name = $wpdb->prefix . 'mymovies_value_identifiers';
        
        $value = $wpdb->get_col("
            SELECT value
            FROM $table_name
            WHERE identifier = '".$identifier."'");
        
        return $value[0];
    }
    
    function createIdentifier($identifier, $value){
        global $wpdb;
        $table_name = $wpdb->prefix . 'mymovies_value_identifiers';
        
        $wpdb->insert($table_name, array( 
            'identifier' => $identifier, 
            'value' => $value 
	), array(
            '%s', 
            '%s'));
    }
    
    function getAllValues(){
        global $wpdb;
        $table_name = $wpdb->prefix . 'mymovies_value_identifiers';
        
        $values = $wpdb->get_results("
                SELECT *
                FROM $table_name");
        
        return $values;
    }
    
    function setValue($identifier, $value) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mymovies_value_identifiers';
        
        $wpdb->update($table_name, array( 
            'value' => $value,
            ),array( 
                'identifier' => $identifier ));
    }
}

