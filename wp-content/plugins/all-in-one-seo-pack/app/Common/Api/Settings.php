<?php
namespace AIOSEO\Plugin\Common\Api;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use AIOSEO\Plugin\Common\Models;
use AIOSEO\Plugin\Common\Migration;

/**
 * Route class for the API.
 *
 * @since 4.0.0
 */
class Settings {
	/**
	 * Contents to import.
	 *
	 * @since 4.7.2
	 *
	 * @var array
	 */
	public static $importFile = [];

	/**
	 * Update the settings.
	 *
	 * @since 4.0.0
	 *
	 * @return \WP_REST_Response The response.
	 */
	public static function getOptions() {
		return new \WP_REST_Response( [
			'options'  => aioseo()->options->all(),
			'settings' => aioseo()->settings->all()
		], 200 );
	}

	/**
	 * Toggles a card in the settings.
	 *
	 * @since 4.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function toggleCard( $request ) {
		$body  = $request->get_json_params();
		$card  = ! empty( $body['card'] ) ? sanitize_text_field( $body['card'] ) : null;
		$cards = aioseo()->settings->toggledCards;
		if ( array_key_exists( $card, $cards ) ) {
			$cards[ $card ] = ! $cards[ $card ];
			aioseo()->settings->toggledCards = $cards;
		}

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Toggles a radio in the settings.
	 *
	 * @since 4.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function toggleRadio( $request ) {
		$body   = $request->get_json_params();
		$radio  = ! empty( $body['radio'] ) ? sanitize_text_field( $body['radio'] ) : null;
		$value  = ! empty( $body['value'] ) ? sanitize_text_field( $body['value'] ) : null;
		$radios = aioseo()->settings->toggledRadio;
		if ( array_key_exists( $radio, $radios ) ) {
			$radios[ $radio ] = $value;
			aioseo()->settings->toggledRadio = $radios;
		}

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Dismisses an alert.
	 *
	 * @since 4.3.6
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function dismissAlert( $request ) {
		$body   = $request->get_json_params();
		$alert  = ! empty( $body['alert'] ) ? sanitize_text_field( $body['alert'] ) : null;
		$alerts = aioseo()->settings->dismissedAlerts;
		if ( array_key_exists( $alert, $alerts ) ) {
			$alerts[ $alert ] = true;
			aioseo()->settings->dismissedAlerts = $alerts;
		}

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Toggles a table's items per page setting.
	 *
	 * @since 4.2.5
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function changeItemsPerPage( $request ) {
		$body   = $request->get_json_params();
		$table  = ! empty( $body['table'] ) ? sanitize_text_field( $body['table'] ) : null;
		$value  = ! empty( $body['value'] ) ? intval( $body['value'] ) : null;
		$tables = aioseo()->settings->tablePagination;
		if ( array_key_exists( $table, $tables ) ) {
			$tables[ $table ] = $value;
			aioseo()->settings->tablePagination = $tables;
		}

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Dismisses the upgrade bar.
	 *
	 * @since 4.0.0
	 *
	 * @return \WP_REST_Response The response.
	 */
	public static function hideUpgradeBar() {
		aioseo()->settings->showUpgradeBar = false;

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Hides the Setup Wizard CTA.
	 *
	 * @since 4.0.0
	 *
	 * @return \WP_REST_Response The response.
	 */
	public static function hideSetupWizard() {
		aioseo()->settings->showSetupWizard = false;

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Save options from the front end.
	 *
	 * @since 4.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function saveChanges( $request ) {
		$body           = $request->get_json_params();
		$options        = ! empty( $body['options'] ) ? $body['options'] : [];
		$dynamicOptions = ! empty( $body['dynamicOptions'] ) ? $body['dynamicOptions'] : [];
		$network        = ! empty( $body['network'] ) ? (bool) $body['network'] : false;
		$networkOptions = ! empty( $body['networkOptions'] ) ? $body['networkOptions'] : [];

		// If this is the network admin, reset the options.
		if ( $network ) {
			aioseo()->networkOptions->sanitizeAndSave( $networkOptions );
		} else {
			aioseo()->options->sanitizeAndSave( $options );
			aioseo()->dynamicOptions->sanitizeAndSave( $dynamicOptions );
		}

		// Re-initialize notices.
		aioseo()->notices->init();

		return new \WP_REST_Response( [
			'success'       => true,
			'notifications' => Models\Notification::getNotifications()
		], 200 );
	}

	/**
	 * Reset settings.
	 *
	 * @since 4.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function resetSettings( $request ) {
		$body     = $request->get_json_params();
		$settings = ! empty( $body['settings'] ) ? $body['settings'] : [];

		$notAllowedOptions = aioseo()->access->getNotAllowedOptions();

		foreach ( $settings as $setting ) {
			$optionAccess = in_array( $setting, [ 'robots', 'blocker' ], true ) ? 'tools' : $setting;

			if ( in_array( $optionAccess, $notAllowedOptions, true ) ) {
				continue;
			}

			switch ( $setting ) {
				case 'robots':
					aioseo()->options->tools->robots->reset();
					break;
				case 'blocker':
					aioseo()->options->deprecated->tools->blocker->reset();
					break;
				default:
					if ( aioseo()->options->has( $setting ) ) {
						aioseo()->options->$setting->reset();
					}
					if ( aioseo()->dynamicOptions->has( $setting ) ) {
						aioseo()->dynamicOptions->$setting->reset();
					}
			}

			if ( 'access-control' === $setting ) {
				aioseo()->access->addCapabilities();
			}
		}

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Import settings from external file.
	 *
	 * @since 4.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request.
	 * @return \WP_REST_Response          The response.
	 */
	public static function importSettings( $request ) {
		$file        = $request->get_file_params()['file'];
		$isJSONFile  = 'application/json' === $file['type'];
		$isCSVFile   = 'text/csv' === $file['type'];
		$isOctetFile = 'application/octet-stream' === $file['type'];
		if (
			empty( $file['tmp_name'] ) ||
			empty( $file['type'] ) ||
			(
				! $isJSONFile &&
				! $isCSVFile &&
				! $isOctetFile
			)
		) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		$contents = aioseo()->core->fs->getContents( $file['tmp_name'] );
		if ( empty( $contents ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		if ( $isJSONFile ) {
			self::$importFile = json_decode( $contents, true );
		}

		if ( $isCSVFile ) {
			// Transform the CSV content into the original JSON array.
			self::$importFile = self::prepareCsvImport( $contents );
		}

		// If the file is invalid just return.
		if ( empty( self::$importFile ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		// Import settings.
		if ( ! empty( self::$importFile['settings'] ) ) {
			self::importSettingsFromFile( self::$importFile['settings'] );
		}

		// Import posts.
		if ( ! empty( self::$importFile['postOptions'] ) ) {
			self::importPostsFromFile( self::$importFile['postOptions'] );
		}

		// Import INI.
		if ( $isOctetFile ) {
			$response = aioseo()->importExport->importIniData( self::$importFile );
			if ( ! $response ) {
				return new \WP_REST_Response( [
					'success' => false
				], 400 );
			}
		}

		return new \WP_REST_Response( [
			'success' => true,
			'options' => aioseo()->options->all()
		], 200 );
	}

	/**
	 * Import settings from a file.
	 *
	 * @since 4.7.2
	 *
	 * @param array $settings The data to import.
	 */
	private static function importSettingsFromFile( $settings ) {
		// Clean up the array removing options the user should not manage.
		$notAllowedOptions = aioseo()->access->getNotAllowedOptions();
		$settings          = array_diff_key( $settings, $notAllowedOptions );
		if ( ! empty( $settings['deprecated'] ) ) {
			$settings['deprecated'] = array_diff_key( $settings['deprecated'], $notAllowedOptions );
		}

		// Remove any dynamic options and save them separately since this has been refactored.
		$commonDynamic = [
			'sitemap',
			'searchAppearance',
			'breadcrumbs',
			'accessControl'
		];

		foreach ( $commonDynamic as $cd ) {
			if ( ! empty( $settings[ $cd ]['dynamic'] ) ) {
				$settings['dynamic'][ $cd ] = $settings[ $cd ]['dynamic'];
				unset( $settings[ $cd ]['dynamic'] );
			}
		}

		// These options have a very different structure so we'll do them separately.
		if ( ! empty( $settings['social']['facebook']['general']['dynamic'] ) ) {
			$settings['dynamic']['social']['facebook']['general'] = $settings['social']['facebook']['general']['dynamic'];
			unset( $settings['social']['facebook']['general']['dynamic'] );
		}

		if ( ! empty( $settings['dynamic'] ) ) {
			aioseo()->dynamicOptions->sanitizeAndSave( $settings['dynamic'] );
			unset( $settings['dynamic'] );
		}

		aioseo()->options->sanitizeAndSave( $settings );
	}

	/**
	 * Import posts from a file.
	 *
	 * @since 4.7.2
	 *
	 * @param array $postOptions The data to import.
	 */
	private static function importPostsFromFile( $postOptions ) {
		$notAllowedFields = aioseo()->access->getNotAllowedPageFields();

		foreach ( $postOptions as $postData ) {
			if ( ! empty( $postData['posts'] ) ) {
				foreach ( $postData['posts'] as $post ) {
					unset( $post['id'] );
					// Clean up the array removing fields the user should not manage.
					$post    = array_diff_key( $post, $notAllowedFields );
					$thePost = Models\Post::getPost( $post['post_id'] );
					$thePost->set( $post );
					$thePost->save();
				}
			}
		}
	}

	/**
	 * Prepare the content from CSV to the original JSON array to import.
	 *
	 * @since 4.7.2
	 *
	 * @param  string $fileContent The Data to import.
	 * @return array               The content.
	 */
	public static function prepareCSVImport( $fileContent ) {
		$content    = [];
		$newContent = [
			'postOptions' => null
		];

		$rows = str_getcsv( $fileContent, "\n" );

		// Get the first row to check if the file has post_id or term_id.
		$header = str_getcsv( $rows[0], ',' );
		$header = aioseo()->helpers->sanitizeOption( $header );

		// Check if the file has post_id or term_id.
		$type = in_array( 'post_id', $header, true ) ? 'posts' : null;
		$type = in_array( 'term_id', $header, true ) ? 'terms' : $type;

		if ( ! $type ) {
			return false;
		}

		// Remove header row.
		unset( $rows[0] );

		$jsonFields = [
			'keywords',
			'keyphrases',
			'page_analysis',
			'primary_term',
			'og_article_tags',
			'schema',
			'options',
			'open_ai',
			'videos'
		];

		foreach ( $rows as $row ) {
			$row = str_replace( '\\""', '\\"', $row );
			$row = str_getcsv( $row, ',' );

			foreach ( $row as $key => $value ) {
				$key = aioseo()->helpers->sanitizeOption( $key );

				if ( ! empty( $value ) && in_array( $header[ $key ], $jsonFields, true ) && ! aioseo()->helpers->isJsonString( $value ) ) {
					return false;
				}

				$content[ $header [ $key ] ] = $value;
			}
			$newContent['postOptions']['content'][ $type ][] = $content;
		}

		return $newContent;
	}

	/**
	 * Export settings.
	 *
	 * @since 4.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function exportSettings( $request ) {
		$body        = $request->get_json_params();
		$settings    = ! empty( $body['settings'] ) ? $body['settings'] : [];
		$allSettings = [
			'settings' => []
		];

		if ( empty( $settings ) ) {
			return new \WP_REST_Response( [
				'success' => false
			], 400 );
		}

		$options           = aioseo()->options->noConflict();
		$dynamicOptions    = aioseo()->dynamicOptions->noConflict();
		$notAllowedOptions = aioseo()->access->getNotAllowedOptions();
		foreach ( $settings as $setting ) {
			$optionAccess = in_array( $setting, [ 'robots', 'blocker' ], true ) ? 'tools' : $setting;

			if ( in_array( $optionAccess, $notAllowedOptions, true ) ) {
				continue;
			}

			switch ( $setting ) {
				case 'robots':
					$allSettings['settings']['tools']['robots'] = $options->tools->robots->all();
					break;
				default:
					if ( $options->has( $setting ) ) {
						$allSettings['settings'][ $setting ] = $options->$setting->all();
					}

					// If there are related dynamic settings, let's include them.
					if ( $dynamicOptions->has( $setting ) ) {
						$allSettings['settings']['dynamic'][ $setting ] = $dynamicOptions->$setting->all();
					}

					// It there is a related deprecated $setting, include it.
					if ( $options->deprecated->has( $setting ) ) {
						$allSettings['settings']['deprecated'][ $setting ] = $options->deprecated->$setting->all();
					}
					break;
			}
		}

		return new \WP_REST_Response( [
			'success'  => true,
			'settings' => $allSettings
		], 200 );
	}

	/**
	 * Export post data.
	 *
	 * @since 4.7.2
	 *
	 * @param  \WP_REST_Request  $request The REST Request.
	 * @return \WP_REST_Response          The response.
	 */
	public static function exportContent( $request ) {
		$body            = $request->get_json_params();
		$postOptions     = $body['postOptions'] ?? [];
		$typeFile        = $body['typeFile'] ?? false;
		$siteId          = (int) ( $body['siteId'] ?? get_current_blog_id() );
		$contentPostType = null;
		$return          = true;

		try {
			aioseo()->helpers->switchToBlog( $siteId );

			// Get settings from post types selected.
			if ( ! empty( $postOptions ) ) {
				$fieldsToExclude = [
					'seo_score'                  => '',
					'schema_type'                => '',
					'schema_type_options'        => '',
					'images'                     => '',
					'image_scan_date'            => '',
					'videos'                     => '',
					'video_thumbnail'            => '',
					'video_scan_date'            => '',
					'link_scan_date'             => '',
					'link_suggestions_scan_date' => '',
					'local_seo'                  => '',
					'options'                    => '',
					'open_ai'                    => ''
				];

				$notAllowed = array_merge( aioseo()->access->getNotAllowedPageFields(), $fieldsToExclude );
				$posts      = self::getPostTypesData( $postOptions, $notAllowed );

				// Generate content to CSV or JSON.
				if ( ! empty( $posts ) ) {
					if ( 'csv' === $typeFile ) {
						$contentPostType = self::dataToCsv( $posts );
					}

					if ( 'json' === $typeFile ) {
						$contentPostType['postOptions']['content']['posts'] = $posts;
					}
				}
			}
		} catch ( \Throwable $th ) {
			$return = false;
		}

		return new \WP_REST_Response( [
			'success'      => $return,
			'postTypeData' => $contentPostType
		], 200 );
	}

	/**
	 * Returns the posts of specific post types.
	 *
	 * @since 4.7.2
	 *
	 * @param  array $postOptions      The post types to get data from.
	 * @param  array $notAllowedFields An array of fields not allowed to be returned.
	 * @return array                   The posts.
	 */
	private static function getPostTypesData( $postOptions, $notAllowedFields = [] ) {
		$posts = aioseo()->core->db->start( 'aioseo_posts as ap' )
			->select( 'ap.*' )
			->join( 'posts as p', 'ap.post_id = p.ID' )
			->whereIn( 'p.post_type', $postOptions )
			->orderBy( 'ap.id' )
			->run()
			->result();

		if ( ! empty( $notAllowedFields ) ) {
			foreach ( $posts as $key => &$p ) {
				$p = array_diff_key( (array) $p, $notAllowedFields );
				if ( count( $p ) <= 2 ) {
					unset( $posts[ $key ] );
				}
			}
		}

		return $posts;
	}

	/**
	 * Returns a CSV string.
	 *
	 * @since 4.7.2
	 *
	 * @param  array $data An array of data to transform into a CSV.
	 * @return string      The CSV string.
	 */
	public static function dataToCsv( $data ) {
		// Get the header row.
		$csvString = implode( ',', array_keys( (array) $data[0] ) ) . "\r\n";

		// Get the content rows.
		foreach ( $data as $row ) {
			$row = (array) $row;
			foreach ( $row as &$value ) {
				if ( aioseo()->helpers->isJsonString( $value ) ) {
					$value = '"' . str_replace( '"', '""', $value ) . '"';
				} elseif ( false !== strpos( (string) $value, ',' ) ) {
					$value = '"' . $value . '"';
				}
			}

			$csvString .= implode( ',', $row ) . "\r\n";
		}

		return $csvString;
	}

	/**
	 * Import other plugin settings.
	 *
	 * @since 4.0.0
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function importPlugins( $request ) {
		$body    = $request->get_json_params();
		$plugins = ! empty( $body['plugins'] ) ? $body['plugins'] : [];

		foreach ( $plugins as $plugin ) {
			aioseo()->importExport->startImport( $plugin['plugin'], $plugin['settings'] );
		}

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}

	/**
	 * Executes a given administrative task.
	 *
	 * @since 4.1.2
	 *
	 * @param  \WP_REST_Request  $request The REST Request
	 * @return \WP_REST_Response          The response.
	 */
	public static function doTask( $request ) {
		$body          = $request->get_json_params();
		$action        = ! empty( $body['action'] ) ? $body['action'] : '';
		$data          = ! empty( $body['data'] ) ? $body['data'] : [];
		$network       = ! empty( $body['network'] ) ? boolval( $body['network'] ) : false;
		$siteId        = ! empty( $body['siteId'] ) ? intval( $body['siteId'] ) : false;
		$siteOrNetwork = empty( $siteId ) ? aioseo()->helpers->getNetworkId() : $siteId; // If we don't have a siteId, we will use the networkId.

		// When on network admin page and no siteId, it is supposed to perform on network level.
		if ( $network && 'clear-cache' === $action && empty( $siteId ) ) {
			aioseo()->core->networkCache->clear();

			return new \WP_REST_Response( [
				'success' => true
			], 200 );
		}

		// Switch to the right blog before processing any task.
		aioseo()->helpers->switchToBlog( $siteOrNetwork );

		switch ( $action ) {
			// General
			case 'clear-cache':
				aioseo()->core->cache->clear();
				break;
			case 'clear-plugin-updates-transient':
				delete_site_transient( 'update_plugins' );
				break;
			case 'readd-capabilities':
				aioseo()->access->addCapabilities();
				break;
			case 'reset-data':
				aioseo()->core->uninstallDb( true );
				aioseo()->internalOptions->database->installedTables = '';
				aioseo()->internalOptions->internal->lastActiveVersion = '4.0.0';
				aioseo()->internalOptions->save( true );
				aioseo()->updates->addInitialCustomTablesForV4();
				break;
			// Sitemap
			case 'clear-image-data':
				aioseo()->sitemap->query->resetImages();
				break;
			// Migrations
			case 'rerun-migrations':
				aioseo()->internalOptions->database->installedTables   = '';
				aioseo()->internalOptions->internal->lastActiveVersion = '4.0.0';
				aioseo()->internalOptions->save( true );
				break;
			case 'restart-v3-migration':
				Migration\Helpers::redoMigration();
				break;
			// Old Issues
			case 'remove-duplicates':
				aioseo()->updates->removeDuplicateRecords();
				break;
			case 'unescape-data':
				aioseo()->admin->scheduleUnescapeData();
				break;
			// Deprecated Options
			case 'deprecated-options':
				// Check if the user is forcefully wanting to add a deprecated option.
				$allDeprecatedOptions = aioseo()->internalOptions->getAllDeprecatedOptions() ?: [];
				$enableOptions        = array_keys( array_filter( $data ) );
				$enabledDeprecated    = array_intersect( $allDeprecatedOptions, $enableOptions );

				aioseo()->internalOptions->internal->deprecatedOptions = array_values( $enabledDeprecated );
				aioseo()->internalOptions->save( true );
				break;
			default:
				aioseo()->helpers->restoreCurrentBlog();

				return new \WP_REST_Response( [
					'success' => true,
					'error'   => 'The given action isn\'t defined.'
				], 400 );
		}

		// Revert back to the current blog after processing to avoid conflict with other actions.
		aioseo()->helpers->restoreCurrentBlog();

		return new \WP_REST_Response( [
			'success' => true
		], 200 );
	}
}