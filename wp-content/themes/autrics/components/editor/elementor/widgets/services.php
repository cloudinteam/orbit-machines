<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Autrics_Services_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'autrics-service';
    }

    public function get_title() {
        return esc_html__( 'Autrics Services', 'autrics' );
    }

    public function get_icon() { 
        return 'eicon-tools';
    }

    public function get_categories() {
        return [ 'autrics-elements' ];
    }

    protected function register_controls() {
		$this->start_controls_section(
			'section_tab', [
				'label' =>esc_html__( 'Autrics Services', 'autrics' ),
			]
        );

        $this->add_control(
			'service_style',
			[
				'label' => esc_html__( 'Service Style', 'autrics' ),
				'type' => Custom_Controls_Manager::IMAGECHOOSE,
				'default' => 'style1',
				'options' => [
                    'style1' => [
                        'title'      => esc_html__( ' Style 1 ', 'autrics' ),
                        'imagelarge' => AUTRICS_IMG. '/style/service/style1.PNG',
                        'imagesmall' => AUTRICS_IMG. '/style/service/style1.PNG',
                        'width' => '30%',
                    ],
                    'style2' => [
                        'title'      => esc_html__( ' Style 2', 'autrics' ),
                        'imagelarge' => AUTRICS_IMG. '/style/service/style2.PNG',
                        'imagesmall' => AUTRICS_IMG. '/style/service/style2.PNG',
                        'width'      => '30%',
                    ],  				
            
                    'style3' => [
                        'title'      => esc_html__( ' Style 3', 'autrics' ),
                        'imagelarge' => AUTRICS_IMG. '/style/service/style1.PNG',
                        'imagesmall' => AUTRICS_IMG. '/style/service/style1.PNG',
                        'width'      => '30%',
                    ],
                    'style4' => [
                        'title'      => esc_html__( ' Style 4', 'autrics' ),
                        'imagelarge' => AUTRICS_IMG. '/style/service/service-classic.PNG',
                        'imagesmall' => AUTRICS_IMG. '/style/service/service-classic.PNG',
                        'width'      => '30%',
                    ],
				],
			]
        );

 
        $this->add_control(
			'service_category',
			[
				'label'     => esc_html__( 'Category', 'autrics' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'all',
                'options'   => $this->getCategories(),
                'condition' =>["service_style"=>["style1","style2"] ],
			]
        );

        $this->add_control(
			'service_single',
			[
				'label'      => esc_html__( 'Single Service', 'autrics' ),
				'type'       => \Elementor\Controls_Manager::SELECT,
				'options'    =>   $this->getServices(),
                'condition'  =>["service_style"=>["style3","style4"] ],
			]
        );
   
      $this->add_control('post_count',
            [
               'label'         => esc_html__( 'Service count', 'autrics' ),
               'type'          => Controls_Manager::NUMBER,
               'default'       => '3',
               'condition'     =>["service_style"=>["style1","style2"] ],
            ]
        );
    
      $this->add_control('post_title_crop',
            [
                'label'         => esc_html__( 'Title limit', 'autrics' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '3',
            ]
       ); 
       
      $this->add_control('show_desc',
            [
               'label'      => esc_html__('Show desc', 'autrics'),
               'type'       => Controls_Manager::SWITCHER,
               'label_on'   => esc_html__('Yes', 'autrics'),
               'label_off'  => esc_html__('No', 'autrics'),
               'default'    => 'yes',
            ]
         ); 
         $this->add_control(
          'post_order',
          [
              'label'     =>esc_html__( 'Post order', 'autrics' ),
              'type'      => Controls_Manager::SELECT,
              'default'   => 'DESC',
              'options'   => [
                    'DESC'      =>esc_html__( 'Descending', 'autrics' ),
                    'ASC'       =>esc_html__( 'Ascending', 'autrics' ),
                ],
          ]
      );   
      $this->add_control('desc_limit',
            [
              'label'         => esc_html__( 'Description limit', 'autrics' ),
              'type'          => Controls_Manager::NUMBER,
              'default'       => '10',
              'condition'     => [ 'show_desc' => ['yes'] ],
            ]
          );   
    
      $this->add_control('show_icon',
            [
                'label'     => esc_html__('Show Icon', 'autrics'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__('Yes', 'autrics'),
                'label_off' => esc_html__('No', 'autrics'),
                'default'   => 'yes',
                'condition' => ["service_style"=>["style1","style3"] ],
            ]
        ); 
    

      $this->add_control('show_readmore',
            [
               'label'     => esc_html__('Show Readmore', 'autrics'),
               'type'      => Controls_Manager::SWITCHER,
               'label_on'  => esc_html__('Yes', 'autrics'),
               'label_off' => esc_html__('No', 'autrics'),
               'default'   => 'yes',
               'condition' => ["service_style"=>["style1","style3","style4"] ],
      
            ]
        );  
        
        $this->add_control(
          'service_button_icon',
          [
            'label' => esc_html__( 'Service Icon', 'autrics' ),
            'type' => Controls_Manager::ICONS,
            'default' => [
              'value' => 'fas fa-arrow-right',
            ]
          ]
        );

       $this->add_control('show_navigation',
            [
            'label'     => esc_html__('Show Navigation', 'autrics'),
            'type'      => Controls_Manager::SWITCHER,
            'label_on'  => esc_html__('Yes', 'autrics'),
            'label_off' => esc_html__('No', 'autrics'),
            'default'   => 'yes',
            'condition' => ["service_style"=>"style1"],
   
            ]
        );  

      $this->end_controls_section();

      // Title And Description
      
      $this->start_controls_section('style_section',
			[
				'label' => esc_html__( 'Title, Description and Button', 'autrics' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		  );

      $this->add_group_control(Group_Control_Typography::get_type(), 
            [
                'name'		 => 'autrics_service_title_typography',
                'label'     => esc_html__('Title Typography', 'autrics'),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ts-service-title',
            ]
      );

      $this->add_group_control(Group_Control_Typography::get_type(), 
      [
        'name'		 => 'autrics_service_post_typography',
        'label'     => esc_html__('Description Typography', 'autrics'),

        'selectors'	 => [
              '{{WRAPPER}} .ts-service-wrapper .service-content',
              '{{WRAPPER}} .ts-feature-wrapper .feature-content',
          
            ]
        ]
      );

        $this->start_controls_tabs(
          'description_style_tabs'
        );

        $this->start_controls_tab(
          'title_and_description_style_normal_tab',
          [
            'label' => esc_html__( 'Normal', 'autrics' ),
          ]
        );

        $this->add_control('post_text_color',
            [
                'label'    => esc_html__('Title color', 'autrics'),
                'type'     => Controls_Manager::COLOR,
                'selectors'   => [

                    '{{WRAPPER}} .post .entry-title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ts-service-wrapper .service-content h3 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control('description_text_color',
            [
                'label'    => esc_html__('Description Color', 'autrics'),
                'type'     => Controls_Manager::COLOR,
                'selectors'   => [
                    '{{WRAPPER}} .ts-service-wrapper .service-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control('read_more_color',
            [
                'label'    => esc_html__('Read More Color', 'autrics'),
                'type'     => Controls_Manager::COLOR,
                'selectors'   => [
                    '{{WRAPPER}} .service-content .readmore' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .service-content .readmore i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
          'title_and_description_style_hover_tab',
          [
            'label' => esc_html__( 'Hover', 'autrics' ),
          ]
        );

        $this->add_control('post_text_color_hover',
            [
                'label'     => esc_html__('Title Color', 'autrics'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .post .entry-title a:hover' => 'color: {{VALUE}};',
                '{{WRAPPER}} .ts-service-wrapper:hover .service-content h3 a' => 'color: {{VALUE}};',
            
                ],
            ]
        );

        $this->add_control('description_text_hover_color',
            [
                'label'    => esc_html__('Description Color', 'autrics'),
                'type'     => Controls_Manager::COLOR,
                'selectors'   => [
                    '{{WRAPPER}} .ts-service-wrapper:hover .service-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control('read_more_color_hover',
            [
                'label'    => esc_html__('Read More Hover Color', 'autrics'),
                'type'     => Controls_Manager::COLOR,
                'selectors'   => [
                    '{{WRAPPER}} .ts-service-wrapper:hover .service-content .readmore' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ts-service-wrapper:hover .service-content .readmore i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
      
      $this->end_controls_section();  

      // Service Content Wrapper 

      $this->start_controls_section('content_wrapper',
			[
				'label' => esc_html__( 'Content Wrapper', 'autrics' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		  );

      $this->add_responsive_control(
        'content_wrapper_padding',
        [
          'label' => esc_html__( 'Padding', 'autrics' ),
          'type' => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px', '%', 'em' ],
          'selectors' => [
            '{{WRAPPER}} .ts-service-wrapper .service-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          ],
        ]
      );

      $this->start_controls_tabs(
        'content-wrapper_style_tabs'
      );

      $this->start_controls_tab(
        'content_wrapper_normal_tab',
        [
          'label' => esc_html__( 'Normal', 'autrics' ),
        ]
      );

      $this->add_control('content_wrapper_bg_color',
            [
                'label'    => esc_html__('Background', 'autrics'),
                'type'     => Controls_Manager::COLOR,
                'selectors'   => [
                    '{{WRAPPER}} .ts-service-wrapper .service-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
          \Elementor\Group_Control_Border::get_type(),
          [
            'name' => 'content_wrapper_border',
            'label' => esc_html__( 'Border', 'autrics' ),
            'selector' => '{{WRAPPER}} .ts-service-wrapper .service-content',
          ]
        );

      $this->end_controls_tab();

      $this->start_controls_tab(
        'content_wrapper_hover_tab',
        [
          'label' => esc_html__( 'Hover', 'textdomain' ),
        ]
      );

        $this->add_control('content_wrapper_bg_hover_color',
            [
                'label'    => esc_html__('Background', 'autrics'),
                'type'     => Controls_Manager::COLOR,
                'selectors'   => [
                    '{{WRAPPER}} .ts-service-wrapper:hover .service-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
          \Elementor\Group_Control_Border::get_type(),
          [
            'name' => 'content_wrapper_hover_border',
            'label' => __( 'Border', 'autrics' ),
            'selector' => '{{WRAPPER}} .ts-service-wrapper:hover .service-content',
          ]
        );

      $this->end_controls_tab();

      $this->end_controls_tabs();

      $this->end_controls_section();

      // Icon Controls 
      $this->start_controls_section('Service Icon',
			[
				'label' => esc_html__( 'Service Icon', 'autrics' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		  );

      $this->add_responsive_control(
        'icon_font_size',
        [
          'label' => esc_html__( 'Icon Size', 'autrics' ),
          'type' => Controls_Manager::SLIDER,
          'size_units' => [ 'px', '%' ],
          'range' => [
            'px' => [
              'min' => 0,
              'max' => 1000,
              'step' => 5,
            ],
            '%' => [
              'min' => 0,
              'max' => 100,
            ],
          ],
          'selectors' => [
            '{{WRAPPER}} .service-content .service-icon' => 'font-size: {{SIZE}}{{UNIT}};',
          ],
        ]
      );


      $this->add_responsive_control(
        'positioning',
        [
          'label' => esc_html__( 'Left', 'autrics' ),
          'type' => Controls_Manager::SLIDER,
          'size_units' => [ 'px', '%' ],
          'range' => [
            'px' => [
              'min' => 0,
              'max' => 1000,
              'step' => 5,
            ],
            '%' => [
              'min' => 0,
              'max' => 100,
            ],
          ],
          'selectors' => [
            '{{WRAPPER}} .service-content .service-icon' => 'left: {{SIZE}}{{UNIT}};',
          ],
        ]
      );

      $this->start_controls_tabs(
        'icon_style_tabs'
      );

      $this->start_controls_tab(
        'icon_style_normal_tab',
        [
          'label' => esc_html__( 'Normal', 'autrics' ),
        ]
      );

      $this->add_control(
        'icon_color',
        [
          'label'    => esc_html__('Color', 'autrics'),
          'type'     => Controls_Manager::COLOR,
          'selectors'   => [
              '{{WRAPPER}} .service-content .service-icon' => 'color: {{VALUE}};',
          ],
        ]
      );

      $this->add_control(
        'icon_bg_color',
        [
          'label'    => esc_html__('Background', 'autrics'),
          'type'     => Controls_Manager::COLOR,
          'selectors'   => [
              '{{WRAPPER}} .service-content .service-icon' => 'background-color: {{VALUE}};',
          ],
        ]
      );

      $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
          'name' => 'icon_wrapper_border',
          'label' => esc_html__( 'Border', 'autrics' ),
          'selector' => '{{WRAPPER}} .service-content .service-icon',
        ]
      );

      $this->end_controls_tab();

      $this->start_controls_tab(
        'icon_style_hover_tab',
        [
          'label' => esc_html__( 'Hover', 'autrics' ),
        ]
      );

      $this->add_control(
        'icon_hover_color',
        [
          'label'    => esc_html__('Color', 'autrics'),
          'type'     => Controls_Manager::COLOR,
          'selectors'   => [
              '{{WRAPPER}} .ts-service-wrapper:hover .service-content .service-icon' => 'color: {{VALUE}};',
          ],
        ]
      );

      $this->add_control(
        'icon_bg_hover_color',
        [
          'label'    => esc_html__('Background', 'autrics'),
          'type'     => Controls_Manager::COLOR,
          'selectors'   => [
              '{{WRAPPER}} .ts-service-wrapper:hover .service-content .service-icon' => 'background-color: {{VALUE}};',
          ],
        ]
      );

      $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
          'name' => 'icon_wrapper_hover_border',
          'label' => esc_html__( 'Border', 'autrics' ),
          'selector' => '{{WRAPPER}} .ts-service-wrapper:hover .service-content .service-icon',
        ]
      );

      $this->end_controls_tabs();

      $this->end_controls_section();
    } 

    

    protected function render() {

    $sevice_cat =     'all';
    $settings =            $this->get_settings();
    $post_title_crop =     $settings["post_title_crop"];
    $service_style =       $settings["service_style"];
    $show_desc =           $settings["show_desc"];
    $desc_limit =          $settings["desc_limit"];
    $post_count =          $settings["post_count"];
    $show_icon =           $settings["show_icon"];
    $sevice_cat =          $settings["service_category"];
    $service_single =      $settings["service_single"];
    $show_readmore=        $settings["show_readmore"];
    $show_navigation =      $settings["show_navigation"]=="yes"?true:false;
    $post_order =        isset($settings['post_order'])?$settings['post_order']:'DESC';
    $service_button_icon = $settings['service_button_icon'];  
  
   if($service_style=="style1" || $service_style=="style2"){
      $args = array(
         'numberposts'    => $post_count,
         'orderby'        => 'post_date',
         'order'          => $post_order,
         'post_type'      => 'ts_service',
         'post_status'    => 'publish',
         'tax_query'      => [],
       
     );
  
     if($sevice_cat!='all'){
         $args["tax_query"]  = array(
             array(
                 'taxonomy' => 'ts_service_cat',
                 'field'    => 'slug',
                 'terms'    => array($sevice_cat)
             )
         );
     }  
 
     $service_posts = get_posts( $args );
    }elseif($service_style=="style3"){
      
      $args = [
      'post_type'        => 'ts_service',
      'posts_per_page'   => 1,
      'p'                => $service_single,
     
      ];
      $q = get_posts( $args ,ARRAY_A );
   
   } 
   if($service_style=="style4"){
      
    $args = [
    'post_type'        => 'ts_service',
    'posts_per_page'   => 1,
    'p'                => $service_single,
   
    ];

    if(is_array($sevice_cat) && count($sevice_cat)){
      $args['category__in'] = $sevice_cat;
   }

    $q = get_posts( $args ,ARRAY_A );
 
 } 
   
  
    ?>
  
    <?php if($service_style == "style1"): ?>         
        <div data-nav="<?php  echo esc_attr( $show_navigation ); ?>" class="service-carousel owl-carousel">
           <?php  foreach( $service_posts as $recent):   
             setup_postdata( $recent ); 
        
            ?>
            <?php $icon = autrics_meta_option($recent->ID,'autrics_service_icon');  ?>
                  <div class="ts-service-wrapper">
                    <?php if(has_post_thumbnail($recent->ID)): ?>
                        <span class="service-img">
                        <a href="<?php echo get_post_permalink($recent->ID); ?>">
                           <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url( $recent->ID, 'large' ); ?>" alt="thumbnail">
                        </a>   
                        </span> <!-- Service Img end -->
                     <?php endif; ?> 
                     <div class="service-content">
                     <?php if($show_icon=="yes"): ?>
                        <div class="service-icon">
                           <i class="<?php echo esc_attr($icon) ?>"></i>
                        </div> <!-- Service icon end -->
                     <?php endif; ?>  
                        <h3 class="ts-service-title">
                            <a href="<?php echo get_post_permalink($recent->ID); ?>"><?php echo wp_trim_words( wp_kses($recent->post_title,['p']), $post_title_crop, '');  ?>
                            </a>
                        </h3>
                        <?php if($show_desc=="yes"): ?>
                            <p> 
                               <?php 
                                 echo wp_trim_words( wp_kses($recent->post_excerpt,['p']), $desc_limit, ''); 
                                ?>  
                            </p>
                        <?php endif; ?> 
                        <?php if($show_readmore=="yes"): ?>
                           <a href="<?php echo get_post_permalink($recent->ID); ?>" class="readmore"><?php echo esc_html__('Read more', 'autrics');  ?><i class="fas fa-angle-double-right"></i></a>
                        <?php endif; ?> 
     
                     </div> <!-- Service content end -->
               </div> <!-- Service wrapper end -->
               
        <?php endforeach; ?>       
      </div><!-- Row end -->    
    <?php endif; ?>     

    <?php if($service_style == "style2"): ?>   
    <div class="row ts-feature-standard">
    <?php  foreach( $service_posts as $recent):   
             setup_postdata( $recent );
     ?>
            <div class="col-lg-4 col-md-6">
               <?php $icon = autrics_meta_option($recent->ID,'autrics_service_icon');  ?>
                  <div class="ts-feature-wrapper">
                    <div class="feature-single">
                     <span class="feature-icon">
                     <i class="<?php echo esc_attr($icon) ?>"></i>
                     </span><!-- feature icon -->
                    <div class="feature-content">
                        <h3 class="ts-service-title">
                           <a href="<?php echo get_post_permalink($recent->ID); ?>"><?php echo wp_trim_words( wp_kses($recent->post_title,['p']), $post_title_crop, '');  ?>
                           </a>
                        </h3>
                        <?php if($show_desc=="yes"): ?>
                          <p>
                             <?php echo wp_trim_words( wp_kses($recent->post_excerpt,['p']), $desc_limit, '');  ?>  
                           </p>
                        <?php endif; ?> 
                    </div><!-- feature content end -->
                </div><!-- feature single end -->
                </div><!-- feature wrapper end -->
            </div><!-- Col end -->
    <?php endforeach; ?>               
    </div><!-- Content Row End -->
    <?php endif; ?>    

    <?php if($service_style == "style3" && count($q)==1): ?>   
    <?php $icon = autrics_meta_option($q[0]->ID,'autrics_service_icon');  ?>

      <div class="ts-service-wrapper">
               <span class="service-img">
                  <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url($q[0]->ID,'large'); ?>" alt="service-img">
               </span> <!-- Service Img end -->
               <div class="service-content">
               <?php if($show_icon == 'yes'): ?>
                     <div class="service-icon">
                     <i class="<?php echo esc_attr($icon) ?>"></i>
                     </div> <!-- Service icon end -->
            <?php endif; ?>
                     <h3 class="ts-service-title">
                        <a href="<?php echo get_post_permalink($q[0]->ID); ?>"><?php echo wp_trim_words( wp_kses($q[0]->post_title,['p']), $post_title_crop, '');  ?>
                        </a>
                     </h3>
                     <?php if($show_desc=="yes"): ?>
                     <p>
                       <?php echo wp_trim_words( wp_kses($q[0]->post_excerpt,['p']), $desc_limit, '');  ?> 
                     </p>
                     <?php endif; ?> 
                     <?php if($show_readmore=="yes"): ?>
                       <a href="<?php echo get_post_permalink($q[0]->ID); ?>" class="readmore"> <?php echo esc_html__('Read more', 'autrics'); ?>
                        
                        <i class="fa fa-arrow-right"></i>
                        
                      </a>
                     <?php endif; ?> 
                    
               </div> <!-- Service content end -->
      </div> <!-- Service wrapper end -->   

     <?php endif; ?> 


     <?php if($service_style == "style4" && count($q)==1): ?>   
    <?php $icon = autrics_meta_option($q[0]->ID,'autrics_service_icon');  ?>

      <div class="ts-service-wrapper ts-service-classic-wrapper">
               <div class="ts-classic-service">
               <span class="service-img">
                  <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url($q[0]->ID,'large'); ?>" alt="service-img">
               </span> <!-- Service Img end -->
               <div class="service-content">
               <?php if($show_icon == 'yes'): ?>
            <?php endif; ?>

            <div class="service-category">
                <?php 
                  $terms = get_the_terms( $q[0]->ID, 'ts_service_cat' );
                  $cat = '';
                    if(is_array($terms)):
                        foreach($terms as $term):
                          $cat .= '<a href="'.get_term_link($term->slug, 'ts_service_cat').'">'.$term->name.'</a>';
                        endforeach;
                  endif;
                  echo autrics_kses($cat);
                ?>
            </div>
              <h3 class="ts-service-title">
                <a href="<?php echo get_post_permalink($q[0]->ID); ?>"><?php echo wp_trim_words( wp_kses($q[0]->post_title,['p']), $post_title_crop, '');
                  ?>
                </a>
              </h3>
              <?php if($show_desc=="yes"): ?>
              <p>
                <?php echo wp_trim_words( wp_kses($q[0]->post_excerpt,['p']), $desc_limit, '');  ?> 
              </p>
              <?php endif; ?> 
              <?php if($show_readmore=="yes"): ?>
                <a href="<?php echo get_post_permalink($q[0]->ID); ?>" class="readmore"> <?php echo esc_html__('More Details', 'autrics'); ?> <i class="fa fa-angle-double-right"></i></a>
              <?php endif; ?> 
                    
               </div> <!-- Service content end -->
               </div>
      </div> <!-- Service wrapper end -->   

     <?php endif; ?> 
   <?php 
    wp_reset_query();
    }
    
    public function getCategories(){
        $terms = get_terms( array(
            'taxonomy'    => 'ts_service_cat',
            'hide_empty'  => false,
            'number'      => '150', 
        ) );
       
       
        $cat_list = [];
        $cat_list['all']   = ['All'];
        foreach($terms as $post) {
         $cat_list[$post->slug]  = [$post->name];
        }
          
       return $cat_list;
    }

    public function getServices(){
      $service_list = [];
      $args = array(
          'post_type' 		    	=> 'ts_service',
          'suppress_filters' 		=> false,
          'posts_per_page'       => '-1'
       
       );
       
       $posts = get_posts($args);
       foreach ($posts as $postdata) {
          setup_postdata( $postdata );
          $service_list[$postdata->ID] = [$postdata->post_title];
        }
     
      return $service_list;
  }
   
}