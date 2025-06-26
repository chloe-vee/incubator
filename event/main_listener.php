<?php

/**
 * Event listener.
 *
 * PHP version 5+
 *
 * @category Phpbb
 * @package  PhpBB_RA_Incubator
 * @author   Chloe Vee
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace ra\incubator\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface
{
    /* @var \phpbb\controller\helper */
    protected $helper;

    /* @var \phpbb\template\template */
    protected $template;

    /**
     * Events this listener is subscribed to.
     *
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return ["core.user_setup" => "load_lang_on_setup"];
    }

    /**
     * Constructor
     *
     * @param \phpbb\controller\helper $helper   Controller helper object
     * @param \phpbb\template\template $template Template object
     */
    public function __construct(
        \phpbb\controller\helper $helper,
        \phpbb\template\template $template
    ) {
        $this->helper = $helper;
        $this->template = $template;
    }

    /**
     * Load extension language.
     *
     * @param \phpbb\event\data $event The event object
     *
     * @return null
     */
    public function load_lang_on_setup(\phpbb\event\data $event): void
    {
        $ext = $event["lang_set_ext"];
        $ext[] = array(
            "ext_name" => "ra/incubator",
            "lang_set" => "common",
        );
        $event["lang_set_ext"] = $ext;
    }
}
