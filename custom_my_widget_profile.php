<?php
/* profile */
class Custom_My_Widget_Profile extends WP_Widget {

	public function __construct() {
		$widget_options = array(
			'classname'                     => 'widget-profile',
			'customize_selective_refresh'   => FALSE,
		);

		parent::__construct( 'widget-profile', 'プロフィール', $widget_options );
	}

	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */


		$name = apply_filters( 'widget_body', empty( $instance['name'] ) ? '' : $instance['name'], $instance, $this->id_base );
		$job = apply_filters( 'widget_text', empty( $instance['job'] ) ? '' : $instance['job'], $instance, $this->id_base );
		$desc = apply_filters( 'widget_text', empty( $instance['desc'] ) ? '' : $instance['desc'], $instance, $this->id_base );
		$sns = apply_filters( 'widget_text', empty( $instance['sns'] ) ? '' : $instance['sns'], $instance, $this->id_base );
		$cps_ranking01_img = apply_filters( 'widget_body', empty( $instance['cps_ranking01_img'] ) ? '' : $instance['cps_ranking01_img'], $instance, $this->id_base );
		$cps_ranking01_img_check = apply_filters( 'widget_body', empty( $instance['cps_ranking01_img_check'] ) ? '' : $instance['cps_ranking01_img_check'], $instance, $this->id_base );

		$myprofile_id = get_id_by_post_name('profile');
		$myprofile_url = get_the_permalink($myprofile_id);

		echo $args['before_widget'];
?>
		<div class="my-profile">
			<div class="myjob"><?php echo $job; ?></div>
			<div class="myname"><?php echo $name; ?></div>
			<div class="my-profile-thumb">
				<a href="<?php echo $myprofile_url; ?>"><img width="150" height="150" loading="lazy" src="<?php echo $cps_ranking01_img; ?>" /></a>
			</div>
			<div class="myintro"><?php echo $desc; ?></div>
			<?php if( $sns == '表示' ) :?>
			<div class="profile-sns-menu">
				<div class="profile-sns-menu-title ef">＼ Follow me ／</div>
				<ul>
					<?php if ( get_option('tw_page_url') ): ?>
					<li class="pro-tw"><a href="<?php echo get_option('tw_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-twitter"></i></a></li>
					<?php endif; ?>
					<?php if ( get_option('fb_page_url') ): ?>
					<li class="pro-fb"><a href="<?php echo get_option('fb_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-facebook" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if ( get_option('insta_page_url') ): ?>
					<li class="pro-insta"><a href="<?php echo get_option('insta_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-instagram" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if ( get_option('youtube_page_url') ): ?>
					<li class="pro-youtube"><a href="<?php echo get_option('youtube_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-youtube" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if ( get_option('line_page_url') ): ?>
					<li class="pro-line"><a href="<?php echo get_option('line_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-line" aria-hidden="true"></i></a></li>
					<?php endif; ?>
					<?php if ( get_option('contact_page_url') ): ?>
					<li class="pro-contact"><a href="<?php echo get_option('contact_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-mail" aria-hidden="true"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
			<style type="text/css">
				.my-profile{
					<?php if( is_mobile() ): ?>
					padding-bottom: 105px;
					<?php else: ?>
					padding-bottom: 85px;
					<?php endif; ?>
				}
			</style>
			<?php endif; ?>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {

		$name  = isset( $instance['name'] ) ? $instance['name'] : '';
		$job  = isset( $instance['job'] ) ? $instance['job'] : '';
		$desc = isset( $instance['desc'] ) ? $instance['desc'] : '';
		$sns = isset( $instance['sns'] ) ? $instance['sns'] : '表示';
		$cps_ranking01_img = isset( $instance['cps_ranking01_img'] ) ? $instance['cps_ranking01_img'] : '';
		$cps_ranking01_img_check = isset( $instance['cps_ranking01_img_check'] ) ? $instance['cps_ranking01_img_check'] : '';

		wp_enqueue_media(); // メディアアップローダー用のスクリプトをロードする

		// カスタムメディアアップローダー用のJavaScript
		wp_enqueue_script(
			'my-media-uploader', get_bloginfo( 'template_directory' ) . '/js/cps-media-uploader.js', array('jquery'), false, false
		);
		?>
		<style type="text/css">
			#media{
				margin-top: 10px;
			}
			#media1 img{
				max-width: 100%;
				height: auto;
				display: block;
			}
			input, button, textarea, select {
				-webkit-appearance: none;
				-moz-appearance: none;
				appearance: none;
				cursor: pointer;
			}
			input[type="button"]{
				padding: 10px;
				font-size: 12px;
				background: #eee;
				border: 3px #aaa solid;
			}
		</style>

		<input class="widefat cps-ranking01" id="<?php echo $this->get_field_id('cps_ranking01_img'); ?>" name="<?php echo $this->get_field_name('cps_ranking01_img'); ?>" type="hidden" value="<?php echo esc_attr($cps_ranking01_img); ?>" />

		<p>
            <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'プロフィール名' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id( 'job' ); ?>"><?php _e( '肩書き' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'job' ); ?>" name="<?php echo $this->get_field_name( 'job' ); ?>" type="text" value="<?php echo esc_attr( $job ); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( '説明' ); ?></label>
            <textarea rows="6" cols="10" class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" type="text"><?php echo esc_attr( $desc ); ?></textarea>
        </p>
		<div id="media1"><?php echo '<img src="'.$cps_ranking01_img.'" />' ?></div>
		<div style="margin-top: 10px">
			<input type="button" widgetid="<?php echo $this->id ?>" name="media1" value="画像を選択" />
			<input type="button" widgetid="<?php echo $this->id ?>" name="media1-clear" value="画像をクリア" />
		</div>
		<div style="margin-top: 10px; background: #eee; padding: 5px;">
		<input class="widefat cps-ranking01-check" id="<?php echo $this->get_field_id('cps_ranking01_img_check'); ?>" name="<?php echo $this->get_field_name('cps_ranking01_img_check'); ?>" type="checkbox" checked value="ok" />この画像で確定</div>

<?php

        $f_radio_id   = $this->get_field_id('sns');
        $f_radio_name = $this->get_field_name('sns');
        $mess_radio = 'SNSボタン';

        $data = array(
         array("表示","表示",""),
         array("非表示","非表示","checked"),
         );

        echo <<<EOS
             <p>
              <label for="{$f_radio_id}">{$mess_radio}<br />
EOS;
        foreach($data as $akey=>$d){
        if(isset($instance['sns'])){
			$d[2]= $instance['sns'] ? checked( $instance['sns'], $d[1] ,false) : $d[2];
		}
        echo <<<EOS
        <label for ="{$f_radio_id}_{$akey}" >
        <input type="radio" name="{$f_radio_name}" id="{$f_radio_id}_{$akey}" value="{$d[1]}" {$d[2]}>{$d[0]}
        </label>　
EOS;
    }
       echo <<<EOS
    </p>
EOS;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['name']  = sanitize_text_field( $new_instance['name'] );
		$instance['job']  = sanitize_text_field( $new_instance['job'] );
		$instance['desc']  = $new_instance['desc'];
		$instance['sns']  = $new_instance['sns'];
		$instance['cps_ranking01_img']  = $new_instance['cps_ranking01_img'];
		$instance['cps_ranking01_img_check']  = $new_instance['cps_ranking01_img_check'];

		return $instance;
	}

}
