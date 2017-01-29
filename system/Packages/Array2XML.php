<?php
/**
 * Array2XML: A class to convert array in PHP to XML
 * It also takes into account attributes names unlike SimpleXML in PHP
 * It returns the XML in form of DOMDocument class for further manipulation.
 * It throws exception if the tag name or attribute name has illegal chars.
 * Usage:
 *		$php_array=	array(
 *            '@attributes' => array(
 *                'author' => 'Robert A Heinlein'
 *            ),
 *            'title' => 'Stranger in a Strange Land',
 *            'price' => array(
 *                '@attributes' => array(
 *                    'discount' => '10%'
 *                ),
 *                '@value' => '$18.00'
 *            )
 *        )
 *       $xml = Array2XML::createXML('root_node_name', $php_array);
 *       echo $xml->saveXML();
 * @author : Ionut Cylosh
 * @link : https://cylo.ro
 * Author : Lalit Patel
 * Website: http://www.lalit.org/lab/convert-php-array-to-xml-with-attributes
 * License: Apache License 2.0
 *          http://www.apache.org/licenses/LICENSE-2.0
 * Version: 0.1 (10 July 2011)
 * Version: 0.2 (16 August 2011)
 *          - replaced htmlentities() with htmlspecialchars() (Thanks to Liel Dulev)
 *          - fixed a edge case where root node has a false/null/0 value. (Thanks to Liel Dulev)
 * Version: 0.3 (22 August 2011)
 *          - fixed tag sanitize regex which didn't allow tagnames with single character.
 * Version: 0.4 (18 September 2011)
 *          - Added support for CDATA section using @cdata instead of @value.
 * Version: 0.5 (07 December 2011)
 *          - Changed logic to check numeric array indices not starting from 0.
 * Version: 0.6 (04 March 2012)
 *          - Code now doesn't @cdata to be placed in an empty array
 * Version: 0.7 (24 March 2012)
 *          - Reverted to version 0.5
 * Version: 0.8 (02 May 2012)
 *          - Removed htmlspecialchars() before adding to text node or attributes.
 * Version: 0.9 (02 March 2016)
 *          - Added XML element attribute support for the root node
 * Version: 1.0 (09 March 2016)
 *          - Fixed 'Invalid Character' Error that appeared when XML root node element had empty trails
 *
 */

class Array2XML {

    private static $xml = null;
	private static $encoding = 'UTF-8';

    /**
     * Initialize the root XML node [optional]
     * @param $version
     * @param $encoding
     * @param $format_output
     */
    public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true) {
        self::$xml = new DomDocument($version, $encoding);
        self::$xml->formatOutput = $format_output;
		self::$encoding = $encoding;
    }

    /**
     * Convert an Array to XML
     * @param string $node_name - name of the root node to be converted
     * @param array $arr - aray to be converterd
     * @return DomDocument
     */
    public static function &createXML($node_name, $arr=array()) {
        $xml = self::getXMLRoot();
        $xml->appendChild(self::convert($node_name, $arr));

        self::$xml = null;    // clear the xml node in the class for 2nd time use.
        return $xml;
    }

    /**
     * Convert an Array to XML
     * @param string $node_name - name of the root node to be converted
     * @param array $arr - aray to be converterd
     * @return DOMNode
     */
    private static function &convert($node_name, $arr=array()) {

        //print_arr($node_name);
        $xml = self::getXMLRoot();
		if(is_array($node_name)){
			$node = $xml->createElement(self::bool2str($node_name['@value']));
			
            // get the attributes first.;
            if(isset($node_name['@attributes'])) {
                foreach($node_name['@attributes'] as $key => $value) {
                    if(!self::isValidTagName($key)) {
                        throw new Exception('[Array2XML] Illegal character in attribute name. attribute: '.$key.' in node: '.$node_name);
                    }
					$nodeAttribute = $xml->createAttribute($key);
					$nodeAttribute->value = self::bool2str($value);
					$node->appendChild($nodeAttribute);
					$xml->appendChild($node);

                }
                unset($node_name['@attributes']); //remove the key from the array once done.
            }


		}else
			$node = $xml->createElement(self::bool2str($node_name));

        if(is_array($arr)){
            // get the attributes first.;
            if(isset($arr['@attributes'])) {
                foreach($arr['@attributes'] as $key => $value) {
                    if(!self::isValidTagName($key)) {
                        throw new Exception('[Array2XML] Illegal character in attribute name. attribute: '.$key.' in node: '.$node_name);
                    }
                    $node->setAttribute($key, self::bool2str($value));
                }
                unset($arr['@attributes']); //remove the key from the array once done.
            }

            // check if it has a value stored in @value, if yes store the value and return
            // else check if its directly stored as string
            if(isset($arr['@value'])) {
                $node->appendChild($xml->createTextNode(self::bool2str($arr['@value'])));
                unset($arr['@value']);    //remove the key from the array once done.
                //return from recursion, as a note with value cannot have child nodes.
                return $node;
            } else if(isset($arr['@cdata'])) {
                $node->appendChild($xml->createCDATASection(self::bool2str($arr['@cdata'])));
                unset($arr['@cdata']);    //remove the key from the array once done.
                //return from recursion, as a note with cdata cannot have child nodes.
                return $node;
            }
        }

        //create subnodes using recursion
        if(is_array($arr)){
            // recurse to get the node for that key
            foreach($arr as $key=>$value){
                if(!self::isValidTagName($key)) {
                    throw new Exception('[Array2XML] Illegal character in tag name. tag: '.$key.' in node: '.$node_name);
                }
                if(is_array($value) && is_numeric(key($value))) {
                    // MORE THAN ONE NODE OF ITS KIND;
                    // if the new array is numeric index, means it is array of nodes of the same kind
                    // it should follow the parent key name
                    foreach($value as $k=>$v){
                        $node->appendChild(self::convert($key, $v));
                    }
                } else {
                    // ONLY ONE NODE OF ITS KIND
                    $node->appendChild(self::convert($key, $value));
                }
                unset($arr[$key]); //remove the key from the array once done.
            }
        }

        // after we are done with all the keys in the array (if it is one)
        // we check if it has any text value, if yes, append it.
        if(!is_array($arr)) {
            $node->appendChild($xml->createTextNode(self::bool2str($arr)));
        }

        return $node;
    }

    /*
     * Get the root XML node, if there isn't one, create it.
     */
    private static function getXMLRoot(){
        if(empty(self::$xml)) {
            self::init();
        }
        return self::$xml;
    }

    /*
     * Get string representation of boolean value
     */
    private static function bool2str($v){
        //convert boolean to text value.
        $v = $v === true ? 'true' : trim($v);
        $v = $v === false ? 'false' : trim($v);
        return $v;
    }

    /*
     * Check if the tag name or attribute name contains illegal characters
     * Ref: http://www.w3.org/TR/xml/#sec-common-syn
     */
    private static function isValidTagName($tag){
        $pattern = '/^[a-z_]+[a-z0-9\:\-\.\_]*[^:]*$/i';
        return preg_match($pattern, $tag, $matches) && $matches[0] == $tag;
    }
}

/**
 * sanitizeXML: Returns Safe XML maintaining the XML element attributes 
 * Usage:
 *		$newXml = sanitizeXML($body);
 * 		var_dump($newXml);
 *
 * @author : Ionut Cylosh
 * @link : https://cylo.ro
 * @version 1.0: 2 March 2016
 * @version 1.1: 9 March 2016
 *				Added utf support
 *
 * @param string $xml_content
 *		The XML content to be sanitized
 * @param boolean $xml_declare
 *		If set to true it'll include the XML declaration
 *  
 * @return string
*/

function sanitizeXML($xml_content, $xml_declare=true){
		
		$xml_content = preg_replace('%<\w*/>%sim', '', $xml_content);

		if (preg_match_all('%(<\?xml.{1,150}?\?>)?.{0,25}?<((\w+)\s?.*?)>(.+?)</\3>%si', $xml_content, $xmlElements, PREG_SET_ORDER)) {
		
			$xmlSafeContent = '';
			if($xml_declare)
				$xmlBeginBlock = $xmlElements['0']['1'];
	
			foreach($xmlElements as $xmlElem){
				$xmlSafeContent .= '<'.$xmlElem['2'].'>';
				if (preg_match('%<((?P<tag>\w+)\s?[^/]*?)>(.+?)</(?P=tag)>%si', $xmlElem['4'])) {
					$xmlSafeContent .= sanitizeXML($xmlElem['4'], false);
				}else{
					#$xml_content = mb_convert_encoding($xml_content, "UTF-8", 'pass');
					$xmlSafeContent .= utf8_for_xml(htmlspecialchars($xmlElem['4'],ENT_NOQUOTES, 'UTF-8'));
				}
				$xmlSafeContent .= '</'.$xmlElem['3'].'>';
			}
			
			if(!$xml_declare)
				return $xmlSafeContent;
			else
				return (empty($xmlBeginBlock) ? '<?xml version="1.0" encoding="UTF-8"?>' : $xmlBeginBlock).$xmlSafeContent;
			
		} else {
			#$xml_content = mb_convert_encoding($xml_content, "UTF-8", 'pass');

			$xmlSafeContent = utf8_for_xml(htmlspecialchars($xml_content,ENT_NOQUOTES, 'UTF-8'));

			return (!$xml_declare ? $xmlSafeContent : false);
		}

}


function utf8_for_xml($string)
{
  return preg_replace('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', ' ', $string);
}
