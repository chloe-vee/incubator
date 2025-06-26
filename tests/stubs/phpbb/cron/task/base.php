<?php

namespace phpbb\cron\task;

/**
* Cron task base class. Provides sensible defaults for cron tasks
* and partially implements cron task interface, making writing cron tasks easier.
*
* At a minimum, subclasses must override the run() method.
*
* Cron tasks need not inherit from this base class. If desired,
* they may implement cron task interface directly.
*/
// abstract class base implements \phpbb\cron\task\task
abstract class base
{
    /**
     * Returns the name of the task.
     *
     * @return string		Name of wrapped task.
     */
    public function get_name()
    {
    }
    /**
     * Sets the name of the task.
     *
     * @param string	$name The task name
     */
    public function set_name($name)
    {
    }
    /**
     * Returns whether this cron task can run, given current board configuration.
     *
     * For example, a cron task that prunes forums can only run when
     * forum pruning is enabled.
     *
     * @return bool
     */
    public function is_runnable()
    {
    }
    /**
     * Returns whether this cron task should run now, because enough time
     * has passed since it was last run.
     *
     * @return bool
     */
    public function should_run()
    {
    }
}
