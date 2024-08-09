<?php
namespace owpElementor\Modules\Pricing\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pricing extends Widget_Base {

	public function get_name() {
		return 'oew-pricing';
	}

	public function get_title() {
		return __( 'Price Table', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-price-table';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'price',
			'table',
			'price table',
			'pricing table',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-pricing' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_pricing',
			array(
				'label' => __( 'Price Table', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'featured',
			array(
				'label'   => __( 'Featured', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => array(
					'no'  => __( 'No', 'ocean-elementor-widgets' ),
					'yes' => __( 'Yes', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'plan',
			array(
				'label'       => __( 'Plan', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Standard', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'cost',
			array(
				'label'       => __( 'Cost', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '$29',
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'per',
			array(
				'label'       => __( 'Per', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => __( 'Features', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => '<ul>
							<li>1 Website</li>
							<li class="oew-even">20GB Disk Space</li>
							<li>SSD Included FREE</li>
							<li class="oew-even">E-Commerce Ready</li>
							<li>Unlimited Bandwidth</li>
						</ul>',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'button_url',
			array(
				'label'       => __( 'Button URL', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'default'     => array(
					'url' => '#',
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'       => __( 'Button Text', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Subscribe Now', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'button_icon',
			array(
				'label'       => __( 'Button Icon', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value'   => '',
					'library' => 'fa-solid',
				),
			)
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_plan',
			array(
				'label' => __( 'Plan', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'plan_background',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-header' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'plan_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-header' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'plan_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'plan_border',
				'label'       => __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-pricing-header',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'plan_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-header',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cost',
			array(
				'label' => __( 'Cost', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'cost_background',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-cost' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cost_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-cost .oew-pricing-amount' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cost_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-cost' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'cost_border',
				'label'       => __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-pricing-cost',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cost_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-cost .oew-pricing-amount',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_per',
			array(
				'label' => __( 'Per', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'per_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-per' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'per_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-per',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features',
			array(
				'label' => __( 'Features', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'features_bg',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-content' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'features_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'features_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'features_border',
				'label'       => __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-pricing-content',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-content',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			array(
				'label' => __( 'Button', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'wrap_button_bg',
			array(
				'label'     => __( 'Wrap Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wrap_button_padding',
			array(
				'label'      => __( 'Wrap Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'wrap_button_border',
				'label'       => __( 'Wrap Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-pricing-button',
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
			'button_bg',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-button .button' => 'background-color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-button .button' => 'color: {{VALUE}};',
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
			'button_hover_bg',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-button .button:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-button .button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-button .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-button .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-button .button',
			)
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_button_icon_style',
			array(
				'label' => __( 'Button Icon', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'button_icon_color',
			array(
				'label'     => __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing .elementor-button-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-pricing .elementor-button-icon svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'icon_spacing',
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
					'{{WRAPPER}} .oew-pricing .elementor-button-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
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
						'min' => 6,
						'max' => 300,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing .elementor-button-icon' => 'font-size: {{SIZE}}{{UNIT}};line-height: 20px;',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Vars
		$plan     = $settings['plan'];
		$cost     = $settings['cost'];
		$per      = $settings['per'];
		$content  = $settings['content'];
		$btn_url  = $settings['button_url']['url'];
		$btn_text = $settings['button_text'];

		// Wrapper classes
		$featured_class = '';
		if ( 'yes' == $settings['featured'] ) {
			$featured_class = ' featured';
		}

		// Button target
		if ( ! empty( $settings['button_url']['is_external'] ) ) {
			$btn_target = 'blank';
		} else {
			$btn_target = 'self';
		}

		if ( ! empty( $settings['button_icon'] ) ) {
			$this->add_render_attribute(
				'icon',
				'class',
				array(
					'elementor-button-icon',
				)
			);
		}

		?>

		<div class="oew-pricing clr<?php echo esc_attr( $featured_class ); ?>">

			<?php
			// Display plan
			if ( $plan ) {
				?>

				<div class="oew-pricing-header clr"><?php echo do_shortcode( $plan ); ?></div>

			<?php } ?>

			<?php
			// Display cost
			if ( $cost ) {
				?>

				<div class="oew-pricing-cost clr">

					<div class="oew-pricing-amount"><?php echo esc_attr( $cost ); ?></div>

					<?php if ( $per ) { ?>
						<div class="oew-pricing-per"><?php echo esc_attr( $per ); ?></div>
					<?php } ?>

				</div>

			<?php } ?>

			<?php
			// Display content
			if ( $content ) {
				?>

				<div class="oew-pricing-content clr"><?php echo do_shortcode( $content ); ?></div>

			<?php } ?>

			<?php
			// Display button
			if ( $btn_url ) {
				?>

				<div class="oew-pricing-button clr">



				<a href="<?php echo esc_url( $btn_url ); ?>" title="<?php echo esc_attr( $btn_text ); ?>" class="button" target="_<?php echo esc_attr( $btn_target ); ?>">
					<?php
					if ( ! empty( $settings['button_icon'] ) && ! empty( $settings['button_icon']['value'] ) ) {
						$icon_data = $settings['button_icon'];
						if ( isset( $icon_data['library'], $icon_data['value'] ) && ! empty( $icon_data['library'] ) && ! empty( $icon_data['value'] ) ) {
							?>
							<span <?php echo $this->get_render_attribute_string( 'icon' ); ?>>
								<?php Icons_Manager::render_icon( $settings['button_icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</span>
							<?php
						}
					}
					?>
					<?php echo esc_attr( $btn_text ); ?>
				</a>

				</div>

			<?php } ?>

		</div><!-- .oew-pricing -->

		<?php
	}

}
