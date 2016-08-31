<?php

/**
 * Class Interleaved_Sidebars
 *
 * This class adds sidebars in other sidebars.
 *
 * @author  Sven Wagener - awesome.ug
 * @license GNU General Public License v3
 * @version 1.0.0
 * @since   1.0.0
 */
class Interleaved_Sidebars
{
	/**
	 * Sidebar indexes where to add
	 *
	 * @var array
	 * @since 1.0.0
	 */
	static $sidebar_indexes = array();

	/**
	 * Sidebar indexes which have to be added
	 *
	 * @var array
	 * @since 1.0.0
	 */
	static $additional_sidebar_indexes = array();

	/**
	 * Adding sidebars to other sidebars
	 *
	 * @param array  $additional_sidebar_indexes Sidebar id's to add
	 * @param array  $sidebar_indexes Sidebar id's where other sidebars to add
	 * @param string $insert_situation Add sidebars 'before' or 'after' existing sidebar
	 *
	 * @since 1.0.0
	 */
	public static function interleave_sidebars( $additional_sidebar_indexes, $sidebar_indexes, $insert_situation = 'after' )
	{
		self::$sidebar_indexes            = $sidebar_indexes;
		self::$additional_sidebar_indexes = $additional_sidebar_indexes;

		if ( 'before' === $insert_situation )
		{
			add_action( 'dynamic_sidebar_before', array( __CLASS__, 'add' ) );
			add_filter( 'is_active_sidebar', array( __CLASS__, 'filter' ), 10, 2 );
		}

		if ( 'after' === $insert_situation )
		{
			add_action( 'dynamic_sidebar_after', array( __CLASS__, 'add' ) );
			add_filter( 'is_active_sidebar', array( __CLASS__, 'filter' ), 10, 2 );
		}
		add_action( 'dynamic_sidebar_before', array( __CLASS__, 'add' ) );
		add_filter( 'is_active_sidebar', array( __CLASS__, 'filter' ), 10, 2 );
	}

	/**
	 * Adding sidebars in 'dynamic_sidebar' function
	 *
	 * @param string $index
	 *
	 * @since 1.0.0
	 */
	public static function add( $index )
	{
		if ( ! in_array( $index, self::$sidebar_indexes ) )
		{
			return;
		}

		foreach ( self::$additional_sidebar_indexes AS $index )
		{
			dynamic_sidebar( $index );
		}
	}

	/**
	 * Filtering is_active_sidebar in case there is no widget in it before
	 *
	 * @param boolean    $is_active_sidebar
	 * @param string|int $index
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public static function filter( $is_active_sidebar, $index )
	{
		if ( ! in_array( $index, self::$sidebar_indexes ) )
		{
			return $is_active_sidebar;
		}

		return true;
	}
}
/**
 * Adding sidebars to other sidebars
 *
 * @param array  $sidebar_indexes Sidebar id's where other sidebars to add
 * @param array  $additional_sidebar_indexes Sidebar id's to add
 * @param string $insert_situation Add sidebars 'before' or 'after' existing sidebar
 *
 * @since 1.0.0
 */
function interleave_sidebars( $additional_sidebar_indexes, $sidebar_indexes, $insert_situation )
{
	Interleaved_Sidebars::interleave_sidebars( $additional_sidebar_indexes, $sidebar_indexes, $insert_situation );
}