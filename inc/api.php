<?php

/**
 * API for saving and retrieving data from plugin
 */

/**
 * Check if request method is the same as the given method.
 *
 * @param string $method
 * @since 1.0.0
 *
 * @return bool True if method match false otherwise.
 */

function talandewebb_is_method( $method ) {
  return $_SERVER ['REQUEST_METHOD'] == strtoupper( $method );
}


/**
 * Remove trailing dobule quote.
 * PHP's $_POST object adds this automatic.
 *
 * @param string $str The string to check.
 * @since 1.0.0
 *
 * @return string
 */

function talandewebb_remove_trailing_quotes( $str ) {
  return str_replace( "\'", "'", str_replace( '\"', '"', $str ) );
}


/**
 * Get plugin options prefix.
 *
 * @return string
 */

function _talandewebb_get_plugin_options_prefix() {
  return 'talandewebb_plugin_option_';
}


/**
 * Save plugin options data.
 */

function _talandewebb_save_plugin_options() {
  $pattern = '/^' . str_replace( '_', '\_', _talandewebb_get_plugin_options_prefix() ) . '.*/';
  $data    = array();
  $keys    = preg_grep( $pattern, array_keys( $_POST ) );

  foreach ( $keys as $key ) {
    if ( ! isset( $_POST[ $key ] ) ) {
      continue;
    }

    $data[ $key ] = talandewebb_remove_trailing_quotes( $_POST[ $key ] );

  }

  foreach ( $data as $key => $value ) {
    update_option( $key, $value );
  }
}


/**
 * Get plugin option value.
 *
 * @param string $key
 * @param mixed $default
 *
 * @return mixed
 */

function talandewebb_get_plugin_option( $key, $default ='' ) {
  $prefix = _talandewebb_get_plugin_options_prefix();
  $value = get_option( $prefix . $key );

  if ( $value === false || !empty( $value ) ) {
    return $value;
  }

  return $default;
}


/**
 * Update plugin option.
 *
 * @param string $key
 * @param mixed $value
 */

function talandewebb_update_plugin_option( $key, $value ) {
  $prefix = _talandewebb_get_plugin_options_prefix();
  update_option( $prefix . $key, $value );
}
