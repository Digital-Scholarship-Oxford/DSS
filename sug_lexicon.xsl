<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- 
* sug_lexicon.xsl
*
* XSLT stylesheet for the js function showSug
*
* @package    DSS prototype
* @author     Henriette Roued <henriette@roued.com>
* @license    AGPL-3.0-or-later https://www.gnu.org/licenses/agpl-3.0.html
* @link       http://roued.com
* @link       https://ora.ox.ac.uk/objects/uuid:9d547661-4dea-4c54-832b-b2f862ec7b25
* @since      File available since 2011
-->
<xsl:param name="documentws"/>
<xsl:template match="/">
	<xsl:value-of select="@WORD"/>
    <xsl:apply-templates select="//RES"/>
</xsl:template>

<xsl:template match="//RES">
    <p>
        <b><xsl:value-of select="@AUTHOR"/>  <xsl:text> </xsl:text></b>
        <xsl:value-of select="@DICT"/> 
        <xsl:text> </xsl:text>
        <a target="_blank">
            <xsl:attribute name="href">
            	<xsl:value-of select="@LINK"/>
            </xsl:attribute>
            <xsl:value-of select="@LEM"/>
        </a>
    </p>
</xsl:template>

</xsl:stylesheet>
