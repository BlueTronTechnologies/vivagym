<?php
/**
 * Class WPCF7R_Action_api_url_request file.
 *
 * @package cf7r
 */

 if ( ! defined( 'ABSPATH' ) ) {
 	exit;
 }

 register_wpcf7r_actions(
     'api_url_request',
     __('API POST/GET Request' , 'wpcf7r-redirect'),
     'WPCF7R_Action_api_url_request'
 );
 /**
 * Class WPCF7R_Action_api_url_request
 * A Class that handles send send to api process
 *
 * @version  1.0.0
 */

class WPCF7R_Action_api_url_request extends WPCF7R_Action{

    public function __construct($post){
        parent::__construct($post);

        $this->api_base = new WPCF7R_Action_send_to_api($post);
    }
    /**
     * Get the fields relevant for this action
     * @return [type] [description]
     */
    public function get_action_fields(){
        return array_merge( array(
                array(
                    'name' => 'base_url',
                    'type' => 'text',
                    'label' => __( 'Base API Url', 'wpcf7-redirect' ),
                    'sub_title' => '',
                    'placeholder' => '',
                    'show_selector' => '.field-wrap-external_url,.field-wrap-page_id',
                    'value' => $this->get('base_url'),
                ),
                array(
                    'name' => 'input_type',
                    'type' => 'select',
                    'label' => __( 'Api Input type', 'wpcf7-redirect' ),
                    'sub_title' => '',
                    'placeholder' => '',
                    'show_selector' => '',
                    'value' => $this->get('input_type'),
                    'options' => array(
                        'post' => __('POST', 'wpcf7-redirect'),
                        'get' => __('GET', 'wpcf7-redirect'),
						'put' => __('PUT', 'wpcf7-redirect'),
						'patch' => __('PATCH', 'wpcf7-redirect'),
						'delete' => __('DELETE', 'wpcf7-redirect')
                    ),
                ),
                array(
                    'name' => 'tags_map_mapping_section',
                    'type' => 'section',
                    'title' => __( 'Tags mapping', 'wpcf7-redirect' ),
                    'fields' => array(
                        array(
                            'name' => 'tags_map',
                            'type' => 'tags_map',
                            'label' => '',
                            'sub_title' => '',
                            'placeholder' => '',
                            'show_selector' => '',
                            'value' => maybe_unserialize( $this->get('tags_map') ),
                            'tags_functions' => maybe_unserialize( $this->get('tags_functions') ),
                            'tags_defaults' => maybe_unserialize( $this->get('tags_defaults') ),
                            'tags' => WPCF7R_Form::get_mail_tags()
                        ),
                    )
                ),
                array(
                    'name' => 'api_headers_section',
                    'type' => 'section',
                    'title' => __( 'Headers(Optional)', 'wpcf7-redirect' ),
                    'fields' => array(
                        array(
                            'name' => 'api_headers',
                            'type' => 'repeater',
                            'label' => '',
                            'sub_title' => __( 'Use this to send custom headers.', 'wpcf7-redirect' ),
                            'placeholder' => '',
                            'show_selector' => '',
                            'value'  => maybe_unserialize( $this->get('api_headers') ),
                            'fields' => array(
                                array(
                                    'name' => 'header_key',
                                    'type' => 'text',
                                    'label' => __( 'Header Key', 'wpcf7-redirect' ),
                                    'sub_title' => '',
                                    'placeholder' => '',
                                    'show_selector' => '',
                                    'class' => '',
                                    'value' => '',
                                ),
                                array(
                                    'name' => 'header_value',
                                    'type' => 'text',
                                    'label' => __( 'Header value', 'wpcf7-redirect' ),
                                    'sub_title' => '',
                                    'placeholder' => '',
                                    'show_selector' => '',
                                    'class' => '',
                                    'value' => '',
                                ),
                            )
                        ),
                    )
                ),
                array(
                    'name' => 'test_section',
                    'type' => 'section',
                    'title' => __( 'Test', 'wpcf7-redirect' ),
                    'sub_title' => __( '<span class="dashicons dashicons-warning"></span> Before testing dont forget to save your changes', 'wpcf7-redirect' ),
                    'fields' => array(
                        array(
                            'name' => 'test_tags_map',
                            'type' => 'tags_map',
                            'label' => '',
                            'sub_title' => '',
                            'placeholder' => '',
                            'show_selector' => '',
                            'value' => maybe_unserialize( $this->get('tags_map') ),
                            'tags_functions' => maybe_unserialize( $this->get('tags_functions') ),
                            'tags_defaults' => maybe_unserialize( $this->get('tags_defaults') ),
                            'defaults_name' => 'test_values',
                            'tags' => WPCF7R_Form::get_mail_tags()
                        ),
                        array(
                            'name' => 'test_button',
                            'type' => 'button',
                            'label' => __( 'Test', 'wpcf7-redirect' ),
                            'placeholder' => '',
                            'show_selector' => '.field-wrap-api_debug_url',
                            'value' => '',
                            'class' => '',
                            'attr' => array(
                                'data-ruleid' => $this->get_rule_id(),
                                'data-action_id' => $this->get_id(),
                                'data-cf7_id' => $this->get_action_wpcf7_id(),
                            )
                        ),
                    )
                ),
                array(
                    'name' => 'use_result',
                    'type' => 'checkbox',
                    'label' => __( 'Use api result', 'wpcf7-redirect' ),
                    'sub_title' => '',
                    'placeholder' => '',
                    'show_selector' => '.field-wrap-result_javascript',
                    'value' => $this->get('use_result'),
                    'class' => ''
                ),
                array(
                    'name' => 'result_javascript',
                    'type' => 'textarea',
                    'label' => __( 'Api reult', 'wpcf7-redirect' ),
                    'sub_title' => 'Write your javascript here you can use "response" (JSON) variable and type your script',
                    'placeholder' => 'console.log(response);',
                    'value' => $this->get('result_javascript'),
                    'class' => $this->get('use_result') ? '' : 'field-hidden'
                ),
                array(
                    'name' => 'show_debug',
                    'type' => 'checkbox',
                    'label' => __( 'Show debug log', 'wpcf7-redirect' ),
                    'sub_title' => '',
                    'placeholder' => '',
                    'show_selector' => '.field-wrap-api_debug_url',
                    'value' => '',
                    'class' => ''
                ),
                array(
                    'name' => 'api_debug_url',
                    'type' => 'debug_log',
                    'class' => 'field-hidden',
                    'label' => __( 'Debug log', 'wpcf7-redirect' ),
                    'sub_title' => '',
                    'placeholder' => '',
                    'show_selector' => '',
                    'fields' => array(
                        __('Debug Url', 'wpcf7-redirect' ) => $this->get('api_debug_url'),
                        __('Sent Parameters', 'wpcf7-redirect' ) => $this->get('api_debug_params'),
                        __('Api Results', 'wpcf7-redirect' ) => $this->get('api_debug_result'),
                    )
                ),

            ),
            parent::get_default_fields()
        );

    }

    /**
     * Get settings page
     * @return [type] [description]
     */
    public function get_action_settings(){
        $this->get_settings_template('html-action-send-to-email.php');
    }

    /**
     * Handle a simple redirect rule
     * @param  [type] $rules    [description]
     * @param  [type] $response [description]
     * @return [type]           [description]
     */
    public function process( $submission ){

        $posted_data = $submission->get_posted_data();

        $headers = maybe_unserialize( $this->get('api_headers') );

        $key_value_headers = array();

        if( $headers ){
            foreach( $headers as $header ){
                $key_value_headers[$header['header_key']] = $header['header_value'];
            }
        }

        $args = array(
            'base_url' => $this->get('base_url'),
            'headers' => maybe_unserialize( $this->get('api_headers') ),
            'record_type' => 'params',
            'input_type' => $this->get('input_type'),
            'tags' => maybe_unserialize( $this->get('tags_map') ),
            'sumibssion' => $submission,
            'request_template' => $this->get('request_template'),
            'api_headers' => $key_value_headers,
            'tags_functions' => maybe_unserialize( $this->get('tags_functions') ),
            'tags_defaults' => maybe_unserialize( $this->get('tags_defaults') ),
        );

        $args = apply_filters('process_api_xml_json' , $args );

        $api_result = $this->api_base->qs_cf7_send_data_to_api($args);

        if( ! is_wp_error($api_result[0]) ){
            unset($api_result[0]['headers']);
            if( ! $this->get('use_result') ){
                unset($api_result['body']);
            }else{
                $api_result = array(
                    'api_response' => $api_result[0]['body'],
                    'result_javascript' => $this->get('result_javascript'),
                    'request' => $posted_data
                );
            }
        }

        return $api_result;
    }

}
