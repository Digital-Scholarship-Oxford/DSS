<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- 
* sug_word.xsl
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
    <xsl:choose>
        <xsl:when test="//list[@type='words']/item">
            <xsl:text> Results from: </xsl:text><xsl:value-of select="//catRef/@target"/><br/><br/>
            <ul>
                <xsl:apply-templates select="//list[@type='words']/item">
                    <xsl:sort select="ident/@type" order="ascending"/>
                    <xsl:sort select="@n" order="ascending"/>
                </xsl:apply-templates>
            </ul>
            </xsl:when>
        <xsl:otherwise>
        	<xsl:text>There is nothing in the </xsl:text><xsl:value-of select="//catRef/@target"/> <xsl:text> that matches this pattern!</xsl:text><br/><br/>
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>

<xsl:template match="//list[@type='words']/item">
	<li>
    	<b><xsl:value-of select="ident/@type"/></b>: <xsl:value-of select="ident"/> 
        <xsl:if test="list[@type='tablets']">
            <xsl:text> </xsl:text>
             <xsl:apply-templates select="list[@type='tablets']/item"/>
        </xsl:if>
        <xsl:if test="list[@type='lemma_subtype']">
        	<ul><xsl:apply-templates select="list[@type='lemma_subtype']/item"/></ul>
        </xsl:if>
        <xsl:if test="list[@type='date']">
        	<ul><xsl:apply-templates select="list[@type='date']/item"/></ul>
        </xsl:if>
    </li>
</xsl:template>

<xsl:template match="list[@type='lemma_subtype']/item">
    <li>
    	<b>sub-lemma</b>: <xsl:value-of select="ident"/>
        <xsl:if test="list[@type='tablets']">
            <xsl:text> </xsl:text>
             <xsl:apply-templates select="list[@type='tablets']/item"/>
        </xsl:if>
    </li>
</xsl:template>
    
<xsl:template match="list[@type='date']/item">
    <li><b>date</b>: <xsl:value-of select="ident"/></li>
</xsl:template>
    
<xsl:template match="list[@type='tablets']/item">
    <a target="_blank">
        <xsl:attribute name="href">
        	<xsl:value-of select="$documentws"/><xsl:value-of select="ident"/>
        </xsl:attribute>
        <xsl:value-of select="ident"/>
    </a>
    <xsl:text>, </xsl:text>
</xsl:template>

</xsl:stylesheet>
