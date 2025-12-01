<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- 
* viewlink.xsl
*
* XSLT stylesheet for the js function showArg()
*
* @package    DSS prototype
* @author     Henriette Roued <henriette@roued.com>
* @license    AGPL-3.0-or-later https://www.gnu.org/licenses/agpl-3.0.html
* @link       http://roued.com
* @link       https://ora.ox.ac.uk/objects/uuid:9d547661-4dea-4c54-832b-b2f862ec7b25
* @since      File available since 2011
-->
<xsl:param name="letter"/>
<xsl:param name="word"/>
<xsl:param name="id"/>
<xsl:param name="index"/>
<xsl:strip-space  elements="*"/>
<xsl:template match="/">
	<xsl:apply-templates select="//item"/>
</xsl:template>

<xsl:template match="//item">
    <div class="link-view">
        <xsl:choose>
        	<xsl:when test="//l">
        	<xsl:apply-templates select="//l"/>
          </xsl:when>
    	</xsl:choose>
    </div>
</xsl:template>

<xsl:template match="//l">
	<div class="link-line"><span class="link-linenr">Line <xsl:value-of select="@n"/>: </span> 
	<xsl:apply-templates select="w"/>
	</div>  
</xsl:template>

<xsl:template match="w">
	<xsl:choose>
        <xsl:when test="@n=$word">
            <span class="link-w-highlight">    	
                <xsl:if test="c">
                    <xsl:apply-templates select="c"/> 
                </xsl:if>
            </span>
    	</xsl:when>
        <xsl:otherwise>
        	<span class="link-w">    	
            	<a class="link-word">
                    <xsl:attribute name="onclick">view();
                        <!-- FUNCTION: doSomething(add=linkword) -->
                        <xsl:text>doSomething( 'xml.php?do=add&amp;add=linkword&amp;type=</xsl:text>
                        <xsl:value-of select="$id"/>
                        <xsl:text>','</xsl:text>
                        <xsl:value-of select="@n"/>
                        <!-- FUNCTION: showArg(get=add=arg) -->
                        <xsl:text>'); showArg('xml.php?do=get&amp;get=arg&amp;type=letter','</xsl:text>
                        <xsl:value-of select="$index"/>
                        <xsl:text>');</xsl:text>
            		</xsl:attribute>
            	<xsl:text>*</xsl:text>
            	</a>
                <xsl:if test="c">
                    <xsl:apply-templates select="c"/> 
                </xsl:if>
           </span>
       </xsl:otherwise>
   </xsl:choose>
</xsl:template>

<xsl:template match="c">
	<xsl:choose>
        <xsl:when test="@n=$letter">
        	<span class="link-c-highlight">
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
                                <xsl:text>?</xsl:text>
                            </xsl:when>
                        </xsl:choose>
        			</xsl:when>
        			<xsl:otherwise>
        				<xsl:text>&#46;</xsl:text>
        			</xsl:otherwise>
    			</xsl:choose>
    		</span>
        </xsl:when>
        <xsl:otherwise>
			<span class="link-c">
    			<xsl:attribute name="onclick">
                  	<!-- FUNCTION: doSomething(add=linkletter) -->
                	<xsl:text>doSomething( 'xml.php?do=add&amp;add=linkletter&amp;type=</xsl:text>
                    <xsl:value-of select="$id"/>
                    <xsl:text>','</xsl:text>
                     <xsl:value-of select="@n"/>
                      <!-- FUNCTION: showArg(get=add=arg) -->
                	<xsl:text>'); showArg('xml.php?do=get&amp;get=arg&amp;type=letter','</xsl:text>
                    <xsl:value-of select="$index"/>
                    <xsl:text>');</xsl:text>
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
                                <xsl:text>?</xsl:text>
                            </xsl:when>
                        </xsl:choose>
        			</xsl:when>
        			<xsl:otherwise>
        				<xsl:text>&#46;</xsl:text>
        			</xsl:otherwise>
    			</xsl:choose>
    		</span>
    	</xsl:otherwise>
    </xsl:choose>
</xsl:template>

<xsl:template match="g">
	<xsl:param name="type"/>
     <xsl:choose>
		<xsl:when test="@ana='#resolved' and $type='1'">
        	<xsl:value-of select="."/>
		</xsl:when>
		<xsl:when test="@ana='#unresolved' and $type='2'">
        	<xsl:value-of select="."/><xsl:text>&#x0323;</xsl:text>
		</xsl:when>
        <xsl:when test="@ana='#resolved' and $type='3'">
			<xsl:value-of select="."/><xsl:text>&#x0323;</xsl:text>
        </xsl:when>
	</xsl:choose>
</xsl:template>
</xsl:stylesheet>