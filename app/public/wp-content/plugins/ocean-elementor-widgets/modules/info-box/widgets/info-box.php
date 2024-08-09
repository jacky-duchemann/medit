<?php
namespace owpElementor\Modules\InfoBox\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class InfoBox extends Widget_Base {

	public function get_name() {
		return 'oew-info-box';
	}

	public function get_title() {
		return __( 'Info Box', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-icon-box';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'info',
			'box',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-info-box' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_info_box',
			array(
				'label' => __( 'General', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'type',
			array(
				'label'   => __( 'Type', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => array(
					'none'  => __( 'None', 'ocean-elementor-widgets' ),
					'icon'  => __( 'Icon', 'ocean-elementor-widgets' ),
					'image' => __( 'Image', 'ocean-elementor-widgets' ),
					'text'  => __( 'Text', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'     => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-info-circle',
					'library' => 'brand',
				),
				'condition' => array(
					'type' => 'icon',
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => __( 'Image', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'type' => 'image',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label'     => __( 'Image Size', 'ocean-elementor-widgets' ),
				'default'   => 'large',
				'condition' => array(
					'type' => 'image',
				),
			)
		);

		$this->add_control(
			'image_link',
			array(
				'label'       => __( 'Image Link', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'condition'   => array(
					'type' => 'image',
				),
			)
		);

		$this->add_control(
			'text',
			array(
				'label'     => __( 'Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '1',
				'condition' => array(
					'type' => 'text',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_responsive_control(
			'position',
			array(
				'label'              => __( 'Position', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::CHOOSE,
				'default'            => 'top',
				'options'            => array(
					'left'  => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'top'   => array(
						'title' => __( 'Top', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'prefix_class'       => 'oew-info-box%s-',
				'frontend_available' => true,
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'     => __( 'Content Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'vertical_position',
			array(
				'label'                => __( 'Vertical Position', 'ocean-elementor-widgets' ),
				'type'                 => Controls_Manager::CHOOSE,
				'default'              => 'top',
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'condition'            => array(
					'position' => array(
						'left',
						'right',
					),
					'type!'    => 'none',
				),
				'selectors'            => array(
					'(desktop){{WRAPPER}}.oew-info-box-left .oew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(desktop){{WRAPPER}}.oew-info-box-right .oew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(tablet){{WRAPPER}}.oew-info-box-tablet-left .oew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(tablet){{WRAPPER}}.oew-info-box-tablet-right .oew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(mobile){{WRAPPER}}.oew-info-box-mobile-left .oew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
					'(mobile){{WRAPPER}}.oew-info-box-mobile-right .oew-info-box' => '-webkit-align-items: {{VALUE}}; -ms-flex-align: {{VALUE}}; align-items: {{VALUE}};',
				),
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'This is the heading', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => __( 'Description', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'Enter your description', 'ocean-elementor-widgets' ),
				'rows'        => 10,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title_divider',
			array(
				'label'   => __( 'Title Separator', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title Tag', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => array(
					'h1'   => __( 'H1', 'ocean-elementor-widgets' ),
					'h2'   => __( 'H2', 'ocean-elementor-widgets' ),
					'h3'   => __( 'H3', 'ocean-elementor-widgets' ),
					'h4'   => __( 'H4', 'ocean-elementor-widgets' ),
					'h5'   => __( 'H5', 'ocean-elementor-widgets' ),
					'h6'   => __( 'H6', 'ocean-elementor-widgets' ),
					'div'  => __( 'div', 'ocean-elementor-widgets' ),
					'span' => __( 'span', 'ocean-elementor-widgets' ),
					'p'    => __( 'p', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'link_heading',
			array(
				'label'     => __( 'Link', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'link_type',
			array(
				'label'   => __( 'Link Type', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'   => __( 'None', 'ocean-elementor-widgets' ),
					'box'    => __( 'Box', 'ocean-elementor-widgets' ),
					'title'  => __( 'Title', 'ocean-elementor-widgets' ),
					'button' => __( 'Button', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'button_size',
			array(
				'label'     => __( 'Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'md',
				'options'   => array(
					'xs' => __( 'Extra Small', 'ocean-elementor-widgets' ),
					'sm' => __( 'Small', 'ocean-elementor-widgets' ),
					'md' => __( 'Medium', 'ocean-elementor-widgets' ),
					'lg' => __( 'Large', 'ocean-elementor-widgets' ),
					'xl' => __( 'Extra Large', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'url' => '#',
				),
				'placeholder' => __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'condition'   => array(
					'link_type!' => 'none',
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => __( 'Button Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Learn More', 'ocean-elementor-widgets' ),
				'condition' => array(
					'link_type' => 'button',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'button_icon',
			array(
				'label'     => __( 'Button Icon', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => '',
					'library' => 'solid',
				),
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_icon_position',
			array(
				'label'     => __( 'Icon Position', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => __( 'Before', 'ocean-elementor-widgets' ),
					'right' => __( 'After', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'link_type'    => 'button',
					'button_icon!' => '',
				),
			)
		);

		$this->add_control(
			'button_icon_spacing',
			array(
				'label'     => __( 'Icon Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'condition' => array(
					'link_type'    => 'button',
					'button_icon!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-button.elementor-align-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-info-box-button.elementor-align-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_icon_size',
			array(
				'label'      => __( 'Button Icon Size', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'em' ),
				'condition'  => array(
					'type' => 'icon',
				),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-button i, {{WRAPPER}} .oew-info-box-button svg' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Info Box', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_info_box' );

		$this->start_controls_tab(
			'tab_info_box_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'info_box_background',
				'selector' => '{{WRAPPER}} .oew-info-box-wrap',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'info_box_border',
				'selector' => '{{WRAPPER}} .oew-info-box-wrap',
			)
		);

		$this->add_control(
			'info_box_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'info_box_shadow',
				'selector' => '{{WRAPPER}} .oew-info-box-wrap',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_info_box_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'info_box_hover_background',
				'selector' => '{{WRAPPER}} .oew-info-box-wrap:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'info_box_hover_border',
				'selector' => '{{WRAPPER}} .oew-info-box-wrap:hover',
			)
		);

		$this->add_control(
			'info_box_border_radius_hover',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'info_box_hover_animation',
			array(
				'label' => __( 'Animation', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'info_box_shadow_hover',
				'selector' => '{{WRAPPER}} .oew-info-box-wrap:hover',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'info_box_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			array(
				'label'     => __( 'Icon Style', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'em' ),
				'condition'  => array(
					'type' => 'icon',
				),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-icon' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .oew-info-box-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'img_width',
			array(
				'label'          => __( 'Width', 'ocean-elementor-widgets' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'size' => 30,
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units'     => array( '%' ),
				'range'          => array(
					'%' => array(
						'min' => 5,
						'max' => 100,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}}.oew-info-box-top .oew-info-box-icon, {{WRAPPER}}.oew-info-box-left .oew-info-box-icon-wrap, {{WRAPPER}}.oew-info-box-right .oew-info-box-icon-wrap' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'      => array(
					'type' => 'image',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'text_typography',
				'label'     => __( 'Typography', 'ocean-elementor-widgets' ),
				'condition' => array(
					'type' => 'text',
				),
				'selector'  => '{{WRAPPER}} .oew-info-box-icon',
			)
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'icon_background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-icon' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-info-box-icon svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'type!' => 'image',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'icon_background_hover',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'type!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-icon:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_color_hover',
			array(
				'label'     => __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-icon:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-info-box-icon:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-info-box-icon:hover svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'type!' => 'image',
				),
			)
		);

		$this->add_control(
			'icon_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'type!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-icon:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_hover_animation',
			array(
				'label' => __( 'Icon Animation', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'icon_border',
				'label'     => __( 'Border', 'ocean-elementor-widgets' ),
				'condition' => array(
					'type!' => 'none',
				),
				'selector'  => '{{WRAPPER}} .oew-info-box-icon',
			)
		);

		$this->add_control(
			'icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'type!' => 'none',
				),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-icon, {{WRAPPER}} .oew-info-box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_rotation',
			array(
				'label'      => __( 'Icon Rotation', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 360,
						'step' => 1,
					),
				),
				'size_units' => '',
				'condition'  => array(
					'type!' => 'none',
				),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-icon' => '-webkit-transform: rotate( {{SIZE}}deg ); -moz-transform: rotate( {{SIZE}}deg ); -ms-transform: rotate( {{SIZE}}deg ); -o-transform: rotate( {{SIZE}}deg ); transform: rotate( {{SIZE}}deg );',
				),
			)
		);

		$this->add_responsive_control(
			'icon_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_margin',
			array(
				'label'       => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%' ),
				'placeholder' => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'selectors'   => array(
					'{{WRAPPER}} .oew-info-box-icon-wrap' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => __( 'Title & Description', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-info-box-title',
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin Bottom', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 15,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'description_heading',
			array(
				'label'     => __( 'Description', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-description' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-info-box-description',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_divider_style',
			array(
				'label'     => __( 'Title Separator', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'title_divider' => 'yes',
				),
			)
		);

		$this->add_control(
			'divider_title_border_type',
			array(
				'label'     => __( 'Border Type', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'none'   => __( 'None', 'ocean-elementor-widgets' ),
					'solid'  => __( 'Solid', 'ocean-elementor-widgets' ),
					'double' => __( 'Double', 'ocean-elementor-widgets' ),
					'dotted' => __( 'Dotted', 'ocean-elementor-widgets' ),
					'dashed' => __( 'Dashed', 'ocean-elementor-widgets' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-divider' => 'border-bottom-style: {{VALUE}}',
				),
				'condition' => array(
					'title_divider' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'divider_title_width',
			array(
				'label'      => __( 'Border Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 30,
				),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-divider' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'title_divider' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'divider_title_border_height',
			array(
				'label'      => __( 'Border Height', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 2,
				),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'title_divider' => 'yes',
				),
			)
		);

		$this->add_control(
			'divider_title_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-divider' => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'title_divider' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'divider_title_align',
			array(
				'label'     => __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-divider-wrap'   => 'display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex; -webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
				),
				'condition' => array(
					'title_divider' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'divider_title_margin',
			array(
				'label'      => __( 'Margin Bottom', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 20,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-divider-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'title_divider' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label'     => __( 'Button', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label'     => __( 'Normal', 'ocean-elementor-widgets' ),
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-button' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_text_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-button' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_box_shadow',
				'selector'  => '{{WRAPPER}} .oew-info-box-button',
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label'     => __( 'Hover', 'ocean-elementor-widgets' ),
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_hover_background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-button:hover' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-button:hover' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-info-box-button:hover' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_control(
			'button_animation',
			array(
				'label'     => __( 'Animation', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HOVER_ANIMATION,
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_hover_box_shadow',
				'selector'  => '{{WRAPPER}} .oew-info-box-button:hover',
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'button_border_normal',
				'label'     => __( 'Border', 'ocean-elementor-widgets' ),
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
				'selector'  => '{{WRAPPER}} .oew-info-box-button',
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typography',
				'label'     => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .oew-info-box-button',
				'condition' => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'link_type'    => 'button',
					'button_text!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => __( 'Margin Top', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 15,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-info-box-btn-wrap' => 'margin-top: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrap', 'class', 'oew-info-box-wrap' );

		if ( $settings['info_box_hover_animation'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'elementor-animation-' . $settings['info_box_hover_animation'] );
		}

		$this->add_render_attribute( 'info-box', 'class', 'oew-info-box' );
		$this->add_render_attribute( 'icon-wrap', 'class', 'oew-info-box-icon-wrap' );
		$this->add_render_attribute( 'icon', 'class', 'oew-info-box-icon' );
		$this->add_render_attribute( 'content', 'class', 'oew-info-box-content' );
		$this->add_render_attribute( 'title', 'class', 'oew-info-box-title' );
		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'description', 'class', 'oew-info-box-description' );
		$this->add_inline_editing_attributes( 'description', 'basic' );

		$wrap_tag = 'div';
		$tag      = $settings['title_tag'];

		$this->add_render_attribute(
			'info-box-button',
			'class',
			array(
				'oew-info-box-button',
				'elementor-button',
				'elementor-size-' . $settings['button_size'],
				'elementor-align-icon-' . $settings['button_icon_position'],
			)
		);

		if ( $settings['button_animation'] ) {
			$this->add_render_attribute( 'info-box-button', 'class', 'elementor-animation-' . $settings['button_animation'] );
		}

		if ( $settings['icon_hover_animation'] ) {
			$this->add_render_attribute( 'icon', 'class', 'elementor-animation-' . $settings['icon_hover_animation'] );
		}

		if ( 'none' != $settings['link_type'] ) {

			if ( ! empty( $settings['link']['url'] ) ) {

				if ( 'box' == $settings['link_type'] ) {

					$wrap_tag = 'a';

					$this->add_render_attribute( 'wrap', 'href', $settings['link']['url'] );

					if ( $settings['link']['is_external'] ) {
						$this->add_render_attribute( 'wrap', 'target', '_blank' );
					}

					if ( $settings['link']['nofollow'] ) {
						$this->add_render_attribute( 'wrap', 'rel', 'nofollow' );
					}
				} elseif ( 'title' == $settings['link_type'] ) {

					$tag = 'a';

					$this->add_render_attribute( 'title', 'href', $settings['link']['url'] );

					if ( $settings['link']['is_external'] ) {
						$this->add_render_attribute( 'title', 'target', '_blank' );
					}

					if ( $settings['link']['nofollow'] ) {
						$this->add_render_attribute( 'title', 'rel', 'nofollow' );
					}
				} elseif ( 'button' == $settings['link_type'] ) {

					$this->add_render_attribute( 'info-box-button', 'href', $settings['link']['url'] );

					if ( $settings['link']['is_external'] ) {
						$this->add_render_attribute( 'info-box-button', 'target', '_blank' );
					}

					if ( $settings['link']['nofollow'] ) {
						$this->add_render_attribute( 'info-box-button', 'rel', 'nofollow' );
					}
				}
			}
		} ?>

		<<?php echo $wrap_tag; ?> <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'info-box' ); ?>>

				<?php
				if ( 'none' != $settings['type'] ) {
					?>
					<div <?php echo $this->get_render_attribute_string( 'icon-wrap' ); ?>>
						<span <?php echo $this->get_render_attribute_string( 'icon' ); ?>>
							<?php
							if ( 'icon' == $settings['type'] ) {
								\Elementor\Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
							} elseif ( 'image' == $settings['type'] ) {
								if ( ! empty( $settings['image_link']['url'] ) ) {
									$this->add_render_attribute( 'image-link', 'href', $settings['image_link']['url'] );

									if ( $settings['image_link']['is_external'] ) {
										$this->add_render_attribute( 'image-link', 'target', '_blank' );
									}

									if ( $settings['image_link']['nofollow'] ) {
										$this->add_render_attribute( 'image-link', 'rel', 'nofollow' );
									}

									echo '<a ' . $this->get_render_attribute_string( 'image-link' ) . '>';
									?>
									<?php
								}
									echo Group_Control_Image_Size::get_attachment_image_html( $settings );
								if ( ! empty( $settings['image_link']['url'] ) ) {
									?>
									</a>
									<?php
								}
							} elseif ( 'text' == $settings['type'] ) {
								?>
								<span class="oew-icon-text">
									<?php echo $settings['text']; ?>
								</span>
								<?php
							}
							?>
						</span>
					</div>
					<?php
				}
				?>

				<div <?php echo $this->get_render_attribute_string( 'content' ); ?>>
					<?php
					if ( ! empty( $settings['title'] ) ) {
						?>
						<<?php echo $tag; ?> <?php echo $this->get_render_attribute_string( 'title' ); ?>>
							<?php echo $this->parse_text_editor( $settings['title'] ); ?>
						</<?php echo $tag; ?>>
						<?php
					}
					?>

					<?php
					if ( 'yes' == $settings['title_divider'] ) {
						?>
						<div class="oew-info-box-divider-wrap">
							<div class="oew-info-box-divider"></div>
						</div>
						<?php
					}
					?>

					<?php
					if ( ! empty( $settings['description'] ) ) {
						?>
						<div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
							<?php echo $this->parse_text_editor( nl2br( $settings['description'] ) ); ?>
						</div>
						<?php
					}
					?>

					<?php
					if ( 'button' == $settings['link_type'] ) {
						?>
						<div class="oew-info-box-btn-wrap">
							<a <?php echo $this->get_render_attribute_string( 'info-box-button' ); ?>>
								<?php
								if ( ! empty( $settings['button_icon'] ) && 'left' == $settings['button_icon_position'] ) {
									\Elementor\Icons_Manager::render_icon( $settings['button_icon'], array( 'aria-hidden' => 'true' ) );
								}
								?>

								<?php
								if ( ! empty( $settings['button_text'] ) ) {
									?>
									<span <?php echo $this->get_render_attribute_string( 'button_text' ); ?>>
										<?php echo esc_attr( $settings['button_text'] ); ?>
									</span>
									<?php
								}
								?>

								<?php
								if ( ! empty( $settings['button_icon'] ) && 'right' == $settings['button_icon_position'] ) {
									\Elementor\Icons_Manager::render_icon( $settings['button_icon'], array( 'aria-hidden' => 'true' ) );
								}
								?>
							</a>
						</div>
						<?php
					}
					?>
				</div>

			</div>
		</<?php echo $wrap_tag; ?>>

		<?php
	}

	protected function content_template() {

		?>

		<#
			var wrap_tag = 'div';
			var tag = 'h3';

			if ( settings.image.url ) {
				if ( 'box' == settings.link_type ) {
					var wrap_tag = 'a';
				} else if ( 'title' == settings.link_type ) {
					var tag = 'a';
				}

				var image = {
					id: settings.image.id,
					url: settings.image.url,
					size: settings.image_size,
					dimension: settings.image_custom_dimension,
					model: view.getEditModel()
				};

				var image_url = elementor.imagesManager.getImageUrl( image );
			}
		#>

		<# var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' ); #>
		<# var buttoniconHTML = elementor.helpers.renderIcon( view, settings.button_icon, { 'aria-hidden': true }, 'i' , 'object' ); #>

		<{{{wrap_tag}}} class="oew-info-box-wrap elementor-animation-{{ settings.info_box_hover_animation }}" href="{{settings.link.url}}">
			<div class="oew-info-box oew-info-box-{{ settings.icon_position }}">

				<# if ( 'none' != settings.type ) { #>
					<div class="oew-info-box-icon-wrap">
						<span class="oew-info-box-icon elementor-animation-{{ settings.icon_hover_animation }}">
							<# if ( 'icon' == settings.type ) { #>
								{{{ iconHTML.value }}}
							<# } else if ( 'image' == settings.type ) { #>
								<# if ( '' != settings.image_link.url ) { #>
									<a href="{{ settings.image_link.url }}">
								<# } #>
									<img src="{{ image_url }}">
								<# if ( '' != settings.image_link.url ) { #>
									</a>
								<# } #>
							<# } else if ( 'text' == settings.type ) { #>
								<span class="oew-icon-text elementor-inline-editing" data-elementor-setting-key="text" data-elementor-inline-editing-toolbar="none">
									{{{ settings.text }}}
								</span>
							<# } #>
						</span>
					</div>
				<# } #>

				<div class="oew-info-box-content">
					<# if ( settings.title ) { #>
						<{{tag}} class="oew-info-box-title elementor-inline-editing" data-elementor-setting-key="heading" data-elementor-inline-editing-toolbar="none" href="{{ settings.link.url }}">
							{{{ settings.title }}}
						</{{tag}}>
					<# } #>

					<# if ( 'yes' == settings.title_divider ) { #>
						<div class="oew-info-box-divider-wrap">
							<div class="oew-info-box-divider"></div>
						</div>
					<# } #>

					<# if ( settings.description ) { #>
						<div class="oew-info-box-description elementor-inline-editing" data-elementor-setting-key="description" data-elementor-inline-editing-toolbar="basic">
							{{{ settings.description }}}
						</div>
					<# } #>

					<# if ( 'button' == settings.link_type ) { #>
						<div class="oew-info-box-btn-wrap">
							<a href="{{ settings.link.url }}" class="oew-info-box-button elementor-button elementor-size-{{ settings.button_size }} elementor-align-icon-{{ settings.button_icon_position }} elementor-animation-{{ settings.button_animation }}">
								<# if ( settings.button_icon && 'left' == settings.button_icon_position ) { #>
									{{{ buttoniconHTML.value }}}
								<# } #>

								<# if ( settings.button_text ) { #>
									<span class="oew-button-text elementor-inline-editing" data-elementor-setting-key="button_text" data-elementor-inline-editing-toolbar="none">
										{{{ settings.button_text }}}
									</span>
								<# } #>

								<# if ( settings.button_icon && 'right' == settings.button_icon_position ) { #>
									{{{ buttoniconHTML.value }}}
								<# } #>
							</a>
						</div>
					<# } #>
				</div>

			</div>
		</{{{wrap_tag}}}>

		<?php
	}
}
