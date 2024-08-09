<?php
namespace owpElementor\Modules\CallToAction\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class CallToAction extends Widget_Base {

	public function get_name() {
		return 'oew-call-to-action';
	}

	public function get_title() {
		return __( 'Call To Action', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-call-to-action';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'call',
			'action',
			'notice',
			'message',
			'banner',
			'cta',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-call-to-action' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cta_general',
			array(
				'label' => __( 'General', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'        => __( 'Style', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'basic',
				'options'      => array(
					'basic'   => __( 'Basic', 'ocean-elementor-widgets' ),
					'inside'  => __( 'Inside', 'ocean-elementor-widgets' ),
					'outside' => __( 'Outside', 'ocean-elementor-widgets' ),
				),
				'render_type'  => 'template',
				'prefix_class' => 'oew-cta-style-',
			)
		);

		$this->add_responsive_control(
			'min_height',
			array(
				'label'      => __( 'Height', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min' => 100,
						'max' => 1000,
					),
					'vh' => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'size_units' => array( 'px', 'vh' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta .oew-cta-inner' => 'min-height: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'style!' => 'basic',
				),
			)
		);

		$this->add_responsive_control(
			'position',
			array(
				'label'        => __( 'Image Position', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'above',
				'options'      => array(
					'left'  => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'above' => array(
						'title' => __( 'Above', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-top',
					),
					'right' => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'prefix_class' => 'oew-cta-%s-image-',
				'condition'    => array(
					'style' => 'outside',
				),
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
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
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-inner' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'vertical_position',
			array(
				'label'        => __( 'Vertical Position', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
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
				'prefix_class' => 'oew-cta-valign-',
				'condition'    => array(
					'style!' => 'basic',
				),
			)
		);

		$this->add_control(
			'bg_image',
			array(
				'label'     => __( 'Choose Image', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array( 'active' => true ),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'style!' => 'basic',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'bg_image',
				'label'     => __( 'Image Resolution', 'ocean-elementor-widgets' ),
				'default'   => 'large',
				'condition' => array(
					'bg_image[id]!' => '',
					'style!'        => 'basic',
				),
			)
		);

		$this->add_control(
			'overlay',
			array(
				'label'        => __( 'Add Overlay?', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array(
					'style!' => 'basic',
				),
			)
		);

		$this->add_control(
			'heading_bg_image',
			array(
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Image', 'ocean-elementor-widgets' ),
				'condition' => array(
					'bg_image[url]!' => '',
					'style!'         => 'basic',
				),
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'image_min_width',
			array(
				'label'      => __( 'Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta .oew-cta-bg-wrapper' => 'min-width: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'style!'    => 'basic',
					'position!' => 'above',
				),
			)
		);

		$this->add_responsive_control(
			'image_min_height',
			array(
				'label'      => __( 'Height', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
					'vh' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'size_units' => array( 'px', 'vh' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta .oew-cta-bg-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'style!' => 'basic',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cta_content',
			array(
				'label' => __( 'Content', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'element',
			array(
				'label'   => __( 'Element', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'none',
				'options' => array(
					'none'  => array(
						'title' => __( 'None', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-ban',
					),
					'image' => array(
						'title' => __( 'Image', 'ocean-elementor-widgets' ),
						'icon'  => 'fa fa-picture-o',
					),
					'icon'  => array(
						'title' => __( 'Icon', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-star',
					),
				),
			)
		);

		$this->add_control(
			'element_image',
			array(
				'label'      => __( 'Choose Image', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic'    => array( 'active' => true ),
				'show_label' => false,
				'condition'  => array(
					'element' => 'image',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'element_image',
				'default'   => 'thumbnail',
				'condition' => array(
					'element'            => 'image',
					'element_image[id]!' => '',
				),
			)
		);

		$this->add_control(
			'selected_cta_icon',
			array(
				'label'            => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'cta_icon',
				'default'          => array(
					'value'   => 'far fa-gem',
					'library' => 'fa-regular',
				),
				'condition'        => array(
					'element' => 'icon',
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Call to action heading', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
				'dynamic' => array( 'active' => true ),
				'rows'    => 5,
			)
		);

		$this->add_control(
			'title_html_tag',
			array(
				'label'   => __( 'HTML Tag', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => oew_get_available_tags(),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cta_button',
			array(
				'label' => __( 'Button', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'btn_text',
			array(
				'label'       => __( 'Text', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Click me', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'Click me', 'ocean-elementor-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'btn_link',
			array(
				'label'       => __( 'Link', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_control(
			'link_click',
			array(
				'label'     => __( 'Apply Link On', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'button',
				'options'   => array(
					'button' => __( 'Button Only', 'ocean-elementor-widgets' ),
					'box'    => __( 'Whole Box', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'btn_link[url]!' => '',
				),
			)
		);

		$this->add_control(
			'selected_btn_icon',
			array(
				'label'            => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'btn_icon',
				'default'          => array(
					'value'   => '',
					'library' => 'fa-regular',
				),
			)
		);

		$this->add_control(
			'icon_align',
			array(
				'label'   => __( 'Icon Position', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => array(
					'left'  => __( 'Before', 'ocean-elementor-widgets' ),
					'right' => __( 'After', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'     => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 3,
						'max' => 60,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-cta .oew-button-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_indent',
			array(
				'label'     => __( 'Icon Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'condition' => array(
					'icon!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-cta-btn .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-cta-btn .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'secondary_btn',
			array(
				'label'        => __( 'Show Secondary Button?', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			's_btn_text',
			array(
				'label'       => __( 'Text', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Click me', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'Click me', 'ocean-elementor-widgets' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			's_btn_link',
			array(
				'label'       => __( 'Link', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'default'     => array(
					'url' => '#',
				),
				'condition'   => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			'selected_s_btn_icon',
			array(
				'label'            => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 's_btn_icon',
				'default'          => array(
					'value'   => '',
					'library' => 'fa-regular',
				),
				'condition'        => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			's_icon_align',
			array(
				'label'     => __( 'Icon Position', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => __( 'Before', 'ocean-elementor-widgets' ),
					'right' => __( 'After', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			's_icon_size',
			array(
				'label'     => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 3,
						'max' => 60,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			's_icon_indent',
			array(
				'label'     => __( 'Icon Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'condition' => array(
					'icon!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-cta-btn .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-cta-btn .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Box', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-cta' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'basic',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'border',
				'label'    => __( 'Border', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-cta',
			)
		);

		$this->add_responsive_control(
			'padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => 'basic',
				),
			)
		);

		$this->add_responsive_control(
			'margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .oew-cta',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'element_style',
			array(
				'label'     => __( 'Element', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'element!' => array(
						'none',
						'',
					),
				),
			)
		);

		$this->add_control(
			'element_image_spacing',
			array(
				'label'     => __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-cta-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'element' => 'image',
				),
			)
		);

		$this->add_control(
			'element_image_width',
			array(
				'label'      => __( 'Size', 'ocean-elementor-widgets' ) . ' (%)',
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'default'    => array(
					'unit' => '%',
				),
				'range'      => array(
					'%' => array(
						'min' => 5,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta-image img' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'element' => 'image',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'element_image_border',
				'selector'  => '{{WRAPPER}} .oew-cta-image img',
				'condition' => array(
					'element' => 'image',
				),
			)
		);

		$this->add_control(
			'element_image_border_radius',
			array(
				'label'     => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-cta-image img' => 'border-radius: {{SIZE}}{{UNIT}}',
				),
				'condition' => array(
					'element' => 'image',
				),
			)
		);

		$this->add_control(
			'element_icon_spacing',
			array(
				'label'     => __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-cta-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'element' => 'icon',
				),
			)
		);

		$this->add_control(
			'element_icon_size',
			array(
				'label'     => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 6,
						'max' => 300,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'element' => 'icon',
				),
			)
		);

		$this->add_control(
			'element_icon_padding',
			array(
				'label'     => __( 'Icon Padding', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'em' => array(
						'min' => 0,
						'max' => 5,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-icon' => 'padding: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'element' => 'icon',
				),
			)
		);

		$this->add_control(
			'element_icon_bg',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-icon' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'element' => 'icon',
				),
			)
		);

		$this->add_control(
			'element_icon_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-icon'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .oew-cta .oew-icon svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'element' => 'icon',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'element_icon_border',
				'label'     => __( 'Border', 'ocean-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .oew-cta .oew-icon',
				'condition' => array(
					'element' => 'icon',
				),
			)
		);

		$this->add_control(
			'element_icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta .oew-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'element' => 'icon',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			array(
				'label'     => __( 'Content', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => 'outside',
				),
			)
		);

		$this->add_control(
			'content_background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}.oew-cta-style-outside .oew-cta .oew-cta-inner' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'outside',
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}.oew-cta-style-outside .oew-cta .oew-cta-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => 'outside',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => __( 'Title', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_bg',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-title' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .oew-cta .oew-cta-title',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'title_border',
				'label'    => __( 'Border', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-cta .oew-cta-title',
			)
		);

		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta .oew-cta-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta .oew-cta-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'title_shadow',
				'selector' => '{{WRAPPER}} .oew-cta .oew-cta-title',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			array(
				'label' => __( 'Description', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typo',
				'selector' => '{{WRAPPER}} .oew-cta .oew-cta-description',
			)
		);

		$this->add_responsive_control(
			'description_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta .oew-cta-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'description_shadow',
				'selector' => '{{WRAPPER}} .oew-cta .oew-cta-description',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_buttons_style',
			array(
				'label' => __( 'Buttons', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .oew-cta .oew-cta-btn .button',
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_text_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button_background_hover_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_animation',
			array(
				'label' => __( 'Hover Animation', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'button_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-cta .oew-cta-btn .button',
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .oew-cta .oew-cta-btn .button',
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_s_btn_style',
			array(
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Secondary Button', 'ocean-elementor-widgets' ),
				'condition' => array(
					'secondary_btn' => 'yes',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 's_button_typography',
				'selector'  => '{{WRAPPER}} .oew-cta .oew-cta-btn .button.oew-cta-s-btn',
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_s_button_style' );

		$this->start_controls_tab(
			'tab_s_button_normal',
			array(
				'label'     => __( 'Normal', 'ocean-elementor-widgets' ),
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			's_button_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button.oew-cta-s-btn' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			's_button_text_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button.oew-cta-s-btn' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_s_button_hover',
			array(
				'label'     => __( 'Hover', 'ocean-elementor-widgets' ),
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			's_button_background_hover_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button.oew-cta-s-btn:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			's_button_hover_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button.oew-cta-s-btn:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			's_button_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button.oew-cta-s-btn:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 's_button_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-cta .oew-cta-btn .button.oew-cta-s-btn',
				'separator'   => 'before',
				'condition'   => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_control(
			's_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button.oew-cta-s-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 's_button_box_shadow',
				'selector'  => '{{WRAPPER}} .oew-cta .oew-cta-btn .button.oew-cta-s-btn',
				'condition' => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			's_button_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-cta .oew-cta-btn .button.oew-cta-s-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'secondary_btn' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hover_effects',
			array(
				'label'     => __( 'Hover Effects', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style!' => 'basic',
				),
			)
		);

		$this->add_control(
			'content_hover_heading',
			array(
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Content', 'ocean-elementor-widgets' ),
				'condition' => array(
					'style' => 'inside',
				),
			)
		);

		$this->add_control(
			'content_animation',
			array(
				'label'     => __( 'Hover Animation', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'groups'    => array(
					array(
						'label'   => __( 'None', 'ocean-elementor-widgets' ),
						'options' => array(
							'' => __( 'None', 'ocean-elementor-widgets' ),
						),
					),
					array(
						'label'   => __( 'Entrance', 'ocean-elementor-widgets' ),
						'options' => array(
							'enter-from-right'  => 'Slide In Right',
							'enter-from-left'   => 'Slide In Left',
							'enter-from-top'    => 'Slide In Up',
							'enter-from-bottom' => 'Slide In Down',
							'enter-zoom-in'     => 'Zoom In',
							'enter-zoom-out'    => 'Zoom Out',
							'fade-in'           => 'Fade In',
						),
					),
					array(
						'label'   => __( 'Reaction', 'ocean-elementor-widgets' ),
						'options' => array(
							'grow'       => 'Grow',
							'shrink'     => 'Shrink',
							'move-right' => 'Move Right',
							'move-left'  => 'Move Left',
							'move-up'    => 'Move Up',
							'move-down'  => 'Move Down',
						),
					),
					array(
						'label'   => __( 'Exit', 'ocean-elementor-widgets' ),
						'options' => array(
							'exit-to-right'  => 'Slide Out Right',
							'exit-to-left'   => 'Slide Out Left',
							'exit-to-top'    => 'Slide Out Up',
							'exit-to-bottom' => 'Slide Out Down',
							'exit-zoom-in'   => 'Zoom In',
							'exit-zoom-out'  => 'Zoom Out',
							'fade-out'       => 'Fade Out',
						),
					),
				),
				'default'   => 'fade-in',
				'condition' => array(
					'style' => 'inside',
				),
			)
		);

		$this->add_control(
			'animation_class',
			array(
				'label'        => __( 'Animation', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::HIDDEN,
				'default'      => 'animated-content',
				'prefix_class' => 'oew-',
				'condition'    => array(
					'content_animation!' => '',
					'style'              => 'inside',
				),
			)
		);

		$this->add_control(
			'content_animation_duration',
			array(
				'label'       => __( 'Animation Duration', 'ocean-elementor-widgets' ) . ' (ms)',
				'type'        => Controls_Manager::SLIDER,
				'render_type' => 'template',
				'default'     => array(
					'size' => 1000,
				),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 3000,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .oew-cta-content' => 'transition-duration: {{SIZE}}ms',
					'{{WRAPPER}}.oew-cta-sequenced-animation .oew-cta-content:nth-child(2)' => 'transition-delay: calc( {{SIZE}}ms / 3 )',
					'{{WRAPPER}}.oew-cta-sequenced-animation .oew-cta-content:nth-child(3)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 2 )',
					'{{WRAPPER}}.oew-cta-sequenced-animation .oew-cta-content:nth-child(4)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 3 )',
				),
				'condition'   => array(
					'content_animation!' => '',
					'style'              => 'inside',
				),
			)
		);

		$this->add_control(
			'sequenced_animation',
			array(
				'label'        => __( 'Sequenced Animation', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'oew-cta-sequenced-animation',
				'prefix_class' => '',
				'condition'    => array(
					'content_animation!' => '',
					'style'              => 'inside',
				),
			)
		);

		$this->add_control(
			'background_hover_heading',
			array(
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'separator' => 'before',
				'condition' => array(
					'style' => 'inside',
				),
			)
		);

		$this->add_control(
			'transformation',
			array(
				'label'        => __( 'Hover Animation', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					''           => 'None',
					'zoom-in'    => 'Zoom In',
					'zoom-out'   => 'Zoom Out',
					'move-left'  => 'Move Left',
					'move-right' => 'Move Right',
					'move-up'    => 'Move Up',
					'move-down'  => 'Move Down',
				),
				'default'      => 'zoom-in',
				'prefix_class' => 'oew-bg-transform oew-bg-transform-',
				'condition'    => array(
					'style!' => 'basic',
				),
			)
		);

		$this->start_controls_tabs( 'bg_effects_tabs' );

		$this->start_controls_tab(
			'normal',
			array(
				'label'     => __( 'Normal', 'ocean-elementor-widgets' ),
				'condition' => array(
					'style!' => 'basic',
				),
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => __( 'Overlay Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-bg-overlay' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'style!' => 'basic',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'      => 'bg_filters',
				'selector'  => '{{WRAPPER}} .oew-cta .oew-cta-bg',
				'condition' => array(
					'style!' => 'basic',
				),
			)
		);

		$this->add_control(
			'overlay_blend_mode',
			array(
				'label'     => __( 'Blend Mode', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''            => __( 'Normal', 'ocean-elementor-widgets' ),
					'multiply'    => 'Multiply',
					'screen'      => 'Screen',
					'overlay'     => 'Overlay',
					'darken'      => 'Darken',
					'lighten'     => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'color-burn'  => 'Color Burn',
					'hue'         => 'Hue',
					'saturation'  => 'Saturation',
					'color'       => 'Color',
					'exclusion'   => 'Exclusion',
					'luminosity'  => 'Luminosity',
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-cta .oew-cta-bg-overlay' => 'mix-blend-mode: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'basic',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			array(
				'label'     => __( 'Hover', 'ocean-elementor-widgets' ),
				'condition' => array(
					'style!' => 'basic',
				),
			)
		);

		$this->add_control(
			'overlay_color_hover',
			array(
				'label'     => __( 'Overlay Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-cta:hover .oew-cta-bg-overlay' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'style!' => 'basic',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'      => 'bg_filters_hover',
				'selector'  => '{{WRAPPER}} .oew-cta:hover .oew-cta-bg',
				'condition' => array(
					'style!' => 'basic',
				),
			)
		);

		$this->add_control(
			'effect_duration',
			array(
				'label'       => __( 'Transition Duration', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SLIDER,
				'render_type' => 'template',
				'default'     => array(
					'size' => 1500,
				),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 3000,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .oew-cta .oew-cta-bg, {{WRAPPER}} .oew-cta .oew-cta-bg-overlay' => 'transition-duration: {{SIZE}}ms',
				),
				'condition'   => array(
					'style!' => 'basic',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function render_btn_icon() {
		$settings = $this->get_settings_for_display();
		$migrated = isset( $settings['__fa4_migrated']['selected_btn_icon'] );
		$is_new   = empty( $settings['btn_icon'] ) && Icons_Manager::is_migration_allowed();

		if ( $is_new || $migrated ) :
			Icons_Manager::render_icon( $settings['selected_btn_icon'], array( 'aria-hidden' => 'true' ) );
		else : ?>
			<i class="<?php echo esc_attr( $settings['btn_icon'] ); ?>" aria-hidden="true"></i>
			<?php
		endif;
	}

	private function render_secondary_btn_icon() {
		$settings = $this->get_settings_for_display();
		$migrated = isset( $settings['__fa4_migrated']['selected_s_btn_icon'] );
		$is_new   = empty( $settings['s_btn_icon'] ) && Icons_Manager::is_migration_allowed();

		if ( $is_new || $migrated ) :
			Icons_Manager::render_icon( $settings['selected_s_btn_icon'], array( 'aria-hidden' => 'true' ) );
		else :
			?>
			<i class="<?php echo esc_attr( $settings['s_btn_icon'] ); ?>" aria-hidden="true"></i>
			<?php
		endif;
	}

	protected function render() {
		$settings    = $this->get_settings_for_display();
		$bg_image    = '';
		$wrapper_tag = 'div';
		$btn_tag     = 'a';
		$tag         = $settings['title_html_tag'];
		$animation   = $settings['content_animation'];

		$this->add_render_attribute( 'wrapper', 'class', 'oew-cta' );

		if ( ! empty( $settings['bg_image']['id'] ) ) {
			$bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['bg_image']['id'], 'bg_image', $settings );
		} elseif ( ! empty( $settings['bg_image']['url'] ) ) {
			$bg_image = $settings['bg_image']['url'];
		}

		$this->add_render_attribute(
			array(
				'bg_image' => array(
					'class' => 'oew-cta-bg',
					'style' => 'background-image: url(' . $bg_image . ');',
				),
			)
		);

		$this->add_render_attribute(
			'element',
			array(
				'class' => array(
					'oew-cta-item',
					'oew-cta-content',
				),
			)
		);

		if ( 'icon' === $settings['element'] ) {
			$this->add_render_attribute( 'element', 'class', 'oew-cta-icon' );
		} elseif ( 'image' === $settings['element'] && ! empty( $settings['element_image']['url'] ) ) {
			$this->add_render_attribute( 'element', 'class', 'oew-cta-image' );
		}

		$this->add_render_attribute(
			'title',
			array(
				'class' => array(
					'oew-cta-title',
					'oew-cta-content',
				),
			)
		);
		$this->add_inline_editing_attributes( 'title' );

		$this->add_render_attribute(
			'description',
			array(
				'class' => array(
					'oew-cta-description',
					'oew-cta-content',
				),
			)
		);
		$this->add_inline_editing_attributes( 'description' );

		$this->add_render_attribute(
			'btn-wrapper',
			array(
				'class' => array(
					'oew-cta-btn',
					'oew-cta-content',
				),
			)
		);
		$this->add_render_attribute( 'btn', 'class', 'button' );
		$this->add_render_attribute(
			's-btn',
			array(
				'class' => array(
					'button',
					'oew-cta-s-btn',
				),
			)
		);

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$link_element = 'btn';

			if ( 'box' === $settings['link_click'] ) {
				$wrapper_tag  = 'a';
				$btn_tag      = 'span';
				$link_element = 'wrapper';
			}

			$this->add_link_attributes( $link_element, $settings['btn_link'] );
		}

		if ( ! empty( $settings['s_btn_link']['url'] ) ) {
			$this->add_link_attributes( 's-btn', $settings['s_btn_link'] );
		}

		if ( $settings['button_hover_animation'] ) {
			$this->add_render_attribute( 'btn', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
			$this->add_render_attribute( 's-btn', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
		}

		if ( ! empty( $animation ) && 'inside' == $settings['style'] ) {
			$animation_class = 'oew-animated-' . $animation;
			$this->add_render_attribute( 'element', 'class', $animation_class );
			$this->add_render_attribute( 'title', 'class', $animation_class );
			$this->add_render_attribute( 'description', 'class', $animation_class );
			$this->add_render_attribute( 'btn-wrapper', 'class', $animation_class );
		}
		?>

		<<?php echo $wrapper_tag . ' ' . $this->get_render_attribute_string( 'wrapper' ); ?>>

			<?php
			if ( 'basic' != $settings['style']
				&& ! empty( $bg_image ) ) :
				?>
				<div class="oew-cta-bg-wrapper">
					<div <?php echo $this->get_render_attribute_string( 'bg_image' ); ?>></div>
					<?php
					if ( 'yes' === $settings['overlay'] ) :
						?>
						<div class="oew-cta-bg-overlay"></div>
						<?php
					endif;
					?>
				</div>
				<?php
			endif;
			?>

			<div class="oew-cta-inner">
				<?php
				if ( 'image' === $settings['element']
					&& ! empty( $settings['element_image']['url'] ) ) :
					?>
					<div <?php echo $this->get_render_attribute_string( 'element' ); ?>>
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'element_image' ); ?>
					</div>
					<?php
				elseif ( 'icon' === $settings['element']
					&& ( ! empty( $settings['cta_icon'] ) || ! empty( $settings['selected_cta_icon'] ) ) ) :
					$migrated = isset( $settings['__fa4_migrated']['selected_cta_icon'] );
					$is_new   = empty( $settings['cta_icon'] ) && Icons_Manager::is_migration_allowed();
					?>
					<div <?php echo $this->get_render_attribute_string( 'element' ); ?>>
						<div class="oew-icon">
							<?php
							if ( $is_new || $migrated ) :
								Icons_Manager::render_icon( $settings['selected_cta_icon'], array( 'aria-hidden' => 'true' ) );
							else :
								?>
								<i class="<?php echo esc_attr( $settings['cta_icon'] ); ?>" aria-hidden="true"></i>
								<?php
							endif;
							?>
						</div>
					</div>
					<?php
				endif;

				if ( ! empty( $settings['title'] ) ) :
					?>
					<<?php echo $tag . ' ' . $this->get_render_attribute_string( 'title' ); ?>>
						<?php echo $settings['title']; ?>
					</<?php echo $tag; ?>>
					<?php
				endif;

				if ( ! empty( $settings['description'] ) ) :
					?>
					<div <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo $settings['description']; ?></div>
					<?php
				endif;

				if ( ! empty( $settings['btn_link']['url'] ) ) :
					?>
					<div <?php echo $this->get_render_attribute_string( 'btn-wrapper' ); ?>>
						<<?php echo $btn_tag . ' ' . $this->get_render_attribute_string( 'btn' ); ?>>
							<?php
							if ( 'left' == $settings['icon_align']
								&& ( ! empty( $settings['btn_icon'] ) || ! empty( $settings['selected_btn_icon'] ) ) ) :
								$this->render_btn_icon();
							endif;
							?>
							<span><?php echo $settings['btn_text']; ?></span>
							<?php
							if ( 'right' == $settings['icon_align']
								&& ( ! empty( $settings['btn_icon'] ) || ! empty( $settings['selected_btn_icon'] ) ) ) :
								$this->render_btn_icon();
							endif;
							?>
						</<?php echo $btn_tag; ?>>

						<?php
						if ( 'yes' == $settings['secondary_btn']
							&& ! empty( $settings['s_btn_link']['url'] ) ) :
							?>
							<a <?php echo $this->get_render_attribute_string( 's-btn' ); ?>>
								<?php
								if ( 'left' == $settings['s_icon_align']
									&& ( ! empty( $settings['s_btn_icon'] ) || ! empty( $settings['selected_s_btn_icon'] ) ) ) :
									$this->render_secondary_btn_icon();
								endif;
								?>
								<span><?php echo $settings['s_btn_text']; ?></span>
								<?php
								if ( 'right' == $settings['s_icon_align']
									&& ( ! empty( $settings['s_btn_icon'] ) || ! empty( $settings['selected_s_btn_icon'] ) ) ) :
									$this->render_secondary_btn_icon();
								endif;
								?>
							</a>
							<?php
						endif;
						?>
					</div>
					<?php
				endif;
				?>
			</div>
		</<?php echo $wrapper_tag; ?>>

		<?php
	}
}
