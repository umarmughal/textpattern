<?php

/*
 * Textpattern Content Management System
 * https://textpattern.io/
 *
 * Copyright (C) 2017 The Textpattern Development Team
 *
 * This file is part of Textpattern.
 *
 * Textpattern is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, version 2.
 *
 * Textpattern is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Textpattern. If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * Textile filter.
 *
 * @since   4.6.0
 * @package Textfilter
 */

namespace Textpattern\Textfilter;

class Textile extends Base implements TextfilterInterface
{
    /**
     * Instance of Textile.
     *
     * @var Textile
     */

    protected $textile;

    /**
     * Constructor.
     */

    public function __construct()
    {
        parent::__construct(USE_TEXTILE, gTxt('use_textile'));
        $this->textile = new \Textpattern\Textile\Parser();
        $this->version = $this->textile->getVersion();
    }

    /**
     * Filter.
     *
     * @param string $thing
     * @param array  $options
     */

    public function filter($thing, $options)
    {
        parent::filter($thing, $options);

        if (($this->options['restricted'])) {
            return $this->textile->textileRestricted(
                $thing,
                $this->options['lite'],
                $this->options['noimage'],
                $this->options['rel']
            );
        } else {
            return $this->textile->textileThis(
                $thing,
                $this->options['lite'],
                '',
                $this->options['noimage'],
                '',
                $this->options['rel']
            );
        }
    }

    /**
     * Help link for Textile syntax.
     *
     * @return string HTML
     */

    public function getHelp()
    {
        return 'https://textpattern.io/textile-sandbox';
    }
}
