<?php 

/**
 * @package  WPGreeksCPT
 */

namespace Inc\Api\Widgets;

use WP_Widget;

class WpgreeksWidget extends WP_Widget
{
	public $widget_ID;
	public $widget_name;
	public $widget_options = array();
	public $control_options = array();

	function __construct() {

		$this->widget_ID = 'wpgreeks_widget';
		$this->widget_name = 'WPGreeks Widget';

		$this->widget_options = array(
			'classname' => $this->widget_ID,
			'description' => $this->widget_name,
			'customize_selective_refresh' => true,
		);

		$this->control_options = array(
			'width' => 400,
			'height' => 350,
		);
	}

	public function register()
	{
		parent::__construct( $this->widget_ID, $this->widget_name, $this->widget_options, $this->control_options );

		add_action( 'widgets_init', array( $this, 'widgetsInit' ) );
	}

	public function widgetsInit()
	{
		register_widget( $this );
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		if ( ! empty( $instance['description'] ) ) {
			echo "<p class='widget-description'>".$instance['description']."</p>";
		}
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$description = ! empty( $instance['description'] ) ? $instance['description'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'wpgreeks_widgets_text' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_attr_e( 'Description:', 'wpgreeks_widgets_text' ); ?></label> 
			<textarea class="widget-textarea" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_attr( $description ); ?></textarea>
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['description'] = sanitize_textarea_field( $new_instance['description'] );

		return $instance;
	}
}