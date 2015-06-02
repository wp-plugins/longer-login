<?php
/**
 * Plugin Name: Longer Login ("Remember Me" Extension)
 * Plugin URI: http://longer-login.johnmorris.me/
 * Description: Tired of WordPress logging you out after 14 days, even if you check "Remember Me"? Use this plugin to remedy that!
 * Version: 1.0.0
 * Author: John Morris
 * Author URI: http://cs.johnmorris.me
 * Text Domain: longer-login
 * License: GPL2
 */

/*  Copyright 2015 John Morris  (email : johntylermorris@jtmorris.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//  Authentication Cookie Expiration Filter
//  https://developer.wordpress.org/reference/hooks/auth_cookie_expiration/
add_filter( 'auth_cookie_expiration', 'lolo_adjust_login_period' );

function lolo_adjust_login_period( $expires_in ) {
    //  Get the value stored in the database    
    $value = get_option( 'lolo_login_expiration_length' );
    
    if( $value && is_numeric( $value ) ) {    //  Is value stored, and is it a valid integer
        return $value;
    }
    else {  //  Invalid value trying to be stored, just keep it as is.
        return $expires_in;
    }    
}


//  Add setting to General Settings page
//  SEE: https://codex.wordpress.org/Modifying_Options_Pages
class LOLO_Setting {
    /**
     * Class constructor. Responsible for registering the settings field on admin_init.
     */
    public function __construct() {
        add_filter( 'admin_init', array( &$this, 'register_fields' ) );
    }

    /**
     * Tells WordPress we have a settings API field to insert on the General Settings page.
     */
    public function register_fields() {
        register_setting( 
            //  Page
            'general', 
            //  Option name
            'lolo_login_expiration_length', 
            //  Validation/Sanitization function callback
            array( &$this, 'validate_input' ) 
        );
        
        add_settings_field( 
            //  ID
            'lolo_login_expiration_length',           
            //  Title       
            '<label for="lolo_login_expiration_length">' . __('"Remember Me" Login Length', 'longer-login') . '</label>',
            //  Callback
            array( &$this, 'output_field'),
            //  Page
            'general'
        );
    }

    /**
     * Outputs the form field HTML.
     */
    public function output_field() {
        $value = get_option( 'lolo_login_expiration_length', '' );

        //  If there is no stored option, use the default of 14 days
        if( empty( $value ) ) { $value = 1210000; }

        $possibles = array(
            //  Key = Seconds (used by WordPress expiration filter and stored in database)
            //  Value = Readable name with localization
            '86400'     => __('1 Day', 'longer_login'),
            '172800'    => __('2 Days', 'longer_login'),
            '432000'    => __('5 Days', 'longer_login'),
            '604800'    => __('1 Week', 'longer_login'),
            '1210000'   => __('2 Weeks (Default)', 'longer_login'),
            '2630000'   => __('1 Month', 'longer_login'),
            '5259000'   => __('2 Months', 'longer_login'),
            '7889000'   => __('3 Months', 'longer_login'),
            '15780000'  => __('6 Months', 'longer_login'),
            '31560000'  => __('1 Year', 'longer_login')           
        );
        ?>
        <select id='lolo_login_expiration_length' name='lolo_login_expiration_length'>
            <?php
            foreach( $possibles as $val => $read ) {
                //  Make sure we're going to "select" the value stored in the database
                if( $val == $value ) {
                    $selected = ' selected="selected"';
                }
                else {
                    $selected = '';
                }

                echo '<option value="' . $val . '"' . $selected . '>' . $read . '</option>';
            }
            ?>
        </select>
        <?php
    }

    /**
     * The sanitization/validation callback for the register_field call. In this case, it
     * checks if the value is numeric, and if not, inserts a default value.
     *
     * @param    mixed   $input   The form field input
     *
     * @return   mixed            The sanitized form field input.
     */
    public function validate_input( $input ) {
        if( !is_numeric( $input ) ) {
            return 1210000; //  Default of fourteen days
        }

        return $input;
    }
}   //  end class LOLO_Setting

//  instantiate the class so the constructor is called, which sets this whole trainwreck
//  in motion.
new LOLO_Setting();