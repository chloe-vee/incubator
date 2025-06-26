<?php

namespace ra\incubator\tests\event;

use PHPUnit\Framework\TestCase;
use ra\incubator\event\main_listener;
use phpbb\event\data;

final class main_listener_test extends TestCase
{
    /**
     * The MainListener class should instante without error.
     */
    public function testConstructor(): void
    {
        $listener = new main_listener(
            $this->createStub('\phpbb\controller\helper'),
            $this->createStub('\phpbb\template\template'),
        );

        $this->assertInstanceOf('ra\incubator\event\main_listener', $listener);
    }

    /**
     * The .load_lang_on_setup($) method
     *     should add the extension language to the event.
     */
    public function testLoadLang()
    {
        $event = new data();

        $listener = new main_listener(
            $this->createStub('\phpbb\controller\helper'),
            $this->createStub('\phpbb\template\template'),
        );

        $listener->load_lang_on_setup($event);

        $ext = [
            "ext_name" => "ra/incubator",
            "lang_set" => "common",
        ];

        $this->assertEquals([$ext], $event["lang_set_ext"]);
    }
}
