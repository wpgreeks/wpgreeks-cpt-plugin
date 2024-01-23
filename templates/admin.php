<div class="wrap">
	<h1 class="wrap-title">WPGreeks CPT Plugin</h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Manage Settings</a></li>
		<li><a href="#tab-2">Updates</a></li>
		<li><a href="#tab-3">About</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">

			<form method="post" action="options.php">
				<?php 
					settings_fields( 'wpgreeks_plugin_settings' );
					do_settings_sections( 'wpgreeks_plugin' );
					submit_button();
				?>
			</form>
			
		</div>

		<div id="tab-2" class="tab-pane">
			<h1>WPGreeks CPT 1.0.0</h1>
			<P>Thank you for choosing WPGreeks CPT! We hope that your experience with our plugin makes creating post types and organizing your content quick and easy.</P>
		</div>

		<div id="tab-3" class="tab-pane">
			<h1>About WPGreeks CPT</h1>
			<p>Enhance the functionality of your WordPress website with WPGreeks CPT (Custom Post Types), a powerful and versatile plugin designed to streamline content management. Whether you're a blogger, business owner, or developer, WPGreeks CPT empowers you to create custom post types effortlessly, tailoring your website's structure to meet your unique needs. Also transform your WordPress admin dashboard into a visually stunning and highly functional workspace.</p>

			<p><strong>Key Features:</strong></p>
			<ol>
				<li><strong>Custom Post Types Made Simple:</strong> With WPGreeks CPT, you can easily create and manage custom post types without delving into complex coding. Effortlessly organize your content, making it more structured and user-friendly.</li>

				<li><strong>Flexible Content Management:</strong> Take control of your website's content by defining custom post types for various content elements. Whether it's portfolios, testimonials, events, or any other content, WPGreeks CPT provides the flexibility you need.</li>

				<li><strong>Intuitive Interface:</strong> Our user-friendly interface ensures that creating and managing custom post types is a breeze. No technical expertise required – WPGreeks CPT simplifies the process for beginners and experts alike.</li>

				<li><strong>Template Support:</strong> Customize the display of your custom post types by utilizing templates. WPGreeks CPT seamlessly integrates with your theme, allowing you to present your content in a visually appealing and cohesive manner.</li>

				<li><strong>SEO-Friendly:</strong> Ensure your content gets the visibility it deserves with WPGreeks CPT's SEO-friendly features. Optimize each custom post type for search engines and enhance your website's discoverability.</li>

				<li><strong>Import functionality:</strong> You can easily import the custom post types code that's you created.</li>

				<li><strong>Modern Design:</strong> Say goodbye to a dull admin dashboard! Admin Dashboard UI brings a modern and visually appealing design to your WordPress backend, providing a more enjoyable and efficient user experience.</li>

				<li><strong>Responsive Design:</strong> Whether you're managing your site from a desktop or a mobile device, Admin Dashboard UI ensures a seamless and responsive experience, adapting to different screen sizes effortlessly.</li>
			</ol>

			<p>Empower your WordPress website with WPGreeks CPT and unlock a new level of content management. Download the plugin now and start creating a more organized and tailored online experience for your audience.</p>
		</div>
	</div>
</div>