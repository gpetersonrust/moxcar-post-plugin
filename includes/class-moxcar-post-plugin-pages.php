<?php

/**
 * Register all admin pages for the plugin
 */
class Moxcar_Post_Plugin_Pages {
    
    /**
     * The array of pages registered with WordPress.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $pages    The pages registered with WordPress to fire when the plugin loads.
     */
    protected $pages;

    /**
     * Initialize the collections used to maintain the pages.
     *
     * @since    1.0.0
     */
    public function __construct() {
        $this->pages = array();
    }

    /**
     * Add a new page to the collection to be registered with WordPress.
     *
     * @since    1.0.0
     * @param    string    $page             The name of the WordPress page that is being registered.
     * @param    string    $title            The title of the WordPress page that is being registered.
     * @param    string    $capability       The capability required for the page to be available to the user.
     * @param    string    $menu_slug        The slug name to refer to this menu by (should be unique for this menu).
     * @param    string    $function         The function to be called to output the content for this page.
     * @param    string    $icon_url         The URL to the icon to be used for this menu.
     * @param    int       $position         The position in the menu order this one should appear.
     */
    public function add_page( $page, $title, $capability, $menu_slug, $function, $icon_url, $position, $parent_slug = null) {
        $page = array(

            'page' => $page,
            'title' => $title,
            'capability' => $capability,
            'menu_slug' => $menu_slug,
            'function' =>   $function,
            'icon_url' => $icon_url,
            'position' => $position
           );

           if( $parent_slug ) {
               $page['parent_slug'] = $parent_slug;
           }

              $this->pages[] = $page;

     
    }

 

    /**
     * Register the pages with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        echo 'running';
        foreach ( $this->pages as $page ) {
            // if ( $page['parent_slug'] ) {
                $has_parent =  isset( $page['parent_slug'] ) ? true : false;
                if( $has_parent ) {
                    add_action( 'admin_menu', function() use ( $page ) {
                        add_submenu_page(
                            $page['parent_slug'],
                            $page['title'],
                            $page['menu_slug'],
                            $page['capability'],
                            $page['menu_slug'],
                            $page['function']
                        );
                    });
                } else {
                    add_action( 'admin_menu', function() use ( $page ) {
                        add_menu_page(
                            $page['title'],
                            $page['title'],
                            $page['capability'],
                            $page['menu_slug'],
                            $page['function'],
                            $page['icon_url'],
                            $page['position']
                        );
                    });
                }
            // 
        }

    
    }

        // add_plugin_page();
        public function add_plugin_page() {

      
            // Add your logic to add plugin pages here
            foreach ( $this->pages as $page ) {
                add_menu_page(
                    $page['title'],
                    $page['title'],
                    $page['capability'],
                    $page['menu_slug'],
                    $page['function'],
                    $page['icon_url'],
                    $page['position']
                );
            }
        }
    // add page functions here

    function subscriber_list_page() {
       
        // add template    template/subscriber-list.php

        return require_once MOXCAR_POST_PLUGIN_DIR_PATH . 'template/subscriber-list.php';
    }
}
