<?php
namespace owpElementor\Modules\Recipe\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Recipe extends Widget_Base {

	public function get_name() {
		return 'oew-recipe';
	}

	public function get_title() {
		return __( 'Recipe', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-menu-card';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'recipe',
			'cook',
			'cooking',
			'reviews',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-recipe' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_recipe',
			array(
				'label' => __( 'Info', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'name',
			array(
				'label'       => __( 'Recipe Name', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'My amazing cook recipe', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => '',
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'I am text block. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Image', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title_html_tag',
			array(
				'label'   => __( 'HTML Tag', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => oew_get_available_tags(),
			)
		);

		$this->add_control(
			'schema',
			array(
				'label'   => __( 'Schema Markup', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'meta_heading',
			array(
				'label'     => __( 'Recipe Meta', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'author',
			array(
				'label'   => __( 'Show Author Meta', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'date',
			array(
				'label'   => __( 'Show Author Date', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_details',
			array(
				'label' => __( 'Details', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'prep_time',
			array(
				'label'   => __( 'Prep Time', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => __( '10', 'ocean-elementor-widgets' ),
				'title'   => __( 'In minutes', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'prep_icon',
			array(
				'label'     => __( 'Prep Icon', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-leaf',
					'library' => 'solid',
				),
				'condition' => array(
					'prep_time!' => '',
				),
			)
		);

		$this->add_control(
			'preportfolio-text',
			array(
				'label'     => __( 'Prep Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Prep Time', 'ocean-elementor-widgets' ),
				'condition' => array(
					'prep_time!' => '',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'prep_value',
			array(
				'label'     => __( 'Prep Value', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Minutes', 'ocean-elementor-widgets' ),
				'condition' => array(
					'prep_time!' => '',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'cook_time',
			array(
				'label'     => __( 'Cook Time', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => __( '30', 'ocean-elementor-widgets' ),
				'title'     => __( 'In minutes', 'ocean-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'cook_icon',
			array(
				'label'     => __( 'Cook Icon', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-utensils',
					'library' => 'solid',
				),
				'condition' => array(
					'cook_time!' => '',
				),
			)
		);

		$this->add_control(
			'cook_text',
			array(
				'label'     => __( 'Cook Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Cook Time', 'ocean-elementor-widgets' ),
				'condition' => array(
					'cook_time!' => '',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'cook_value',
			array(
				'label'     => __( 'Cook Value', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Minutes', 'ocean-elementor-widgets' ),
				'condition' => array(
					'cook_time!' => '',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'total_time',
			array(
				'label'     => __( 'Total Time', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => __( '40', 'ocean-elementor-widgets' ),
				'title'     => __( 'In minutes', 'ocean-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'total_icon',
			array(
				'label'     => __( 'Total Icon', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-clock',
					'library' => 'solid',
				),
				'condition' => array(
					'total_time!' => '',
				),
			)
		);

		$this->add_control(
			'total_text',
			array(
				'label'     => __( 'Total Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Total Time', 'ocean-elementor-widgets' ),
				'condition' => array(
					'total_time!' => '',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'total_value',
			array(
				'label'     => __( 'Total Value', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Minutes', 'ocean-elementor-widgets' ),
				'condition' => array(
					'total_time!' => '',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'servings',
			array(
				'label'     => __( 'Servings', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => __( '4', 'ocean-elementor-widgets' ),
				'title'     => __( 'Number of people', 'ocean-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'servings_icon',
			array(
				'label'     => __( 'Servings Icon', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-users',
					'library' => 'solid',
				),
				'condition' => array(
					'servings!' => '',
				),
			)
		);

		$this->add_control(
			'servings_text',
			array(
				'label'     => __( 'Servings Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Serves', 'ocean-elementor-widgets' ),
				'condition' => array(
					'servings!' => '',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'servings_value',
			array(
				'label'     => __( 'Servings Value', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'People', 'ocean-elementor-widgets' ),
				'condition' => array(
					'servings!' => '',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'calories',
			array(
				'label'     => __( 'Calories', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => __( '345', 'ocean-elementor-widgets' ),
				'title'     => __( 'In kcal', 'ocean-elementor-widgets' ),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'calories_icon',
			array(
				'label'     => __( 'Calories Icon', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-bolt',
					'library' => 'solid',
				),
				'condition' => array(
					'calories!' => '',
				),
			)
		);

		$this->add_control(
			'calories_text',
			array(
				'label'     => __( 'Calories Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Calories', 'ocean-elementor-widgets' ),
				'condition' => array(
					'calories!' => '',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'calories_value',
			array(
				'label'     => __( 'Calories Value', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'kcal', 'ocean-elementor-widgets' ),
				'condition' => array(
					'calories!' => '',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ingredients',
			array(
				'label' => __( 'Ingredients', 'ocean-elementor-widgets' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'ingredient',
			array(
				'name'        => 'ingredient',
				'label'       => __( 'Text', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Ingredient', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'ingredients',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'ingredient' => __( 'Ingredient #1', 'ocean-elementor-widgets' ),
					),
					array(
						'ingredient' => __( 'Ingredient #2', 'ocean-elementor-widgets' ),
					),
					array(
						'ingredient' => __( 'Ingredient #3', 'ocean-elementor-widgets' ),
					),
					array(
						'ingredient' => __( 'Ingredient #4', 'ocean-elementor-widgets' ),
					),
				),
				'title_field' => '{{{ ingredient }}}',
			)
		);

		$this->add_control(
			'ingredients_icon',
			array(
				'label'   => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-circle',
					'library' => 'solid',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_instructions',
			array(
				'label' => __( 'Instructions', 'ocean-elementor-widgets' ),
			)
		);

		$repeater->add_control(
			'instruction',
			array(
				'name'        => 'instruction',
				'label'       => __( 'Text', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Instruction', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'instructions',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'instruction' => __( 'Instruction #1', 'ocean-elementor-widgets' ),
					),
					array(
						'instruction' => __( 'Instruction #2', 'ocean-elementor-widgets' ),
					),
					array(
						'instruction' => __( 'Instruction #3', 'ocean-elementor-widgets' ),
					),
					array(
						'instruction' => __( 'Instruction #4', 'ocean-elementor-widgets' ),
					),
				),
				'title_field' => '{{{ instruction }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_notes',
			array(
				'label' => __( 'Notes', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'notes',
			array(
				'label'   => '',
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			array(
				'label' => __( 'Box', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_background',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'box_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-recipe-wrap',
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'sections_border_color',
			array(
				'label'     => __( 'Sections Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-section' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'box_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap',
			)
		);

		$this->add_responsive_control(
			'box_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => __( 'Content', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'content_title_heading',
			array(
				'label' => __( 'Title', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'content_title_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_title_typography',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-title',
			)
		);

		$this->add_responsive_control(
			'content_title_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_desc_heading',
			array(
				'label'     => __( 'Description', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'content_desc_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_desc_typography',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-description',
			)
		);

		$this->add_control(
			'content_image_heading',
			array(
				'label'     => __( 'Image', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'content_image_width',
			array(
				'label'      => __( 'Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'max' => 1000,
					),
					'%'  => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-image' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_image_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_meta_heading',
			array(
				'label'     => __( 'Meta', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'content_meta_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-meta' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_meta_typography',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-meta',
			)
		);

		$this->add_responsive_control(
			'content_meta_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_details_style',
			array(
				'label' => __( 'Details', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'details_background',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-details',
			)
		);

		$this->add_responsive_control(
			'details_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'details_title_heading',
			array(
				'label'     => __( 'Title', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'details_title_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-details-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'details_title_typography',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-details-title',
			)
		);

		$this->add_control(
			'details_content_heading',
			array(
				'label'     => __( 'Content', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'details_content_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-details-value' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'details_content_typography',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-details-value',
			)
		);

		$this->add_control(
			'details_icon_heading',
			array(
				'label'     => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'details_icon_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-details-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-details-icon svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'details_icon_width',
			array(
				'label'      => __( 'Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max' => 60,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-details-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ingredients_style',
			array(
				'label' => __( 'Ingredients', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'ingredients_heading',
			array(
				'label' => __( 'Title', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'ingredients_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-ingredients > h3' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ingredients_typography',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-ingredients > h3',
			)
		);

		$this->add_responsive_control(
			'ingredients_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-ingredients > h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'ingredients_content_heading',
			array(
				'label'     => __( 'Content', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'ingredients_content_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-ingredients-list' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ingredients_content_typography',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-ingredients-list',
			)
		);

		$this->add_responsive_control(
			'ingredients_icon_width',
			array(
				'label'      => __( 'Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max' => 60,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-ingredient i, {{WRAPPER}} .oew-recipe-wrap .oew-recipe-ingredient svg' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_instructions_style',
			array(
				'label' => __( 'Instructions', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'instructions_heading',
			array(
				'label' => __( 'Title', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'instructions_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-instructions > h3' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'instructions_typography',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-instructions > h3',
			)
		);

		$this->add_responsive_control(
			'instructions_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-instructions > h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'instructions_content_heading',
			array(
				'label'     => __( 'Content', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'instructions_content_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-instructions-list' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'instructions_content_typography',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-instructions-list',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_notes_style',
			array(
				'label' => __( 'Notes', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'notes_heading',
			array(
				'label' => __( 'Title', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'notes_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-notes > h3' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'notes_typography',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-notes > h3',
			)
		);

		$this->add_responsive_control(
			'notes_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-notes > h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'notes_content_heading',
			array(
				'label'     => __( 'Content', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'notes_content_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-recipe-wrap .oew-recipe-notes-text' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'notes_content_typography',
				'selector' => '{{WRAPPER}} .oew-recipe-wrap .oew-recipe-notes-text',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag      = $settings['title_html_tag'];
		$schema   = $settings['schema'];

		$this->add_render_attribute( 'wrap', 'class', 'oew-recipe-wrap' );
		$this->add_render_attribute( 'header', 'class', 'oew-recipe-header' );

		if ( ! empty( $settings['image']['url'] ) ) {
			$this->add_render_attribute( 'image', 'class', 'oew-recipe-image' );
			$this->add_render_attribute( 'image-tag', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image-tag', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image-tag', 'title', Control_Media::get_image_title( $settings['image'] ) );
		}

		$this->add_render_attribute( 'content', 'class', 'oew-recipe-header-content' );
		$this->add_render_attribute( 'name', 'class', 'oew-recipe-title' );
		$this->add_inline_editing_attributes( 'name', 'none' );

		$this->add_render_attribute( 'meta', 'class', 'oew-recipe-meta' );
		$this->add_render_attribute(
			'meta-author',
			'class',
			array(
				'oew-recipe-meta-item',
				'oew-recipe-meta-author',
			)
		);
		$this->add_render_attribute(
			'meta-date',
			'class',
			array(
				'oew-recipe-meta-item',
				'oew-recipe-meta-date',
			)
		);

		$this->add_render_attribute( 'description', 'class', 'oew-recipe-description' );
		$this->add_inline_editing_attributes( 'description', 'basic' );

		$this->add_render_attribute(
			'details',
			'class',
			array(
				'oew-recipe-details',
				'oew-recipe-section',
			)
		);
		$this->add_render_attribute( 'details-list', 'class', 'oew-recipe-details-list' );
		$this->add_render_attribute( 'details-icon', 'class', 'oew-recipe-details-icon' );
		$this->add_render_attribute( 'details-content', 'class', 'oew-recipe-details-content' );
		$this->add_render_attribute( 'details-title', 'class', 'oew-recipe-details-title' );
		$this->add_render_attribute( 'details-value', 'class', 'oew-recipe-details-value' );

		$this->add_render_attribute(
			'ingredients',
			'class',
			array(
				'oew-recipe-ingredients',
				'oew-recipe-section',
			)
		);
		$this->add_render_attribute( 'ingredients-list', 'class', 'oew-recipe-ingredients-list' );

		$this->add_render_attribute(
			'instructions',
			'class',
			array(
				'oew-recipe-instructions',
				'oew-recipe-section',
			)
		);
		$this->add_render_attribute( 'instructions-list', 'class', 'oew-recipe-instructions-list' );

		$this->add_render_attribute(
			'notes',
			'class',
			array(
				'oew-recipe-notes',
				'oew-recipe-section',
			)
		);
		$this->add_render_attribute( 'notes-text', 'class', 'oew-recipe-notes-text' );
		$this->add_inline_editing_attributes( 'notes-text', 'basic' );

		if ( 'yes' == $schema ) {
			$this->add_render_attribute( 'wrap', 'itemscope', '' );
			$this->add_render_attribute( 'wrap', 'itemtype', 'http://schema.org/Recipe' );
			if ( ! empty( $settings['image']['url'] ) ) {
				$this->add_render_attribute(
					'image',
					array(
						'itemprop'  => 'image',
						'itemscope' => '',
						'itemtype'  => 'https://schema.org/ImageObject',
					)
				);
				$this->add_render_attribute(
					'image-url',
					array(
						'itemprop' => 'url',
						'itemtype' => $settings['image']['url'],
					)
				);
				$this->add_render_attribute(
					'image-height',
					array(
						'itemprop' => 'height',
						'content'  => '',
					)
				);
				$this->add_render_attribute(
					'image-width',
					array(
						'itemprop' => 'width',
						'content'  => '',
					)
				);
				$this->add_render_attribute( 'image-tag', 'itemprop', 'image' );
			}
			$this->add_render_attribute( 'name', 'itemprop', 'name' );
			$this->add_render_attribute( 'description', 'itemprop', 'description' );
			$this->add_render_attribute( 'meta-author', 'itemprop', 'author' );
			$this->add_render_attribute( 'meta-date', 'itemprop', 'datePublished' );
			$this->add_render_attribute(
				'details-prep',
				array(
					'itemprop' => 'prepTime',
					'content'  => 'PT15MIN',
				)
			);
			$this->add_render_attribute(
				'details-cook',
				array(
					'itemprop' => 'cookTime',
					'content'  => 'PT30MIN',
				)
			);
			$this->add_render_attribute(
				'details-total',
				array(
					'itemprop' => 'totalTime',
					'content'  => 'PT45MIN',
				)
			);
			$this->add_render_attribute(
				'details-servings',
				array(
					'itemprop' => 'recipeYield',
				)
			);
			$this->add_render_attribute(
				'details-calories',
				array(
					'itemprop'  => 'nutrition',
					'itemscope' => 'PT15MIN',
					'itemtype'  => 'http://schema.org/NutritionInformation',
				)
			);
			$this->add_render_attribute( 'details-calories-item', 'itemprop', 'calories' );
		} ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'header' ); ?>>
				<?php
				if ( ! empty( $settings['image']['url'] ) ) {
					?>
					<div <?php echo $this->get_render_attribute_string( 'image' ); ?>>
						<img <?php echo $this->get_render_attribute_string( 'image-tag' ); ?> />

						<?php
						if ( ! empty( $settings['image']['url'] ) ) {
							?>
							<meta <?php echo $this->get_render_attribute_string( 'image-url' ); ?>>
							<meta <?php echo $this->get_render_attribute_string( 'image-height' ); ?>>
							<meta <?php echo $this->get_render_attribute_string( 'image-width' ); ?>>
							<?php
						}
						?>
					</div>
					<?php
				}
				?>

				<div <?php echo $this->get_render_attribute_string( 'content' ); ?>>

					<?php
					if ( ! empty( $settings['name'] ) ) {
						?>
						<<?php echo $tag; ?> <?php echo $this->get_render_attribute_string( 'name' ); ?>>
							<?php echo $settings['name']; ?>
						</<?php echo $tag; ?>>
						<?php
					}
					?>

					<?php
					if ( 'yes' == $settings['author']
						|| 'yes' == $settings['date'] ) {
						?>
						<ul <?php echo $this->get_render_attribute_string( 'meta' ); ?>>
							<?php
							if ( 'yes' == $settings['author'] ) {
								?>
								<li <?php echo $this->get_render_attribute_string( 'meta-author' ); ?>>
									<?php echo get_the_author(); ?>
								</li>
								<?php
							}
							?>

							<?php
							if ( 'yes' == $settings['date'] ) {
								?>
								<li <?php echo $this->get_render_attribute_string( 'meta-date' ); ?>>
									<?php the_time( 'F d, Y' ); ?>
								</li>
								<?php
							}
							?>
						</ul>
						<?php
					}
					?>

					<?php
					if ( ! empty( $settings['description'] ) ) {
						?>
						<div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
							<?php echo $this->parse_text_editor( $settings['description'] ); ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>

			<div <?php echo $this->get_render_attribute_string( 'details' ); ?>>
				<ul <?php echo $this->get_render_attribute_string( 'details-list' ); ?>>
					<?php
					if ( $settings['prep_time'] ) {
						?>
						<li <?php echo $this->get_render_attribute_string( 'details-prep' ); ?>>
							<span <?php echo $this->get_render_attribute_string( 'details-icon' ); ?>>
								<?php \Elementor\Icons_Manager::render_icon( $settings['prep_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>

							<span <?php echo $this->get_render_attribute_string( 'details-content' ); ?>>
								<span <?php echo $this->get_render_attribute_string( 'details-title' ); ?>>
									<?php echo $settings['preportfolio-text']; ?>
								</span>

								<span <?php echo $this->get_render_attribute_string( 'details-value' ); ?>>
									<span><?php echo $settings['prep_time']; ?></span> <?php echo $settings['prep_value']; ?>
								</span>
							</span>
						</li>
						<?php
					}
					?>

					<?php
					if ( $settings['cook_time'] ) {
						?>
						<li <?php echo $this->get_render_attribute_string( 'details-cook' ); ?>>
							<span <?php echo $this->get_render_attribute_string( 'details-icon' ); ?>>
								<?php \Elementor\Icons_Manager::render_icon( $settings['cook_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>

							<span <?php echo $this->get_render_attribute_string( 'details-content' ); ?>>
								<span <?php echo $this->get_render_attribute_string( 'details-title' ); ?>>
									<?php echo $settings['cook_text']; ?>
								</span>

								<span <?php echo $this->get_render_attribute_string( 'details-value' ); ?>>
									<span><?php echo $settings['cook_time']; ?></span> <?php echo $settings['cook_value']; ?>
								</span>
							</span>
						</li>
						<?php
					}
					?>

					<?php
					if ( $settings['total_time'] ) {
						?>
						<li <?php echo $this->get_render_attribute_string( 'details-total' ); ?>>
							<span <?php echo $this->get_render_attribute_string( 'details-icon' ); ?>>
								<?php \Elementor\Icons_Manager::render_icon( $settings['total_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>

							<span <?php echo $this->get_render_attribute_string( 'details-content' ); ?>>
								<span <?php echo $this->get_render_attribute_string( 'details-title' ); ?>>
									<?php echo $settings['total_text']; ?>
								</span>

								<span <?php echo $this->get_render_attribute_string( 'details-value' ); ?>>
									<span><?php echo $settings['total_time']; ?></span> <?php echo $settings['total_value']; ?>
								</span>
							</span>
						</li>
						<?php
					}
					?>

					<?php
					if ( $settings['servings'] ) {
						?>
						<li <?php echo $this->get_render_attribute_string( 'details-servings' ); ?>>
							<span <?php echo $this->get_render_attribute_string( 'details-icon' ); ?>>
								<?php \Elementor\Icons_Manager::render_icon( $settings['servings_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>

							<span <?php echo $this->get_render_attribute_string( 'details-content' ); ?>>
								<span <?php echo $this->get_render_attribute_string( 'details-title' ); ?>>
									<?php echo $settings['servings_text']; ?>
								</span>

								<span <?php echo $this->get_render_attribute_string( 'details-value' ); ?>>
									<span><?php echo $settings['servings']; ?></span> <?php echo $settings['servings_value']; ?>
								</span>
							</span>
						</li>
						<?php
					}
					?>

					<?php
					if ( $settings['calories'] ) {
						?>
						<li <?php echo $this->get_render_attribute_string( 'details-calories' ); ?>>
							<span <?php echo $this->get_render_attribute_string( 'details-calories-item' ); ?>>
								<span <?php echo $this->get_render_attribute_string( 'details-icon' ); ?>>
									<?php \Elementor\Icons_Manager::render_icon( $settings['calories_icon'], array( 'aria-hidden' => 'true' ) ); ?>
								</span>

								<span <?php echo $this->get_render_attribute_string( 'details-content' ); ?>>
									<span <?php echo $this->get_render_attribute_string( 'details-title' ); ?>>
										<?php echo $settings['calories_text']; ?>
									</span>

									<span <?php echo $this->get_render_attribute_string( 'details-value' ); ?>>
										<span><?php echo $settings['calories']; ?></span> <?php echo $settings['calories_value']; ?>
									</span>
								</span>
							</span>
						</li>
						<?php
					}
					?>
				</ul>
			</div>

			<div <?php echo $this->get_render_attribute_string( 'ingredients' ); ?>>
				<h3><?php _e( 'Ingredients', 'ocean-elementor-widgets' ); ?></h3>

				<ul <?php echo $this->get_render_attribute_string( 'ingredients-list' ); ?>>
					<?php
					foreach ( $settings['ingredients'] as $index => $item ) :
						$ingredient_key = $this->get_repeater_setting_key( 'ingredient', 'ingredients', $index );
						$this->add_render_attribute( $ingredient_key, 'class', 'oew-recipe-ingredient-text' );
						$this->add_inline_editing_attributes( $ingredient_key, 'none' );

						if ( 'yes' == $schema ) {
							$this->add_render_attribute( $ingredient_key, 'itemprop', 'recipeIngredient' );
						}

						if ( $item['ingredient'] ) :
							?>
							<li class="oew-recipe-ingredient">
								<?php
								if ( '' != $settings['ingredients_icon'] ) {
									?>
									<?php \Elementor\Icons_Manager::render_icon( $settings['ingredients_icon'], array( 'aria-hidden' => 'true' ) ); ?>
									<?php
								}
								?>

								<span <?php echo $this->get_render_attribute_string( $ingredient_key ); ?>>
									<?php echo $item['ingredient']; ?>
								</span>
							</li>
							<?php
						endif;
					endforeach;
					?>
				</ul>
			</div>

			<div <?php echo $this->get_render_attribute_string( 'instructions' ); ?>>
				<h3><?php _e( 'Instructions', 'ocean-elementor-widgets' ); ?></h3>

				<ol <?php echo $this->get_render_attribute_string( 'instructions-list' ); ?>>
					<?php
					foreach ( $settings['instructions'] as $index => $item ) :
						$instruction_key = $this->get_repeater_setting_key( 'instruction', 'instructions', $index );
						$this->add_render_attribute( $instruction_key, 'class', 'oew-recipe-instruction-text' );
						$this->add_inline_editing_attributes( $instruction_key, 'none' );

						if ( 'yes' == $schema ) {
							$this->add_render_attribute( $instruction_key, 'itemprop', 'recipeInstructions' );
						}

						if ( $item['instruction'] ) :
							?>
							<li class="oew-recipe-instruction">
								<span <?php echo $this->get_render_attribute_string( $instruction_key ); ?>>
									<?php echo $item['instruction']; ?>
								</span>
							</li>
							<?php
						endif;
					endforeach;
					?>
				</ol>
			</div>

			<?php
			if ( ! empty( $settings['notes'] ) ) {
				?>
				<div <?php echo $this->get_render_attribute_string( 'notes' ); ?>>
					<h3><?php _e( 'Notes', 'ocean-elementor-widgets' ); ?></h3>

					<div <?php echo $this->get_render_attribute_string( 'notes-text' ); ?>>
						<?php echo $this->parse_text_editor( $settings['notes'] ); ?>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
}
