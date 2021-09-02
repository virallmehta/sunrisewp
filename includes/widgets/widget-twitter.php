<?php

    /*
    Plugin Name: Simple Twitter Widget
    Plugin URI: http://chipsandtv.com/
    Description: A simple but powerful widget to display updates from a Twitter feed. Configurable and reliable.
    Version: 1.03
    Author: Matthias Siegel
    Author URI: http://chipsandtv.com/


    Copyright 2011  Matthias Siegel  (email : chipsandtv@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    */

    class Twitter_Widget extends WP_Widget {

		function __construct() {
            // Widget settings
            $widget_ops = array( 'classname' => 'twitter-widget', 'description' => 'Display your latest tweets.' );

            // Create the widget
            parent::__construct( 'twitter-widget', 'Swasti Tweets', $widget_ops );
        }


        function widget( $args, $instance ) {

            extract( $args );

            global $interval;

            // User-selected settings
            $title         = apply_filters( 'widget_title', $instance['title'] );
            $username      = $instance['username'];
            $tweets        = $instance['posts'];
            $date          = $instance['date'];
            $datedisplay   = $instance['datedisplay'];
            $clickable     = $instance['clickable'];
            $hideerrors    = $instance['hideerrors'];
            $encodespecial = $instance['encodespecial'];

            // Before widget (defined by themes)
            echo $before_widget;
            // Before widget WP hook
            //echo $args['before_widget'];

            // Title of widget (before and after defined by themes)
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }


            $result = '<ul class="twitter-widget">';

            $result .= sf_latest_tweet( $tweets, $username );

            $result .= '</ul>';

            $result .= '<div class="twitter-link">Follow <a href="http://www.twitter.com/' . $username . '">@' . $username . '</a>.</div>';

            // Display everything
            echo $result;

            // After widget (defined by themes)
            echo $after_widget;
        }


        // Callback helper for the cache interval filter
        function setInterval() {

            global $interval;

            return $interval;
        }


        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            $instance['title']         = $new_instance['title'];
            $instance['username']      = $new_instance['username'];
            $instance['posts']         = $new_instance['posts'];
            $instance['date']          = $new_instance['date'];
            $instance['datedisplay']   = $new_instance['datedisplay'];
            $instance['clickable']     = $new_instance['clickable'];
            $instance['hideerrors']    = $new_instance['hideerrors'];
            $instance['encodespecial'] = $new_instance['encodespecial'];

            // Delete the cache file when options were updated so the content gets refreshed on next page load
            $upload    = wp_upload_dir();
            $cachefile = $upload['basedir'] . '/_twitter_' . $old_instance['username'] . '.txt';
            @unlink( $cachefile );

            return $instance;
        }


        function form( $instance ) {

            // Set up some default widget settings
            $defaults = array( 'title'         => 'Latest Tweets',
                               'username'      => '',
                               'posts'         => 5,
                               'interval'      => 1800,
                               'date'          => 'j F Y',
                               'datedisplay'   => true,
                               'clickable'     => true,
                               'hideerrors'    => true,
                               'encodespecial' => false
            );
            $instance = wp_parse_args( (array) $instance, $defaults );

            ?>

            <p>
                <label
                    for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', ST_DOMAIN ); ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>"
                       name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>">
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Your Twitter username:', ST_DOMAIN ); ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'username' ); ?>"
                       name="<?php echo $this->get_field_name( 'username' ); ?>"
                       value="<?php echo $instance['username']; ?>">
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Display how many tweets?', ST_DOMAIN ); ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'posts' ); ?>"
                       name="<?php echo $this->get_field_name( 'posts' ); ?>" value="<?php echo $instance['posts']; ?>">
            </p>

        <?php
        }
    }

    add_action( 'widgets_init', 'loadTwitterWidget' );

    function loadTwitterWidget() {

        register_widget( 'Twitter_Widget' );
    }


    function sf_latest_tweet( $count, $twitterID ) {

            global $sf_options;
            $enable_twitter_rts = true;

            $content = "";

            if ( $twitterID == "" ) {
                return __( "Please provide your Twitter username", ST_DOMAIN );
            }

            if ( function_exists( 'getTweets' ) ) {

                $options = array(
                    'trim_user'       => true,
                    'exclude_replies' => false,
                    'include_rts'     => $enable_twitter_rts
                );

                $tweets = getTweets( $twitterID, $count, $options );

                if ( is_array( $tweets ) ) {

                    foreach ( $tweets as $tweet ) {

                        $content .= '<li>';

                        if ( is_array( $tweet ) && $tweet['text'] ) {

                            $content .= '<div class="tweet-text">';

                            $the_tweet = apply_filters( 'sf_tweet_text', $tweet['text'] );

                            /*
                            Twitter Developer Display Requirements
                            https://dev.twitter.com/terms/display-requirements

                            2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
                              i. User_mentions must link to the mentioned user's profile.
                             ii. Hashtags must link to a twitter.com search with the hashtag as the query.
                            iii. Links in Tweet text must be displayed using the display_url
                                 field in the URL entities API response, and link to the original t.co url field.
                            */

                            // i. User_mentions must link to the mentioned user's profile.
                            if ( is_array( $tweet['entities']['user_mentions'] ) ) {
                                foreach ( $tweet['entities']['user_mentions'] as $key => $user_mention ) {
                                    $the_tweet = preg_replace(
                                        '/@' . $user_mention['screen_name'] . '/i',
                                        '<a href="http://www.twitter.com/' . $user_mention['screen_name'] . '" target="_blank">@' . $user_mention['screen_name'] . '</a>',
                                        $the_tweet );
                                }
                            }

                            // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
                            if ( is_array( $tweet['entities']['hashtags'] ) ) {
                                foreach ( $tweet['entities']['hashtags'] as $key => $hashtag ) {
                                    $the_tweet = preg_replace(
                                        '/#' . $hashtag['text'] . '/i',
                                        '<a href="https://twitter.com/search?q=%23' . $hashtag['text'] . '&amp;src=hash" target="_blank">#' . $hashtag['text'] . '</a>',
                                        $the_tweet );
                                }
                            }

                            // iii. Links in Tweet text must be displayed using the display_url
                            //      field in the URL entities API response, and link to the original t.co url field.
                            if ( is_array( $tweet['entities']['urls'] ) ) {
                                foreach ( $tweet['entities']['urls'] as $key => $link ) {

                                    $link_url = "";

                                    if ( isset( $link['expanded_url'] ) ) {
                                        $link_url = $link['expanded_url'];
                                    } else {
                                        $link_url = $link['url'];
                                    }

                                    $the_tweet = preg_replace(
                                        '`' . $link['url'] . '`',
                                        '<a href="' . $link_url . '" target="_blank">' . $link_url . '</a>',
                                        $the_tweet );
                                }
                            }

                            // Custom code to link to media
                            if ( isset( $tweet['entities']['media'] ) && is_array( $tweet['entities']['media'] ) ) {
                                foreach ( $tweet['entities']['media'] as $key => $media ) {
                                    $the_tweet = preg_replace(
                                        '`' . $media['url'] . '`',
                                        '<a href="' . $media['url'] . '" target="_blank">' . $media['url'] . '</a>',
                                        $the_tweet );
                                }
                            }

                            $content .= $the_tweet;

                            $content .= '</div>';

                            // 3. Tweet Actions
                            //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
                            //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
                            // 4. Tweet Timestamp
                            //    The Tweet timestamp must always be visible and include the time and date. e.g., "3:00 PM - 31 May 12".
                            // 5. Tweet Permalink
                            //    The Tweet timestamp must always be linked to the Tweet permalink.

                            $content .= '<div class="twitter_intents">' . "\n";
                            $content .= '<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to=' . $tweet['id_str'] . '"><i class="fa-reply"></i></a>' . "\n";
                            $content .= '<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id=' . $tweet['id_str'] . '"><i class="fa-retweet"></i></a>' . "\n";
                            $content .= '<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id=' . $tweet['id_str'] . '"><i class="fa-star"></i></a>' . "\n";

                            $date     = strtotime( $tweet['created_at'] ); // retrives the tweets date and time in Unix Epoch terms
                            $blogtime = current_time( 'U' ); // retrives the current browser client date and time in Unix Epoch terms
                            $dago     = human_time_diff( $date, $blogtime ) . ' ' . sprintf( __( 'ago', 'swiftframework' ) ); // calculates and outputs the time past in human readable format
                            $content .= '<a class="timestamp" href="https://twitter.com/' . $twitterID . '/status/' . $tweet['id_str'] . '" target="_blank">' . $dago . '</a>' . "\n";
                            $content .= '</div>' . "\n";
                        } else {
                            $content .= '<a href="http://twitter.com/' . $twitterID . '" target="_blank">@' . $twitterID . '</a>';
                        }
                        $content .= '</li>';
                    }
                }

                return $content;
            } else {
                return '<li><div class="tweet-text">Please install the oAuth Twitter Feed Plugin and follow the theme documentation to set it up.</div></li>';
            }
        }
?>