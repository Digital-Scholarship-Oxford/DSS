<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- 
* view.xsl
*
* XSLT stylesheet for the js function view()
*
* @package    DSS prototype
* @author     Henriette Roued <henriette@roued.com>
* @license    AGPL-3.0-or-later https://www.gnu.org/licenses/agpl-3.0.html
* @link       http://roued.com
* @link       https://ora.ox.ac.uk/objects/uuid:9d547661-4dea-4c54-832b-b2f862ec7b25
* @since      File available since 2011
-->

<!-- Remove all extra spaces in the document -->
<xsl:strip-space  elements="*"/>
<xsl:template match="/">
	<xsl:apply-templates select="//item"/>
</xsl:template>

<xsl:template match="//item">
	<div class="main-view">
		<xsl:choose>
			<xsl:when test="//l">
				<xsl:apply-templates select="//l"/>
 			 </xsl:when>
   	 	</xsl:choose>
	</div>
</xsl:template>

<!-- Transform lines -->
<xsl:template match="//l">
	<div class="line">
    	<span class="linenr">Line <xsl:value-of select="@n"/>: </span> 
		<xsl:apply-templates select="w"/>
	</div>
</xsl:template>

<!-- Transform words -->
<xsl:template match="w">
	<span class="w">    	
        <a class="word">
            <xsl:attribute name="onclick">
            	<!-- FUNCTION: showTop(get=word) -->
                <xsl:text>showTop( 'xml.php?do=get&amp;get=word','</xsl:text>
                <xsl:value-of select="@n"/>
                <xsl:text>')</xsl:text>
            </xsl:attribute>
            <xsl:text>*</xsl:text>
        </a>
        <xsl:if test="c">
        	<xsl:apply-templates select="c"/> 
        </xsl:if>
	</span>
</xsl:template>

<!-- Transform characters -->
<xsl:template match="c">
	<span class="c">
        <xsl:attribute name="onclick">
        	<!-- FUNCTION: showTop(get=char) -->
            <xsl:text>showTop( 'xml.php?do=get&amp;get=char','</xsl:text>
            <xsl:value-of select="@n"/>
            <xsl:text>')</xsl:text>
        </xsl:attribute>
        <xsl:choose>
            <xsl:when test="string(.)">
                <xsl:param name="countg" select="count(g)"/>
                <xsl:param name="countu" select="count(g[@ana='#unresolved'])"/>
                <xsl:param name="countr" select="count(g[@ana='#resolved'])"/>
                <xsl:choose>
                    <xsl:when test="$countr='1' and $countu='0'">
                        <xsl:apply-templates>
                            <xsl:with-param name="type" select="1"/>
                        </xsl:apply-templates>
                    </xsl:when>
                    <xsl:when test="$countr='0' and $countu='1'">
                        <xsl:apply-templates>
                            <xsl:with-param name="type" select="2"/>
                        </xsl:apply-templates>
                    </xsl:when>
                    <xsl:when test="$countr='1' and $countu!='0'">
                        <xsl:apply-templates>
                            <xsl:with-param name="type" select="3"/>
                        </xsl:apply-templates>
                    </xsl:when>
                    <xsl:when test="$countr='0' and $countu!='0'">
                        <span class="red"><xsl:text>?</xsl:text></span>
                    </xsl:when>
                </xsl:choose>
            </xsl:when>
            <xsl:otherwise>
				<span class="blue"> <xsl:text>*</xsl:text> </span>
            </xsl:otherwise>
        </xsl:choose>
	</span>
</xsl:template>

<!-- Transform letter elements -->
 <xsl:template match="g">
	<xsl:param name="type"/>
     <xsl:choose>
		<xsl:when test="@ana='#resolved' and $type='1'">
        	<xsl:value-of select="."/>
		</xsl:when>
		<xsl:when test="@ana='#unresolved' and $type='2'">
        	<span class="yellow"><xsl:value-of select="."/></span>
		</xsl:when>
        <xsl:when test="@ana='#resolved' and $type='3'">
			<span class="green"><xsl:value-of select="."/></span>
        </xsl:when>
	</xsl:choose>
</xsl:template>

</xsl:stylesheet>