<?php

/**
* Recalculate Nested Sets
*
* @param int	$new_id	first left_id (should start with 1)
* @param string	$pkey	primary key-column (containing the id for the parent_id of the children)
* @param string	$table	constant or fullname of the table
* @param int	$parent_id parent_id of the current set (default = 0)
* @param array	$where	contains strings to compare closer on the where statement (additional)
*/
function recalc_nested_sets(&$new_id, $pkey, $table, $parent_id = 0, $where = array())
{
}
/**
* Simple version of jumpbox, just lists authed forums
*/
function make_forum_select($select_id = \false, $ignore_id = \false, $ignore_acl = \false, $ignore_nonpost = \false, $ignore_emptycat = \true, $only_acl_post = \false, $return_array = \false)
{
}
/**
* Generate size select options
*/
function size_select_options($size_compare)
{
}
/**
* Generate list of groups (option fields without select)
*
* @param int $group_id The default group id to mark as selected
* @param array $exclude_ids The group ids to exclude from the list, false (default) if you whish to exclude no id
* @param int $manage_founder If set to false (default) all groups are returned, if 0 only those groups returned not being managed by founders only, if 1 only those groups returned managed by founders only.
*
* @return string The list of options.
*/
function group_select_options($group_id, $exclude_ids = \false, $manage_founder = \false)
{
}
/**
* Obtain authed forums list
*/
function get_forum_list($acl_list = 'f_list', $id_only = \true, $postable_only = \false, $no_cache = \false)
{
}
/**
* Get forum branch
*/
function get_forum_branch($forum_id, $type = 'all', $order = 'descending', $include_forum = \true)
{
}
/**
* Copies permissions from one forum to others
*
* @param int	$src_forum_id		The source forum we want to copy permissions from
* @param array	$dest_forum_ids		The destination forum(s) we want to copy to
* @param bool	$clear_dest_perms	True if destination permissions should be deleted
* @param bool	$add_log			True if log entry should be added
*
* @return bool						False on error
*/
function copy_forum_permissions($src_forum_id, $dest_forum_ids, $clear_dest_perms = \true, $add_log = \true)
{
}
/**
* Get physical file listing
*/
function filelist($rootdir, $dir = '', $type = 'gif|jpg|jpeg|png|svg|webp')
{
}
/**
* Move topic(s)
*/
function move_topics($topic_ids, $forum_id, $auto_sync = \true)
{
}
/**
* Move post(s)
*/
function move_posts($post_ids, $topic_id, $auto_sync = \true)
{
}
/**
* Remove topic(s)
* @return array with topics and posts affected
*/
function delete_topics($where_type, $where_ids, $auto_sync = \true, $post_count_sync = \true, $call_delete_posts = \true)
{
}
/**
* Remove post(s)
*/
function delete_posts($where_type, $where_ids, $auto_sync = \true, $posted_sync = \true, $post_count_sync = \true, $call_delete_topics = \true)
{
}
/**
* Deletes shadow topics pointing to a specified forum.
*
* @param int		$forum_id		The forum id
* @param string		$sql_more		Additional WHERE statement, e.g. t.topic_time < (time() - 1234)
* @param bool		$auto_sync		Will call sync() if this is true
*
* @return array		Array with affected forums
*/
function delete_topic_shadows($forum_id, $sql_more = '', $auto_sync = \true)
{
}
/**
* Update/Sync posted information for topics
*/
function update_posted_info(&$topic_ids)
{
}
/**
* All-encompasing sync function
*
* Exaples:
* <code>
* sync('topic', 'topic_id', 123);			// resync topic #123
* sync('topic', 'forum_id', array(2, 3));	// resync topics from forum #2 and #3
* sync('topic');							// resync all topics
* sync('topic', 'range', 'topic_id BETWEEN 1 AND 60');	// resync a range of topics/forums (only available for 'topic' and 'forum' modes)
* </code>
*
* Modes:
* - forum				Resync complete forum
* - topic				Resync topics
* - topic_moved			Removes topic shadows that would be in the same forum as the topic they link to
* - topic_visibility	Resyncs the topic_visibility flag according to the status of the first post
* - post_reported		Resyncs the post_reported flag, relying on actual reports
* - topic_reported		Resyncs the topic_reported flag, relying on post_reported flags
* - post_attachement	Same as post_reported, but with attachment flags
* - topic_attachement	Same as topic_reported, but with attachment flags
*/
function sync($mode, $where_type = '', $where_ids = '', $resync_parents = \false, $sync_extra = \false)
{
}
/**
* Prune function
* @return array with topics and posts affected
*/
function prune($forum_id, $prune_mode, $prune_date, $prune_flags = 0, $auto_sync = \true, $prune_limit = 0)
{
}
/**
* Function auto_prune(), this function now relies on passed vars
*/
function auto_prune($forum_id, $prune_mode, $prune_flags, $prune_days, $prune_freq, $log_prune = \true)
{
}
/**
* Cache moderators. Called whenever permissions are changed
* via admin_permissions. Changes of usernames and group names
* must be carried through for the moderators table.
*
* @param \phpbb\db\driver\driver_interface $db Database connection
* @param \phpbb\db\tools\tools_interface $db_tools Database tools
* @param \phpbb\cache\driver\driver_interface $cache Cache driver
* @param \phpbb\auth\auth $auth Authentication object
* @return void
*/
function phpbb_cache_moderators($db, $db_tools, $cache, $auth)
{
}
/**
* View log
*
* @param	string	$mode			The mode defines which log_type is used and from which log the entry is retrieved
* @param	array	&$log			The result array with the logs
* @param	mixed	&$log_count		If $log_count is set to false, we will skip counting all entries in the database.
*									Otherwise an integer with the number of total matching entries is returned.
* @param	int		$limit			Limit the number of entries that are returned
* @param	int		$offset			Offset when fetching the log entries, f.e. when paginating
* @param	mixed	$forum_id		Restrict the log entries to the given forum_id (can also be an array of forum_ids)
* @param	int		$topic_id		Restrict the log entries to the given topic_id
* @param	int		$user_id		Restrict the log entries to the given user_id
* @param	int		$limit_days		Only get log entries newer than the given timestamp
* @param	string	$sort_by		SQL order option, e.g. 'l.log_time DESC'
* @param	string	$keywords		Will only return log entries that have the keywords in log_operation or log_data
*
* @return	int				Returns the offset of the last valid page, if the specified offset was invalid (too high)
*/
function view_log($mode, &$log, &$log_count, $limit = 0, $offset = 0, $forum_id = 0, $topic_id = 0, $user_id = 0, $limit_days = 0, $sort_by = 'l.log_time DESC', $keywords = '')
{
}
/**
* Removes moderators and administrators from foe lists.
*
* @param \phpbb\db\driver\driver_interface $db Database connection
* @param \phpbb\auth\auth $auth Authentication object
* @param array|bool $group_id If an array, remove all members of this group from foe lists, or false to ignore
* @param array|bool $user_id If an array, remove this user from foe lists, or false to ignore
* @return void
*/
function phpbb_update_foes($db, $auth, $group_id = \false, $user_id = \false)
{
}
/**
* Lists inactive users
*/
function view_inactive_users(&$users, &$user_count, $limit = 0, $offset = 0, $limit_days = 0, $sort_by = 'user_inactive_time DESC')
{
}
/**
* Lists warned users
*/
function view_warned_users(&$users, &$user_count, $limit = 0, $offset = 0, $limit_days = 0, $sort_by = 'user_warnings DESC')
{
}
/**
* Get database size
*/
function get_database_size()
{
}
/*
* Tidy Warnings
* Remove all warnings which have now expired from the database
* The duration of a warning can be defined by the administrator
* This only removes the warning and reduces the associated count,
* it does not remove the user note recording the contents of the warning
*/
function tidy_warnings()
{
}
/**
* Tidy database, doing some maintanance tasks
*/
function tidy_database()
{
}
/**
* Add permission language - this will make sure custom files will be included
*/
function add_permission_language()
{
}
/**
 * Enables a particular flag in a bitfield column of a given table.
 *
 * @param string	$table_name		The table to update
 * @param string	$column_name	The column containing a bitfield to update
 * @param int		$flag			The binary flag which is OR-ed with the current column value
 * @param string	$sql_more		This string is attached to the sql query generated to update the table.
 *
 * @return void
 */
function enable_bitfield_column_flag($table_name, $column_name, $flag, $sql_more = '')
{
}
function display_ban_end_options()
{
}
/**
* Display ban options
*/
function display_ban_options($mode)
{
}