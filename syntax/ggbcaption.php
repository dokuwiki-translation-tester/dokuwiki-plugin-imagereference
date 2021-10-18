<?php
/**
 * Plugin imagereference
 *
 * Syntax: <tabref linkname> - creates a table link to a table
 *         <tabcaption linkname <orientation> | Table caption> Table</tabcaption>
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Gerrit Uitslag <klapinklapin@gmail.com>
 * @author     Philipp Imhof <dev@imhof.cc>
 */

if(!defined('DOKU_INC')) die();

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_imagereference_ggbcaption extends syntax_plugin_imagereference_imgcaption {

    /**
     * @return string Syntax type
     */
    public function getType() {
        return 'formatting';
    }
    /**
     * @return string Paragraph type
     */
    public function getPType() {
        return 'block';
    }
    /**
     * @return int Sort order
     */
    public function getSort() {
        return 196;
    }

    /**
     * Specify modes allowed in the ggbcaption tag
     * Using getAllowedTypes() includes too much modes.
     *
     * @param string $mode Parser mode
     * @return bool true if $mode is accepted
     */
    public function accepts($mode) {
        $allowedsinglemodes = array(
            'media', //allowed content
            'plugin_geogebrembed_ggb'    //plugins
        );
        if(in_array($mode, $allowedsinglemodes)) return true;
        
        return parent::accepts($mode);
    }

    /**
     * Connect lookup pattern to lexer.
     *
     * @param string $mode Parser mode
     */
    public function connectTo($mode) {
        $this->Lexer->addEntryPattern('<ggbcaption.*?>(?=.*?</ggbcaption>)', $mode, 'plugin_imagereference_ggbcaption');
    }

    public function postConnect() {
        $this->Lexer->addExitPattern('</ggbcaption>', 'plugin_imagereference_ggbcaption');
    }

}

