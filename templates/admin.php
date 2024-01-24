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
			<P>Thank you for choosing WPGreeks CPT! We hope that your experience with our plugin makes creating post types and organizing your content quick and easy.</P>
			<h1>=== Changelogs ===</h1>
			<h2>1.0.0 Jan.24.2024</h2>
			<ul>
				<li>First initial release of plugin:</li>
			</ul>

			<h2>1.1.0 Jan.24.2024</h2>
			<ul>
				<li>New. Enhance content categorization with custom taxonomies</li>
				<li>New. Modern Design UI for Admin Dashboard</li>
				<li>Added. Menu Icon Parameter for post types.</li>
				<li>Added. Publicly Queryable Parameter for post types.</li>
				<li>Added. Fields Description for understand the means of fields for post types.</li>
				<li>Fix. Restricted edit the Post Type Slug</li>
				<li>Updated: readme descriptions and screenshots.</li>
			</ul>
		</div>

		<div id="tab-3" class="tab-pane">
			<h1>About WPGreeks CPT</h1>
			<p>Take control of your WordPress content management with WPGreeks CPT, a feature-packed plugin that redefines how you structure and present your website content. WPGreeks CPT empowers you with these functionalities: Custom Post Types, Custom Taxonomies, and a Modern Design UI for the admin dashboard. Whether you're a blogger, business owner, or developer, WPGreeks CPT empowers you to create custom post types, custom taxonomies effortlessly, tailoring your website's structure to meet your unique needs.</p>

			<p><strong>Key Features:</strong></p>
			<ol>
			<li><strong>Custom Post Types:</strong> WPGreeks CPT simplifies the creation and management of custom post types, allowing you to organize your content in a way that best suits your website's unique needs. Tailor your posts for portfolios, testimonials, events, and more with ease.</li>

			<li><strong>Custom Taxonomies:</strong> Enhance content categorization with custom taxonomies. WPGreeks CPT enables you to create and manage taxonomies specific to your content, ensuring a more granular and efficient way to organize and filter information.</li>

			<li><strong>Modern Design UI:</strong> Elevate your admin dashboard experience with a modern and visually appealing user interface. WPGreeks CPT not only enhances the functionality of your WordPress backend but also provides an aesthetically pleasing environment for effortless content management.</li>

			<li><strong>Intuitive Content Organization:</strong> The plugin's user-friendly interface ensures that even complex content structures are easy to manage. With clear navigation and intuitive controls, you can efficiently create, edit, and organize your custom post types and taxonomies.</li>

			<li><strong>Template Support:</strong> Customize the display of your custom post types with seamless template integration. WPGreeks CPT ensures that your content not only functions well but also looks stunning, maintaining consistency with your website's design.</li>

			<li><strong>Import functionality:</strong> You can easily import the custom post types code that's you created by our plugin.</li>

			<li><strong>Developer-Friendly:</strong> For developers, WPGreeks CPT offers extensibility through hooks and filters, allowing for further customization and integration with other plugins or themes.</li>
			</ol>

			<p>Empower your WordPress website with WPGreeks CPT and unlock a new level of content management. Download the plugin now and start creating a more organized and tailored online experience for your audience.</p>
		</div>
	</div>
</div>