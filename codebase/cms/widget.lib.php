<?php
/**
 * @package pragyan
 * @author Abhishek Shrivastava
 * @brief Widget Framework for Pragyan CMS
 * @copyright (c) 2010 Pragyan Team
 * @license http://www.gnu.org/licenses/ GNU Public License
 * @warning The database structure of widgetsinfo is such that config_id is one of the primary keys. But what if there is a widget with NO configuration at all ? Hence, every widget must have atleast one configuration. So how about inserting a default configuration like Enable/Disable ?
 * For more details, see README
 */
 
 /** 
  * @description
  * Idea :
 

 Put all the widgets inside cms/widgets folder. 
 Every widget should have a folder by its name inside cms/widgets.
 Inside every folder there will be a description file consisting of widget information and usage details.
 Each such folder will have widget.class.php file having a class which should extend WidgetFramework abstract class.
 The class will have abstract functions like :

 init_widget() to pass widget-instance-specific configurations to the widgets
 get_widget() to get the widget's output html code
 
 WidgetFramework will implement the following functions :
 
  __construct() to pass universal (static) parameters to the widgets
 create_widget() will create the entry of the widget in the database along with proper settings
 reset_widget() will reset all the widgets configurations to default (OPTIONAL)
 destroy_widget() will remove the widget from the database and its associated files
 
 
 A widget is a small customized html code that can be put in any part of the generated page. 
 The template's index.php will have variables $WIDGET1, $WIDGET2 to $WIDGETn where n is user-defined.
 Each $WIDGETi represents a unique-location and NOT a unique widget i.e. $WIDGETi can have multiple widgets, but in same location.
 
 
 
 SQL QUERY ::
 -- --------------------------------------------------------

--
-- Table structure for table `pragyanV3_widgets`
--

CREATE TABLE IF NOT EXISTS `pragyanV3_widgets` (
  `widget_id` int(11) NOT NULL,
  `widget_instanceid` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `widget_location` int(11) NOT NULL,
  `widget_order` int(11) NOT NULL,
  PRIMARY KEY (`widget_id`,`widget_instanceid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pragyanV3_widgetsconfig`
--

CREATE TABLE IF NOT EXISTS `pragyanV3_widgetsconfig` (
  `widget_id` int(11) NOT NULL,
  `widget_instanceid` int(11) NOT NULL,
  `config_id` int(11) NOT NULL,
  `config_value` longtext NOT NULL,
  PRIMARY KEY (`widget_id`,`widget_instanceid`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pragyanV3_widgetsdata`
--

CREATE TABLE IF NOT EXISTS `pragyanV3_widgetsdata` (
  `widget_id` int(11) NOT NULL,
  `widget_instanceid` int(11) NOT NULL,
  `widget_datakey` varchar(500) NOT NULL,
  `widget_datavalue` longtext NOT NULL,
  PRIMARY KEY (`widget_id`,`widget_instanceid`,`widget_datakey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pragyanV3_widgetsinfo`
--


CREATE TABLE IF NOT EXISTS `pragyanV3_widgetsinfo` (
  `widget_id` int(11) NOT NULL,
  `widget_name` varchar(100) NOT NULL,
  `config_id` int(11) NOT NULL,
  `config_name` varchar(27) NOT NULL,
  `config_type` enum('text','textarea','bool','integer','date','select','hidden','datetime','file','radio','checkbox') NOT NULL,
  `config_options` text NOT NULL,
  `config_displaytext` text NOT NULL,
  `config_default` longtext NOT NULL,
  `is_global` int(1) NOT NULL,
  PRIMARY KEY (`widget_id`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-----------------------------------------------------------------
Database Structure :
 
 PragyanV3_widgetsinfo table :
 *widget_id	widget_name *config_id	config_name	config_type	config_options	config_displaytext	config_default	is_global

 PragyanV3_widgets table :
 *widget_id	*widget_instanceid	page_id		widget_location		widget_order

  PragyanV3_widgetsconfig
 widget_id	widget_instanceid	config_id	config_value
 
 PragyanV3_widgetsdata
 widget_id	widget_instanceid	widget_datakey		widget_datavalue

 @note Global configurations are the configurations which are common to all the instances of a particular widget type.
 Algo ::
 
 When a page is being opened.
 
 For all widget_id and widget_instanceid from PragyanV3_widgets for page_id order by widget_location, widget_order
 	widget_globalconfigs = Get all global configurations from PragyanV3_widgetglobalconfig for widget_id
 	widget_configs = Get all configurations from PragyanV3_widgetsconfig for widget_id and widget_instanceid
 	widget_name = Select widget_name from PragyanV3_widgetsinfo for widget_id
 	Include file cms/widgets/widget_name/widget.class.php
 	widget_object = Object of class widget_name passing some universal widget_globalconfigs in the contructor
 	widget_object.init_widget(widget_configs)
 	widget_output = widget_object.get_widget()
 	$WIDGET<widget_location> .= widget_output
 
 Note : All the widgets will have the power to add/remove/modify their information in PragyanV3_widgetsdata table
 
 For administrators. (+admin&subaction=widgets)
 
 1) Generate the list of all the widgets based on PragyanV3_widgetinfo table.
 2) When clicking on a widget, a page should be displayed with some widget informations like authorname from PragyanV3_widgetsinfo table
 3) The above page should also have links to change instance-specific and universal configurations for that widget.
 4) When clicked on instance-specific, a list of all the page_urls (dereferenced from page_id in PragyanV3_widgets table) is generated.
 5) Clicking on any url should open a form-type configuration page based upon PragyanV3_widgetsconfiginfo and PragyanV3_widgetsconfig.
 6) When clicked on universal configurations in (3), it should open a form-like page from PragyanV3_widgetglobalconfig
 7) Widget Installation and Removal (LATER)
 
 For page-admins (+settings)
 
 1) List of available, enabled widgets for that page.
 2) Configure button to configure the enabled widgets
 3) Manipulate the ordering and Location ID of the widgets.
 
*/
/**
 * Handles the widget administration interface.
 *
 * @param $pageId Id of the current page
 *
 * @return HTML code of the widget admin page
 */
function handleWidgetAdmin($pageId)
{
	global $ICONS,$urlRequestRoot;
	$html = "";
	
	if(isset($_GET['widgetid']))
	{
		$widgetid=escape($_GET['widgetid']);
		if(isset($_GET['subsubaction']) && $_GET['subsubaction']=="globalconf")
			updateGlobalConf($widgetid); // POST variables are processed inside this function
		$widgetinfo=getWidgetGlobalInfo($widgetid);
		$description=readWidgetDescription($widgetinfo['name']);
	
		$containsFileUploadFields = false;
		$formElements=getGlobalConfigFormAsArray($widgetinfo,$containsFileUploadFields);
		
		$jsPath = "$urlRequestRoot/$cmsFolder/templates/common/scripts/formValidator.js";//validation.js
		$calpath = "$urlRequestRoot/$cmsFolder/$moduleFolder/form/calendar";
		$jsPathMooTools = "$urlRequestRoot/$cmsFolder/templates/common/scripts/mootools-1.11-allCompressed.js";
		
		$html = '<link rel="stylesheet" type="text/css" media="all" href="'.$calpath.'/calendar.css" title="Aqua" />' .
						 '<script type="text/javascript" src="'.$calpath.'/calendar.js"></script>';
		$html .= '<br /><br /><div class="registrationform"><form class="fValidator-form" name="widgetglobalsettings" action="./+admin&subaction=widgets&subsubaction=globalconf&widgetid='.$widgetid.'" method="post"';
		
		if($containsFileUploadFields)
			$html .= ' enctype="multipart/form-data"';
		$html .= '>';
		
		$html.="<table><tr><th colspan=2>Widget : {$widgetinfo[0]['name']}</th><tr>";
		$html.="<tr><td>Description : </td><td>$description</td></tr>";
		$html.="<tr><td>Instances : </td><td>";
		$instances=getWidgetInstances($widgetid);
		if(count($instances)>0) $html.="<ol>";
		else $html.="None"; 
		foreach($instances as $instance)
		{
			$html.="<li><a href='$urlRequestRoot/{$instance['url']}/+settings&subaction=widgets'>".
					"{$instance['name']} [{instance['url']}]</li>";
		}
		if(count($instances)>0) $html.="</ol>";
		
		
		$html .="<tr>".join($formElements, "</tr>\n<tr>")."</tr>";
		
		$html.="</table><input name='update_global_settings' type='submit' value='Update'/>" .
				"<input type='reset' value='Reset'/>";
		$html.="</form><br/>";
		
	
	}
	
	
	$widgetsarr=getAllWidgetsInfo();
	
	
	
	$html .= "<fieldset><legend>{$ICONS['Widgets']['small']}Available Widgets</legend>";
	
	$html .= "<table><tr><th colspan=2>Available Widgets<br/>Click for more information</th></tr>";
	foreach( $widgetsarr as $widget )
	{
		$html.="<tr><td><a href='./+admin&subaction=widgets&widgetid=".$widget['id']."'>".$widget['name']."</a></td></tr>";
	}
	$html.="</table>";
	return $html;
}
/**
 * Retrieves the global configurations in the form of an HTML with all the fields and types appropriately put into place.
 *
 * @param $widgetinfo Contains the array of configuration settings
 *
 * @return see description.
 */
function getGlobalConfigFormAsArray($widgetinfo,$containsFileUploadFields)
{
		$containsFileUploadFields = false;
		$formValues = array();
	
		$formElements = array();
		$confids = array();
		foreach($widgetinfo as $configentry)
			$confids[]=$configentry['confid'];
			
		$query="SELECT `config_id` AS 'confid', `config_value` AS 'confvalue' FROM ".MYSQL_DATABASE_PREFIX."widgetsconfig WHERE `widget_instanceid`=-1 AND `widget_id`={$widgetinfo[0]['id']}  AND `config_id` IN (".join($confids,",").")";
		
		$res=mysql_query($query); 
		while($row=mysql_fetch_assoc($res))
		{
			$formValues[$row['confid']]=$row['confvalue'];
		}
		
		$jsValidationFunctions = array();

		foreach( $widgetinfo as $configentry )
		{
			$jsOutput = '';
			if($configentry['conftype'] == 'file') {
				$containsFileUploadFields = true;
			}
			$formElements[] =	getFormElementInputField
						(
							$configentry,
							isset($formValues[$configentry['confid']]) ? $formValues[$configentry['confname']] : ''
						);
			if($jsOutput != '') {
				$jsValidationFunctions[] = $jsOutput;
			}
		}

		return $formElements;
}

/**
 * Retrieves the HTML code of a particular form element type.
 *
 * @param $configentry Contains the informations about a particular configuration
 * @param $value Current value of that configuration (not default)
 * @return The HTML field of that configuration along with the javascript Validation function (if any).
 */
function getFormElementInputField($configentry, $value="") {


	
	$htmlOutput = '<td>' . $configentry['confdisplay'];

	$elementType = $configentry['conftype'];
	$elementTypeOptions = $configentry['confoptions'];

	$elementName = 'globalconfform_' .  $configentry['confid'];

	$htmlOutput .='</td><td>';
	
	$functionName = "render".ucfirst(strtolower($elementType))."TypeField";
	
	if($functionName($elementName,$value,$elementTypeOptions,$htmlOutput)==false)
		displayerror("Unable to run function ".$functionName);

	return $htmlOutput . "</td>\n";
}
/**
 * Renders the Text-Area type element
 *
 * @param $elementName	The name of the field
 * @param $value The current value
 * @param $elementTypeOptions The extra options related to this field type
 * @param $htmlOutput Will contain the actual HTML Output
 * @return true if succesful, or false if rendering failed.
 */
function renderTextareaTypeField($elementName,$value,$elementTypeOptions,&$htmlOutput)
{
			$rows = 5;
			$cols = 20;
			$htmlOutput .= '<textarea style="width:100%" rows="'.$rows.'" cols="'.$cols.'"  name="'.$elementName.'" id="'.$elementName.'>' . $value . '</textarea>';
			return true;
}
/**
 * Renders the Select type element
 *
 * @param $elementName	The name of the field
 * @param $value The current value
 * @param $elementTypeOptions The extra options related to this field type
 * @param $htmlOutput Will contain the actual HTML Output
 * @return true if succesful, or false if rendering failed.
 */
function renderSelectTypeField($elementName,$value,$elementTypeOptions,&$htmlOutput)
{

	$options = split('\|', $elementTypeOptions);
	$optionsHtml = '';

	for($i = 0; $i < count($options); $i++) {
		if($options[$i] == $value) {
			$optionsHtml .= '<option value="'.$i.'" selected="selected" >' . $options[$i] . "</option>\n";
		}
		else {
			$optionsHtml .= '<option value="'.$i.'" >' . $options[$i] . "</option>\n";
		}
	}

	$htmlOutput .= '<select name="'.$elementName.'" id="'.$elementName.'">' . $optionsHtml . '</select>';
	return true;
}
/**
 * Renders the Radio type element
 *
 * @param $elementName	The name of the field
 * @param $value The current value
 * @param $elementTypeOptions The extra options related to this field type
 * @param $htmlOutput Will contain the actual HTML Output
 * @return true if succesful, or false if rendering failed.
 */
function renderRadioTypeField($elementName,$value,$elementTypeOptions,&$htmlOutput)
{

	
	$options = split('\|', $elementTypeOptions);
	$optionsHtml = '';

	for($i = 0; $i < count($options); $i++) {
		$optionsHtml .= '<label><input type="radio" id="'.$elementName.'" name="'.$elementName.'" value="'.
										$i.'"';

		if($options[$i] == $value) {
			$optionsHtml .= ' checked="checked"';
		}

		$optionsHtml .= '/>'.$options[$i].'</label>&nbsp;&nbsp;';
	}

	$htmlOutput .= $optionsHtml;
	return true;
}
/**
 * Renders the Bool type element
 *
 * @param $elementName	The name of the field
 * @param $value The current value
 * @param $elementTypeOptions The extra options related to this field type
 * @param $htmlOutput Will contain the actual HTML Output
 * @return true if succesful, or false if rendering failed.
 */
function renderBoolTypeField($elementName,$value,$elementTypeOptions,&$htmlOutput)
{

	
	$options = array("Yes","No");
	$optionsHtml = '';

	for($i = 0; $i < count($options); $i++) {
		$optionsHtml .= '<label><input type="radio" id="'.$elementName.'" name="'.$elementName.'" value="'.
										$i.'"';

		if($options[$i] == $value) {
			$optionsHtml .= ' checked="checked"';
		}

		$optionsHtml .= '/>'.$options[$i].'</label>&nbsp;&nbsp;';
	}

	$htmlOutput .= $optionsHtml;
	return true;
}
/**
 * Renders the Checkbox type element
 *
 * @param $elementName	The name of the field
 * @param $value The current value
 * @param $elementTypeOptions The extra options related to this field type
 * @param $htmlOutput Will contain the actual HTML Output
 * @return true if succesful, or false if rendering failed.
 */
function renderCheckboxTypeField($elementName,$value,$elementTypeOptions,&$htmlOutput)
{

	$optionsHtml = '';
	$values=explode("|",$value);
	for($i = 0; $i < count($options); $i++) {
		$optionsHtml .= '<label><input type="checkbox" id="'.$elementName.'_'.$i.'" name="'.$elementName.'_'.$i.'" value="'.
										htmlentities($options[$i]).'"';

		if(array_search($options[$i],$values)!==FALSE) {
			$optionsHtml .= ' checked="checked"';
		}

		$optionsHtml .= $validCheck.' />'.$options[$i].'</label>&nbsp;&nbsp;';
	}

	$htmlOutput .= $optionsHtml;
	return true;
}
/**
 * Renders the File type element
 *
 * @param $elementName	The name of the field
 * @param $value The current value
 * @param $elementTypeOptions The extra options related to this field type
 * @param $htmlOutput Will contain the actual HTML Output
 * @see getFileUploadField
 * @return true if succesful, or false if rendering failed.
 */
function renderFileTypeField($elementName,$value,$elementTypeOptions,&$htmlOutput)
{

	global $sourceFolder;
	require_once("$sourceFolder/upload.lib.php");
	
	///Used to maintain uniformity in upload fields in the CMS
	$htmlOutput .= getFileUploadField($elementName,"", 2*1024*1024, ""); 

	
	if($value != '') {
		$htmlOutput .= '<br />(Leave blank to keep current file : <a href="./' . $value . '">'.$value.'</a>)';
	}

	return true;
}
/**
 * Renders the Text type element
 *
 * @param $elementName	The name of the field
 * @param $value The current value
 * @param $elementTypeOptions The extra options related to this field type
 * @param $htmlOutput Will contain the actual HTML Output
 * @return true if succesful, or false if rendering failed.
 */
function renderTextTypeField($elementName,$value,$elementTypeOptions,&$htmlOutput)
{
	
	$htmlOutput .= '<input type="text" name="'.$elementName.'" id="'.$elementName.'" value="'.$value.'"  />';
								
	return true;
}
/**
 * Renders the Integer type element
 *
 * @param $elementName	The name of the field
 * @param $value The current value
 * @param $elementTypeOptions The extra options related to this field type
 * @param $htmlOutput Will contain the actual HTML Output
 * @return true if succesful, or false if rendering failed.
 */
function renderIntegerTypeField($elementName,$value,$elementTypeOptions,&$htmlOutput)
{
	
	$htmlOutput .= '<input type="text" class="numeric" name="'.$elementName.'" id="'.$elementName.'" value="'.$value.'"  />';
								
	return true;
}
/**
 * Renders the Hidden type element
 *
 * @param $elementName	The name of the field
 * @param $value The current value
 * @param $elementTypeOptions The extra options related to this field type
 * @param $htmlOutput Will contain the actual HTML Output
 * @return true if succesful, or false if rendering failed.
 */
function renderHiddenTypeField($elementName,$value,$elementTypeOptions,&$htmlOutput)
{
	
	$htmlOutput .= '<input type="hidden" name="'.$elementName.'" id="'.$elementName.'" value="'.$value.'"  />';
								
	return true;
}
/**
 * Renders the Datetime type element
 *
 * @param $elementName	The name of the field
 * @param $value The current value
 * @param $elementTypeOptions The extra options related to this field type
 * @param $htmlOutput Will contain the actual HTML Output
 * @return true if succesful, or false if rendering failed.
 */
function renderDatetimeTypeField($elementName,$value,$elementTypeOptions,&$htmlOutput)
{
	
	$datetimeFormat = "'%Y-%m-%d %H:%M'";

	$validCheck .= ' dateformat="YY-MM-DD hh:mm" ';


	$htmlOutput .= '<input type="text" '. $validCheck . ' name="'.$elementName.'" value="' . $value . '" id="'.$elementName.'" /><input name="cal'.$elementName.'" type="reset" value=" ... " onclick="return showCalendar(\'' . $elementName . '\', '.$datetimeFormat.', \'24\', true);" />';
	return true;
}
/**
 * Renders the Date type element
 *
 * @param $elementName	The name of the field
 * @param $value The current value
 * @param $elementTypeOptions The extra options related to this field type
 * @param $htmlOutput Will contain the actual HTML Output
 * @return true if succesful, or false if rendering failed.
 */
function renderDateTypeField($elementName,$value,$elementTypeOptions,&$htmlOutput)
{
	
	$datetimeFormat = "'%Y-%m-%d'" ;

	$validCheck .= ' dateformat="YY-MM-DD" ';


	$htmlOutput .= '<input type="text" '. $validCheck . ' name="'.$elementName.'" value="' . $value . '" id="'.$elementName.'" /><input name="cal'.$elementName.'" type="reset" value=" ... " onclick="return showCalendar(\'' . $elementName . '\', '.$datetimeFormat.', \'24\', true);" />';
	return true;
}
/**
 * Reloads the widgets from the widget directoty and update proper entries in database.
 *
 * @param
 *
 * @return
 */
function reloadWidgets()
{
	// Load the widgets from widget/ directory and update proper entries in database. Should be there in admin/site-maintenaince
}
/**
 * Gets the widget information and global configuration settings about a particular widget
 *
 * @param $widgetid Id of the widget type
 *
 * @return Configuration settings, only global.
 */
function getWidgetGlobalInfo($widgetid)
{
	$query="SELECT `widget_id` AS 'id',`widget_name` AS 'name', `config_id` AS 'confid', `config_name` AS 'confname', `config_displaytext` AS 'confdisplay', `config_type` AS 'conftype',`config_options` AS 'confoptions',`config_default` AS 'confdefault'  FROM `".MYSQL_DATABASE_PREFIX."widgetsinfo` WHERE `widget_id`=$widgetid AND `is_global`=1 ";
	$res=mysql_query($query);
	$ret=array();
	while($arr=mysql_fetch_assoc($res))
	{
		$ret[]=$arr;
	}
	return $ret;
}
/**
 * Retrieves the widget id and name of all the widgets
 *
 * @return An associative 2D array containing the widget ids and names.
 */
function getAllWidgetsInfo()
{
	$query="SELECT DISTINCT(`widget_id`) AS 'id',`widget_name` AS 'name' FROM `".MYSQL_DATABASE_PREFIX."widgetsinfo`";
	$res=mysql_query($query);
	$ret=array();
	while($row=mysql_fetch_array($res))
	{
		$ret[]=$row;
	}
	return $ret;
}
function updateGlobalConf($widgetid)
{
	
	$query="SELECT `config_name` FROM `".MYSQL_DATABASE_PREFIX."widgetsglobalconfig` WHERE `widget_id`=$widgetid";
	$res=mysql_query($query);
	while($row=mysql_fetch_array($res))
	{
		if(isset($_POST[$row['config_name']]))
		{
			$configname=$row['config_name'];
			$configval=escape($_POST[$configname]);
			
			mysql_query("UPDATE `".MYSQL_DATABASE_PREFIX."widgetsglobalconfig` SET `config_value`=$configval WHERE `config_name`=$configname");
		}
		else 
		{
			displayerror("Could not update the global configurations. Some fields missing.");
			return;	
		}
	}
	displayinfo("Global configurations updated successfully!");
}
function getWidgetInstances($widgetid)
{
	return array();
}
function readWidgetDescription($widgetid)
{
	return "hi";
}

function renderInputField($config)
{
	return "<input type='{$config['type']}' name='{$config['name']}' value='{$config['value']}'";
}

 
?>