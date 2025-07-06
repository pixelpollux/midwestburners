<?php // phpcs:disable

/**
 * Plugin class for Matchbox Blocks.
 *
 * @since 1.0.0
 *
 * @package MatchboxBlocks
 */

namespace Matchbox;

/**
 * Main plugin class.
 *
 * @since 1.0.0
 *
 * @package MatchboxBlocks
 */
class Plugin {
	/**
	 * Reference to the Assets manager.
	 *
	 * @var Assets
	 */
	private $assets;

	/**
	 * Constructor to initialize the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		// Copy native render templates into build/ if needed
		$this->copy_render_templates();

		// Load helpers
		require_once plugin_dir_path( dirname( __DIR__ ) ) . 'src/acf-blocks.php';

		// Continue init
		$this->init_hooks();
		$this->assets = new Assets();
		$this->assets->init();
	}

	/**
	 * Initialize WordPress hooks.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	private function init_hooks() {
		add_action( 'init', [ $this, 'register_blocks' ] );
		add_action( 'acf/init', [ $this, 'register_acf_blocks' ] );
	}

	/**
	 * Register all blocks defined in the build/blocks directory.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_blocks() {
		$block_folders = glob( plugin_dir_path( dirname( __DIR__ ) ) . 'build/blocks/*', GLOB_ONLYDIR );

		foreach ( $block_folders as $block_folder ) {
			$block_json_path = $block_folder . '/block.json';

			if ( file_exists( $block_json_path ) ) {
				$block_json = json_decode( file_get_contents( $block_json_path ), true );

				if ( isset( $block_json['acf'] ) && is_array( $block_json['acf'] ) ) {
					continue;
				}

				// Check if render.php exists
				$render_path = $block_folder . '/render.php';
				if ( file_exists( $render_path ) ) {
					// Include the render file
					include_once $render_path;

					// Register block with explicit render callback
					$block_args = $block_json;

					// For report-button block, set the render callback
					if ( $block_json['name'] === 'kindling/report-button' ) {
						$block_args['render_callback'] = 'kindling_render_report_button_block';
					}

					// For test-button block, set the render callback
					if ( $block_json['name'] === 'kindling/dynamic-button' ) {
						$block_args['render_callback'] = 'kindling_dynamic_button_render';
					}

					register_block_type( $block_folder, $block_args );
				} else {
					register_block_type( $block_folder );
				}
			}
		}
	}

	public function register_acf_blocks() {
		$block_folders = glob( plugin_dir_path( dirname( __DIR__ ) ) . 'build/blocks/*', GLOB_ONLYDIR );

		foreach ( $block_folders as $block_folder ) {
			$block_json_path = $block_folder . '/block.json';

			if ( file_exists( $block_json_path ) ) {
				$block_json = json_decode( file_get_contents( $block_json_path ), true );

				if ( isset( $block_json['acf'] ) && is_array( $block_json['acf'] ) ) {
					$acf_args = array_merge(
						$block_json,
						$block_json['acf'],
						[
							'render_template' => $block_folder . '/' . $block_json['acf']['renderTemplate'],
						]
					);

					unset( $acf_args['acf'] );

					if ( function_exists( 'acf_register_block_type' ) && ! acf_get_block_type( $acf_args['name'] ) ) {
						// error_log( 'Matchbox ACF Block: Registering ' . $acf_args['name'] );
						acf_register_block_type( $acf_args );
					}
				}
			}
		}
	}

	private function copy_render_templates() {
		$src_blocks_path = plugin_dir_path( dirname( __DIR__ ) ) . 'src/blocks/';
		$build_blocks_path = plugin_dir_path( dirname( __DIR__ ) ) . 'build/blocks/';

		foreach ( glob( $src_blocks_path . '*' , GLOB_ONLYDIR ) as $src_folder ) {
			$slug = basename( $src_folder );

			// Copy render.php files for all blocks (native and ACF)
			$src = "{$src_folder}/render.php";
			$dst = "{$build_blocks_path}{$slug}/render.php";
			if ( file_exists( $src ) ) {
				if ( ! file_exists( dirname( $dst ) ) ) {
					mkdir( dirname( $dst ), 0755, true );
				}
				copy( $src, $dst );
			}
		}
	}

	/**
	 * Code to run on plugin activation.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function activate() {
		// Code to run on plugin activation.
	}

	/**
	 * Code to run on plugin deactivation.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function deactivate() {
		// Code to run on plugin deactivation.
	}
}
