<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
include_once( dirname( __FILE__ ) . '/inc/menus.php' );
include_once( dirname( __FILE__ ) . '/inc/assets.php' );
include_once( dirname( __FILE__ ) . '/inc/filters.php' );
include_once( dirname( __FILE__ ) . '/inc/actions.php' );
include_once( dirname( __FILE__ ) . '/inc/install.php' );

class NexoPOS_Advanced_Init extends Tendoo_Module {
    public function __construct()
    {
        parent::__construct();
        $this->menus    =   new NexoPOS_Admin_Menus;
        $this->assets   =   new NexoPOS_Assets;
        $this->filters  =   new NexoPOS_Filters;
        $this->actions  =   new NexoPOS_Actions;
        $this->install  =   new NexoPOS_Install;

        $this->load->module_config( 'nexopos_advanced' );
        $this->load->module_model( 'nexopos_advanced', 'nexopos_deliveries_model', 'deliveries' );
        $this->load->module_model( 'nexopos_advanced', 'nexopos_providers_model', 'providers' );
        $this->load->module_model( 'nexopos_advanced', 'nexopos_categories_model', 'categories' );
        $this->load->module_library( 'nexopos_advanced', 'nexopos_misc_library', 'misc' );

        $this->events->add_action( 'load_dashboard', [ $this, 'dashboard' ] );
        $this->events->add_action( 'do_enable_module', [ $this->install, 'create_tables' ] );
        $this->events->add_action( 'do_enable_module', [ $this->actions, 'do_enable_module' ], 20 );
        $this->events->add_action( 'do_remove_module', [ $this->install, 'remove_tables' ] );
        $this->events->add_action( 'tendoo_settings_tables', [ $this->install, 'setup' ] );
    }

    /**
     *  Dashboard Init
     *  @param void
     *  @return void
    **/

    public function dashboard()
    {
        $this->events->add_action( 'dashboard_footer', [ $this->actions, 'dashboard_footer' ] );
        $this->events->add_action( 'dashboard_header', [ $this->actions, 'dashboard_header' ] );
        $this->events->add_filter( 'admin_menus', [ $this->menus, 'register' ] );
        $this->events->add_filter( 'dashboard_dependencies', [ $this->filters, 'dependencies' ] );
        $this->events->add_filter( 'tendoo_spinner', [ $this->filters, 'nexopos_spinner' ] );
        // $this->events->add_filter( 'load_tendoo_app', '__return_false', 99 );
        // $this->events->add_filter( 'dashboard_body_attrs', '__return_false', 99 );
        // unset( $this->enqueue->scripts[ 'common_footer' ][ 'angular.min' ] );

        // Register Controllers
        $this->actions->register_controllers();
    }
}

new NexoPOS_Advanced_Init;
