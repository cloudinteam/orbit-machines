<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Autrics_Call_To_Action_Widget extends Widget_Base {


  public $base;

    public function get_name() {
        return 'autrics-call-to-action';
    }

    public function get_title() {

        return esc_html__( 'Call to action', 'autrics' );

    }

    public function get_icon() { 
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'autrics-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Title settings', 'autrics'),
            ]
        );

        $this->add_control(
         'action_media',
         [
             'label' => esc_html__('Action Thumbnail', 'autrics'),
             'type' => Controls_Manager::MEDIA,
             'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],         
         ]
      );

        $this->add_control(
            'action_url',
            [
                'label' => esc_html__('Link', 'autrics'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ],
            ]
        );
        
        $this->add_control(
            'action_url_text',
            [
                'label'   => esc_html__('Link', 'autrics'),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        
        
        
        $this->end_controls_section();
    }

    protected function render( ) { 
        $settings = $this->get_settings();
    ?>
      <div class="item">
            <div class="ts-post-thumb">
               <img class="img-fluid" src="<?php echo esc_url($settings['action_media']['url']); ?>" alt="<?php  
              echo esc_attr($settings['action_url_text']); ?>">
               <a href="<?php echo esc_url($settings['action_url']['url']); ?>" class="view-link-btn">
                  <span><?php echo esc_html($settings['action_url_text']); ?></span>
               </a>

            </div>
      </div>

    <?php  
    }
    protected function content_template() { }
}