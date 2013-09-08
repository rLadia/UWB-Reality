<?php

add_action( 'init', 'the_reality_theme_setup', 9999 );
function the_reality_theme_setup()
{
  // First we check to see if our default theme settings have been applied.
  $the_theme_status = get_option( 'reality_theme_setup_status' );
  // If the theme has not yet been used we want to run our default settings.
  if ( $the_theme_status !== '1' ) {
    // Setup Default WordPress settings

    $bp_active_components = array( 
      'xprofile'  => true,
      'settings'  => true,
      'friends'   => true,
      'messages'  => true,
      'activity'  => true, 
      'blogs'     => true,
      'members'   => true );

    $default_audience_awards = array(
      'funny'       =>  'Funny',
      'suspenseful' =>  'Suspenseful',
      'romantic'    =>  'Romantic',
      'masterpiece' =>  'Masterpiece',
      'techy'       =>  'Techy',
      'crazy'       =>  'Crazy'
    );
    $default_point_values = array(
      'activity_update'   =>  array( 'name' => 'Post Update', 'value' => 5 ),
      'activity_comment'  =>  array( 'name' => 'Post Comment', 'value' => 10 ),
      'reality_rate_deal' =>  array( 'name' => 'Rate Deal', 'value' => 15 ),
      'photo_blog_update' =>  array( 'name' => 'Photo Blog Update', 'value' => 10 ),
      'reality_card_comment'  =>  array( 'name' => 'Reality Card Comment', 'value' => 10 )
    );
    $default_rank_values = array(
      0     =>  array( 'rank_name' => 'Rebel', 'rank_slug' => 'rebel' ),
      30    =>  array( 'rank_name' => 'Iconoclast', 'rank_slug' => 'iconoclast' ),
      100   =>  array( 'rank_name' => 'Instigator', 'rank_slug' => 'instigator' ),
      200   =>  array( 'rank_name' => 'Revolutionary', 'rank_slug' => 'revolutionary' ),
      300   =>  array( 'rank_name' => 'Ring Leader', 'rank_slug' => 'ring-leader' ),
      500   =>  array( 'rank_name' => 'Visionary', 'rank_slug' => 'visionary' ),
      1000  =>  array( 'rank_name' => 'Mastermind', 'rank_slug' => 'mastermind' ),
      2000  =>  array( 'rank_name' => 'Badass', 'rank_slug' => 'badass' ),
      5000  =>  array( 'rank_name' => 'Legend', 'rank_slug' => 'legend' ),
      10000 =>  array( 'rank_name' => 'Assistant to the Producer', 'rank_slug' => 'assistant-to-the-producer' ),
      50000 =>  array( 'rank_name' => 'Unicorn', 'rank_slug' => 'unicorn' )
    );
    $default_fourohfour = '<h1>Could not find this page!</h1>';

    $bp_pages = get_option( 'bp-pages' );
    $front_page = $bp_pages['activity'];

    $core_settings = array(
      'posts_per_page'              =>  9,
      //'permalink_structure'       =>  '/%postname%/',
      'default_role'                =>  'player',
      'show_on_front'               =>  'page',
      'page_on_front'               =>  $front_page,
      //'bp-active-components'      =>  $bp_active_components,
      'bp-disable-account-deletion'     =>  1,
      'hide-loggedout-adminbar'         =>  1,
      'reality_audience_award_options'  =>  $default_audience_awards,
      'reality_404_content'             =>  $default_fourohfour,
      'reality_activity_point_values'   =>  $default_point_values,
      'reality_rank_values'             =>  $default_rank_values,
      'reality_submit_form_author_autosuggest'  =>  2,
      'reality_submit_form_card_autosuggest'    =>  3,
      'reality_game_installed_date'             =>  time(),
      'reality_weekly_leaderboard_reset'        =>  'Monday',
      'reality_card_navigation'                 =>  0
    );
    foreach ( $core_settings as $k => $v ) {
      update_option( $k, $v );
    }

    // Delete dummy post, page and comment.
    wp_delete_post( 1, true );
    wp_delete_post( 2, true );
    wp_delete_comment( 1 );

    // Setup Reality Pages

    $default_pages = array(
      'cardlookup'    =>  array(
        'post_name'     =>  'cardlookup',
        'post_title'    =>  'Card Lookup',
        'post_status'   =>  'publish',
        'post_type'     =>  'page',
        'meta'          =>  array(
          '_wp_page_template'  => 'archive-reality_cards.php',
        ),
      ),
      'deals'         =>  array(
        'post_name'     =>  'deals',
        'post_title'    =>  'Deal Archive',
        'post_status'   =>  'publish',
        'post_type'     =>  'page',
        'meta'          =>  array(
          '_wp_page_template'  => 'archive-reality_deals.php',
        ),
      ),
      'leaderboard'   =>  array(
        'post_content'  =>  '<h2>Weekly Leaderboard</h2>[reality_leaderboard type="weekly"]<h2>TOTAL POINTS</h2>[reality_leaderboard]<h2>BIGGEST DEALS</h2>[reality_leaderboard type="biggest_deals"]<h2>MOST DEALS MADE</h2>[reality_leaderboard type="most_deals"]',
        'post_name'     =>  'leaderboard',
        'post_title'    =>  'Leaderboard',
        'post_status'   =>  'publish',
        'post_type'     =>  'page'
      ),
      'about'         =>  array(
        'post_content'  =>  '<h1><b>Welcome to the games</b></h1>
<h2>What do I do?</h2>
The games are about making—making partnerships, making media, and making deals. By making deals you earn points and prestige, and earn the favor of the Director. It never hurts when the Director likes you.

&nbsp;
<h2>How do I do that?</h2>
Start with a green card- that tells you what you’re making. This could be anything from a 30 second short to a facebook group to a card game. Next, you need to connect your card, using its arrows, to any other card. Once you have a connection, you have a deal. Maybe you’re making a manual involving nuclear war. Maybe you’re making a card game that includes a bicycle— if you can connect it, make it.  But don’t stop there- keep connecting. Make a card game involving nuclear war AND a bicycle—as long as you can connect cards with their arrows, you can make your deal bigger, better, and worth more points.

&nbsp;
<h2>How big can a deal be?</h2>
As big as you can make it. Surprise us.

&nbsp;
<h2>Can I work with other people?</h2>
Absolutely. If two people work on a deal, two people get the points. If ten people work on a deal, ten people get the points. There is no split— you all get all of them. More people, more cards, more points for everyone. Get your friends involved, and work together to win it all.

&nbsp;
<h2>What do I get?</h2>
Points, prestige, and fabulous prizes. A happy director is a generous director. There will be a winner every week.

&nbsp;
<h2>Where do I ask questions?</h2>
Office hours are from 12:00pm-5:00pm, Monday/Tuesday/Thursday.

&nbsp;
<h2>What else is there to do?</h2>
You never know. Keep watching, look for the eye, and carry your cards with you at all times. We always have more secrets in store, and you never know when or where the games will find you.

&nbsp;
<h2>Who are you? Who is the director? What do you people want?</h2>
<p style="text-align: center;"><img class=" wp-image-594 aligncenter" alt="Reality-Logo-White-fill" src="http://games.illuminatiuwb.com/wp-content/uploads/cache/2013/08/Reality-Logo-White-fill/1132444017.png" width="108" height="62" /></p>',
        'post_name'     =>  'about',
        'post_title'    =>  'About',
        'post_status'   =>  'publish',
        'post_type'     =>  'page',
      ),
      'submit'        =>  array(
        'post_content'  =>  '<p style="text-align: center;">If there are additional materials that you feel you need to submit, mention them in the "Notes" before submitting your Deal.
        Some types of challenges will require you to submit a .zip archive. Creating a .zip is super easy. Click for tips on doing it on a <a title="Zip for MAC" href="http://docs.info.apple.com/article.html?path=Mac/10.6/en/8726.html" target="_blank">Mac</a> or a <a title="Zip for Windows" href="http://windows.microsoft.com/en-US/windows-vista/Compress-and-uncompress-files-zip-files" target="_blank">PC</a>.
        If you want to make changes to a submission after you have submitted it, please resubmit: we will use the most recent version.</p>',
        'post_name'     =>  'submit',
        'post_title'    =>  'Submit a Deal',
        'post_status'   =>  'private',
        'post_type'     =>  'page',
        'meta'          =>  array(
          '_wp_page_template'       =>  'submission_form.php',
          'REALITY_success_message' =>  "<h2>Congratulations, you've successfully submitted a deal... almost. Come into the office and show us the proof.</h2>"
        )
      ),
      'login'         =>  array(
        'post_name'     =>  'login',
        'post_title'    =>  'Login',
        'post_status'   =>  'publish',
        'post_type'     =>  'page',
        'meta'          =>  array(
          '_wp_page_template' =>  'reality_login.php'
        )
      )
    );

    $post_id = array();

    foreach( $default_pages as $key => $page ) {

      if ( $id = wp_insert_post( $page ) ) {

        $post_id[ $key ] = $id;

        if ( !empty( $page['meta'] ) ) {

          foreach( $page['meta'] as $meta_key => $meta_value ) {

            update_post_meta( $id, $meta_key, $meta_value );

          }
        }
      }
    }

    // Setup Card Type Categories

    $default_card_types = array(
      'Maker'   =>  array(
        'slug'  =>  'maker'
      ),
      'Property'=>  array(
        'slug'  =>  'property'
      ),
      'Player'  =>  array(
        'slug'  =>  'player'
      ),
      'Special' =>  array(
        'slug'  =>  'special'
      ),
      'Utility' =>  array(
        'slug'  =>  'utility'
      )
    );

    foreach( $default_card_types as $term => $args ) {

      wp_insert_term( $term, 'card-type', $args );

    }

    // Setup Card Connections

    $default_card_connections = array(
      '0 Out'      => array(
        'slug'  =>  'zero_out'
      ),
      '1 Out Bottom'  =>  array(
        'slug'  =>  'one_out_bottom'
      ),
      '1 Out Bottom Special'  =>  array(
        'slug'  =>  'one_out_bottom_special'
      ),
      '1 Out Left'  =>  array(
        'slug'  =>  'one_out_left'
      ),
      '1 Out Right' =>  array(
        'slug'  =>  'one_out_right'
      ),
      '2 Out Left'  =>  array(
        'slug'  =>  'two_out_left'
      ),
      '2 Out Left Special'  =>  array(
        'slug'  =>  'two_out_left_special'
      ),
      '2 Out Right' =>  array(
        'slug'  =>  'two_out_right'
      ),
      '2 Out Right Special' =>  array(
        'slug'  =>  'two_out_right_special'
      ),
      '3 Out'       =>  array(
        'slug'  =>  'three_out'
      ),
      '3 Out Special' =>  array(
        'slug'  =>  'three_out_special'
      ),
      'Wildcard'    =>  array(
        'slug'  =>  'wildcard'
      )
    );

    foreach( $default_card_connections as $term => $args ) {

      wp_insert_term( $term, 'card-connections', $args );

    }

    // Setup Top Level Award Categories

    $default_awards = array(
      'Deal Awards',
      'Player Achievements',
      'Point Achievements'
    );

    foreach( $default_awards as $award ) {

      wp_insert_term( $award, 'awards-tax' );

    }

    // Prepopulate Card Values

    $default_values = array(
      '10 15 25'  =>  array(
        'description' => '10,15,25'
      ),
      '10 20 25'  =>  array(
        'description' =>  '10,20,25'
      ),
      '15 20 30'  =>  array(
        'description' =>  '15,20,30'
      ),
      '20 25 35'  =>  array(
        'description' =>  '20,25,35'
      ),
      '25 30 40'  =>  array(
        'description' =>  '25,30,40'
      ),
      '25'        =>  array(
        'description' =>  '25'
      ),
      '5 10 15'   =>  array(
        'description' =>  '5,10,15'
      ),
      '5 10 20'   =>  array(
        'description' =>  '5,10,20'
      )
    );

    foreach( $default_values as $term => $args ) {

      wp_insert_term( $term, 'card-value', $args );

    }

    // Setup Authors Taxonomy for all existing users

    $users_count = count_users();

    if ( isset($users_count['avail_roles']) ) {
      foreach( $users_count['avail_roles'] as $role => $count ) {
        $args = array( 'role' => $role );
        $users = new WP_User_Query( $args );

        if ( !empty( $users->results ) ) {
          foreach( $users->results as $user ) {

            $additional_user_info = array(
              'nicename'  =>  $user->user_nicename
            );

            $author_args = array(
              'slug'  =>  $user->ID,
              'description' =>  serialize( $additional_user_info )
            );

            wp_insert_term( $user->display_name, 'authors-tax', $author_args );

            update_user_meta( $user->ID, 'reality_current_points', '0' );
            $current_points = 0;

            $ranks = get_option( 'reality_rank_values' );
            if ( !isset( $ranks[0] ) ) {
              $ranks[0]['rank_name'] = 'Unranked';
              $ranks[0]['rank_slug'] = 'unranked';
            }

            foreach( $ranks as $key => $rank ) {

              if ( $current_points < $key ) {
                $current_rank = $ranks[$previous]['rank_name'];
                $current_rank_slug = $ranks[$previous]['rank_slug'];
                $points_spread = $key - $previous;
                $points_to_next_level = $key - $current_points;
                $percent_to_next_level = (float) (1 - ($points_to_next_level / $points_spread))*100;
                $points_towards_next_level = $points_spread - $points_to_next_level;
                break;
              }

              $previous = $key;
            }

            $rank_info = array(
              'current_rank'      =>  $current_rank,
              'current_rank_slug'   =>  $current_rank_slug,
              'points_to_next_level'  =>  $points_to_next_level,
              'points_spread'     =>  $points_spread,
              'percent_to_next_level' =>  $percent_to_next_level,
              'points_towards_next_level' =>  $points_towards_next_level
            );

            update_user_meta( $user->ID, 'reality_current_rank', $rank_info );

          }
        }

      }
    }

    // Setup Default Menus
    // Post Type = 'nav_menu_item' -> ordered by menu_order
    // Organized in Taxonomy named 'nav_menu'
    // @uses wp_update_nav_menu_object( $menu_id = 0, $menu_data = array() )
    // @uses wp_update_nav_menu_item( $menu_id = 0, $menu_item_db_id = 0, $menu_item_data = array() )

    $default_menus = array(
      'Footer Menu'   =>  array(
        'menu-items'  =>  array(
          'about'     =>  array(
            'menu-item-type'      =>  'post_type',
            'menu-item-title'     =>  'About',
            'menu-item-object'    =>  'page',
            'menu-item-object-id' =>  $post_id['about'],
            'menu-item-status'    =>  'publish'
          )
        ),
        'location'  =>  'footer_menu'
      ),
      'Logged Out Menu' =>  array(
        'menu-items'    =>  array(
          'feed'        =>  array(
            'menu-item-type'      =>  'disabled',
            'menu-item-title'     =>  'Feed',
            'menu-item-status'    =>  'publish'
          ), 
          'members'     =>  array(
            'menu-item-type'      =>  'disabled',
            'menu-item-title'     =>  'Members',
            'menu-item-status'    =>  'publish'
          ),
          'cardlookup'  =>  array(
            'menu-item-type'      =>  'disabled',
            'menu-item-title'     =>  'Card Lookup',
            'menu-item-status'    =>  'publish'
          ),
          'deals'       =>  array(
            'menu-item-type'      =>  'disabled',
            'menu-item-title'     =>  'Deal Archive',
            'menu-item-status'    =>  'publish'
          ),
          'leaderboard' =>  array(
            'menu-item-type'      =>  'disabled',
            'menu-item-title'     =>  'Leaderboard',
            'menu-item-status'    =>  'publish'
          ),
          'about'       =>  array(
            'menu-item-type'      =>  'post_type',
            'menu-item-title'     =>  'About',
            'menu-item-object'    =>  'page',
            'menu-item-object-id' =>  $post_id['about'],
            'menu-item-status'    =>  'publish'
          ),
          'submit'      =>  array(
            'menu-item-type'      =>  'disabled',
            'menu-item-title'     =>  'Submit',
            'menu-item-status'    =>  'publish'
          ),
          'login'       =>  array(
            'menu-item-type'      =>  'custom',
            'menu-item-title'     =>  'Login',
            'menu-item-url'       =>  site_url( 'login' ),
            'menu-item-status'    =>  'publish'
          ),
        ),
        'location'  =>  'logged_out_menu' 
      ),    
      'Main Menu'       =>  array(
        'menu-items'    =>  array(
          'feed'        =>  array(
            'menu-item-type'      =>  'post_type',
            'menu-item-title'     =>  'Feed',
            'menu-item-object'    =>  'page',
            'menu-item-object-id' =>  $bp_pages['activity'],
            'menu-item-status'    =>  'publish'
          ),                        
          'members'     =>  array(
            'menu-item-type'      =>  'post_type',
            'menu-item-title'     =>  'Members',
            'menu-item-object'    =>  'page',
            'menu-item-object-id' =>  $bp_pages['members'],
            'menu-item-status'    =>  'publish'
          ),
          'cardlookup'  =>  array(
            'menu-item-type'      =>  'post_type',
            'menu-item-title'     =>  'Card Lookup',
            'menu-item-object'    =>  'page',
            'menu-item-object-id' =>  $post_id['cardlookup'],
            'menu-item-status'    =>  'publish'
          ),
          'deals'       =>  array(
            'menu-item-type'      =>  'post_type',
            'menu-item-title'     =>  'Deal Archive',
            'menu-item-object'    =>  'page',
            'menu-item-object-id' =>  $post_id['deals'],
            'menu-item-status'    =>  'publish'
          ),
          'leaderboard' =>  array(
            'menu-item-type'      =>  'post_type',
            'menu-item-title'     =>  'Leaderboard',
            'menu-item-object'    =>  'page',
            'menu-item-object-id' =>  $post_id['leaderboard'],
            'menu-item-status'    =>  'publish'
          ),
          'about'       =>  array(
            'menu-item-type'      =>  'post_type',
            'menu-item-title'     =>  'About',
            'menu-item-object'    =>  'page',
            'menu-item-object-id' =>  $post_id['about'],
            'menu-item-status'    =>  'publish'
          ),
          'submit'      =>  array(
            'menu-item-type'      =>  'post_type',
            'menu-item-title'     =>  'Submit',
            'menu-item-object'    =>  'page',
            'menu-item-object-id' =>  $post_id['submit'],
            'menu-item-status'    =>  'publish'
          ),
        ),
        'location'  =>  'primary'
      )
    );

    $menu_locations = array();

    foreach( $default_menus as $menu_name => $menu_args ) {
      $menu_data = array(
        'menu-name' =>  $menu_name
      );
      if ( $menu_id = wp_update_nav_menu_object( 0, $menu_data ) ) {

        foreach( $menu_args['menu-items'] as $menu_item ) {

          wp_update_nav_menu_item( $menu_id, 0, $menu_item );

        }

        $menu_locations[ $menu_args['location'] ] = $menu_id;

      }

    }

    if ( isset( $menu_locations ) ) {
      set_theme_mod( 'nav_menu_locations', array_map( 'absint', $menu_locations ) );
    }

    // Once done, we register our setting to make sure we don't duplicate everytime we activate.
    update_option( 'reality_theme_setup_status', '1' );

    // Lets let the admin know whats going on.
    $msg = '
      <div class="error">
      <p>The ' . get_option( 'current_theme' ) . 'theme has changed your WordPress default <a href="' . admin_url( 'options-general.php' ) . '" title="See Settings">settings</a> and deleted default posts & comments.</p>
      </div>';
    add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
  }
  // Else if we are re-activing the theme
  elseif ( $the_theme_status === '1' and isset( $_GET['activated'] ) ) {
    $msg = '
      <div class="updated">
      <p>The ' . get_option( 'current_theme' ) . ' theme was successfully re-activated.</p>
      </div>';
    add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
  }
}


?>
