//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// site-specific declarations
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
var m_blnDoBodyUnload = false;
var m_winAddressManager;
var m_BlinkTopAlertBarTID;

//the following "BarHeight" values MUST equal height + border-width as defined in global_base.css
var m_iTopAlertBarHeight = 21;
var m_iTopToolBarHeight = 25;
var ProgressID; // for polling progress bar
var ShowProgressBar = false;
var DefaultTimer;

var CategorySearchResults = [];

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// site-specific functions
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//


function WriteAdminNavBar(LinkedMemberExists, HasMemberAuthID, MemberName, IsContentAdmin, SmartLink)
{
	try { if (m_blnSuppressAdminNavBar) return; } catch (e) { };

	var sContent = '';
	if (HasMemberAuthID) {
		sContent += '<div style="float:left">YOU ARE SIGNED IN AS: ';
		sContent += ('<span style="text-transform:uppercase">' + MemberName);
		sContent += '</span> (<a href="/general/logout.asp">SIGN OUT</a>)&nbsp;&nbsp;</div>';
		sContent += '<div style="float:right">';
	} else if (LinkedMemberExists) {
		sContent += '<div style="float:center">';
		sContent += '<a href="/general/login_admin_as_linked_member.asp">SIGN IN TO THE COMMUNITY</a>&nbsp;|&nbsp;';
	} else {
		sContent += '<div style="float:center">';
	}

	sContent += '<a href="/admin/">ADMIN DASHBOARD</a>';

	if (SmartLink != undefined)
	{
		if (SmartLink.length > 0)
			sContent += '&nbsp;|&nbsp;<a href="' + SmartLink + '">RETURN TO PREVIOUS ADMIN PAGE</a>';
	}

	if (IsContentAdmin) {
		sContent += '&nbsp;|&nbsp;<a href="#" onclick="openPopup(\'/admin/content/resource_manager.asp\',\'winResMgr\',\'toolbar=false,status,scrollbars,resizable\',\'650\',\'720\'); return false;">SITE RESOURCE MANAGER</a>';
		sContent += '&nbsp;|&nbsp;<a href="#" onclick="ToggleAdminEditMode()"); return false;" id="togglelink">';

		var toggle = getCookie("AdminEditMode");

		if (toggle != null && toggle != "") {
			if (toggle == "1") {
				sContent += 'EDIT MODE [ON]</a>'
			}
			else {
				sContent += 'EDIT MODE [OFF]</a>'
			}
		}
		else {
			sContent += 'EDIT MODE [OFF]</a>'
		}
	}

	sContent += '</div>';

	WriteTopAlertBar(sContent);
}

function ToggleAdminEditMode() {
	var toggle = getCookie("AdminEditMode");

	if (toggle != null) {
		if (toggle == "1") {
			setCookie("AdminEditMode", "0", "/", 1);
		}
		else {
			setCookie("AdminEditMode", "1", "/", 1);
		}
	}
	else {
		setCookie("AdminEditMode", "0", "/", 1);
	}

	window.location.reload();
	return;
}

function WriteTopAlertBar(sContent, iBlinks) {
	var TopAlertBarText = document.getElementById('TopAlertBarText');
	if (TopAlertBarText) {	//update alert bar text
		TopAlertBarText.innerHTML = sContent;

	} else {
		//create the alert bar
		var TopAlertBar = document.createElement('div');
		TopAlertBar.setAttribute('id', 'TopAlertBar');

		TopAlertBarText = document.createElement('div');
		TopAlertBarText.setAttribute('id', 'TopAlertBarText');


		TopAlertBarText.onmouseover = function() {
			document.getElementById('TopAlertBarText').style.display = '';
			clearTimeout(m_BlinkTopAlertBarTID);
		};

		TopAlertBarText.innerHTML = sContent;
		TopAlertBar.appendChild(TopAlertBarText);

		var docBody = document.getElementsByTagName('body')[0];

		docBody.appendChild(TopAlertBar);

	}

	if ((!isNaN(iBlinks)) && iBlinks > 0) BlinkTopAlertBar(iBlinks);

	var $ToolBar = $("#TopAlertBar");
	// Create sticky tool bar
	StickyFooter($ToolBar);

	// Hide Tool  Bar on scroll
	HideOnScroll($ToolBar);
}

function WriteTopToolBar(sContent) {
	var TopToolBarText = document.getElementById('TopToolBarText');
	if (TopToolBarText) {	//update top toolbar text
		TopToolBarText.innerHTML = sContent;
	} else {
		//create the toolbar
		var iTop = 0;
		if (document.getElementById('TopAlertBar')) {
			iTop = (m_iTopAlertBarHeight * 1);

		}

		var TopToolBar = document.createElement('div');
		TopToolBar.setAttribute('id', 'TopToolBar');

		TopToolBarText = document.createElement('div');
		TopToolBarText.setAttribute('id', 'TopToolBarText');

		TopToolBarText.innerHTML = sContent;
		TopToolBar.appendChild(TopToolBarText);

		var docBody = document.getElementsByTagName('body')[0];

		docBody.appendChild(TopToolBar);

		var TopAlertBarHeight = 21;
	
		var $ToolBar = $("#TopToolBar");

		if (document.getElementById('TopAlertBar')) {

			StickyFooterWithAlertBar($ToolBar);// account for the extra space of the admin bar
			HideOnScroll($ToolBar);
		}
		else
		{
			StickyFooter($ToolBar);// no admin bar present
			HideOnScroll($ToolBar);
		}
	}
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// Progress bar functions
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//

function CreateProgressBarMarkup() {

	//  create empty divs that will hold the information from the jquery ajax call in function WriteProgressBar
	//	var CurrentScoreHiddenField = document.createElement('input');
	//	CurrentScoreHiddenField.setAttribute('type', 'hidden');
	//	CurrentScoreHiddenField.setAttribute('id', 'CurrentScore');

	//	var GameLevelNameHiddenField = document.createElement('input');
	//	GameLevelNameHiddenField.setAttribute('type', 'hidden');
	//	GameLevelNameHiddenField.setAttribute('id', 'GameLevelName');

	//	var BarEnabledHiddenField = document.createElement('input');
	//	BarEnabledHiddenField.setAttribute('type', 'hidden');
	//	BarEnabledHiddenField.setAttribute('id', 'IsProgressBarEnabled');

	//	var GameLevelHiddenField = document.createElement('input');
	//	GameLevelHiddenField.setAttribute('type', 'hidden');
	//	GameLevelHiddenField.setAttribute('id', 'GameLevel');

	//	var ScoreUpdatedHiddenField = document.createElement('input');
	//	ScoreUpdatedHiddenField.setAttribute('type', 'hidden');
	//	ScoreUpdatedHiddenField.setAttribute('id', 'ScoreUpdated');

	//	var ShowProgressBarAlwaysHiddenField = document.createElement('input');
	//	ShowProgressBarAlwaysHiddenField.setAttribute('type', 'hidden');
	//	ShowProgressBarAlwaysHiddenField.setAttribute('id', 'ShowProgressBarAlways');


	//	var HasCurrentBadgeMarkupHiddenField = document.createElement('input');
	//	HasCurrentBadgeMarkupHiddenField.setAttribute('type', 'hidden');
	//	HasCurrentBadgeMarkupHiddenField.setAttribute('id', 'HasCurrentBadgeMarkup');

	//	var HasNextBadgeMarkupHiddenField = document.createElement('input');
	//	HasNextBadgeMarkupHiddenField.setAttribute('type', 'hidden');
	//	HasNextBadgeMarkupHiddenField.setAttribute('id', 'HasNextBadgeMarkup');

	var CurrentScoreDiv = document.createElement('div');
	CurrentScoreDiv.setAttribute('id', 'CurrentScore');
	CurrentScoreDiv.style.display = 'none';

	var GameLevelNameDiv = document.createElement('div');
	GameLevelNameDiv.setAttribute('id', 'GameLevelName');
	GameLevelNameDiv.style.display = 'none';	

	var BarEnabledDiv = document.createElement('div');
	BarEnabledDiv.setAttribute('id', 'IsProgressBarEnabled');
	BarEnabledDiv.style.display = 'none';	

	var GameLevelDiv = document.createElement('div');
	GameLevelDiv.setAttribute('id', 'GameLevel');
	GameLevelDiv.style.display = 'none';	

	var ScoreUpdatedDiv = document.createElement('div');
	ScoreUpdatedDiv.setAttribute('id', 'ScoreUpdated');
	ScoreUpdatedDiv.style.display = 'none';

	// Create the tool bar that will hold the progress bar stuff
	var progressToolBarDiv = document.createElement('div');
	progressToolBarDiv.setAttribute('id', 'ProgressToolBar');
	progressToolBarDiv.style.display = 'none';

	var ShowProgressBarDiv = document.createElement('div');
	ShowProgressBarDiv.setAttribute('id', 'ShowProgressBarAlways');
	ShowProgressBarDiv.style.display = 'none';

	var HasCurrentBadgeMarkupDiv = document.createElement('div');
	HasCurrentBadgeMarkupDiv.setAttribute('id', 'HasCurrentBadgeMarkup');
	HasCurrentBadgeMarkupDiv.style.display = 'none';

	var HasNextBadgeMarkuDiv = document.createElement('div');
	HasNextBadgeMarkuDiv.setAttribute('id', 'HasNextBadgeMarkup');
	HasNextBadgeMarkuDiv.style.display = 'none';

	var YuiDiv = document.createElement('div');
	YuiDiv.setAttribute('class', 'yui-skin-sam');

	// I'm lazy, create the inner tool bar with text that will be placed inside the progress tool bar
	var progressToolBarInnerHtml = '<div id="ProgressBarText" style="display:none;" onmouseover="showBadge(this)">' +
								   '</div><div class="progressBar" id="progressBar" style="display:none;"></div>' +
								   '<div id="NextProgressBarText" style="display:none;" onmouseover="showBadge(this)"></div>';

	var YuiDivInnerHtml = '<div id="BadgePanel" style="visibility: hidden;" class="BadgePanel">' +
				 '<div id="BadgePanelHead" class="hd"></div>' +
				 '<div id="BadgePanelBody" class="bd"></div></div>';

	YuiDiv.innerHTML = YuiDivInnerHtml;

	// put those divs inside the progress tool bar
	progressToolBarDiv.innerHTML = progressToolBarInnerHtml;

	// append everything!
	var docBody = document.getElementsByTagName('body')[0];

//	docBody.appendChild(CurrentScoreHiddenField);
//	docBody.appendChild(GameLevelNameHiddenField);
//	docBody.appendChild(BarEnabledHiddenField);
//	docBody.appendChild(GameLevelHiddenField);
//	docBody.appendChild(ScoreUpdatedHiddenField);
//	docBody.appendChild(ShowProgressBarAlwaysHiddenField);
//	docBody.appendChild(HasNextBadgeMarkupHiddenField);
//	docBody.appendChild(HasCurrentBadgeMarkupHiddenField);
	docBody.appendChild(HasNextBadgeMarkuDiv)
	docBody.appendChild(HasCurrentBadgeMarkupDiv);
	docBody.appendChild(ShowProgressBarDiv);
	docBody.appendChild(ScoreUpdatedDiv);
	docBody.appendChild(GameLevelDiv);
	docBody.appendChild(BarEnabledDiv);
	docBody.appendChild(GameLevelNameDiv);
	docBody.appendChild(CurrentScoreDiv);
	docBody.appendChild(progressToolBarDiv);
	docBody.appendChild(YuiDiv);

	// wire up mouse out to hide either badge on mouse out of tool bar
	$('#ProgressToolBar').mouseout(function() {
		YAHOO.container.BadgePanel.hide();
	});
	
	createBadgeYUI();
	WriteProgressBar();
}

function WriteProgressBar() {

	var url = '/general/ProgressBarReceiver.aspx?TransferSession=0';

	// only poll for new data if Pulse has not been disabled
	if (getCookie("PulseOff") != "1")
	{
		$.ajax({
			url: url,
			async: true,
			dataType: 'json',
			success: function (json) {
				$('#CurrentScore').text(json.CurrentScore); // the current score as a string, only in 10s
				$('#ProgressBarText').text(json.CurrentLevelName); // the current game level name with stats(percentage achieved until next level)
				$('#NextProgressBarText').text(json.NextLevelName); // the name of the next level if one exists
				$('#IsProgressBarEnabled').text(json.IsProgressBarEnabled);
				$('#GameLevel').text(json.LevelName);
				$('#ScoreUpdated').text(json.blnUserAchievedNewScore);
				$('#ShowProgressBarAlways').text(json.ShowProgressBarAlways);
				$('#HasCurrentBadgeMarkup').text(json.HasCurrentBadgeMarkup);
				$('#HasNextBadgeMarkup').text(json.HasNextBadgeMarkup);

				var progress = $("#CurrentScore").text();
				var intProgress = parseInt(progress);
				var isScoreUpdated = $("#ScoreUpdated").text();
				var showProgressBarAlways = $("#ShowProgressBarAlways").text();
				var IsProgressBarEnabled = $("#IsProgressBarEnabled").text();
				var hasCurrentBadgeMarkup = $("#HasCurrentBadgeMarkup").text();
				var hasNextBadgeMarkup = $("#HasNextBadgeMarkup").text();

				$("#ProgressToolBar").hide();
				$("#ProgressBarText").hide();
				$("#progressBar").hide();
				$("#NextProgressBarText").hide();

				//add onmouseover/onhover to ProgressBarText conditionally
				if ((hasCurrentBadgeMarkup == "False") | (hasCurrentBadgeMarkup == "false")) {
					$("#ProgressBarText").remove('onmouseover', 'showBadge(this)');
				}
				//add onmouseover/onhover NextProgressBarText conditionally
				if ((hasNextBadgeMarkup == "False") | (hasNextBadgeMarkup == "false")) {
					$("#NextProgressBarText").remove('onmouseover', 'showBadge(this)');
				}

				// check to see if there is a value  for game level, if there isn't then no use for progress bar
				var gameLevel = $("#GameLevel"); // this value only holds the text of the actual game level name with no statistics
				var ProgressBarText = $("#ProgressBarText"); // this holds game level name with current percent achieved, set to invisible already
				var ProgressBar = $("#progressBar");
				var ProgressToolBar = $("#ProgressToolBar");
				var NextProgressBarText = $("#NextProgressBarText");

				// Don't show if progress bar isn't enabled
				if (IsProgressBarEnabled.toLowerCase() == "true") {
					if ((!gameLevel.text()) && (!NextProgressBarText.text())) {
						// hide the tool bar, no game levels exist
						ProgressToolBar.hide();
						ProgressBarText.hide();
						ProgressBar.hide();
						NextProgressBarText.hide();
					}
					else {
						// else if it's active set the value
						var ProgressBar = $("#progressBar");
						var ProgressToolBar = $("#ProgressToolBar");
						$("div.progressBar").progressbar({
							value: intProgress
						});

						$("#profileProgressBar").progressbar({
							value: intProgress
						});

						if ((isScoreUpdated == "True") | (isScoreUpdated == "true")) {
							// set the animation acccording to user preference on progress bar display
							if (showProgressBarAlways.toLowerCase() == "false") {
								ProgressBarText.show();
								ProgressBar.show();
								NextProgressBarText.show();

								ProgressToolBar.show(3000).fadeIn(4000).delay(5000);
								ProgressToolBar.hide(2000).fadeOut(2000);
							}
							else // it's set to always active
							{
								ProgressBarText.show();
								ProgressBar.show();
								NextProgressBarText.show();
								ProgressToolBar.show();
							}
						}

					}
				}

			},
			complete: function () {

				return true;
			}
		});
	}
	pollForProgress();
}

function pollForProgress(retrys) {
	// poll for new progress bar data, new score
	try {
		//check for new conversations every 60 seconds
		ProgressID = setTimeout(function() { WriteProgressBar() }, 60000);
	}
	catch (e) {
		//retry 3 times before giving up
		if (isNaN(retrys)) retrys = 0;
		if (retrys < 3) {
			retrys++;
			ProgressID = setTimeout(function() { WriteProgressBar(retrys) }, 1000);
		}
	}
}

function createBadgeYUI() {

	YAHOO.namespace("container");

	function YAHOOinitBadgePanel() {
		YAHOO.container.BadgePanel = new YAHOO.widget.Panel("BadgePanel", { visible: false,
			iframe: true,
			constraintoviewport: true,
			close: false,
			draggable: false,
			modal: false,
			underlay: 'shadow'
		});

		YAHOO.container.BadgePanel.render();
	}

	YAHOO.util.Event.onDOMReady(YAHOOinitBadgePanel);	
}

function showBadge(Badge) {

	var currentId = $(Badge).attr('id');
	
	var url = '/general/GameLevelBadgeReciever.aspx?selected=' + $(Badge).attr('id');

	$.ajax({
		url: url,
		async: true,
		dataType: 'json',
		success: function(json) {
			if (json.SelectedBadge) {
				$('#BadgePanelBody').html(json.SelectedBadge);
				//IE hack: underlay size does not change with panel size; resize it now
				if (document.all) YAHOO.container.BadgePanel.sizeUnderlay();

				if (document.all) YAHOO.container.BadgePanel.sizeUnderlay();
				YAHOO.container.BadgePanel.cfg.setProperty('context', [currentId, 'tl', 'bl']);
				YAHOO.container.BadgePanel.show();
			}
		},
		complete: function() {

			return true;
		}
	});	
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// End progress bar functions
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//

function StickyFooterWithAlertBar(ToolBar) {// if the user is an admin and chatting place the chat bar above the admin bar
	if (document.compatMode == 'BackCompat') {// Are we in quirks mode?

		$(function() {
			positionFooter();
			function positionFooter() {
				$("#TopToolBar").css({ position: "absolute", top: ($(window).scrollTop() + $(window).height() - 45) + "px" })
			}

			$(window)
		.scroll(positionFooter)
		.resize(positionFooter)
		});

	}
	else {// standards mode thus position fixed works
		$(ToolBar).css({
			position: 'fixed',
			bottom: '21px'
		});

	}
}

function StickyFooter(ToolBar) {// Chat bar with no active admin bar

	// The css class for CSS1Compat aka standards is already set so nothing will happen unless in quirks aka BackCompat
	if (document.compatMode == 'BackCompat') {

		$(function() {
			positionFooter();
			function positionFooter() {
				ToolBar.css({ position: "absolute", top: ($(window).scrollTop() + $(window).height() - ToolBar.height()) + "px" })
			}

			$(window)
		.scroll(positionFooter)
		.resize(positionFooter)
		});
	}

}

function HideOnScroll(ToolBar) {
	var $menu = ToolBar;
	var opacity = $menu.css("opacity");
	var scrollStopped;

	var fadeInCallback = function() {
		if (typeof scrollStopped != 'undefined') {
			clearInterval(scrollStopped);
		}

		scrollStopped = setTimeout(function() {
			$menu.animate({ opacity: 1 }, "fast");
		}, 100);
	}

	$(window).scroll(function() {
		if (!$menu.is(":animated") && opacity == 1) {
			$menu.animate({ opacity: 0 }, "fast", fadeInCallback);
		} else {
			fadeInCallback.call(this);
		}
	});
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// Category auto complete functions
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//

function QuickSearchForm_DoSubmit()
{
	var QuickSearchForm = document.getElementById('QuickSearchForm');	
	if(QuickSearchForm)
	{
		ClearDefaultValue(QuickSearchForm.bst);
		QuickSearchForm.submit();
	}
	return false;
}

function QuickSearchForm_OnFocus()
{
	var element = document.getElementById("QuickSearchForm_bst");
	ClearDefaultValue(element);
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// End category auto complete functions
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//

function BlinkTopAlertBar(HowManyTimes, i)
{
	if (isNaN(i)) i = 1;

	if (i % 2 == 0) {
		document.getElementById('TopAlertBarText').style.display = '';
	} else {
		document.getElementById('TopAlertBarText').style.display = 'none';
	}

	if (i < (HowManyTimes * 2)) {
		i++;
		m_BlinkTopAlertBarTID = setTimeout(function() { BlinkTopAlertBar(HowManyTimes, i) }, 300);
	}
}

function CheckCityStateZip(oForm, sCityField, sZipField, sStateField, sStateList) {
	if (eval('oForm.' + sCityField).value == '') return false;
	if (eval('oForm.' + sZipField).value == '') return false;
	if (eval('oForm.' + sStateField).value == '') {
		var oStateList = eval('oForm.' + sStateList);
		if (oStateList.options[oStateList.selectedIndex].value == '') return false;
	}

	return true;
}

function CheckMultipartForms(blnAllowSubmit) {
	if (blnAllowSubmit) return;
	if (!document.forms.length > 0) return;

	var blnFoundOne = false;
	for (var i = 0; i < document.forms.length; i++) {
		if (document.forms[i].enctype.toLowerCase() == 'multipart/form-data') {
			blnFoundOne = true;
			document.forms[i].onsubmit = function() { return false; }
		}
	}

	if (blnFoundOne) alert('We\'\re sorry, file uploads and forms containing file uploads\nhave been temporarily disabled. Please check back in a few minutes.');
}

function DoUploadProgress(sender) {	//does the hidden field exist for storing the progress-id?
	var sUid = '', sPid = '';
	if (sender.UploadID) {
		sUid = sender.UploadID.value;
	} else if (sender.ProgressID) {
		sPid = sender.ProgressID.value;
	} else {
		return true;
	}

	//are there any files being uploaded?
	var fields = sender.elements;
	var bHasFile = false;
	FieldLoop: for (var i = 0; i < fields.length; i++) {
		if (fields[i].type.toLowerCase() == 'file' && fields[i].value != '') {
			bHasFile = true;
			break FieldLoop;
		}
	}

	if (!bHasFile) return true;

	var sAction = sender.action;

	var rx = new RegExp("\\?.+=", "i");
	if (rx.test(sAction)) {
		sAction += '&';
	} else {
		rx.compile("\\?$", "i");
		if (!rx.test(sAction)) sAction += '?';
	}

	var sIdArg = sUid.length > 0 ? 'uid=' + sUid : 'pid=' + sPid;

	sAction += sIdArg;
	sender.action = sAction;

	openPopup('/general/upload_progress.asp?' + sIdArg, 'UploadProgress', 'status,toolbar=false', 250, 120);

	return true;
}

function openCsvExport(unicode, alternateUrl, extraQueryArgs) {
	var Url = alternateUrl == null ? '/admin/database/csv_export.asp' : alternateUrl;
	if (extraQueryArgs == null) extraQueryArgs = '';
	openPopup(Url + '?unicode=' + unicode.toString() + '&' + extraQueryArgs.toString(), '_blank', 'resizable,status,toolbar=false', 350, 150);
	return false;
}

//address-manager window functions
function openAddressManager(AddrMgrUrl, MasterElementId, QueryArgs) {
	m_winAddressManager = returnPopup(AddrMgrUrl + '?OpenerMasterElementId=' + MasterElementId + '&' + QueryArgs, 'AddressManager', 'resizable,scrollbars,status,toolbar=false', 660, 475);
	m_winAddressManager.focus()
	return false;
}

function closeAddressManager() {
	try { m_winAddressManager.close(); } catch (e) { };
}

function openMugshotPopup(Url) {
	return openPopup(Url, 'MemberMugshot', 'resizable,scrollbars,status,toolbar=false', 537, 405);
}

function openPrintView(Url, OpenDialog, QueryArgs) {
	openPopup(Url + "?PrintView=1&OpenDialog=" + OpenDialog + "&" + QueryArgs,
		"PrintView", "menubar,scrollbars,status,toolbar=false", 640, 640);
	return false;
}

//begin dynamic help functions
var m_blnInlineHelpIsOn = false;

function switchInlineHelpDisplay() {
	if (m_blnInlineHelpIsOn) {
		doInlineHelpOff();
	} else {
		doInlineHelpOn();
	}
	return false;
}

function doInlineHelpOn() {
	//show inline help areas
	setInlineHelpDisplay(true);
	//switch toggle link
	dhtmlDisplay('InlineHelpLinkShow', 'none');
	dhtmlDisplay('InlineHelpLinkHide', '');
	//set current state
	m_blnInlineHelpIsOn = true;
	//preserve current state in cookie
	setInlineHelpCookie();
}

function doInlineHelpOff() {
	//hide inline help areas
	setInlineHelpDisplay(false);
	//switch toggle link
	dhtmlDisplay('InlineHelpLinkShow', '');
	dhtmlDisplay('InlineHelpLinkHide', 'none');
	//set current state
	m_blnInlineHelpIsOn = false;
	//preserve current state in cookie
	setInlineHelpCookie();
}

function setInlineHelpCookie() {
	if (document.cookie) {	//set cookie expiry at 1 year
		var datExpires = new Date();
		datExpires.setTime(datExpires.getTime() + 31536000000);
		if (m_blnInlineHelpIsOn) {
			document.cookie = 'InlineHelpDisplay=InlineHelpDisplayOn; expires=' + datExpires.toGMTString() + '; path=/';
		} else {
			document.cookie = 'InlineHelpDisplay=InlineHelpDisplayOff; expires=' + datExpires.toGMTString() + '; path=/';
		}
	}
}

function setInlineHelpDisplay(visible) {
	setInlineHelpDisplayItems(document.anchors, visible);
	setInlineHelpDisplayItems(document.links, visible);
}

function setInlineHelpDisplayItems(items, visible) {
	for (var i = 0; i < items.length; i++) {
		if (items[i].className.toLowerCase() == 'inlinehelp') {
			if (items[i].href == '') {
				items[i].style.display = visible ? 'inline' : 'none';
			} else {
				items[i].style.display = visible ? 'inline' : 'none';
				items[i].style.textDecoration = 'underline';
			}
		}
	}
}

function initInlineHelpDisplay() {
	if ((document.cookie) && (document.cookie.toString().indexOf('InlineHelpDisplayOff') >= 0)) {
		doInlineHelpOff();
	} else {
		doInlineHelpOn()
	}
}

function mediaPopup(theURL) {
	openPopup(theURL, 'winMediaPopup', 'status,toolbar=false', 622, 496);
	return false;
}

function AlertAppUpdate() {
	if (confirm('There have been updates to the\nsystem since your last visit!\n\nClick OK to review the latest features, \nenhancements and bug fixes.'))
		location.href = '/admin/client_services/updates.asp';
}

function ConfirmSignIn(strMemberName) {
	return confirm('You will now be signed in as ' + strMemberName + '. \n\nAre you sure you want to continue? ');
}

//search form functions
function SearchForm_q_OnKeyPress(e, sender) {
	if (getkey(e) == 13) {
		return SearchForm_Validate(sender);
	}
	return true;
}

function SearchForm_Validate(sender, element) {
	if (!element) element = sender.form.q;

	var sVal = element.value;

	if (sVal == '' || /^[\s]+$/.test(sVal)) {
		alert('Please enter some search criteria. ');
		element.focus();
		return false;
	}

	return true;
}

function StartNewSearch(FormId) {
	var SearchForm = document.getElementById(FormId);
	if (SearchForm) {
		SearchForm.q.value = '';
		SearchForm.style.display = '';
		SearchForm.q.focus();
	}
	return false;
}

function FilterSearchByCatalog(CatalogEnum) {
		var win = (parent) ? parent : self;
		var sQuery = win.location.search.replace(/\&?c=[^\&]*\&?/, "");
		if (sQuery.length == 0)
		{
			sQuery = '?';
		} else if (sQuery != '?')
		{
			sQuery += '&';
		}

		win.location.href = win.location.pathname + sQuery + "c=" + CatalogEnum.toString();
	return false;
}

function FilterIframeSearchCatalog(Catalog, CatalogEnum)
{
	// The category filter is an empty span appended to the end of the search box text, it will hold a link that is created in the same manner that the parent page is 
	// using to create the remove filter link with as is the case with old functionality when you click on a category in the search results description text
	// This function is used for the actual links created inside of the iframe window, when you filter by one of these categories "More Results" link, then we will want to show
	// the results un filtered, but with the current category
	self.location.href = self.location.href + "&c=" + CatalogEnum;
	var bSelectedCategory = window.parent.document.getElementById('bCategoryFilter');
	bSelectedCategory.innerHTML = " in " + Catalog + "<a href=# title=\"Remove Filter \" onclick=\"return FilterSearchByCatalog(" + 0 + ");\"><sup>(x)</sup></a>";
}

function emoticon(code, txtarea) {
	if ($("#ifRadEditor_strBody").is(":visible")) {
		//new RadEditor IFrame is on the page
		var $editor = $("#ifRadEditor_strBody").contents().find("body div#RadEditor1_contentDiv");

		if ($editor.is(":visible")) {
			// design mode
			$editor.append(code);
		}
		else {
			// HTML mode
			$editor = $("#ifRadEditor_strBody").contents().find("body td#RadEditor1Center iframe").contents().find("body textarea");

			$editor.val($editor.val() + code);
		}

		return;
	}

	if ((!txtarea) || typeof (txtarea) == 'undefined') {
		txtarea = document.frmMessage.strBody;
	}

	try { oUtil.obj.insertHTML(code); return; } catch (e) { }

	try { insertAtCaret(txtarea, code) } catch (e) { }
}

var m_bYuiGenericDialogResult;
var m_sDialogHeaderText = "";

//Two Button (confirm style) dialog
function YuiGenericDialog(Id, BodyText, Callback, TrueText, FalseText, ContainerId, PanelWidth, posX, posY, timeoutSeconds)
{
	if (!objectExists(TrueText)) TrueText = 'Yes';
	if (!objectExists(FalseText)) FalseText = 'No';
	if (!objectExists(PanelWidth)) PanelWidth = '300px';
	if (!objectExists(timeoutSeconds)) timeoutSeconds = 0;

	var blnCentered = true;
	if (objectExists(posX) && objectExists(posY))
	{
		blnCentered = false;
	}
	else
	{
		posX = 0;
		posY = 0;
	}

	var dialog = new YAHOO.widget.SimpleDialog(Id, {
		text: BodyText,
		iframe: false,
		visible: false,
		close: false,
		draggable: false,
		fixedcenter: blnCentered,
		constraintoviewport: true,
		modal: true,
		postmethod: 'none',
		underlay: 'shadow',
		width: PanelWidth,
		x: posX,
		y: posY
	});

	dialog.setHeader("Attention");
	if (m_sDialogHeaderText != '') {
		dialog.setHeader(m_sDialogHeaderText);
	}
	//dialog.cfg.setProperty("icon",YAHOO.widget.SimpleDialog.ICON_HELP);

	var aButtons = new Array();

	if (TrueText.length > 0) {
		aButtons[0] = {
			text: TrueText, handler: function () {
				m_bYuiGenericDialogResult = true;
				this.hide();
				Callback();
			}, isDefault: true
		};
	}

	if (FalseText.length > 0) {
		aButtons[1] = {
			text: FalseText, handler: function () {
				m_bYuiGenericDialogResult = false;
				this.hide();
				Callback();
			}
		};
	}

	dialog.cfg.queueProperty("buttons", aButtons);

	if (!objectExists(ContainerId)) ContainerId = "PageBase_RaiseAlert";

	var container = document.getElementById(ContainerId);
	if (!container) return;

	m_bYuiGenericDialogResult = null;

	dialog.render(container);
	dialog.show();

	if (timeoutSeconds > 0) setTimeout(function () { dialog.hide(); }, Math.round(timeoutSeconds * 1000));
}

function YuiGenericDialogCallback_ButtonClick(button) {
	if (m_bYuiGenericDialogResult) {
		button.onclick = function() { return true; }
		button.click();
	}
}

//call as a replacement for JavaScript Confirm (i.e. <a href="#" onclick="YUIConfirm("Are you sure?", function(){ if (m_bYuiGenericDialogResult) { dosomething(); } });">Submit</a>
function YUIConfirm(msg, yesaction) {
	YuiGenericDialog("confirm",
			msg,
       		yesaction
      );
}
function YUIConfirmCustomHeader(msg, yesaction, headertext) {
	m_sDialogHeaderText = headertext;
	YuiGenericDialog("confirm",
			msg,
       		yesaction
      );
}
function YUIConfirmCustomHeaderCustomPosition(msg, yesaction, headertext, posX, posY)
{
	m_sDialogHeaderText = headertext;
	YuiGenericDialog("confirm", msg, yesaction, null, null, null, null, posX, posY);
}



//One button (alert style) dialog
function YuiGenericAlert(Id, BodyText, Callback, ButtonText, ContainerId, PanelWidth) {
	if (!objectExists(ButtonText)) ButtonText = 'OK';
	if (!objectExists(PanelWidth)) PanelWidth = '300px';

	var dialog = new YAHOO.widget.SimpleDialog(Id, {
		text: BodyText,
		iframe: false,
		visible: false,
		close: false,
		draggable: false,
		fixedcenter: true,
		constraintoviewport: true,
		modal: true,
		postmethod: 'none',
		underlay: 'shadow',
		width: PanelWidth
	}
	);

	dialog.setHeader("Attention");
	//dialog.cfg.setProperty("icon", YAHOO.widget.SimpleDialog.ICON_HELP);

	dialog.cfg.queueProperty("buttons", [
	{ text: ButtonText, handler: function() {
		m_bYuiGenericDialogResult = true;
		this.hide();
		Callback();
	}, isDefault: true
	}
]);

	if (!objectExists(ContainerId)) ContainerId = "PageBase_RaiseAlert";

	var container = document.getElementById(ContainerId);
	if (!container) return;

	m_bYuiGenericDialogResult = null;

	dialog.render(container);
	dialog.show();
}

// Page Alert - Mimics the Page Alert temporary dialog box that appears, but this one can be called from javascript.
function ShowPageAlert(message)
{
	var container = document.getElementById('PageBase_RaiseAlert');

	if (container)
	{
		var AlertID = new Date().getTime();

		if ((document.cookie) && (document.cookie.toString().indexOf(AlertID) < 0))
		{
			document.cookie = 'AlertID=' + AlertID;

			PageBase_RaiseAlert_Dialog = new YAHOO.widget.SimpleDialog("PageBase_RaiseAlert_Dialog", {
				text: message,
				iframe: false,
				visible: true,
				close: true,
				draggable: true,
				modal: false,
				underlay: 'shadow',
				width: '270px',
				x: 5,
				y: 5
			});

			PageBase_RaiseAlert_Dialog.setHeader("Attention");
			PageBase_RaiseAlert_Dialog.cfg.setProperty("icon", YAHOO.widget.SimpleDialog.ICON_WARN);
			PageBase_RaiseAlert_Dialog.render(container);

			var PageBase_RaiseAlert_Tid = setTimeout('PageBase_RaiseAlert_Dialog.hide();', 7000);
		}
	}
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// common functions
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
function getCurrentTime() {
	var now = new Date();
	return now.getTime();
}

function fixnewlines(val) {
	// Adjust newlines so can do correct character counting for MySQL. MySQL counts a newline as 2 characters.
	if (val.indexOf('\r\n') != -1)
		; // this is IE on windows. Puts both characters for a newline, just what MySQL does. No need to alter
	else if (val.indexOf('\r') != -1)
		val = val.replace(/\r/g, "\r\n"); // this is IE on a Mac. Need to add the line feed
	else if (val.indexOf('\n') != -1)
		val = val.replace(/\n/g, "\r\n"); // this is Firefox on any platform. Need to add carriage return
	else
		; // no newlines in the textarea  
	return val;
}

function objectExists(o) {
	if (typeof o == 'undefined' || o == null) return false;
	return true;
}

function isEmpty(val) {
	return (!val || val == null || val.toString() == '');
}

function replaceAccents(sVal) {
	var RetVal = new String(sVal);

	var regExps = [/[\xC0-\xC5]/g,
		/[\xE0-\xE5]/g,
		/[\xC8-\xCB]/g,
		/[\xE8-\xEB]/g,
		/[\xCC-\xCF]/g,
		/[\xEC-\xEF]/g,
		/[\xD2-\xD6]/g,
		/[\xF2-\xF6]/g,
		/[\xD9-\xDC]/g,
		/[\xF9-\xFC]/g,
		/\xDD/g, /\xFD/g,
		/\xC7/g, /\xE7/g,
		/\xD1/g, /\xF1/g];

	var repChar = ['A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u', 'Y', 'y', 'C', 'c', 'N', 'n'];

	for (var i = 0; i < regExps.length; i++)
		RetVal = RetVal.replace(regExps[i], repChar[i]);

	return RetVal;
}

function replaceReturns(sVal) {
	var RetVal = fixnewlines(sVal.toString());
	return RetVal.replace(/\r\n/g, '<br/>');
}

function insertAtCaret(obj, text) {
	if (document.selection) {
		obj.focus();
		var orig = obj.value.replace(/\r\n/g, "\n");
		var range = document.selection.createRange();

		if (range.parentElement() != obj) {
			return false;
		}

		range.text = text;

		var actual = tmp = obj.value.replace(/\r\n/g, "\n");

		for (var diff = 0; diff < orig.length; diff++) {
			if (orig.charAt(diff) != actual.charAt(diff)) break;
		}

		for (var index = 0, start = 0;
			tmp.match(text)
				&& (tmp = tmp.replace(text, ""))
				&& index <= diff;
			index = start + text.length
		) {
			start = actual.indexOf(text, index);
		}
	} else if (obj.selectionStart) {
		var start = obj.selectionStart;
		var end = obj.selectionEnd;

		obj.value = obj.value.substr(0, start)
			+ text
			+ obj.value.substr(end, obj.value.length);
	}

	if (start != null) {
		setCaretTo(obj, start + text.length);
	} else {
		obj.value += text;
	}
}

function setCaretTo(obj, pos) {
	if (obj.createTextRange) {
		var range = obj.createTextRange();
		range.move('character', pos);
		range.select();
	} else if (obj.selectionStart) {
		obj.focus();
		obj.setSelectionRange(pos, pos);
	}
}

function stripHtml(sVal) {
	return sVal.toString().replace(/<[\?\/!A-Za-z]+[^<>]*>?/ig, ' ');
}

function urlDecode(sVal) {
	if (isEmpty(sVal)) return sVal;
	return decodeURIComponent(sVal.toString()).replace(/\+/g, ' ');
}

function setCookie(name, value, path, expiredays) {
	var sCookie = name + '=' + escape(value);

	if (expiredays && typeof (expiredays) != 'undefined') {
		var exdate = new Date();
		exdate.setDate(exdate.getDate() + expiredays);
		sCookie += ('; expires=' + exdate.toGMTString());
	}

	if (path && typeof (path) != 'undefined') sCookie += ('; path=' + path);

	document.cookie = sCookie;
}

function getCookie(name) {
	if ((!document.cookie) || document.cookie.length == 0) return '';

	var iStart = document.cookie.indexOf(name + '=');
	if (iStart >= 0) {
		iStart += (name.length + 1);
		var iEnd = document.cookie.indexOf(";", iStart);
		if (iEnd < 0) iEnd = document.cookie.length;
		return unescape(document.cookie.substring(iStart, iEnd));
	}

	return '';
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// helpers for wiring-up event handlers
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
function addEventHandler_OnLoad(oFunc) {
	var oldHandler = window.onload;
	if (typeof window.onload != 'function') {
		window.onload = oFunc;
	} else {
		window.onload = function() {
			oldHandler();
			oFunc();
		}
	}
}

function addEventHandler_OnUnload(oFunc) {
	var oldHandler = window.onunload;
	if (typeof window.onunload != 'function') {
		window.onunload = oFunc;
	} else {
		window.onunload = function() {
			oldHandler();
			oFunc();
		}
	}
}

function addEventHandler_OnLoadAndUnload(oFunc) {
	addEventHandler_OnLoad(oFunc);
	addEventHandler_OnUnload(oFunc);
}

function addEventHandler_OnSubmit(oForm, oFunc) {
	var oldHandler = oForm.onsubmit;
	if (typeof oForm.onsubmit != 'function') {
		oForm.onsubmit = oFunc;
	} else {
		oForm.onsubmit = function() {
			oldHandler();
			oFunc();
		}
	}
}

function addEventHandler_OnSubmitChained(oForm, oFunc) {
	var oldHandler = oForm.onsubmit;
	if (typeof oForm.onsubmit != 'function') {
		oForm.onsubmit = oFunc;
	} else {
		oForm.onsubmit = function() {
			return oldHandler() && oFunc();
		}
	}
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// window functions
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
var blnRefreshWindow = false;
var blnCallBackRefresh = false;


function getWinSize() {
	var iWinW = 0;
	var iWinH = 0;
	if (typeof (window.innerWidth) != 'undefined') {
		iWinW = window.innerWidth;
		iWinH = window.innerHeight;
	} else {
		var d = document;
		if (d.documentElement && typeof (d.documentElement.clientWidth) != 'undefined' &&
			d.documentElement.clientWidth !== 0) {
			iWinW = d.documentElement.clientWidth;
			iWinH = d.documentElement.clientHeight;
		} else if (document.body && typeof (d.body.clientWidth) != 'undefined') {
			iWinW = d.body.clientWidth;
			iWinH = d.body.clientHeight;
		}
	}

	var aRetVal = new Array(1);
	aRetVal[0] = iWinW;
	aRetVal[1] = iWinH;

	return aRetVal;
}

function windowIsOpen(objWindow) {
	var blnIsOpen = false;

	if (typeof (objWindow) == 'object') {
		if (!objWindow.closed) {
			blnIsOpen = true;
		}
	}
	return blnIsOpen;
}

function setOpenerRefresh() {
	if (windowIsOpen(opener)) {
		opener.blnRefreshWindow = true;
	}
}

function reloadSelf() {
	var now = new Date();
	var newHref = location.protocol + '//' + location.hostname + location.pathname;
	var qString = location.search.replace(/\&?reloadtime=[^\&]*\&?/, '');

	if (qString.length == 0) {
		qString = '?'
	} else if (qString != '?') {
		qString += '&';
	}

	newHref += qString + 'reloadtime=' + now.getTime();

	location.href = newHref;
}



function refreshOpener(strDefaultURL, blnCloseMe) {
	var blnExists = false;

	if (windowIsOpen(opener)) {

	    if (opener.blnCallBackRefresh)
	    {

	        opener.SubmitRefresh();
	    }
        else
		if (opener.blnRefreshWindow == true) {

			var now = new Date();
			var newHref = opener.location.protocol + '//' + opener.location.hostname + opener.location.pathname;
			var qString = opener.location.search.replace(/\&?reloadtime=[^\&]*\&?/, '');

			if (qString.length == 0) {
				qString = '?'
			} else if (qString != '?') {
				qString += '&';
			}

			newHref += qString + 'reloadtime=' + now.getTime();

			opener.location.href = newHref;

			opener.focus();
		}
		blnExists = true;
	}

	if (blnExists == false) {
		window.open(strDefaultURL);
		blnCloseMe = true;
	}

	if (blnCloseMe == true) window.close(self);
}

function openerLocation(strLocation, blnCloseMe) {
	if (windowIsOpen(opener)) {
		opener.location.href = strLocation;
		if (blnCloseMe) opener.focus();
	} else {
		window.open(strLocation);
	}

	if (blnCloseMe) window.close(self);
}

function focusPopup(objPopup, theURL, winName, features, width, height) {
	var blnIsOpen = true;
	if (typeof (objPopup) != 'object') {
		blnIsOpen = false;
	} else if (objPopup.closed) {
		blnIsOpen = false;
	}
	if (blnIsOpen == false) {
		objPopup = returnPopup(theURL, winName, features, width, height);
	}
	objPopup.focus();
	return objPopup;
}

function goToUrlOnClick(Url) {
	location.href = Url;
	return false;
}

function goToUrlOnClickTargetParent(Url) {
	parent.location.href = Url;
	return false;
}

function openPopup(theURL, winName, features, width, height) {
	var objPopup = returnPopup(theURL, winName, features, width, height);
	objPopup.focus();
}

function returnPopup(theURL, winName, features, width, height) {
	var winWidth = width;
	var winHeight = height;
	var strWinSize = ",width=" + winWidth + ",height=" + winHeight;

	if (window.screen) {
		var winPosL = (screen.availWidth - winWidth) / 2;
		var winPosT = (screen.availHeight - winHeight) / 2;
		strWinSize += ",left=" + winPosL + ",screenX=" + winPosL + ",top=" + winPosT + ",screenY=" + winPosT;
	}

	return window.open(theURL, winName, features + strWinSize);
}

function closePopup() {
	window.close(self);
}

function setWinStatus(value) {
	window.status = value;
	return true;
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// form functions
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
function addOptionToSelectList(DomID, value) {
	var SelectList = document.getElementById(DomID);
	SelectList.options[SelectList.length] = new Option(value, value);
}

function removeSelectedOption(DomID) {
	var SelectList = document.getElementById(DomID);
	SelectList.options[SelectList.selectedIndex] = null;
}

function addHiddenInputToForm(form, name, value) {
	var newInput = document.createElement('INPUT');
	if (document.all) {
		newInput.type = 'hidden';
		newInput.id = name;
		newInput.name = name;
		newInput.value = value;
	} else {
		newInput.setAttribute('type', 'hidden');
		newInput.setAttribute('id', name);
		newInput.setAttribute('name', name);
		newInput.setAttribute('value', value);
	}
	form.appendChild(newInput);
}

function ClearDefaultValue(o) {
	if (o && o.value && o.defaultValue && o.value.toLowerCase() == o.defaultValue.toLowerCase()) o.value = '';
}

function checkRadioByValue(oRadio, value) {
	if (oRadio) {
		if (oRadio.length > 0) {
			for (var i = 0; i < oRadio.length; i++)
				oRadio[i].checked = (oRadio[i].value == value.toString());
		} else {
			oRadio.checked = (oRadio.value == value.toString());
		}
	}
}

function getCheckedRadioValue(oRadio) {
	if (oRadio) {
		if (oRadio.length > 0) {
			for (var i = 0; i < oRadio.length; i++) {
				if (oRadio[i].checked) return oRadio[i].value;
			}
		} else if (oRadio.checked) {
			return oRadio.value;
		}
	}
	return null;
}

function getSelectedText(elmnt) {
	if (elmnt && elmnt.options) {
		return elmnt.options[elmnt.selectedIndex].text;
	}
	return '';
}

function getSelectedTextById(elementId) {
	var elmnt = document.getElementById(elementId);
	return getSelectedText(elmnt);
}

function getSelectedValue(elmnt) {
	if (elmnt && elmnt.options) {
		return elmnt.options[elmnt.selectedIndex].value;
	}
	return '';
}

function getSelectedValueById(elementId) {
	var elmnt = document.getElementById(elementId);
	return getSelectedValue(elmnt);
}

function selectOptionByValue(oSelect, value) {
	if (oSelect) {
		for (var i = 0; i < oSelect.length; i++) {
			if (oSelect.options[i].value == value.toString()) {
				oSelect.selectedIndex = i;
				break;
			}
		}
	}
}

function verifyMsg(jsStrURL, jsStrMsg) {
	if (confirm(jsStrMsg)) {
		this.window.location = jsStrURL;
		return true;
	}
}

function CheckALL(objCheckbox) {
	if (objCheckbox) {
		var len = objCheckbox.length;

		if (len > 0) {
			var i = 0;
			for (i = 0; i < len; i++) {
				objCheckbox[i].checked = true;
			}
		} else {
			objCheckbox.checked = true;
		}
	}
}

function UnCheckALL(objCheckbox) {
	if (objCheckbox) {
		var len = objCheckbox.length;

		if (len > 0) {
			var i = 0;
			for (i = 0; i < len; i++) {
				objCheckbox[i].checked = false;
			}
		} else {
			objCheckbox.checked = false;
		}
	}
}

function formFocus(strFormname, strElement) {
	var objE = eval('document.' + strFormname + '.' + strElement);
	if (objE) objE.focus();
}

function buildHumanSQL(objElement, strHeadline) {

	var inputLocal = objElement;
	var strSQLHuman = '<b>' + strHeadline + '</b>\n';
	strSQLHuman += '<ul>\n';

	if (inputLocal) {
		var len = inputLocal.length;
		var i = 0;
		for (i = 0; i < len; i++) {

			if (inputLocal.options[i].selected) {

				strSQLHuman += '<li>' + inputLocal.options[i].text + '<br></li>\n';
			}
		}
	}

	strSQLHuman += '</ul>'
	objElement.form.txt_sqlHuman.value = strSQLHuman;
	return true;
}

function ClickOnCrKeyPress(e, button) {
	if (getkey(e) == 13) {
		button.click();
		return false;
	}
	else return true;
}

function DoOnCrKeyPress(e, oFunc) {
	if (getkey(e) == 13) {
		oFunc();
		return false;
	}
	else return true;
}

function SubmitOnCrKeyPress(e, sender) {
	if (getkey(e) == 13) {
		sender.form.submit();
		return false;
	}
	else return true;
}

function VoidOnCrKeyPress(e) {
	return (getkey(e) != 13);
}

function getkey(e) {
	if (window.event)
		return window.event.keyCode;
	else if (e)
		return e.which;
	else
		return null;
}

function confirmDelete(objForm, strElement, strValue) {
	var ItemRow = document.getElementById(strValue.toString());
	var strPrevClass = '';

	if (ItemRow) {
		strPrevClass = ItemRow.className;
		ItemRow.className = 'delitem';
	}

	if (confirm('Are you sure you want to delete the selected item? ')) {
		eval('objForm.' + strElement).value = strValue;
		return true;
	}
	else {
		if (ItemRow) ItemRow.className = strPrevClass;
		return false;
	}
}

function InlineDelete_Submit(sender, keyfield, id) {
	return confirmDelete(sender.form, keyfield, id);
}

function InlineItem_Delete(sender, ItemID) {
	return confirmDelete(sender.form, 'ItemID', ItemID);
}

//adds a new option to a userlist element
function UserListAdd(sender, ID, AllowComma, DefaultValue) {
	var SelectList = eval('sender.form.' + ID + '_select');
	var UserInput = eval('sender.form.' + ID + '_input');

	if (SelectList && UserInput) {
		var val = stripHtml(UserInput.value.toString());
		if (!AllowComma) val = val.replace(/,/g, '');
		if (val != '') {
			SelectList.options[SelectList.length] = new Option(val, val);
			RebuildUserList(sender.form, ID);
		}
		if (DefaultValue != null) UserInput.value = DefaultValue;
		try { //IE throws an exception if the focus() method of an invisible object is called
			UserInput.focus();
		} catch (e) { };
	}
}

//removes the selected option from a userlist element
function UserListRemove(sender, ID) {
	var SelectList = eval('sender.form.' + ID + '_select');
	if (SelectList) {
		SelectList.options[SelectList.selectedIndex] = null;
		RebuildUserList(sender.form, ID);
	}
}

//rebuilds the hidden value of a userlist element
function RebuildUserList(form, ID) {
	var HiddenInput = eval('form.' + ID);
	if (!HiddenInput) {
		addHiddenInputToForm(form, ID, '');
		HiddenInput = eval('form.' + ID);
	}
	HiddenInput.value = '';

	var SelectList = eval('form.' + ID + '_select');
	if (SelectList) {
		for (var i = 0; i < SelectList.length; i++)
			HiddenInput.value += SelectList.options[i].value + '\r\n';
	}
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// DHTML display functions
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
function adjustIFrameHeight(DomID, Height) {
	var frame = document.getElementById(DomID);
	var frameDoc = getIFrameDoc(DomID);

	if (frameDoc == null) return;

	if (Height)
	{
		frame.height = Height;
	}
	else
	{
		frame.height = frameDoc.body.offsetHeight;
	}
}

function adjustIFrameHeight300(DomID) {
	var frame = document.getElementById(DomID);
	var frameDoc = getIFrameDoc(DomID);

	if (frameDoc == null) return;

	frame.height = frameDoc.body.offsetHeight + 350;
}

function getIFrameDoc(FrameID) {
	var frame = document.getElementById(FrameID);
	var ret = null;

	if (frame.contentDocument) {	// W3C compliant (Mozilla)
		ret = frame.contentDocument;
	} else {
		// IE
		ret = document.frames[FrameID].document;
	}

	return ret;
}

function ul_onclick(jsObj) {
	var i;
	var style;

	for (i = 0; i < jsObj.children.length; i++) {
		style = jsObj.children[i].style;
		if (style.display == "none") {
			style.display = "";
		}
		else {
			style.display = "none";
		}
	}
}

function setDisplay(DomId, Value) {
	var element = document.getElementById(DomId);
	if (element) element.style.display = Value;
	return false;
}

function switchDisplay(strDomID) {
	var CssStyle = document.getElementById(strDomID).style;
	if (CssStyle) {
		if (CssStyle.display == '') {
			CssStyle.display = 'none';
		}
		else {
			CssStyle.display = '';
		}
		setCssDisplayCookie(strDomID);
	}
	return false;
}

function switchDisplayToggle(parentId, childOn, childOff) {
	var CssStyle = document.getElementById(parentId).style;
	if ((CssStyle) && (CssStyle.display == '')) {
		dhtmlDisplay(childOff, '');
		dhtmlDisplay(childOn, 'none');
	}
	else {
		dhtmlDisplay(childOff, 'none');
		dhtmlDisplay(childOn, '');
	}
	return false;
}

function getCssDisplayCookie(domId) {
	if (document.cookie) {
		var CssStyle = document.getElementById(domId).style;
		if ((CssStyle) && (document.cookie.toString().indexOf(domId + 'DisplayOn') < 0)) {
			CssStyle.display = 'none';
		}
		else {
			CssStyle.display = '';
		}
	}
}

function setCssDisplayCookie(domId) {
	if (document.cookie) {
		var CssStyle = document.getElementById(domId).style;
		if ((CssStyle) && (CssStyle.display == '')) {
			document.cookie = domId + 'Display=' + domId + 'DisplayOn';
		}
		else {
			document.cookie = domId + 'Display=' + domId + 'DisplayOff';
		}
	}
}

function textCounter(field, cntfield, maxlimit) {
	var val = fixnewlines(field.value.toString());
	var len = val.length;

	//if aready too long, trim it before making any adjustments
	if (len > maxlimit) {
		val = val.substring(0, maxlimit);
		len = val.length;
		field.value = val;
	}

	//update 'characters left' counter
	cntfield.value = (maxlimit - len);
}

function TextCounter_Window_OnLoad(FormName, InputName, MaxLen) {
	var form = eval('document.' + FormName);
	var TextInput = eval('form.' + InputName);

	TextInput.onkeyup = function() {
		textCounter(this, eval('this.form.' + InputName + '_Counter'), MaxLen);
	}

	textCounter(TextInput, eval('form.' + InputName + '_Counter'), MaxLen);
}

function InitTextCounter(FormName, InputName, MaxLen) {
	addEventHandler_OnLoad(function() { TextCounter_Window_OnLoad(FormName, InputName, MaxLen); });
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// DTHML edit functions 
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
function dhtmlDisplay(domID, dVal) {
	var element = document.getElementById(domID);
	if (element) element.style.display = dVal;
}

function dhtmlFormEdit(objForm, domLEN, domID) {

	var styleView;
	var styleEdit;
	var i = 1;
	for (i = 1; i <= domLEN; i++) {

		var styleView = document.getElementById('view' + i.toString()).style;
		var styleEdit = document.getElementById('edit' + i.toString()).style;

		if ((i.toString() == domID.toString()) && (styleView.display == "")) {
			styleView.display = "none";
			styleEdit.display = "";
			intLastOpenRow = i.toString();
		} else {
			styleView.display = "";
			styleEdit.display = "none";
		}
	}

	objForm.reset();
	return false;

}

function dhtmlFormSubmit(objForm1, objForm2, domID, sysAction) {

	var i = 0;
	for (i = 0; i < objForm2.length; i++) {

		var objE = eval('objForm1.' + objForm2[i].name + domID);

		if (objE) {
			if (objE.type == 'checkbox' | objE.type == 'radio') {
				if (objE.checked) {
					objForm2[i].value = objE.value;
				}
			} else if (objE.type == 'select') {
				var j = 0;
				for (j = 0; j < objE.length; j++) {
					if (objE.options[i].selected) {
						objForm2[i].value = objE.options[j].value;
					}
				}
			} else {
				objForm2[i].value = objE.value;
			}
		}
	}

	objForm2.sys_id.value = domID;
	objForm2.sys_action.value = sysAction;

	var blnSubmit;
	if (sysAction == 'delete') {
		blnSubmit = confirm('Click OK to delete this record.');
	} else {
		blnSubmit = true;
	}

	if (blnSubmit) objForm2.submit();
	return false;

}

function MaximizeScrollingBlock(DomId) {
	var o = document.getElementById(DomId);

	if (o) {
		o.style.overflow = 'visible';
		o.style.height = 'auto';
	}

	return false;
}

function RestoreScrollingBlock(DomId, Height) {
	var o = document.getElementById(DomId);

	if (o) {
		o.style.overflow = 'auto';
		o.style.height = Height;
	}

	return false;
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// "AJAX" functions ;)
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
function setInnerHtmlFromHttpRequest(Id, Url) {
	var xmlhttp = null;
	if (window.XMLHttpRequest) {	//code for Mozilla, etc.
		xmlhttp = new XMLHttpRequest();
	} else if (window.ActiveXObject) {	//code for IE
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	if (xmlhttp) {	//wire up the event to handle the response on successful load
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && xmlhttp.responseText != '') {
				var container = document.getElementById(Id);
				container.innerHTML = xmlhttp.responseText;
				container.style.display = '';
			}
		}

		xmlhttp.open("GET", Url, true);
		xmlhttp.send(null);
	}
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
// 3rd-party functions
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//

// Countdown in Java Script .. Cameron Gregory http://www.bloke.com/
// permission to use and modify as long as you leave these 4 comment
// lines in tact and unmodified.
// http://www.bloke.com/javascript/Countdown/
var clockForm, clockTime, clockTimeout, clockFormat, clockTid, clockRefresh;

function doDate() {

	dt = new Date();

	if (clockTime != 0) {
		v1 = Math.round((clockTime - dt) / 1000);
		//add timeout value to time
		v1 += Math.round(clockTimeout * 60);
		if (v1 <= 0) {
			clockForm.date.value = "expired";
			//dont set the timer again
		}
		else {
			if (clockFormat == 1)
				clockForm.date.value = v1;
			else if (clockFormat == 2) {
				sec = v1 % 60;
				v1 = Math.floor(v1 / 60);
				min = v1 % 60;
				hour = Math.floor(v1 / 60);
				if (sec < 10) sec = "0" + sec;
				if (min < 10) min = "0" + min;
				if (hour > 0) {
					clockForm.date.value = hour + "h " + min + "m " + sec + "s";
				} else {
					clockForm.date.value = min + "m " + sec + "s";
				}
			}
			else if (clockFormat == 3) {
				sec = v1 % 60;
				v1 = Math.floor(v1 / 60);
				min = v1 % 60;
				v1 = Math.floor(v1 / 60);
				hour = v1 % 24;
				day = Math.floor(v1 / 24);
				if (sec < 10) sec = "0" + sec;
				if (min < 10) min = "0" + min;
				if (hour < 10) hour = "0" + hour;
				clockForm.date.value = day + "d " + hour + "h " + min + "m " + sec + "s";
			}
			else if (clockFormat == 4) {
				sec = v1 % 60;
				v1 = Math.floor(v1 / 60);
				min = v1 % 60;
				v1 = Math.floor(v1 / 60);
				hour = v1 % 24;
				day = Math.floor(v1 / 24);
				clockForm.date.value = day + (day == 1 ? "day " : "days ") + hour + (hour == 1 ? "hour " : "hours ") + min + (min == 1 ? "min " : "mins ") + sec + (sec == 1 ? "sec " : "secs ")
			}
			else {
				clockForm.date.value = "invalid format";
			}
			clockTid = window.setTimeout("doDate()", clockRefresh);
		}
	}
	else
		clockForm.date.value = "error";
}

function startCountdown(objForm, time, timeout, format) {
	clockForm = objForm;
	clockTime = new Date(time);
	clockTimeout = timeout;
	clockFormat = format;
	clockTid = 0;
	clockRefresh = 1000;
	if (Math.round((clockTime - new Date()) / 1000) < -60) {
		//clock is too far out of sync
		clockForm.date.value = "unknown";
	}
	else {
		clockTid = window.setTimeout("doDate()", clockRefresh);
	}
}

//shift all the characters in the inval by shiftval characters from the charset
//  example:  "cat", 2, "abcdefghijklmnopqrstuvwxyz"
// would become "ecv"
// if a character is not found in charset, it is untouched.
//if a shift operation goes out of bounds, it will roll to the other side of charset
function CharShiftDecrypt(strInVal, shiftval, shiftCharSet) {
	var strInString = new String(strInVal);
	var intInString = strInString.length;
	var strCharSet = new String(shiftCharSet);
	var intCharSetLen = strCharSet.length;
	var strOutVal = new String('');

	var nextchar, nextindex, ascii_nextchar, i;

	//for each character
	for (i = 0; i < intInString; i++) {
		// grab the next character to encrypt
		nextchar = strInString.substr(i, 1);

		//look it up in charset
		nextindex = strCharSet.indexOf(nextchar, 0)
		if (nextindex >= 0) { //found it
			nextindex = (nextindex - shiftval) % intCharSetLen // modulo this so can stay in bounds for next operation

			//check bounds of nextindex
			if (nextindex < 0) {
				nextindex = nextindex + intCharSetLen //wrap around to high end of charset
			}
			else if (nextindex >= intCharSetLen) { //this wont happen btw, becuase of modulo, but anyway
				nextindex = nextindex - intCharSetLen
			}
			strOutVal += strCharSet.charAt(nextindex);
		}
		else { //char not found in set, so add it as is
			strOutVal += nextchar;
		}
	}

	return strOutVal;

}

//function used with jupload version 2.4+
function jupload_result(result_html) {
	window.setTimeout(function() {
		document.open();
		document.write(result_html);
		document.close();
	}, 1000);
}

//Returns an array of StyleSheet DOM objects for the <link .. /> tags on a page
//See http://www.javascriptkit.com/domref/stylesheet.shtml for the available properties you can use on the array
function getAllSheets() {
	//if you want ICEbrowser's limited support, do it this way
	if (!window.ScriptEngine && navigator.__ice_version) {
		//IE errors if it sees navigator.__ice_version when a window is closing
		//window.ScriptEngine hides it from that
		return document.styleSheets;
	}
	if (document.getElementsByTagName) {
		//DOM browsers - get link and style tags
		var Lt = document.getElementsByTagName('link');
		var St = document.getElementsByTagName('style');
	} else if (document.styleSheets && document.all) {
		//not all browsers that supply document.all supply document.all.tags
		//but those that do and can switch stylesheets will also provide
		//document.styleSheets (checking for document.all.tags produces errors
		//in IE [WHY?!], even though it does actually support it)
		var Lt = document.all.tags('LINK'), St = document.all.tags('STYLE');
	} else { return []; } //lesser browser - return a blank array
	//for all link tags ...
	for (var x = 0, os = []; Lt[x]; x++) {
		//check for the rel attribute to see if it contains 'style'
		if (Lt[x].rel) {
			var rel = Lt[x].rel;
		} else if (Lt[x].getAttribute) {
			var rel = Lt[x].getAttribute('rel');
		} else { var rel = ''; }
		if (typeof (rel) == 'string' && rel.toLowerCase().indexOf('style') + 1) {
			//fill os with linked stylesheets
			os[os.length] = Lt[x];
		}
	}
	return os;
}


//Generating Pop-up Print Preview page
//Creates a new window, loads the style sheets from the parrent window (for proper site rendering),
//then grabs the HTML from the <body> tag and substrings looking for the special YM print comments
function createPrintPagePopup() {
	//Creating new page
	var pp = window.open('', 'print', 'height=600,width=600,scrollbars=yes');
	//Adding HTML opening tag with <HEAD> ￿ </HEAD> portion 
	pp.document.writeln('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">');
	pp.document.writeln('<html xmlns="http://www.w3.org/1999/xhtml">');

	pp.document.writeln('<head><title>Print Preview</title>')

	//include all the stylesheets that are on the current page
	for (var x = 0, ss = getAllSheets(); ss[x]; x++) {
		//for each stylesheet ...
		pp.document.writeln('<link rel="stylesheet" type="text/css" href="' + ss[x].href + '"/>');
	}

	pp.document.writeln('<style type="text/css" media="print">')
	pp.document.writeln('#PRINT, #CLOSE { display:none; }');
	pp.document.writeln('#SpContent { height:100% !important; width:100% !important; }');
	pp.document.writeln('#CustomPageBody { overflow: visible !important; overflow-y: visible !important; overflow-x: visible !important; width:100% !important; }');
	pp.document.writeln('.YMPrintMe { display: table-cell !important; }');
	pp.document.writeln('</style>');
	pp.document.writeln('<style type="text/css">')
	pp.document.writeln('#SpContent { height:100% !important; width:100% !important; }');
	pp.document.writeln('#CustomPageBody { overflow: visible !important; overflow-y: visible !important; overflow-x: visible !important; width:100% !important; }');
	pp.document.writeln('.YMPrintMe { display: table-cell !important; }');
	pp.document.writeln('</style>');
	pp.document.writeln('<script type="text/javascript">');
	pp.document.writeln('function printthis() {');
	pp.document.writeln('	location.reload();');
	pp.document.writeln('	try {');
	pp.document.writeln('		window.print();');
	pp.document.writeln('	} catch(e) {');
	pp.document.writeln('		window.print();');
	//pp.document.writeln('		alert("error");');
	pp.document.writeln('	}');
	pp.document.writeln('}</script>');
	pp.document.writeln('</head>')

	//Adding Body Tag
	pp.document.writeln('<body>');
	//Adding form Tag
	pp.document.writeln('<form method="post">');

	//Creating two buttons Print and Close within a HTML table
	pp.document.writeln('<TABLE width=100%><TR><TD></TD></TR><TR><TD align=right>');
	pp.document.writeln('<INPUT ID="PRINT" type="button" value="Print" class="formbutton" onclick="javascript:printthis();">');
	pp.document.writeln('<INPUT ID="CLOSE" type="button" class="formbutton" value="Close" onclick="javascript:window.openter=\'x\'; window.close();">');
	pp.document.writeln('</TD></TR><TR><TD></TD></TR></TABLE>');

	//Writing print area of the calling page
	var body;
	body = document.getElementById('PageBody').innerHTML;
	var idxStart = body.indexOf('@@DG_PRINT_PAGE_BEGIN@@', 0) + 67;
	var len = body.indexOf('@@DG_PRINT_PAGE_END@@', 0) - idxStart - 4;
	body = body.substr(idxStart, len);
	pp.document.writeln(body);

	//Ending Tag of </form>, </body> and </HTML>
	pp.document.writeln('</form></body></HTML>');
}

function getQueryStringParam(name) {
	name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");

	var regexS = "[\\?&]" + name + "=([^&#]*)";
	var regex = new RegExp(regexS);
	var results = regex.exec(window.location.search);

	if (results == null)
		return "";
	else
		return decodeURIComponent(results[1].replace(/\+/g, " "));
}

// Adds or replaces the query string parameter [name] with [value] in the given [url].
// If [url] is blank, we'll attempt to get the current URL. If [value] is blank, we'll
// remove the parameter from the query string entirely.
function setQueryStringParam(name, value, url) {
	if (!url) url = window.location.href;
	var re = new RegExp("([?|&])" + name + "=.*?(&|#|$)", "gi");

	if (url.match(re)) {
		if (value)
			return url.replace(re, '$1' + name + "=" + value + '$2');
		else
			return url.replace(re, '$2');
	}
	else {
		if (value) {
			var separator = url.indexOf('?') !== -1 ? '&' : '?',
                hash = url.split('#');
			url = hash[0] + separator + name + '=' + value;
			if (hash[1]) url += '#' + hash[1];
			return url;
		}
		else
			return url;
	}
}

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Custom Form Paging & Validation
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

var m_customFormPageNum = 0;
var m_customFormPageErrors = new Array();
var m_customFormMultiPageGuid;

function ShowCustomFormPage(page, totalPages) {
	if (m_customFormPageErrors.length < totalPages) {
		//set array to inital state
		for (var i = 0; i < totalPages; i++) {
			m_customFormPageErrors[i] = 'NA';
		}
	}

	//**** validate the page before switching...


	//build data package for this page
	var data = '';
	var currentPageID = "formpage" + m_customFormPageNum;

	//build a name/value pair post data string
	$('#' + currentPageID + ' :input').each(function() {
		data += $(this).prop('name') + '=' + encodeURIComponent($(this).val()) + "&"
	});

	//remove the trailing "&"
	if (data.length > 0) data = data.substring(0, data.length - 1);

	//validate the form, errors go into the "CFormErrors" div, null is to not validate the capcha
	var valid = ValidateForm(data, 'CFormErrors', null);

	if (valid) {
		m_customFormPageErrors[m_customFormPageNum] = '';
	}
	else {
		m_customFormPageErrors[m_customFormPageNum] = $('#CFormErrors').html();
	}

	//Apply the CSS classes to valid pages during each page transistion
	for (var i = 0; i < m_customFormPageErrors.length; i++) {
		if (m_customFormPageErrors[i] == '') {
			$('#pagination' + i).addClass('valid');
			$('#pagination' + i).removeClass('invalid');
		}
		else if (m_customFormPageErrors[i] == 'NA') {
			$('#pagination' + i).removeClass('invalid');
			$('#pagination' + i).removeClass('valid');
		}
		else {// if (m_customFormPageErrors[i] != '') {
			$('#pagination' + i).addClass('invalid');
			$('#pagination' + i).removeClass('valid');
		}
	}


	//stop action if the page is invalid
	if (!valid) {
		$('#CFormErrors').addClass('infobox');
		//return false;
	}


	//*** End Validation

	//set the "next/prev" page that we are going to as the current
	$('#CustomFormPager:not(.legend)').children().removeClass('current');


	if (page == 'next')
		m_customFormPageNum++;
	else if (page == 'prev')
		m_customFormPageNum--;
	else
		m_customFormPageNum = page;

	for (var i = 0; i < totalPages; i++) {
		// Setup pagination
		if (m_customFormPageNum == i) {
			$('#formpage' + i).show();
			$('#pagination' + i).addClass('current');
		}
		else {
			$('#formpage' + i).hide();
		}
	}

	// Deal with the PREV button
	if (m_customFormPageNum == 0) {
		$('#formpage_prev').hide();
	}
	else {
		$('#formpage_prev').show();
	}

	// Deal with the NEXT button
	if (m_customFormPageNum == totalPages - 1) {
		$('#formpage_next').hide();
		$('#sOr').hide();
		$('#CFormCaptchaSubmit').show();
	}
	else {
		$('#formpage_next').show();
		$('#sOr').show();
		$('#CFormCaptchaSubmit').hide();
	}

	//clear the errors div on each virtual page load
	var errors = '';
	for (var i = 0; i < m_customFormPageErrors.length; i++) {
		if (m_customFormPageErrors[i] != 'NA') {
			errors += m_customFormPageErrors[i];
		}
	}

	if (errors == '') {
		$('#CFormErrors').removeClass('infobox');
		$('#CFormErrors').html('');
	}
	else {
		$('#CFormErrors').addClass('infobox');
		$('#CFormErrors').html('<ul style="margin: 0px;">' + errors + '</ul>');
	}

	// Scroll to the top of the form page.
	$('html,body').animate({
		scrollTop: $("#CustomFormForm").offset().top
	}, 'slow');
}

function SubmitCustomForm(strUseCaptcha) {
	var valid = true;
	var data = $("#CustomFormForm").serialize();
	var blnUseCaptcha = false;
	var errors;

	if (strUseCaptcha == 'True') {
		blnUseCaptcha = true;
	}

	valid = ValidateForm(data, 'CFormErrors', blnUseCaptcha);

	if (!valid) {
		$('#CFormErrors').addClass('infobox');

		// Read the errors from the div first, then store it back in there with the ul around it.
		errors = $('#CFormErrors').html();
		$('#CFormErrors').html('<ul style="margin: 0px;">' + errors + '</ul>');
	

	    // Scroll to the top of the form page.
		$('html,body').animate({
		    scrollTop: $("#CustomFormForm").offset().top
		}, 'slow');
    }

	if (m_customFormPageErrors != null && m_customFormPageErrors.length > 0) {
		//multi-page form, do final validation check before submit
		for (var i = 0; i < m_customFormPageErrors.length - 1; i++) { //skip the last page....
			if (m_customFormPageErrors[i].length != 0) {
				//alert("--" + m_customFormPageErrors[i] + "--");
				valid = false;
			}
		}
		if (!valid) {
			alert("Please make sure you visit each page and complete all required fields.");
		}
	}

	// add check for attached item, if item is attached pass query string to check out page
	// redirect here to checkout page

	return valid;
}
		
function createBasicYUI() 
{	
	YAHOO.namespace("container");

	function YAHOOinitDescriptionPanel() {
		YAHOO.container.DescriptionPanel = new YAHOO.widget.SimpleDialog("DescriptionPanel", { visible: false,
			iframe: false,
			constraintoviewport: true,
			close: false,
			draggable: false,
			modal: false,
			underlay: 'shadow',
			width: '350px',
			height: '200px',
			x: 20,
			fixedcenter: true
		});

		YAHOO.container.DescriptionPanel.cfg.queueProperty("buttons", [
			{ text: 'Yes', handler: function() {
				document.getElementById("blnUpdateUserProfileData").checked = true;
				this.cancel();
			}, isDefault: true
			},
			{ text: 'No', handler: function() {
				document.getElementById("blnUpdateUserProfileData").checked = false;
				this.cancel();
			}
			}
		]);
		
		YAHOO.container.DescriptionPanel.render();
	}

	YAHOO.util.Event.onDOMReady(YAHOOinitDescriptionPanel);

}


function showDialog()// goes with above function
{
	//	//IE hack: underlay size does not change with panel size; resize it now
	if (document.all) YAHOO.container.DescriptionPanel.sizeUnderlay();
		YAHOO.container.DescriptionPanel.show();
}

/*******************************************************\
* Custom Fields File Uploader Stuff						*
\*******************************************************/
function openFileUploadDialog(fileUploadControlID)
{
	window.open("/general/CustomFieldFileUpload.aspx?controlID=" + fileUploadControlID, 'fileUploadPopup', 'width=600,height=340,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=300,top=200');
}

/*******************************************************\
* Rich Text Editor Stuff								*
\*******************************************************/
function OpenTextEditor(showSourceControlID, showResourcesControlID, disableMediaControlID, useAbsolutePathsControlID, modeControlID, contentControlID, messageControlID, shouldShowWidgetsControlID, groupID, previewControlID, publishingPathControlID, styleSheetControlID, macrosControlID) {
	var textEditor = window.open("/TextEditor.aspx?" +
		"ss=" + $("#" + showSourceControlID).val() +
		"&sr=" + $("#" + showResourcesControlID).val() +
		"&dm=" + $("#" + disableMediaControlID).val() +
		"&uap=" + $("#" + useAbsolutePathsControlID).val() +
		"&m=" + $("#" + modeControlID).val() +
		"&group=" + groupID +
		"&pp=" + $("#" + publishingPathControlID).val() +
		"&s=" + $("#" + styleSheetControlID).val() +
		"&macros=" + $("#" + macrosControlID).val(), "TextEditor_" + contentControlID, "width=730,height=700,resizable=yes,scrollbars=yes", true);

	//set variables for control ids to access data from parent page
	textEditor.contentControlID = contentControlID;
	textEditor.messageControlID = messageControlID;
	textEditor.shouldShowWidgetsControlID = shouldShowWidgetsControlID;
	textEditor.previewControlID = previewControlID;

	textEditor.focus();
}
// called from popup
function GetTextEditorContent(contentControlID) {
	return $("#" + contentControlID).val();
}
// called from popup
function HandleTextEditorSave(contentControlID, messageControlID, strHTML, strDateTime, previewControlID) {
	$("#" + contentControlID).val(strHTML);

	// preview is a RadEditor in an iframe and we have the iframe ID
	var $iframe = $("#" + previewControlID);
	var $divContentPreview = $iframe.contents().find("body #reContentPreview");

	$divContentPreview.html(strHTML);

	var intHeight = $iframe.contents().find("html").height();

	intHeight = (intHeight > 350 ? 350 : (intHeight < 100 ? 100 : intHeight)); //min=100 max=350

	$iframe.css("min-height", intHeight + "px").css("max-height", intHeight);

	$("#" + messageControlID).html("&nbsp;Changes made in the popup editor will not commit until this form is submitted.").css("padding-top", "2px").css("padding-bottom", "2px");
}
// called from popup
function ShouldShowWidgets(shouldShowWidgetsControlID) {
	return $("#" + shouldShowWidgetsControlID).val() == "1";
}
function ToggleWidgets(strFieldName) {
	$("#trWidgets_" + strFieldName).toggle();
}

//returns the value of an xml node's child node by tag name
function GetChildNodeValue(Node, TagName)
{
	var RetVal;
	try {
		RetVal = Node.getElementsByTagName(TagName)[0].childNodes[0].nodeValue;
	} catch(e) {
		RetVal = '';
	}
	return RetVal;
}

//returns the value of an xml node
function GetNodeValue(Node)
{
	var RetVal;
	try {
		RetVal = Node.childNodes[0].nodeValue;
	} catch(e) {
		RetVal = '';
	}
	return RetVal;
}

//creates a new xml node and assigns a value if supplied
function NewNode(xmlDoc, Name, Value)
{
	if(!xmlDoc) return null;
	
	var RetNode = xmlDoc.createElement(Name);
	if(Value) {
		var nValue = xmlDoc.createTextNode(Value.toString());
		RetNode.appendChild(nValue);
	}
	
	return RetNode;
}

//creates a new xml node and assigns a CDATA value if supplied
function NewCdataNode(xmlDoc, Name, Value)
{
	if(!xmlDoc) return null;
	
	var RetNode = xmlDoc.createElement(Name);
	if(Value) {
		var nValue = xmlDoc.createCDATASection(Value.toString());
		RetNode.appendChild(nValue);
	}
	
	return RetNode;
}



var FORM_VALIDATION_URL = '/global_engine/validate_form.asp';

function defaultBadBrowserHandler() {
	alert('This interface requires features which your browser does not supprt. \n\n' +
		'You will now be redirected to the Client Services Support Center, \n' +
		'where you will find additional information on browser requirements. ');
	location.href = '/admin/client_services/backend_technical_requirements.asp';
	return null;
}

function ignoreBadBrowser() {
	return null;
}

function DisableToolbarButton(DomId) {
	var btn = document.getElementById(DomId);
	btn.className = 'disabled';
	btn.onclick = function () { return false; };
}

function EnableToolbarButton(DomId) {
	var btn = document.getElementById(DomId);
	btn.className = '';
	btn.onclick = eval(DomId + '_OnClick');
}

function newXmlDoc() {
	var xmldoc = null;
	if (window.ActiveXObject) {
		// browser is IE
		xmldoc = new ActiveXObject('Microsoft.XMLDOM');
	} else if (document.implementation && document.implementation.createDocument) {
		// browser is Mozilla, Firefox, Opera, etc.
		xmldoc = document.implementation.createDocument('', '', null);
	} else {
		return null;
	}
	xmldoc.async = false;
	return xmldoc;
}

function newXmlHttp(BadBrowserHandler) {
	var xmlhttp = null;
	if (window.ActiveXObject) {
		// browser is IE
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} else if (window.XMLHttpRequest) {
		// browser is Mozilla, Firefox, Opera, etc.
		xmlhttp = new XMLHttpRequest();
	} else {
		if (BadBrowserHandler && typeof (BadBrowserHandler) != 'undefined') {
			return BadBrowserHandler();
		} else {
			return defaultBadBrowserHandler();
		}
	}
	return xmlhttp;
}

function sendSimpleHttpRequest(url, callback, formData, xmlhttp) {
	if (!objectExists(xmlhttp)) xmlhttp = newXmlHttp(function () { });

	var bAsync = objectExists(callback);
	var bPost = objectExists(formData);
	var sMethod = bPost ? "POST" : "GET";

	if (bAsync) {
		//wire up the callback
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) callback();
		}
	}

	xmlhttp.open(sMethod, url, bAsync);
	if (bPost) xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(formData);

	return xmlhttp;
}

function getXml(xmlNode) {
	if (xmlNode == null) return null;
	if (xmlNode.xml) {
		return xmlNode.xml;
	} else {
		var s = new XMLSerializer();
		return s.serializeToString(xmlNode);
	}
}

function loadNewXml(sXml) {
	var xmlDoc;
	if (window.ActiveXObject) {
		// browser is IE
		xmlDoc = newXmlDoc();
		xmlDoc.loadXML(sXml);
	} else {
		// browser is Mozilla, Firefox, Opera, etc.
		xmlDoc = (new DOMParser()).parseFromString(sXml, 'text/xml');
	}
	return xmlDoc;
}

function ValidateForm(FormData, ErrorListDomId, ValidateCaptchaCode, ValidationUrl)
{
	try
	{
		var xmlhttp = newXmlHttp(ignoreBadBrowser);

		var sUrl = ((ValidationUrl == null || ValidationUrl == "") ? FORM_VALIDATION_URL : ValidationUrl) + "?";
		if (ValidateCaptchaCode) sUrl += "captcha=1&"

		sUrl += "cb=" + getCurrentTime();

		xmlhttp.open("POST", sUrl, false);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
		xmlhttp.send(FormData);

		if (xmlhttp.status == 200)
		{
			var xmlDoc;
			if (xmlhttp.responseXml)
			{
				xmlDoc = xmlhttp.responseXml;
			} else
			{
				xmlDoc = (new DOMParser()).parseFromString(xmlhttp.responseText, 'text/xml');
			}
			var n = xmlDoc.documentElement;

			var iErrCount = parseInt(n.getElementsByTagName('ErrCount')[0].childNodes[0].nodeValue);
			if (iErrCount == 0) return true;

			var sErrorList = n.getElementsByTagName('ErrorList')[0].childNodes[0].nodeValue;
			document.getElementById(ErrorListDomId).innerHTML = sErrorList;
		}
	} catch (e) { }

	return false;
}


//IMPORTANT! This library assumes that the following libraries have been loaded by the calling page:
//	javascript_library.js
//	yui/build/yahoo/yahoo-min.js
//	yui/build/yahoo/dom-min.js
//	yui/build/yahoo/event-min.js
//	yui/build/yahoo/container-min.js

YAHOO.namespace("container");

function YAHOOinitContextualHelp() {
	YAHOO.container.ContextualHelp = 
		new YAHOO.widget.Panel("ContextualHelp", { visible:false,
			iframe:false,
			visible:false,
			constraintoviewport:false,
			close:true,
			draggable:true,
			modal:false,
			underlay:'none',
			width:'400px'
		} );

	YAHOO.container.ContextualHelp.render();
}

YAHOO.util.Event.onDOMReady(YAHOOinitContextualHelp);

function HelpLink_OnClick(HelpID, blnShowOnLeftOfIcon) {

	var PopupCorner, IconCorner;
	if (blnShowOnLeftOfIcon == true)
	{
		PopupCorner = 'tr';
		IconCorner = 'bl';
	}
	else{
		PopupCorner = 'tl';
		IconCorner = 'br';
	}

	var ContainerHd = document.getElementById('ContextualHelpHead');
	if(ContainerHd.innerHTML.length==0)
		ContainerHd.innerHTML = '<img src="/global_graphics/icons/icon_more_info.gif" align="left" alt="" border=0 height=16 width=16 vspace=3> Help';
	
	var ContainerBd = document.getElementById('ContextualHelpBody');
	ContainerBd.innerHTML = 'Loading...';
	
	YAHOO.container.ContextualHelp.cfg.setProperty('context', ['HelpLink_'+ HelpID,PopupCorner,IconCorner, '', [0, 0]]);

	YAHOO.container.ContextualHelp.cfg.setProperty('width', '400px');
	YAHOO.container.ContextualHelp.cfg.setProperty('height', null);
	YAHOO.container.ContextualHelp.cfg.setProperty('fixedcenter', false);
	YAHOO.container.ContextualHelp.cfg.setProperty('underlay', 'none');
	
	//IE hack: underlay size does not change with panel size; resize it now
	if(document.all) YAHOO.container.ContextualHelp.sizeUnderlay();
	
	YAHOO.container.ContextualHelp.show();
	
	var xmlhttp = null;
	if (window.XMLHttpRequest)
	{	//code for Mozilla, etc.
		xmlhttp = new XMLHttpRequest();
	} else if(window.ActiveXObject)
	{	//code for IE
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if(xmlhttp)
	{	//wire up the event to handle the response on successful load
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState==4 && xmlhttp.status==200 && xmlhttp.responseText!='') {
				ContainerBd.innerHTML = xmlhttp.responseText;
				
				//IE hack: underlay size does not change with panel size; resize it now
				if(document.all) YAHOO.container.ContextualHelp.sizeUnderlay();
			}
		}
		
		xmlhttp.open("GET",'/get_help_topic.asp?id='+ HelpID,true);
		xmlhttp.send(null);
	}
	
	return false;
}

function getHelpLink(HelpID, blnShowOnLeftOfIcon)
{
	document.write('<a id="HelpLink_'+ HelpID +
		'" href="#" title="Help is available" onclick="return HelpLink_OnClick(\'' + HelpID + '\', ' + blnShowOnLeftOfIcon + ')"><img src="/global_graphics/icons/helpme.gif" border=0 height=13 width=11 vspace=2></a>'
	);
}

function getHelpTextLink(HelpID, sText, blnShowOnLeftOfText) {
	document.write('<a id="HelpLink_' + HelpID +
		'" href="#" title="Help is available" onclick="return HelpLink_OnClick(\'' + HelpID + '\', ' + blnShowOnLeftOfText + ')">' + sText + '</a>'
	);
}


function CustomHelpLink_OnClick(HelpID, Width, Height, ContextName) {
	var ContainerHd = document.getElementById('ContextualHelpHead');

	if (ContainerHd.innerHTML.length == 0)
		ContainerHd.innerHTML = '<img src="/global_graphics/icons/more_info_16x16.png" align="left" alt="" border=0 height=16 width=16 vspace=3> Help';

	var ContainerBd = document.getElementById('ContextualHelpBody');
	ContainerBd.innerHTML = 'Loading...';

	YAHOO.container.ContextualHelp.cfg.setProperty('context', [ContextName, 'tl', 'br']);
	YAHOO.container.ContextualHelp.cfg.setProperty('fixedcenter', 'contained');
	YAHOO.container.ContextualHelp.cfg.setProperty('underlay', 'shadow');
	
	if (!(Width == "undefined")) {
		YAHOO.container.ContextualHelp.cfg.setProperty('width', Width + 'px');
	}
	else {
		YAHOO.container.ContextualHelp.cfg.setProperty('width', '400px');
	}

	if (!(Height == "undefined")) {
		YAHOO.container.ContextualHelp.cfg.setProperty('height', Height + 'px');
	}
	else {
		YAHOO.container.ContextualHelp.cfg.setProperty('height', '150px');
	}
	
	//IE hack: underlay size does not change with panel size; resize it now
	if (document.all) YAHOO.container.ContextualHelp.sizeUnderlay();

	YAHOO.container.ContextualHelp.show();
	
	var xmlhttp = null;
	if (window.XMLHttpRequest) {	//code for Mozilla, etc.
		xmlhttp = new XMLHttpRequest();
	} else if (window.ActiveXObject) {	//code for IE
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	if (xmlhttp) {	//wire up the event to handle the response on successful load
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && xmlhttp.responseText != '') {
				ContainerBd.innerHTML = xmlhttp.responseText;

				//IE hack: underlay size does not change with panel size; resize it now
				if (document.all) YAHOO.container.ContextualHelp.sizeUnderlay();
			}
		}
		
		xmlhttp.open("GET", '/help/default.aspx?id=' + HelpID, true);
		xmlhttp.send(null);
	}
	
	return false;
}

function CustomHelpLink_OnMouseOut() {
	YAHOO.container.ContextualHelp.hide();

	return false;
}

function getCustomHelpLink(HelpID, Label, Width, Height) {

	document.write('<a id="CustomHelpLink_' + HelpID +
		'" href="#" title="Help is available" onclick="return CustomHelpLink_OnClick(\'' + HelpID +
		'\', \'' + Width + '\', \'' + Height + '\', \'CustomHelpLink_' + HelpID +'\')">' + Label + '</a>'
	);
}

function AutoCompleteField(dataURL, refreshDataEachFocus)
{
	this.Init = function(domID)
	{
		addEventHandler_OnLoad(function(){
		
			var element = document.getElementById(domID);
			actb(element);
			var oldHandler = element.onfocus;
		
			if (typeof element.onfocus != 'function') {
				element.onfocus = function() {
					if (typeof AutoCompleteField_OnFocus.handleEvent == 'function')
					{
						AutoCompleteField_OnFocus.handleEvent(domID, dataURL);
						if (!refreshDataEachFocus)
						{
							//eliminate the focus event handler to avoid refresh
							AutoCompleteField_OnFocus.handleEvent = null;
						}
					}
				}
			} 
			else 
			{
				element.onfocus = function() {
					if (typeof AutoCompleteField_OnFocus.handleEvent == 'function')
					{
						AutoCompleteField_OnFocus.handleEvent(domID, dataURL);
						if (!refreshDataEachFocus)
						{
							//eliminate the focus event handler to avoid refresh
							AutoCompleteField_OnFocus.handleEvent = null;
						}
					}
					oldHandler();
				}
			}
		})	
	}
}

AutoCompleteField_OnFocus = new AutoCompleteField_FocusHandler()

function AutoCompleteField_FocusHandler() 
{
	this.handleEvent = function(domID, dataURL) 
	{
		BindAutoCompleteValues(domID, dataURL);
	}
}

function BindAutoCompleteValues(domID, dataURL)
{
	var xmlhttp = newXmlHttp();
	if(!xmlhttp) return false;
	
	var now = new Date();
	dataURL += '?ts='+ now.getTime();
	
	//submit to ajax post handler
	xmlhttp.open("GET", dataURL, true);
	xmlhttp.send(null);
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState==4 && xmlhttp.status==200 && xmlhttp.responseText!="")
		{
			//the response should be a JSON string
			var jsonData
			try { //to parse the string into a js-object
				jsonData = YAHOO.lang.JSON.parse(xmlhttp.responseText.toString()); 
			} catch(e) { return; }
			
			//set the values on the form from the JSON response
			actb(document.getElementById(domID), jsonData.arrValues);
		}
	}

	return false;
}

function actb(obj,ca){
	/* ---- Public Variables ---- */
	this.actb_timeOut = -1; // Autocomplete Timeout in ms (-1: autocomplete never time out)
	this.actb_lim = 4;    // Number of elements autocomplete can show (-1: no limit)
	this.actb_firstText = false; // should the auto complete be limited to the beginning of keyword?
	this.actb_mouse = true; // Enable Mouse Support
	this.actb_delimiter = new Array(';',',');  // Delimiter for multiple autocomplete. Set it to empty array for single autocomplete
	this.actb_startcheck = 1; // Show widget only after this number of characters is typed in.
	/* ---- Public Variables ---- */

	/* --- Styles --- */
	this.actb_bgColor = '#888888';
	this.actb_textColor = '#FFFFFF';
	this.actb_hColor = '#000000';
	this.actb_fFamily = 'Verdana';
	this.actb_fSize = '11px';
	this.actb_hStyle = 'text-decoration:underline;font-weight="bold"';
	/* --- Styles --- */

	/* ---- Private Variables ---- */
	var actb_delimwords = new Array();
	var actb_cdelimword = 0;
	var actb_delimchar = new Array();
	var actb_display = false;
	var actb_pos = 0;
	var actb_total = 0;
	var actb_curr = null;
	var actb_rangeu = 0;
	var actb_ranged = 0;
	var actb_bool = new Array();
	var actb_pre = 0;
	var actb_toid;
	var actb_tomake = false;
	var actb_getpre = "";
	var actb_mouse_on_list = 1;
	var actb_kwcount = 0;
	var actb_caretmove = false;
	this.actb_keywords = new Array();
	/* ---- Private Variables---- */
	
	this.actb_keywords = ca;
	var actb_self = this;

	actb_curr = obj;
	
	addEvent(actb_curr,"focus",actb_setup);
	function actb_setup(){
		addEvent(document,"keydown",actb_checkkey);
		addEvent(actb_curr,"blur",actb_clear);
		addEvent(document,"keypress",actb_keypress);
	}

	function actb_clear(evt){
		if (!evt) evt = event;
		removeEvent(document,"keydown",actb_checkkey);
		removeEvent(actb_curr,"blur",actb_clear);
		removeEvent(document,"keypress",actb_keypress);
		actb_removedisp();
	}
	function actb_parse(n){
		if (actb_self.actb_delimiter.length > 0){
			var t = actb_delimwords[actb_cdelimword].trim().addslashes();
			var plen = actb_delimwords[actb_cdelimword].trim().length;
		}else{
			var t = actb_curr.value.addslashes();
			var plen = actb_curr.value.length;
		}
		var tobuild = '';
		var i;

		if (actb_self.actb_firstText){
			var re = new RegExp("^" + t, "i");
		}else{
			var re = new RegExp(t, "i");
		}
		var p = n.search(re);
				
		for (i=0;i<p;i++){
			tobuild += n.substr(i,1);
		}
		tobuild += "<font style='"+(actb_self.actb_hStyle)+"'>"
		for (i=p;i<plen+p;i++){
			tobuild += n.substr(i,1);
		}
		tobuild += "</font>";
			for (i=plen+p;i<n.length;i++){
			tobuild += n.substr(i,1);
		}
		return tobuild;
	}
	function actb_generate(){
		if (document.getElementById('tat_table')){ actb_display = false;document.body.removeChild(document.getElementById('tat_table')); } 
		if (actb_kwcount == 0){
			actb_display = false;
			return;
		}
		a = document.createElement('table');
		a.cellSpacing='1px';
		a.cellPadding='2px';
		a.style.position='absolute';
		a.style.top = eval(curTop(actb_curr) + actb_curr.offsetHeight) + "px";
		a.style.left = curLeft(actb_curr) + "px";
		a.style.backgroundColor=actb_self.actb_bgColor;
		a.id = 'tat_table';
		document.body.appendChild(a);
		var i;
		var first = true;
		var j = 1;
		if (actb_self.actb_mouse){
			a.onmouseout = actb_table_unfocus;
			a.onmouseover = actb_table_focus;
		}
		var counter = 0;
		for (i=0;i<actb_self.actb_keywords.length;i++){
			if (actb_bool[i]){
				counter++;
				r = a.insertRow(-1);
				if (first && !actb_tomake){
					r.style.backgroundColor = actb_self.actb_hColor;
					first = false;
					actb_pos = counter;
				}else if(actb_pre == i){
					r.style.backgroundColor = actb_self.actb_hColor;
					first = false;
					actb_pos = counter;
				}else{
					r.style.backgroundColor = actb_self.actb_bgColor;
				}
				r.id = 'tat_tr'+(j);
				c = r.insertCell(-1);
				c.style.color = actb_self.actb_textColor;
				c.style.fontFamily = actb_self.actb_fFamily;
				c.style.fontSize = actb_self.actb_fSize;
				c.innerHTML = actb_parse(actb_self.actb_keywords[i]);
				c.id = 'tat_td'+(j);
				c.setAttribute('pos',j);
				if (actb_self.actb_mouse){
					c.style.cursor = 'pointer';
					c.onclick=actb_mouseclick;
					c.onmouseover = actb_table_highlight;
				}
				j++;
			}
			if (j - 1 == actb_self.actb_lim && j < actb_total){
				r = a.insertRow(-1);
				r.style.backgroundColor = actb_self.actb_bgColor;
				c = r.insertCell(-1);
				c.style.color = actb_self.actb_textColor;
				c.style.fontFamily = 'arial narrow';
				c.style.fontSize = actb_self.actb_fSize;
				c.align='center';
				replaceHTML(c,'\\/');
				if (actb_self.actb_mouse){
					c.style.cursor = 'pointer';
					c.onclick = actb_mouse_down;
				}
				break;
			}
		}
		actb_rangeu = 1;
		actb_ranged = j-1;
		actb_display = true;
		if (actb_pos <= 0) actb_pos = 1;
	}
	function actb_remake(){
		document.body.removeChild(document.getElementById('tat_table'));
		a = document.createElement('table');
		a.cellSpacing='1px';
		a.cellPadding='2px';
		a.style.position='absolute';
		a.style.top = eval(curTop(actb_curr) + actb_curr.offsetHeight) + "px";
		a.style.left = curLeft(actb_curr) + "px";
		a.style.backgroundColor=actb_self.actb_bgColor;
		a.id = 'tat_table';
		if (actb_self.actb_mouse){
			a.onmouseout= actb_table_unfocus;
			a.onmouseover=actb_table_focus;
		}
		document.body.appendChild(a);
		var i;
		var first = true;
		var j = 1;
		if (actb_rangeu > 1){
			r = a.insertRow(-1);
			r.style.backgroundColor = actb_self.actb_bgColor;
			c = r.insertCell(-1);
			c.style.color = actb_self.actb_textColor;
			c.style.fontFamily = 'arial narrow';
			c.style.fontSize = actb_self.actb_fSize;
			c.align='center';
			replaceHTML(c,'/\\');
			if (actb_self.actb_mouse){
				c.style.cursor = 'pointer';
				c.onclick = actb_mouse_up;
			}
		}
		for (i=0;i<actb_self.actb_keywords.length;i++){
			if (actb_bool[i]){
				if (j >= actb_rangeu && j <= actb_ranged){
					r = a.insertRow(-1);
					r.style.backgroundColor = actb_self.actb_bgColor;
					r.id = 'tat_tr'+(j);
					c = r.insertCell(-1);
					c.style.color = actb_self.actb_textColor;
					c.style.fontFamily = actb_self.actb_fFamily;
					c.style.fontSize = actb_self.actb_fSize;
					c.innerHTML = actb_parse(actb_self.actb_keywords[i]);
					c.id = 'tat_td'+(j);
					c.setAttribute('pos',j);
					if (actb_self.actb_mouse){
						c.style.cursor = 'pointer';
						c.onclick=actb_mouseclick;
						c.onmouseover = actb_table_highlight;
					}
					j++;
				}else{
					j++;
				}
			}
			if (j > actb_ranged) break;
		}
		if (j-1 < actb_total){
			r = a.insertRow(-1);
			r.style.backgroundColor = actb_self.actb_bgColor;
			c = r.insertCell(-1);
			c.style.color = actb_self.actb_textColor;
			c.style.fontFamily = 'arial narrow';
			c.style.fontSize = actb_self.actb_fSize;
			c.align='center';
			replaceHTML(c,'\\/');
			if (actb_self.actb_mouse){
				c.style.cursor = 'pointer';
				c.onclick = actb_mouse_down;
			}
		}
	}
	function actb_goup(){
		if (!actb_display) return;
		if (actb_pos == 1) return;
		document.getElementById('tat_tr'+actb_pos).style.backgroundColor = actb_self.actb_bgColor;
		actb_pos--;
		if (actb_pos < actb_rangeu) actb_moveup();
		document.getElementById('tat_tr'+actb_pos).style.backgroundColor = actb_self.actb_hColor;
		if (actb_toid) clearTimeout(actb_toid);
		if (actb_self.actb_timeOut > 0) actb_toid = setTimeout(function(){actb_mouse_on_list=0;actb_removedisp();},actb_self.actb_timeOut);
	}
	function actb_godown(){
		if (!actb_display) return;
		if (actb_pos == actb_total) return;
		document.getElementById('tat_tr'+actb_pos).style.backgroundColor = actb_self.actb_bgColor;
		actb_pos++;
		if (actb_pos > actb_ranged) actb_movedown();
		document.getElementById('tat_tr'+actb_pos).style.backgroundColor = actb_self.actb_hColor;
		if (actb_toid) clearTimeout(actb_toid);
		if (actb_self.actb_timeOut > 0) actb_toid = setTimeout(function(){actb_mouse_on_list=0;actb_removedisp();},actb_self.actb_timeOut);
	}
	function actb_movedown(){
		actb_rangeu++;
		actb_ranged++;
		actb_remake();
	}
	function actb_moveup(){
		actb_rangeu--;
		actb_ranged--;
		actb_remake();
	}

	/* Mouse */
	function actb_mouse_down(){
		document.getElementById('tat_tr'+actb_pos).style.backgroundColor = actb_self.actb_bgColor;
		actb_pos++;
		actb_movedown();
		document.getElementById('tat_tr'+actb_pos).style.backgroundColor = actb_self.actb_hColor;
		actb_curr.focus();
		actb_mouse_on_list = 0;
		if (actb_toid) clearTimeout(actb_toid);
		if (actb_self.actb_timeOut > 0) actb_toid = setTimeout(function(){actb_mouse_on_list=0;actb_removedisp();},actb_self.actb_timeOut);
	}
	function actb_mouse_up(evt){
		if (!evt) evt = event;
		if (evt.stopPropagation){
			evt.stopPropagation();
		}else{
			evt.cancelBubble = true;
		}
		document.getElementById('tat_tr'+actb_pos).style.backgroundColor = actb_self.actb_bgColor;
		actb_pos--;
		actb_moveup();
		document.getElementById('tat_tr'+actb_pos).style.backgroundColor = actb_self.actb_hColor;
		actb_curr.focus();
		actb_mouse_on_list = 0;
		if (actb_toid) clearTimeout(actb_toid);
		if (actb_self.actb_timeOut > 0) actb_toid = setTimeout(function(){actb_mouse_on_list=0;actb_removedisp();},actb_self.actb_timeOut);
	}
	function actb_mouseclick(evt){
		if (!evt) evt = event;
		if (!actb_display) return;
		actb_mouse_on_list = 0;
		actb_pos = this.getAttribute('pos');
		actb_penter();
	}
	function actb_table_focus(){
		actb_mouse_on_list = 1;
	}
	function actb_table_unfocus(){
		actb_mouse_on_list = 0;
		if (actb_toid) clearTimeout(actb_toid);
		if (actb_self.actb_timeOut > 0) actb_toid = setTimeout(function(){actb_mouse_on_list = 0;actb_removedisp();},actb_self.actb_timeOut);
	}
	function actb_table_highlight(){
		actb_mouse_on_list = 1;
		document.getElementById('tat_tr'+actb_pos).style.backgroundColor = actb_self.actb_bgColor;
		actb_pos = this.getAttribute('pos');
		while (actb_pos < actb_rangeu) actb_moveup();
		while (actb_pos > actb_ranged) actb_movedown();
		document.getElementById('tat_tr'+actb_pos).style.backgroundColor = actb_self.actb_hColor;
		if (actb_toid) clearTimeout(actb_toid);
		if (actb_self.actb_timeOut > 0) actb_toid = setTimeout(function(){actb_mouse_on_list = 0;actb_removedisp();},actb_self.actb_timeOut);
	}
	/* ---- */

	function actb_insertword(a){
		if (actb_self.actb_delimiter.length > 0){
			str = '';
			l=0;
			for (i=0;i<actb_delimwords.length;i++){
				if (actb_cdelimword == i){
					prespace = postspace = '';
					gotbreak = false;
					for (j=0;j<actb_delimwords[i].length;++j){
						if (actb_delimwords[i].charAt(j) != ' '){
							gotbreak = true;
							break;
						}
						prespace += ' ';
					}
					for (j=actb_delimwords[i].length-1;j>=0;--j){
						if (actb_delimwords[i].charAt(j) != ' ') break;
						postspace += ' ';
					}
					str += prespace;
					str += a;
					l = str.length;
					if (gotbreak) str += postspace;
				}else{
					str += actb_delimwords[i];
				}
				if (i != actb_delimwords.length - 1){
					str += actb_delimchar[i];
				}
			}
			actb_curr.value = str;
			setCaret(actb_curr,l);
		}else{
			actb_curr.value = a;
		}
		actb_mouse_on_list = 0;
		actb_removedisp();
	}
	function actb_penter(){
		if (!actb_display) return;
		actb_display = false;
		var word = '';
		var c = 0;
		for (var i=0;i<=actb_self.actb_keywords.length;i++){
			if (actb_bool[i]) c++;
			if (c == actb_pos){
				word = actb_self.actb_keywords[i];
				break;
			}
		}
		actb_insertword(word);
		l = getCaretStart(actb_curr);
	}
	function actb_removedisp(){
		if (actb_mouse_on_list==0){
			actb_display = 0;
			if (document.getElementById('tat_table')){ document.body.removeChild(document.getElementById('tat_table')); }
			if (actb_toid) clearTimeout(actb_toid);
		}
	}
	function actb_keypress(e){
		if (actb_caretmove) stopEvent(e);
		return !actb_caretmove;
	}
	function actb_checkkey(evt){
		if (!evt) evt = event;
		a = evt.keyCode;
		caret_pos_start = getCaretStart(actb_curr);
		actb_caretmove = 0;
		switch (a){
			case 38:
				actb_goup();
				actb_caretmove = 1;
				return false;
				break;
			case 40:
				actb_godown();
				actb_caretmove = 1;
				return false;
				break;
			case 13: case 9:
				if (actb_display){
					actb_caretmove = 1;
					actb_penter();
					return false;
				}else{
					return true;
				}
				break;
			default:
				setTimeout(function(){actb_tocomplete(a)},50);
				break;
		}
	}

	function actb_tocomplete(kc){
		if (kc == 38 || kc == 40 || kc == 13) return;
		var i;
		if (actb_display){ 
			var word = 0;
			var c = 0;
			for (var i=0;i<=actb_self.actb_keywords.length;i++){
				if (actb_bool[i]) c++;
				if (c == actb_pos){
					word = i;
					break;
				}
			}
			actb_pre = word;
		}else{ actb_pre = -1};
		
		if (actb_curr.value == ''){
			actb_mouse_on_list = 0;
			actb_removedisp();
			return;
		}
		if (actb_self.actb_delimiter.length > 0){
			caret_pos_start = getCaretStart(actb_curr);
			caret_pos_end = getCaretEnd(actb_curr);
			
			delim_split = '';
			for (i=0;i<actb_self.actb_delimiter.length;i++){
				delim_split += actb_self.actb_delimiter[i];
			}
			delim_split = delim_split.addslashes();
			delim_split_rx = new RegExp("(["+delim_split+"])");
			c = 0;
			actb_delimwords = new Array();
			actb_delimwords[0] = '';
			for (i=0,j=actb_curr.value.length;i<actb_curr.value.length;i++,j--){
				if (actb_curr.value.substr(i,j).search(delim_split_rx) == 0){
					ma = actb_curr.value.substr(i,j).match(delim_split_rx);
					actb_delimchar[c] = ma[1];
					c++;
					actb_delimwords[c] = '';
				}else{
					actb_delimwords[c] += actb_curr.value.charAt(i);
				}
			}

			var l = 0;
			actb_cdelimword = -1;
			for (i=0;i<actb_delimwords.length;i++){
				if (caret_pos_end >= l && caret_pos_end <= l + actb_delimwords[i].length){
					actb_cdelimword = i;
				}
				l+=actb_delimwords[i].length + 1;
			}
			var ot = actb_delimwords[actb_cdelimword].trim(); 
			var t = actb_delimwords[actb_cdelimword].addslashes().trim();
		}else{
			var ot = actb_curr.value;
			var t = actb_curr.value.addslashes();
		}
		if (ot.length == 0){
			actb_mouse_on_list = 0;
			actb_removedisp();
		}
		if (ot.length < actb_self.actb_startcheck) return this;
		if (actb_self.actb_firstText){
			var re = new RegExp("^" + t, "i");
		}else{
			var re = new RegExp(t, "i");
		}

		actb_total = 0;
		actb_tomake = false;
		actb_kwcount = 0;
		for (i=0;i<actb_self.actb_keywords.length;i++){
			actb_bool[i] = false;
			if (re.test(actb_self.actb_keywords[i])){
				actb_total++;
				actb_bool[i] = true;
				actb_kwcount++;
				if (actb_pre == i) actb_tomake = true;
			}
		}

		if (actb_toid) clearTimeout(actb_toid);
		if (actb_self.actb_timeOut > 0) actb_toid = setTimeout(function(){actb_mouse_on_list = 0;actb_removedisp();},actb_self.actb_timeOut);
		actb_generate();
	}
	return this;
}

/* Event Functions */

// Add an event to the obj given
// event_name refers to the event trigger, without the "on", like click or mouseover
// func_name refers to the function callback when event is triggered
function addEvent(obj,event_name,func_name){
	if (obj.attachEvent){
		obj.attachEvent("on"+event_name, func_name);
	}else if(obj.addEventListener){
		obj.addEventListener(event_name,func_name,true);
	}else{
		obj["on"+event_name] = func_name;
	}
}

// Removes an event from the object
function removeEvent(obj,event_name,func_name){
	if (obj.detachEvent){
		obj.detachEvent("on"+event_name,func_name);
	}else if(obj.removeEventListener){
		obj.removeEventListener(event_name,func_name,true);
	}else{
		obj["on"+event_name] = null;
	}
}

// Stop an event from bubbling up the event DOM
function stopEvent(evt){
	evt || window.event;
	if (evt.stopPropagation){
		evt.stopPropagation();
		evt.preventDefault();
	}else if(typeof evt.cancelBubble != "undefined"){
		evt.cancelBubble = true;
		evt.returnValue = false;
	}
	return false;
}

// Get the obj that starts the event
function getElement(evt){
	if (window.event){
		return window.event.srcElement;
	}else{
		return evt.currentTarget;
	}
}
// Get the obj that triggers off the event
function getTargetElement(evt){
	if (window.event){
		return window.event.srcElement;
	}else{
		return evt.target;
	}
}
// For IE only, stops the obj from being selected
function stopSelect(obj){
	if (typeof obj.onselectstart != 'undefined'){
		addEvent(obj,"selectstart",function(){ return false;});
	}
}

/*    Caret Functions     */

// Get the end position of the caret in the object. Note that the obj needs to be in focus first
function getCaretEnd(obj){
	if(typeof obj.selectionEnd != "undefined"){
		return obj.selectionEnd;
	}else if(document.selection&&document.selection.createRange){
		var M=document.selection.createRange();
		try{
			var Lp = M.duplicate();
			Lp.moveToElementText(obj);
		}catch(e){
			var Lp=obj.createTextRange();
		}
		Lp.setEndPoint("EndToEnd",M);
		var rb=Lp.text.length;
		if(rb>obj.value.length){
			return -1;
		}
		return rb;
	}
}
// Get the start position of the caret in the object
function getCaretStart(obj){
	if(typeof obj.selectionStart != "undefined"){
		return obj.selectionStart;
	}else if(document.selection&&document.selection.createRange){
		var M=document.selection.createRange();
		try{
			var Lp = M.duplicate();
			Lp.moveToElementText(obj);
		}catch(e){
			var Lp=obj.createTextRange();
		}
		Lp.setEndPoint("EndToStart",M);
		var rb=Lp.text.length;
		if(rb>obj.value.length){
			return -1;
		}
		return rb;
	}
}
// sets the caret position to l in the object
function setCaret(obj,l){
	obj.focus();
	if (obj.setSelectionRange){
		obj.setSelectionRange(l,l);
	}else if(obj.createTextRange){
		m = obj.createTextRange();		
		m.moveStart('character',l);
		m.collapse();
		m.select();
	}
}
// sets the caret selection from s to e in the object
function setSelection(obj,s,e){
	obj.focus();
	if (obj.setSelectionRange){
		obj.setSelectionRange(s,e);
	}else if(obj.createTextRange){
		m = obj.createTextRange();		
		m.moveStart('character',s);
		m.moveEnd('character',e);
		m.select();
	}
}

/*    Escape function   */
String.prototype.addslashes = function(){
	return this.replace(/(["\\\.\|\[\]\^\*\+\?\$\(\)])/g, '\\$1');
}
String.prototype.trim = function () {
    return this.replace(/^\s*(\S*(\s+\S+)*)\s*$/, "$1");
};
/* --- Escape --- */

/* Offset position from top of the screen */
function curTop(obj){
	toreturn = 0;
	while(obj){
		toreturn += obj.offsetTop;
		obj = obj.offsetParent;
	}
	return toreturn;
}
function curLeft(obj){
	toreturn = 0;
	while(obj){
		toreturn += obj.offsetLeft;
		obj = obj.offsetParent;
	}
	return toreturn;
}
/* ------ End of Offset function ------- */

/* Types Function */

// is a given input a number?
function isNumber(a) {
    return typeof a == 'number' && isFinite(a);
}

/* Object Functions */

function replaceHTML(obj,text){
	while(el = obj.childNodes[0]){
		obj.removeChild(el);
	};
	obj.appendChild(document.createTextNode(text));
}


function Pulse(dateLastHeartbeat) {
	// time of the last heartbeat
	var timeLastHeartbeat = getCookie("PulseLH");
	if (timeLastHeartbeat == null || timeLastHeartbeat == "" || isNaN(timeLastHeartbeat)) {
		this.TimeLastHeartbeat = Date.parse("1970-01-01 00:00:00");
	} else {
		this.TimeLastHeartbeat = parseInt(timeLastHeartbeat);
	}

	this.Urls = new Array("/pulse.asp", "/pulse.aspx"); // the location of pulse.asp (or any heartbeat handler)
	this.Heartrate = 540; // the heartbeat interval in seconds - 540 (9 minutes)
	this.ConfirmInterval = 2700; // the confirmation interval in seconds - 2700 (45 minutes)
	this.TID = null;

	this.Heartbeat = function () {
		var nowTime = (new Date()).getTime();

		// time of the last confirmation
		var timeLastConfirmation = getCookie("PulseLC");
		if (timeLastConfirmation == null || timeLastConfirmation == "" || isNaN(timeLastConfirmation)) {
			timeLastConfirmation = nowTime;
			setCookie("PulseLC", timeLastConfirmation, "/");
		} else {
			timeLastConfirmation = parseInt(timeLastConfirmation);
		}

		var nextConfirmation = Math.round(timeLastConfirmation + (this.ConfirmInterval * 1000));
		//alert(nextConfirmation);

		// raise a confirmation dialog if one is scheduled within half the time of a heartbeat interval?
		if (nextConfirmation <= nowTime) {
			// confirm that a human is still present
			var self = this;

			// disable Pulse until user clicks confirm. Note: This also effects other pingers (Progress Bar, Chat)
			setCookie("PulseOff", "1", "/");
			setCookie("PulseLC", (new Date()).getTime(), "/");

			YuiGenericDialog("ConfirmThump",
				"It appears that you have been inactive for an extended period of time.<br /><br /> Would you like to continue your browsing session?",
				function () {
					if (m_bYuiGenericDialogResult) {
						// reenable pulse
						setCookie("PulseOff", "0", "/");
						self.Heartbeat();
					}
				}
				, "Yes, continue", "", null, null, null, null, 50
			);

			return;
		}

		for (var i = 0; i < this.Urls.length; i++) {
			var xmlhttp = null;
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			} else if (window.ActiveXObject) {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}

			if (xmlhttp) {
				xmlhttp.open("GET", this.Urls[i], true);
				xmlhttp.send(null);
			}
		}

		this.TimeLastHeartbeat = nowTime;
		setCookie("PulseLH", nowTime, "/");

		var self = this;
		this.TID = setTimeout(function () { self.Heartbeat(); }, Math.round(this.Heartrate * 1000));
	}

	this.Start = function () {
		// reenable Pulse if a confirmation had previously timed out
		setCookie("PulseOff", "0", "/");
		setCookie("PulseLC", (new Date()).getTime(), "/");

		var self = this;
		var nowTime = (new Date()).getTime();
		var nextHeartbeat = Math.round((this.Heartrate * 1000) - (nowTime - this.TimeLastHeartbeat));

		//should the next heartbeat happen within the next 10 seconds?
		if (nextHeartbeat < 10000) {
			// reset confirmation
			setCookie("PulseLC", nowTime, "/");

			//go ahead and do it now
			self.Heartbeat();
		} else {
			//wire it up on a delay
			this.TID = setTimeout(function () { self.Heartbeat(); }, nextHeartbeat);
		}
	}
}



var m_ChatTID;
var m_ChatRequestAlert;

function alertBadBrowser()
{
	alert('The chat system requires features which your browser does not supprt. \n\n'+
		'The following browsers are recommended: \n\nInternet Explorer 7 (Windows) \n'+
		'Firefox 3 (Windows, Mac) \nSafari 2+ (Mac) ');
	self.close();
	return null;
}

function openNewChatWindow(recip)
{
	openPopup('/members/chat.asp?recip='+ recip, '_blank', 'status,resizable,toolbar=false', 550, 400);
	return false;
}

function openChatWindow(GUID, ChatID)
{
	openPopup('/members/chat.asp?cid='+ GUID, getChatWinName(ChatID), 'status,resizable,toolbar=false', 550, 400);
	return HideChatRequestAlert();
}

function getChatWinName(ChatID)
{
	return 'Chat_'+ ChatID.toString();
}

function getChatCookie(id)
{
	return getCookie('Chat_'+ id.toString());
}

function setChatCookie(id, value)
{
	setCookie('Chat_'+ id.toString(),value,'/');
}

function getChats()
{
	// only poll for new data if Pulse has not been disabled
	if (getCookie("PulseOff") != "1")
	{
		try {
			var sTime = (new Date()).getTime().toString();
			var xmlhttp = newXmlHttp(ignoreBadBrowser);
			xmlhttp.open("GET", '/global_inc/xml/chat_xml.asp?type=chats&ts=' + sTime, false);
			xmlhttp.send(null);

			var xmlDoc, xmlRoot;
			if (xmlhttp.status == 200 && xmlhttp.responseText != '') {
				xmlDoc = loadNewXml(xmlhttp.responseText);
				xmlRoot = xmlDoc.documentElement;
			}

			var bInitialBuild = (!document.getElementById('ActiveChatList'));
			var sActiveChatList = '';


			var iChatCount = parseInt(GetChildNodeValue(xmlRoot, "Count"));
			if (!(isNaN(iChatCount) || iChatCount == 0)) {	//spin through chats; we only want display an alert when the participant has not yet been notified
				var iAlerts = -1;
				var aChatID = new Array();
				var aGUID = new Array();
				var aName = new Array();

				var nChats = xmlRoot.getElementsByTagName("Chats")[0].getElementsByTagName("Chat");
				var ChatID;
				for (var n = 0; n < nChats.length; n++) {
					ChatID = GetChildNodeValue(nChats[n], "ID");
					if (GetChildNodeValue(nChats[n], "Notfied") != '1') {
						iAlerts++;

						aChatID.length = iAlerts;
						aChatID[iAlerts] = ChatID;
						aGUID.length = iAlerts;
						aGUID[iAlerts] = GetChildNodeValue(nChats[n], "GUID");
						aName.length = iAlerts;
						aName[iAlerts] = GetChildNodeValue(nChats[n], "Name");

						AddToChatToolBar(ChatID, aGUID[iAlerts], aName[iAlerts]);
					} else if (bInitialBuild) {
						AddToChatToolBar(ChatID,
							GetChildNodeValue(nChats[n], "GUID"),
							GetChildNodeValue(nChats[n], "Name")
						);
					}

					if (GetChildNodeValue(nChats[n], "Unread") != '0') {
						//unread messages; flash the toolbar button
						ChatToolBarFlash(ChatID, 3);
					}
				}

				if (iAlerts >= 0) {
					var sAlertBody = '', sNameTrailer = '';
					if (iAlerts == 0) {	//single chat alert
						sNameTrailer = ' wants to chat!';
					} else {
						//multiple alerts
						sAlertBody = 'You have chat requests from:<br><br>';
					}

					for (var i = 0; i < aGUID.length; i++) {
						if (i > 0) sAlertBody += '<br>';
						sAlertBody += ('<a href=# onclick="return openChatWindow(\'' + aGUID[i] +
							'\',' + aChatID[i] + ');">' + aName[i] + sNameTrailer + '</a>');
					}

					RaiseChatRequestAlert(sAlertBody);
				}
			}

		} catch (e) { }
	}

	pollForChats();
}

function pollForChats(retrys)
{	//chat polling must fire without exception
	try {
		//check for new conversations every 30 seconds
		m_ChatTID = setTimeout(function(){ getChats() }, 30000);
	} catch(e) {
		//retry 9 times before giving up
		if(isNaN(retrys)) retrys = 0;
		
		if(retrys<9) {
			retrys++;
			m_ChatTID = setTimeout(function(){ pollForChats(retrys) }, 1000);
		}
	}
}

function RaiseChatRequestAlert(sAlertBody)
{
	var container = document.getElementById('PageBase_RaiseAlert');
	if(container) {
		if(m_ChatRequestAlert) {
			m_ChatRequestAlert.setBody(sAlertBody);
			
			//IE hack: underlay size does not change with panel size; resize it now
			if(document.all) m_ChatRequestAlert.sizeUnderlay();
			
			m_ChatRequestAlert.show();
		} else {
			m_ChatRequestAlert = new YAHOO.widget.SimpleDialog("ChatRequestAlert", {
				text:sAlertBody,
				iframe:false,
				visible:true,
				close:true,
				draggable:false,
				modal:false,
				underlay:'shadow',
				width:'270px',
				fixedcenter:true
				}
			);
			
			m_ChatRequestAlert.setHeader("Chat Request");
			m_ChatRequestAlert.render(container);
		}
	}
}

function HideChatRequestAlert()
{
	if(m_ChatRequestAlert) m_ChatRequestAlert.hide();
	return false;
}

function AddToChatToolBar(ChatID, GUID, Name)
{
	var ActiveChatList = document.getElementById('ActiveChatList');
	if(!ActiveChatList) {
		WriteTopToolBar('<label>AVAILABLE CHATS</label>');
		var TopToolBarText = document.getElementById('TopToolBarText');
		ActiveChatList = document.createElement('span');
		ActiveChatList.setAttribute('id','ActiveChatList');
		TopToolBarText.appendChild(ActiveChatList);		
	}
	
	var sNewLink = '<a href=# id="ChatTB_'+ ChatID +'" title="'+ Name +'"'+
		' onclick="return openChatWindow(\''+ GUID + '\','+ ChatID +');"'+
		' onmouseover="ChatToolBar_OnMouseOver(this);" onmouseout="ChatToolBar_OnMouseOut(this);">'+
		Name.substr(0,6) + '...</a>';
	
	ActiveChatList.innerHTML = sNewLink + ActiveChatList.innerHTML;
}

function ChatToolBarFlash(ChatID, HowManyTimes, i)
{
	var ChatLink = document.getElementById('ChatTB_'+ ChatID);
	if(!ChatLink) return;
	
	if(isNaN(i)) i = 1;
	
	if(i%2==0) {
		ChatLink.style.backgroundColor = 'Transparent';
	} else {
		ChatLink.style.backgroundColor = 'White';
	}
	
	if(i<(HowManyTimes*2)) {
		i++;
		setTimeout(function(){ ChatToolBarFlash(ChatID, HowManyTimes, i) }, 300);
	}

}

function ChatToolBar_OnMouseOver(sender)
{
	sender.style.backgroundColor = '#F2F6F9';
}

function ChatToolBar_OnMouseOut(sender)
{
	sender.style.backgroundColor = 'Transparent';
}


function AC_AddExtension(src,ext){if(src.indexOf('?')!=-1)return src.replace(/\?/,ext+'?');else return src+ext}function AC_Generateobj(objAttrs,params,embedAttrs){var str='<object ';for(var i in objAttrs)str+=i+'="'+objAttrs[i]+'" ';str+='>';for(var i in params)str+='<param name="'+i+'" value="'+params[i]+'" /> ';str+='<embed ';for(var i in embedAttrs)str+=i+'="'+embedAttrs[i]+'" ';str+=' ></embed></object>';document.write(str)}function AC_FL_RunContent(){var ret=AC_GetArgs(arguments,".swf","movie","clsid:d27cdb6e-ae6d-11cf-96b8-444553540000","application/x-shockwave-flash");AC_Generateobj(ret.objAttrs,ret.params,ret.embedAttrs)}function AC_SW_RunContent(){var ret=AC_GetArgs(arguments,".dcr","src","clsid:166B1BCA-3F9C-11CF-8075-444553540000",null);AC_Generateobj(ret.objAttrs,ret.params,ret.embedAttrs)}function AC_GetArgs(args,ext,srcParamName,classid,mimeType){var ret=new Object();ret.embedAttrs=new Object();ret.params=new Object();ret.objAttrs=new Object();for(var i=0;i<args.length;i=i+2){var currArg=args[i].toLowerCase();switch(currArg){case"classid":break;case"pluginspage":ret.embedAttrs[args[i]]=args[i+1];break;case"src":case"movie":args[i+1]=AC_AddExtension(args[i+1],ext);ret.embedAttrs["src"]=args[i+1];ret.params[srcParamName]=args[i+1];break;case"onafterupdate":case"onbeforeupdate":case"onblur":case"oncellchange":case"onclick":case"ondblClick":case"ondrag":case"ondragend":case"ondragenter":case"ondragleave":case"ondragover":case"ondrop":case"onfinish":case"onfocus":case"onhelp":case"onmousedown":case"onmouseup":case"onmouseover":case"onmousemove":case"onmouseout":case"onkeypress":case"onkeydown":case"onkeyup":case"onload":case"onlosecapture":case"onpropertychange":case"onreadystatechange":case"onrowsdelete":case"onrowenter":case"onrowexit":case"onrowsinserted":case"onstart":case"onscroll":case"onbeforeeditfocus":case"onactivate":case"onbeforedeactivate":case"ondeactivate":case"type":case"codebase":ret.objAttrs[args[i]]=args[i+1];break;case"width":case"height":case"align":case"vspace":case"hspace":case"class":case"title":case"accesskey":case"name":case"id":case"tabindex":ret.embedAttrs[args[i]]=ret.objAttrs[args[i]]=args[i+1];break;default:ret.embedAttrs[args[i]]=ret.params[args[i]]=args[i+1]}}ret.objAttrs["classid"]=classid;if(mimeType)ret.embedAttrs["type"]=mimeType;return ret}

function AC_AX_RunContent(){var ret=AC_AX_GetArgs(arguments);AC_Generateobj(ret.objAttrs,ret.params,ret.embedAttrs)}function AC_AX_GetArgs(args){var ret=new Object();ret.embedAttrs=new Object();ret.params=new Object();ret.objAttrs=new Object();for(var i=0;i<args.length;i=i+2){var currArg=args[i].toLowerCase();switch(currArg){case"pluginspage":case"type":case"src":ret.embedAttrs[args[i]]=args[i+1];break;case"data":case"codebase":case"classid":case"id":case"onafterupdate":case"onbeforeupdate":case"onblur":case"oncellchange":case"onclick":case"ondblClick":case"ondrag":case"ondragend":case"ondragenter":case"ondragleave":case"ondragover":case"ondrop":case"onfinish":case"onfocus":case"onhelp":case"onmousedown":case"onmouseup":case"onmouseover":case"onmousemove":case"onmouseout":case"onkeypress":case"onkeydown":case"onkeyup":case"onload":case"onlosecapture":case"onpropertychange":case"onreadystatechange":case"onrowsdelete":case"onrowenter":case"onrowexit":case"onrowsinserted":case"onstart":case"onscroll":case"onbeforeeditfocus":case"onactivate":case"onbeforedeactivate":case"ondeactivate":ret.objAttrs[args[i]]=args[i+1];break;case"width":case"height":case"align":case"vspace":case"hspace":case"class":case"title":case"accesskey":case"name":case"tabindex":ret.embedAttrs[args[i]]=ret.objAttrs[args[i]]=args[i+1];break;default:ret.embedAttrs[args[i]]=ret.params[args[i]]=args[i+1]}}return ret}


$(document).ready(function () {
    if ($('#divForumBreadCrumb').length == 0) {
        $.ajax({
            url: "/global_engine/ajax/BreadCrumbService.aspx",
            data: "url=" + encodeURIComponent(window.location.pathname + window.location.search) + "&ref=" + encodeURIComponent(document.referrer),
            dataType: "html",
            success: function(data) {
                {
                    $("#SpTitleBar").closest('tr').after("<tr><td class='tdBreadCrumb'>"+data+"</td></tr>");
                }
            },
            error: function(xhr, msg) {
                {
                }
            }
        });
    }
});


/* Simple JavaScript Inheritance
 * By John Resig http://ejohn.org/
 * MIT Licensed.
 */
// Inspired by base2 and Prototype
(function(){
	var initializing = false;

	// The base JQClass implementation (does nothing)
	window.JQClass = function(){};

	// Collection of derived classes
	JQClass.classes = {};
 
	// Create a new JQClass that inherits from this class
	JQClass.extend = function extender(prop) {
		var base = this.prototype;

		// Instantiate a base class (but only create the instance,
		// don't run the init constructor)
		initializing = true;
		var prototype = new this();
		initializing = false;

		// Copy the properties over onto the new prototype
		for (var name in prop) {
			// Check if we're overwriting an existing function
			prototype[name] = typeof prop[name] == 'function' &&
				typeof base[name] == 'function' ?
				(function(name, fn){
					return function() {
						var __super = this._super;

						// Add a new ._super() method that is the same method
						// but on the super-class
						this._super = function(args) {
							return base[name].apply(this, args || []);
						};

						var ret = fn.apply(this, arguments);				

						// The method only need to be bound temporarily, so we
						// remove it when we're done executing
						this._super = __super;

						return ret;
					};
				})(name, prop[name]) :
				prop[name];
		}

		// The dummy class constructor
		function JQClass() {
			// All construction is actually done in the init method
			if (!initializing && this._init) {
				this._init.apply(this, arguments);
			}
		}

		// Populate our constructed prototype object
		JQClass.prototype = prototype;

		// Enforce the constructor to be what we expect
		JQClass.prototype.constructor = JQClass;

		// And make this class extendable
		JQClass.extend = extender;

		return JQClass;
	};
})();

(function($) { // Ensure $, encapsulate

	/** Abstract base class for collection plugins v1.0.1.
		Written by Keith Wood (kbwood{at}iinet.com.au) December 2013.
		Licensed under the MIT (https://github.com/jquery/jquery/blob/master/LICENSE.txt) license.
		@module $.JQPlugin
		@abstract */
	JQClass.classes.JQPlugin = JQClass.extend({

		/** Name to identify this plugin.
			@example name: 'tabs' */
		name: 'plugin',

		/** Default options for instances of this plugin (default: {}).
			@example defaultOptions: {
 	selectedClass: 'selected',
 	triggers: 'click'
 } */
		defaultOptions: {},
		
		/** Options dependent on the locale.
			Indexed by language and (optional) country code, with '' denoting the default language (English/US).
			@example regionalOptions: {
	'': {
		greeting: 'Hi'
	}
 } */
		regionalOptions: {},
		
		/** Names of getter methods - those that can't be chained (default: []).
			@example _getters: ['activeTab'] */
		_getters: [],

		/** Retrieve a marker class for affected elements.
			@private
			@return {string} The marker class. */
		_getMarker: function() {
			return 'is-' + this.name;
		},
		
		/** Initialise the plugin.
			Create the jQuery bridge - plugin name <code>xyz</code>
			produces <code>$.xyz</code> and <code>$.fn.xyz</code>. */
		_init: function() {
			// Apply default localisations
			$.extend(this.defaultOptions, (this.regionalOptions && this.regionalOptions['']) || {});
			// Camel-case the name
			var jqName = camelCase(this.name);
			// Expose jQuery singleton manager
			$[jqName] = this;
			// Expose jQuery collection plugin
			$.fn[jqName] = function(options) {
				var otherArgs = Array.prototype.slice.call(arguments, 1);
				if ($[jqName]._isNotChained(options, otherArgs)) {
					return $[jqName][options].apply($[jqName], [this[0]].concat(otherArgs));
				}
				return this.each(function() {
					if (typeof options === 'string') {
						if (options[0] === '_' || !$[jqName][options]) {
							throw 'Unknown method: ' + options;
						}
						$[jqName][options].apply($[jqName], [this].concat(otherArgs));
					}
					else {
						$[jqName]._attach(this, options);
					}
				});
			};
		},

		/** Set default values for all subsequent instances.
			@param options {object} The new default options.
			@example $.plugin.setDefauls({name: value}) */
		setDefaults: function(options) {
			$.extend(this.defaultOptions, options || {});
		},
		
		/** Determine whether a method is a getter and doesn't permit chaining.
			@private
			@param name {string} The method name.
			@param otherArgs {any[]} Any other arguments for the method.
			@return {boolean} True if this method is a getter, false otherwise. */
		_isNotChained: function(name, otherArgs) {
			if (name === 'option' && (otherArgs.length === 0 ||
					(otherArgs.length === 1 && typeof otherArgs[0] === 'string'))) {
				return true;
			}
			return $.inArray(name, this._getters) > -1;
		},
		
		/** Initialise an element. Called internally only.
			Adds an instance object as data named for the plugin.
			@param elem {Element} The element to enhance.
			@param options {object} Overriding settings. */
		_attach: function(elem, options) {
			elem = $(elem);
			if (elem.hasClass(this._getMarker())) {
				return;
			}
			elem.addClass(this._getMarker());
			options = $.extend({}, this.defaultOptions, this._getMetadata(elem), options || {});
			var inst = $.extend({name: this.name, elem: elem, options: options},
				this._instSettings(elem, options));
			elem.data(this.name, inst); // Save instance against element
			this._postAttach(elem, inst);
			this.option(elem, options);
		},

		/** Retrieve additional instance settings.
			Override this in a sub-class to provide extra settings.
			@param elem {jQuery} The current jQuery element.
			@param options {object} The instance options.
			@return {object} Any extra instance values.
			@example _instSettings: function(elem, options) {
 	return {nav: elem.find(options.navSelector)};
 } */
		_instSettings: function(elem, options) {
			return {};
		},

		/** Plugin specific post initialisation.
			Override this in a sub-class to perform extra activities.
			@param elem {jQuery} The current jQuery element.
			@param inst {object} The instance settings.
			@example _postAttach: function(elem, inst) {
 	elem.on('click.' + this.name, function() {
 		...
 	});
 } */
		_postAttach: function(elem, inst) {
		},

		/** Retrieve metadata configuration from the element.
			Metadata is specified as an attribute:
			<code>data-&lt;plugin name>="&lt;setting name>: '&lt;value>', ..."</code>.
			Dates should be specified as strings in this format: 'new Date(y, m-1, d)'.
			@private
			@param elem {jQuery} The source element.
			@return {object} The inline configuration or {}. */
		_getMetadata: function(elem) {
			try {
				var data = elem.data(this.name.toLowerCase()) || '';
				data = data.replace(/'/g, '"');
				data = data.replace(/([a-zA-Z0-9]+):/g, function(match, group, i) { 
					var count = data.substring(0, i).match(/"/g); // Handle embedded ':'
					return (!count || count.length % 2 === 0 ? '"' + group + '":' : group + ':');
				});
				data = $.parseJSON('{' + data + '}');
				for (var name in data) { // Convert dates
					var value = data[name];
					if (typeof value === 'string' && value.match(/^new Date\((.*)\)$/)) {
						data[name] = eval(value);
					}
				}
				return data;
			}
			catch (e) {
				return {};
			}
		},

		/** Retrieve the instance data for element.
			@param elem {Element} The source element.
			@return {object} The instance data or {}. */
		_getInst: function(elem) {
			return $(elem).data(this.name) || {};
		},
		
		/** Retrieve or reconfigure the settings for a plugin.
			@param elem {Element} The source element.
			@param name {object|string} The collection of new option values or the name of a single option.
			@param [value] {any} The value for a single named option.
			@return {any|object} If retrieving a single value or all options.
			@example $(selector).plugin('option', 'name', value)
 $(selector).plugin('option', {name: value, ...})
 var value = $(selector).plugin('option', 'name')
 var options = $(selector).plugin('option') */
		option: function(elem, name, value) {
			elem = $(elem);
			var inst = elem.data(this.name);
			if  (!name || (typeof name === 'string' && value == null)) {
				var options = (inst || {}).options;
				return (options && name ? options[name] : options);
			}
			if (!elem.hasClass(this._getMarker())) {
				return;
			}
			var options = name || {};
			if (typeof name === 'string') {
				options = {};
				options[name] = value;
			}
			this._optionsChanged(elem, inst, options);
			$.extend(inst.options, options);
		},
		
		/** Plugin specific options processing.
			Old value available in <code>inst.options[name]</code>, new value in <code>options[name]</code>.
			Override this in a sub-class to perform extra activities.
			@param elem {jQuery} The current jQuery element.
			@param inst {object} The instance settings.
			@param options {object} The new options.
			@example _optionsChanged: function(elem, inst, options) {
 	if (options.name != inst.options.name) {
 		elem.removeClass(inst.options.name).addClass(options.name);
 	}
 } */
		_optionsChanged: function(elem, inst, options) {
		},
		
		/** Remove all trace of the plugin.
			Override <code>_preDestroy</code> for plugin-specific processing.
			@param elem {Element} The source element.
			@example $(selector).plugin('destroy') */
		destroy: function(elem) {
			elem = $(elem);
			if (!elem.hasClass(this._getMarker())) {
				return;
			}
			this._preDestroy(elem, this._getInst(elem));
			elem.removeData(this.name).removeClass(this._getMarker());
		},

		/** Plugin specific pre destruction.
			Override this in a sub-class to perform extra activities and undo everything that was
			done in the <code>_postAttach</code> or <code>_optionsChanged</code> functions.
			@param elem {jQuery} The current jQuery element.
			@param inst {object} The instance settings.
			@example _preDestroy: function(elem, inst) {
 	elem.off('.' + this.name);
 } */
		_preDestroy: function(elem, inst) {
		}
	});
	
	/** Convert names from hyphenated to camel-case.
		@private
		@param value {string} The original hyphenated name.
		@return {string} The camel-case version. */
	function camelCase(name) {
		return name.replace(/-([a-z])/g, function(match, group) {
			return group.toUpperCase();
		});
	}
	
	/** Expose the plugin base.
		@namespace "$.JQPlugin" */
	$.JQPlugin = {
	
		/** Create a new collection plugin.
			@memberof "$.JQPlugin"
			@param [superClass='JQPlugin'] {string} The name of the parent class to inherit from.
			@param overrides {object} The property/function overrides for the new class.
			@example $.JQPlugin.createPlugin({
 	name: 'tabs',
 	defaultOptions: {selectedClass: 'selected'},
 	_initSettings: function(elem, options) { return {...}; },
 	_postAttach: function(elem, inst) { ... }
 }); */
		createPlugin: function(superClass, overrides) {
			if (typeof superClass === 'object') {
				overrides = superClass;
				superClass = 'JQPlugin';
			}
			superClass = camelCase(superClass);
			var className = camelCase(overrides.name);
			JQClass.classes[className] = JQClass.classes[superClass].extend(overrides);
			new JQClass.classes[className]();
		}
	};

})(jQuery);

/* http://keith-wood.name/countdown.html
   Countdown for jQuery v2.0.1.
   Written by Keith Wood (kbwood{at}iinet.com.au) January 2008.
   Available under the MIT (https://github.com/jquery/jquery/blob/master/LICENSE.txt) license. 
   Please attribute the author if you use it. */

(function($) { // Hide scope, no $ conflict

	var pluginName = 'countdown';

	var Y = 0; // Years
	var O = 1; // Months
	var W = 2; // Weeks
	var D = 3; // Days
	var H = 4; // Hours
	var M = 5; // Minutes
	var S = 6; // Seconds

	/** Create the countdown plugin.
		<p>Sets an element to show the time remaining until a given instant.</p>
		<p>Expects HTML like:</p>
		<pre>&lt;div>&lt;/div></pre>
		<p>Provide inline configuration like:</p>
		<pre>&lt;div data-countdown="name: 'value'">&lt;/div></pre>
	 	@module Countdown
		@augments JQPlugin
		@example $(selector).countdown({until: +300}) */
	$.JQPlugin.createPlugin({
	
		/** The name of the plugin. */
		name: pluginName,

		/** Countdown expiry callback.
			Triggered when the countdown expires.
			@callback expiryCallback */

		/** Countdown server synchronisation callback.
			Triggered when the countdown is initialised.
			@callback serverSyncCallback
			@return {Date} The current date/time on the server as expressed in the local timezone. */
			
		/** Countdown tick callback.
			Triggered on every <code>tickInterval</code> ticks of the countdown.
			@callback tickCallback
			@param periods {number[]} The breakdown by period (years, months, weeks, days,
					hours, minutes, seconds) of the time remaining/passed. */

		/** Countdown which labels callback.
			Triggered when the countdown is being display to determine which set of labels
			(<code>labels</code>, <code>labels1</code>, ...) are to be used for the current period value.
			@callback whichLabelsCallback
			@param num {number} The current period value.
			@return {number} The suffix for the label set to use. */
			
		/** Default settings for the plugin.
			@property until {Date|number|string} The date/time to count down to, or number of seconds
						offset from now, or string of amounts and units for offset(s) from now:
						'Y' years, 'O' months, 'W' weeks, 'D' days, 'H' hours, 'M' minutes, 'S' seconds.
			@example until: new Date(2013, 12-1, 25, 13, 30)
 until: +300
 until: '+1O -2D'
			@property [since] {Date|number|string} The date/time to count up from, or
						number of seconds offset from now, or string for unit offset(s):
						'Y' years, 'O' months, 'W' weeks, 'D' days, 'H' hours, 'M' minutes, 'S' seconds.
			@example since: new Date(2013, 1-1, 1)
 since: -300
 since: '-1O +2D'
			@property [timezone=null] {number} The timezone (hours or minutes from GMT) for the target times,
						or null for client local timezone.
			@example timezone: +10
 timezone: -60
			@property [serverSync=null] {serverSyncCallback} A function to retrieve the current server time
						for synchronisation.
			@property [format='dHMS'] {string} The format for display - upper case for always, lower case only if non-zero,
						'Y' years, 'O' months, 'W' weeks, 'D' days, 'H' hours, 'M' minutes, 'S' seconds.
			@property [layout=''] {string} Build your own layout for the countdown.
			@example layout: '{d<}{dn} {dl}{d>} {hnn}:{mnn}:{snn}'
			@property [compact=false] {boolean} True to display in a compact format, false for an expanded one.
			@property [padZeroes=false] {boolean} True to add leading zeroes
			@property [significant=0] {number} The number of periods with non-zero values to show, zero for all.
			@property [description=''] {string} The description displayed for the countdown.
			@property [expiryUrl=''] {string} A URL to load upon expiry, replacing the current page.
			@property [expiryText=''] {string} Text to display upon expiry, replacing the countdown. This may be HTML.
			@property [alwaysExpire=false] {boolean} True to trigger <code>onExpiry</code> even if target time has passed.
			@property [onExpiry=null] {expiryCallback} Callback when the countdown expires -
						receives no parameters and <code>this</code> is the containing division.
			@example onExpiry: function() {
	...
 }
			@property [onTick=null] {tickCallback} Callback when the countdown is updated -
						receives <code>number[7]</code> being the breakdown by period
						(years, months, weeks, days, hours, minutes, seconds - based on
						<code>format</code>) and <code>this</code> is the containing division.
			@example onTick: function(periods) {
 	var secs = $.countdown.periodsToSeconds(periods);
 	if (secs < 300) { // Last five minutes
		...
 	}
 }
			@property [tickInterval=1] {number} The interval (seconds) between <code>onTick</code> callbacks. */
		defaultOptions: {
			until: null,
			since: null,
			timezone: null,
			serverSync: null,
			format: 'dHMS',
			layout: '',
			compact: false,
			padZeroes: false,
			significant: 0,
			description: '',
			expiryUrl: '',
			expiryText: '',
			alwaysExpire: false,
			onExpiry: null,
			onTick: null,
			tickInterval: 1
		},

		/** Localisations for the plugin.
			Entries are objects indexed by the language code ('' being the default US/English).
			Each object has the following attributes.
			@property [labels=['Years','Months','Weeks','Days','Hours','Minutes','Seconds']] {string[]}
						The display texts for the counter periods.
			@property [labels1=['Year','Month','Week','Day','Hour','Minute','Second']] {string[]}
						The display texts for the counter periods if they have a value of 1.
						Add other <code>labels<em>n</em></code> attributes as necessary to
						cater for other numeric idiosyncrasies of the localisation.
			@property [compactLabels=['y','m','w','d']] {string[]} The compact texts for the counter periods.
			@property [whichLabels=null] {whichLabelsCallback} A function to determine which
						<code>labels<em>n</em></code> to use.
			@example whichLabels: function(num) {
	return (num > 1 ? 0 : 1);
 }
			@property [digits=['0','1',...,'9']] {number[]} The digits to display (0-9).
			@property [timeSeparator=':'] {string} Separator for time periods in the compact layout.
			@property [isRTL=false] {boolean} True for right-to-left languages, false for left-to-right. */
		regionalOptions: { // Available regional settings, indexed by language/country code
			'': { // Default regional settings - English/US
				labels: ['Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds'],
				labels1: ['Year', 'Month', 'Week', 'Day', 'Hour', 'Minute', 'Second'],
				compactLabels: ['y', 'm', 'w', 'd'],
				whichLabels: null,
				digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
				timeSeparator: ':',
				isRTL: false
			}
		},
		
		/** Names of getter methods - those that can't be chained. */
		_getters: ['getTimes'],

		/* Class name for the right-to-left marker. */
		_rtlClass: pluginName + '-rtl',
		/* Class name for the countdown section marker. */
		_sectionClass: pluginName + '-section',
		/* Class name for the period amount marker. */
		_amountClass: pluginName + '-amount',
		/* Class name for the period name marker. */
		_periodClass: pluginName + '-period',
		/* Class name for the countdown row marker. */
		_rowClass: pluginName + '-row',
		/* Class name for the holding countdown marker. */
		_holdingClass: pluginName + '-holding',
		/* Class name for the showing countdown marker. */
		_showClass: pluginName + '-show',
		/* Class name for the description marker. */
		_descrClass: pluginName + '-descr',

		/* List of currently active countdown elements. */
		_timerElems: [],

		/** Additional setup for the countdown.
			Apply default localisations.
			Create the timer. */
		_init: function() {
			var self = this;
			this._super();
			this._serverSyncs = [];
			var now = (typeof Date.now == 'function' ? Date.now :
				function() { return new Date().getTime(); });
			var perfAvail = (window.performance && typeof window.performance.now == 'function');
			// Shared timer for all countdowns
			function timerCallBack(timestamp) {
				var drawStart = (timestamp < 1e12 ? // New HTML5 high resolution timer
					(perfAvail ? (performance.now() + performance.timing.navigationStart) : now()) :
					// Integer milliseconds since unix epoch
					timestamp || now());
				if (drawStart - animationStartTime >= 1000) {
							self._updateElems();
					animationStartTime = drawStart;
				}
				requestAnimationFrame(timerCallBack);
			}
			var requestAnimationFrame = window.requestAnimationFrame ||
				window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame ||
				window.oRequestAnimationFrame || window.msRequestAnimationFrame || null;
				// This is when we expect a fall-back to setInterval as it's much more fluid
			var animationStartTime = 0;
			if (!requestAnimationFrame || $.noRequestAnimationFrame) {
				$.noRequestAnimationFrame = null;
						setInterval(function() { self._updateElems(); }, 980); // Fall back to good old setInterval
			}
			else {
				animationStartTime = window.animationStartTime ||
					window.webkitAnimationStartTime || window.mozAnimationStartTime ||
					window.oAnimationStartTime || window.msAnimationStartTime || now();
				requestAnimationFrame(timerCallBack);
			}
		},
	
		/** Convert a date/time to UTC.
			@param tz {number} The hour or minute offset from GMT, e.g. +9, -360.
			@param year {Date|number} the date/time in that timezone or the year in that timezone.
			@param [month] {number} The month (0 - 11) (omit if <code>year</code> is a <code>Date</code>).
			@param [day] {number} The day (omit if <code>year</code> is a <code>Date</code>).
			@param [hours] {number} The hour (omit if <code>year</code> is a <code>Date</code>).
			@param [mins] {number} The minute (omit if <code>year</code> is a <code>Date</code>).
			@param [secs] {number} The second (omit if <code>year</code> is a <code>Date</code>).
			@param [ms] {number} The millisecond (omit if <code>year</code> is a <code>Date</code>).
			@return {Date} The equivalent UTC date/time.
			@example $.countdown.UTCDate(+10, 2013, 12-1, 25, 12, 0)
 $.countdown.UTCDate(-7, new Date(2013, 12-1, 25, 12, 0)) */
		UTCDate: function(tz, year, month, day, hours, mins, secs, ms) {
			if (typeof year == 'object' && year.constructor == Date) {
				ms = year.getMilliseconds();
				secs = year.getSeconds();
				mins = year.getMinutes();
				hours = year.getHours();
				day = year.getDate();
				month = year.getMonth();
				year = year.getFullYear();
			}
			var d = new Date();
			d.setUTCFullYear(year);
			d.setUTCDate(1);
			d.setUTCMonth(month || 0);
			d.setUTCDate(day || 1);
			d.setUTCHours(hours || 0);
			d.setUTCMinutes((mins || 0) - (Math.abs(tz) < 30 ? tz * 60 : tz));
			d.setUTCSeconds(secs || 0);
			d.setUTCMilliseconds(ms || 0);
			return d;
		},

		/** Convert a set of periods into seconds.
	   Averaged for months and years.
			@param periods {number[]} The periods per year/month/week/day/hour/minute/second.
			@return {number} The corresponding number of seconds.
			@example var secs = $.countdown.periodsToSeconds(periods) */
		periodsToSeconds: function(periods) {
			return periods[0] * 31557600 + periods[1] * 2629800 + periods[2] * 604800 +
				periods[3] * 86400 + periods[4] * 3600 + periods[5] * 60 + periods[6];
		},

		_instSettings: function(elem, options) {
			return {_periods: [0, 0, 0, 0, 0, 0, 0]};
		},

		/** Add an element to the list of active ones.
			@private
			@param elem {Element} The countdown element. */
		_addElem: function(elem) {
			if (!this._hasElem(elem)) {
				this._timerElems.push(elem);
			}
		},

		/** See if an element is in the list of active ones.
			@private
			@param elem {Element} The countdown element.
			@return {boolean} True if present, false if not. */
		_hasElem: function(elem) {
			return ($.inArray(elem, this._timerElems) > -1);
		},

		/** Remove an element from the list of active ones.
			@private
			@param elem {Element} The countdown element. */
		_removeElem: function(elem) {
			this._timerElems = $.map(this._timerElems,
				function(value) { return (value == elem ? null : value); }); // delete entry
		},

		/** Update each active timer element.
			@private */
		_updateElems: function() {
			for (var i = this._timerElems.length - 1; i >= 0; i--) {
				this._updateCountdown(this._timerElems[i]);
			}
		},

		_optionsChanged: function(elem, inst, options) {
			if (options.layout) {
				options.layout = options.layout.replace(/&lt;/g, '<').replace(/&gt;/g, '>');
			}
			this._resetExtraLabels(inst.options, options);
			var timezoneChanged = (inst.options.timezone != options.timezone);
			$.extend(inst.options, options);
			this._adjustSettings(elem, inst,
				options.until != null || options.since != null || timezoneChanged);
			var now = new Date();
			if ((inst._since && inst._since < now) || (inst._until && inst._until > now)) {
				this._addElem(elem[0]);
			}
			this._updateCountdown(elem, inst);
		},

		/** Redisplay the countdown with an updated display.
			@private
			@param elem {Element|jQuery} The containing division.
			@param inst {object} The current settings for this instance. */
		_updateCountdown: function(elem, inst) {
			elem = elem.jquery ? elem : $(elem);
			inst = inst || this._getInst(elem);
			if (!inst) {
				return;
			}
			elem.html(this._generateHTML(inst)).toggleClass(this._rtlClass, inst.options.isRTL);
			if ($.isFunction(inst.options.onTick)) {
				var periods = inst._hold != 'lap' ? inst._periods :
					this._calculatePeriods(inst, inst._show, inst.options.significant, new Date());
				if (inst.options.tickInterval == 1 ||
						this.periodsToSeconds(periods) % inst.options.tickInterval == 0) {
					inst.options.onTick.apply(elem[0], [periods]);
				}
			}
			var expired = inst._hold != 'pause' &&
				(inst._since ? inst._now.getTime() < inst._since.getTime() :
				inst._now.getTime() >= inst._until.getTime());
			if (expired && !inst._expiring) {
				inst._expiring = true;
				if (this._hasElem(elem[0]) || inst.options.alwaysExpire) {
					this._removeElem(elem[0]);
					if ($.isFunction(inst.options.onExpiry)) {
						inst.options.onExpiry.apply(elem[0], []);
					}
					if (inst.options.expiryText) {
						var layout = inst.options.layout;
						inst.options.layout = inst.options.expiryText;
						this._updateCountdown(elem[0], inst);
						inst.options.layout = layout;
					}
					if (inst.options.expiryUrl) {
						window.location = inst.options.expiryUrl;
					}
				}
				inst._expiring = false;
			}
			else if (inst._hold == 'pause') {
				this._removeElem(elem[0]);
			}
		},

		/** Reset any extra labelsn and compactLabelsn entries if changing labels.
			@private
			@param base {object} The options to be updated.
			@param options {object} The new option values. */
		_resetExtraLabels: function(base, options) {
			for (var n in options) {
				if (n.match(/[Ll]abels[02-9]|compactLabels1/)) {
					base[n] = options[n];
				}
			}
			for (var n in base) { // Remove custom numbered labels
				if (n.match(/[Ll]abels[02-9]|compactLabels1/) && typeof options[n] === 'undefined') {
					base[n] = null;
				}
			}
		},
	
		/** Calculate internal settings for an instance.
			@private
			@param elem {jQuery} The containing division.
			@param inst {object} The current settings for this instance.
			@param recalc {boolean} True if until or since are set. */
		_adjustSettings: function(elem, inst, recalc) {
		var now;
		var serverOffset = 0;
		var serverEntry = null;
		for (var i = 0; i < this._serverSyncs.length; i++) {
			if (this._serverSyncs[i][0] == inst.options.serverSync) {
				serverEntry = this._serverSyncs[i][1];
				break;
			}
		}
		if (serverEntry != null) {
			serverOffset = (inst.options.serverSync ? serverEntry : 0);
			now = new Date();
		}
		else {
			var serverResult = ($.isFunction(inst.options.serverSync) ?
					inst.options.serverSync.apply(elem[0], []) : null);
			now = new Date();
			serverOffset = (serverResult ? now.getTime() - serverResult.getTime() : 0);
			this._serverSyncs.push([inst.options.serverSync, serverOffset]);
		}
		var timezone = inst.options.timezone;
		timezone = (timezone == null ? -now.getTimezoneOffset() : timezone);
		if (recalc || (!recalc && inst._until == null && inst._since == null)) {
			inst._since = inst.options.since;
			if (inst._since != null) {
				inst._since = this.UTCDate(timezone, this._determineTime(inst._since, null));
				if (inst._since && serverOffset) {
					inst._since.setMilliseconds(inst._since.getMilliseconds() + serverOffset);
				}
			}
			inst._until = this.UTCDate(timezone, this._determineTime(inst.options.until, now));
			if (serverOffset) {
				inst._until.setMilliseconds(inst._until.getMilliseconds() + serverOffset);
			}
		}
		inst._show = this._determineShow(inst);
	},

		/** Remove the countdown widget from a div.
			@param elem {jQuery} The containing division.
			@param inst {object} The current instance object. */
		_preDestroy: function(elem, inst) {
			this._removeElem(elem[0]);
			elem.empty();
	},

		/** Pause a countdown widget at the current time.
	   Stop it running but remember and display the current time.
			@param elem {Element} The containing division.
			@example $(selector).countdown('pause') */
		pause: function(elem) {
			this._hold(elem, 'pause');
	},

		/** Pause a countdown widget at the current time.
	   Stop the display but keep the countdown running.
			@param elem {Element} The containing division.
			@example $(selector).countdown('lap') */
		lap: function(elem) {
			this._hold(elem, 'lap');
		},

		/** Resume a paused countdown widget.
			@param elem {Element} The containing division.
			@example $(selector).countdown('resume') */
		resume: function(elem) {
			this._hold(elem, null);
		},

		/** Toggle a paused countdown widget.
			@param elem {Element} The containing division.
			@example $(selector).countdown('toggle') */
		toggle: function(elem) {
			var inst = $.data(elem, this.name) || {};
			this[!inst._hold ? 'pause' : 'resume'](elem);
		},

		/** Toggle a lapped countdown widget.
			@param elem {Element} The containing division.
			@example $(selector).countdown('toggleLap') */
		toggleLap: function(elem) {
			var inst = $.data(elem, this.name) || {};
			this[!inst._hold ? 'lap' : 'resume'](elem);
		},

		/** Pause or resume a countdown widget.
			@private
			@param elem {Element} The containing division.
			@param hold {string} The new hold setting. */
		_hold: function(elem, hold) {
			var inst = $.data(elem, this.name);
		if (inst) {
			if (inst._hold == 'pause' && !hold) {
				inst._periods = inst._savePeriods;
				var sign = (inst._since ? '-' : '+');
				inst[inst._since ? '_since' : '_until'] =
					this._determineTime(sign + inst._periods[0] + 'y' +
						sign + inst._periods[1] + 'o' + sign + inst._periods[2] + 'w' +
						sign + inst._periods[3] + 'd' + sign + inst._periods[4] + 'h' + 
						sign + inst._periods[5] + 'm' + sign + inst._periods[6] + 's');
					this._addElem(elem);
			}
			inst._hold = hold;
			inst._savePeriods = (hold == 'pause' ? inst._periods : null);
				$.data(elem, this.name, inst);
				this._updateCountdown(elem, inst);
		}
	},

		/** Return the current time periods.
			@param elem {Element} The containing division.
			@return {number[]} The current periods for the countdown.
			@example var periods = $(selector).countdown('getTimes') */
		getTimes: function(elem) {
			var inst = $.data(elem, this.name);
		return (!inst ? null : (inst._hold == 'pause' ? inst._savePeriods : (!inst._hold ? inst._periods :
			this._calculatePeriods(inst, inst._show, inst.options.significant, new Date()))));
	},

		/** A time may be specified as an exact value or a relative one.
			@private
			@param setting {string|number|Date} The date/time value as a relative or absolute value.
			@param defaultTime {Date} The date/time to use if no other is supplied.
			@return {Date} The corresponding date/time. */
	_determineTime: function(setting, defaultTime) {
			var self = this;
		var offsetNumeric = function(offset) { // e.g. +300, -2
			var time = new Date();
			time.setTime(time.getTime() + offset * 1000);
			return time;
		};
		var offsetString = function(offset) { // e.g. '+2d', '-4w', '+3h +30m'
			offset = offset.toLowerCase();
			var time = new Date();
			var year = time.getFullYear();
			var month = time.getMonth();
			var day = time.getDate();
			var hour = time.getHours();
			var minute = time.getMinutes();
			var second = time.getSeconds();
			var pattern = /([+-]?[0-9]+)\s*(s|m|h|d|w|o|y)?/g;
			var matches = pattern.exec(offset);
			while (matches) {
				switch (matches[2] || 's') {
					case 's': second += parseInt(matches[1], 10); break;
					case 'm': minute += parseInt(matches[1], 10); break;
					case 'h': hour += parseInt(matches[1], 10); break;
					case 'd': day += parseInt(matches[1], 10); break;
					case 'w': day += parseInt(matches[1], 10) * 7; break;
					case 'o':
						month += parseInt(matches[1], 10); 
							day = Math.min(day, self._getDaysInMonth(year, month));
						break;
					case 'y':
						year += parseInt(matches[1], 10);
							day = Math.min(day, self._getDaysInMonth(year, month));
						break;
				}
				matches = pattern.exec(offset);
			}
			return new Date(year, month, day, hour, minute, second, 0);
		};
		var time = (setting == null ? defaultTime :
			(typeof setting == 'string' ? offsetString(setting) :
			(typeof setting == 'number' ? offsetNumeric(setting) : setting)));
		if (time) time.setMilliseconds(0);
		return time;
	},

		/** Determine the number of days in a month.
			@private
			@param year {number} The year.
			@param month {number} The month.
			@return {number} The days in that month. */
	_getDaysInMonth: function(year, month) {
		return 32 - new Date(year, month, 32).getDate();
	},

		/** Default implementation to determine which set of labels should be used for an amount.
			Use the <code>labels</code> attribute with the same numeric suffix (if it exists).
			@private
			@param num {number} The amount to be displayed.
			@return {number} The set of labels to be used for this amount. */
	_normalLabels: function(num) {
		return num;
	},

		/** Generate the HTML to display the countdown widget.
			@private
			@param inst {object} The current settings for this instance.
			@return {string} The new HTML for the countdown display. */
	_generateHTML: function(inst) {
		var self = this;
		// Determine what to show
		inst._periods = (inst._hold ? inst._periods :
			this._calculatePeriods(inst, inst._show, inst.options.significant, new Date()));
		// Show all 'asNeeded' after first non-zero value
		var shownNonZero = false;
		var showCount = 0;
		var sigCount = inst.options.significant;
		var show = $.extend({}, inst._show);
		for (var period = Y; period <= S; period++) {
			shownNonZero |= (inst._show[period] == '?' && inst._periods[period] > 0);
			show[period] = (inst._show[period] == '?' && !shownNonZero ? null : inst._show[period]);
			showCount += (show[period] ? 1 : 0);
			sigCount -= (inst._periods[period] > 0 ? 1 : 0);
		}
		var showSignificant = [false, false, false, false, false, false, false];
		for (var period = S; period >= Y; period--) { // Determine significant periods
			if (inst._show[period]) {
				if (inst._periods[period]) {
					showSignificant[period] = true;
				}
				else {
					showSignificant[period] = sigCount > 0;
					sigCount--;
				}
			}
		}
		var labels = (inst.options.compact ? inst.options.compactLabels : inst.options.labels);
		var whichLabels = inst.options.whichLabels || this._normalLabels;
		var showCompact = function(period) {
			var labelsNum = inst.options['compactLabels' + whichLabels(inst._periods[period])];
			return (show[period] ? self._translateDigits(inst, inst._periods[period]) +
				(labelsNum ? labelsNum[period] : labels[period]) + ' ' : '');
		};
		var minDigits = (inst.options.padZeroes ? 2 : 1);
		var showFull = function(period) {
			var labelsNum = inst.options['labels' + whichLabels(inst._periods[period])];
			return ((!inst.options.significant && show[period]) ||
				(inst.options.significant && showSignificant[period]) ?
					'<span class="' + self._sectionClass + '">' +
					'<span class="' + self._amountClass + '">' +
				self._minDigits(inst, inst._periods[period], minDigits) + '</span>' +
				'<span class="' + self._periodClass + '">' +
				(labelsNum ? labelsNum[period] : labels[period]) + '</span></span>' : '');
		};
		return (inst.options.layout ? this._buildLayout(inst, show, inst.options.layout,
			inst.options.compact, inst.options.significant, showSignificant) :
			((inst.options.compact ? // Compact version
			'<span class="' + this._rowClass + ' ' + this._amountClass +
			(inst._hold ? ' ' + this._holdingClass : '') + '">' + 
			showCompact(Y) + showCompact(O) + showCompact(W) + showCompact(D) + 
			(show[H] ? this._minDigits(inst, inst._periods[H], 2) : '') +
			(show[M] ? (show[H] ? inst.options.timeSeparator : '') +
			this._minDigits(inst, inst._periods[M], 2) : '') +
			(show[S] ? (show[H] || show[M] ? inst.options.timeSeparator : '') +
			this._minDigits(inst, inst._periods[S], 2) : '') :
			// Full version
			'<span class="' + this._rowClass + ' ' + this._showClass + (inst.options.significant || showCount) +
			(inst._hold ? ' ' + this._holdingClass : '') + '">' +
			showFull(Y) + showFull(O) + showFull(W) + showFull(D) +
			showFull(H) + showFull(M) + showFull(S)) + '</span>' +
			(inst.options.description ? '<span class="' + this._rowClass + ' ' + this._descrClass + '">' +
			inst.options.description + '</span>' : '')));
	},

		/** Construct a custom layout.
			@private
			@param inst {object} The current settings for this instance.
			@param show {boolean[]} Flags indicating which periods are requested.
			@param layout {string} The customised layout.
			@param compact {boolean} True if using compact labels.
			@param significant {number} The number of periods with values to show, zero for all.
			@param showSignificant {boolean[]} Other periods to show for significance.
			@return {string} The custom HTML. */
	_buildLayout: function(inst, show, layout, compact, significant, showSignificant) {
		var labels = inst.options[compact ? 'compactLabels' : 'labels'];
		var whichLabels = inst.options.whichLabels || this._normalLabels;
		var labelFor = function(index) {
			return (inst.options[(compact ? 'compactLabels' : 'labels') +
				whichLabels(inst._periods[index])] || labels)[index];
		};
		var digit = function(value, position) {
			return inst.options.digits[Math.floor(value / position) % 10];
		};
		var subs = {desc: inst.options.description, sep: inst.options.timeSeparator,
			yl: labelFor(Y), yn: this._minDigits(inst, inst._periods[Y], 1),
			ynn: this._minDigits(inst, inst._periods[Y], 2),
			ynnn: this._minDigits(inst, inst._periods[Y], 3), y1: digit(inst._periods[Y], 1),
			y10: digit(inst._periods[Y], 10), y100: digit(inst._periods[Y], 100),
			y1000: digit(inst._periods[Y], 1000),
			ol: labelFor(O), on: this._minDigits(inst, inst._periods[O], 1),
			onn: this._minDigits(inst, inst._periods[O], 2),
			onnn: this._minDigits(inst, inst._periods[O], 3), o1: digit(inst._periods[O], 1),
			o10: digit(inst._periods[O], 10), o100: digit(inst._periods[O], 100),
			o1000: digit(inst._periods[O], 1000),
			wl: labelFor(W), wn: this._minDigits(inst, inst._periods[W], 1),
			wnn: this._minDigits(inst, inst._periods[W], 2),
			wnnn: this._minDigits(inst, inst._periods[W], 3), w1: digit(inst._periods[W], 1),
			w10: digit(inst._periods[W], 10), w100: digit(inst._periods[W], 100),
			w1000: digit(inst._periods[W], 1000),
			dl: labelFor(D), dn: this._minDigits(inst, inst._periods[D], 1),
			dnn: this._minDigits(inst, inst._periods[D], 2),
			dnnn: this._minDigits(inst, inst._periods[D], 3), d1: digit(inst._periods[D], 1),
			d10: digit(inst._periods[D], 10), d100: digit(inst._periods[D], 100),
			d1000: digit(inst._periods[D], 1000),
			hl: labelFor(H), hn: this._minDigits(inst, inst._periods[H], 1),
			hnn: this._minDigits(inst, inst._periods[H], 2),
			hnnn: this._minDigits(inst, inst._periods[H], 3), h1: digit(inst._periods[H], 1),
			h10: digit(inst._periods[H], 10), h100: digit(inst._periods[H], 100),
			h1000: digit(inst._periods[H], 1000),
			ml: labelFor(M), mn: this._minDigits(inst, inst._periods[M], 1),
			mnn: this._minDigits(inst, inst._periods[M], 2),
			mnnn: this._minDigits(inst, inst._periods[M], 3), m1: digit(inst._periods[M], 1),
			m10: digit(inst._periods[M], 10), m100: digit(inst._periods[M], 100),
			m1000: digit(inst._periods[M], 1000),
			sl: labelFor(S), sn: this._minDigits(inst, inst._periods[S], 1),
			snn: this._minDigits(inst, inst._periods[S], 2),
			snnn: this._minDigits(inst, inst._periods[S], 3), s1: digit(inst._periods[S], 1),
			s10: digit(inst._periods[S], 10), s100: digit(inst._periods[S], 100),
			s1000: digit(inst._periods[S], 1000)};
		var html = layout;
		// Replace period containers: {p<}...{p>}
		for (var i = Y; i <= S; i++) {
			var period = 'yowdhms'.charAt(i);
			var re = new RegExp('\\{' + period + '<\\}([\\s\\S]*)\\{' + period + '>\\}', 'g');
			html = html.replace(re, ((!significant && show[i]) ||
				(significant && showSignificant[i]) ? '$1' : ''));
		}
		// Replace period values: {pn}
		$.each(subs, function(n, v) {
			var re = new RegExp('\\{' + n + '\\}', 'g');
			html = html.replace(re, v);
		});
		return html;
	},

		/** Ensure a numeric value has at least n digits for display.
			@private
			@param inst {object} The current settings for this instance.
			@param value {number} The value to display.
			@param len {number} The minimum length.
			@return {string} The display text. */
	_minDigits: function(inst, value, len) {
		value = '' + value;
		if (value.length >= len) {
			return this._translateDigits(inst, value);
		}
		value = '0000000000' + value;
		return this._translateDigits(inst, value.substr(value.length - len));
	},

		/** Translate digits into other representations.
			@private
			@param inst {object} The current settings for this instance.
			@param value {string} The text to translate.
			@return {string} The translated text. */
	_translateDigits: function(inst, value) {
		return ('' + value).replace(/[0-9]/g, function(digit) {
				return inst.options.digits[digit];
			});
	},

		/** Translate the format into flags for each period.
			@private
			@param inst {object} The current settings for this instance.
			@return {string[]} Flags indicating which periods are requested (?) or
					required (!) by year, month, week, day, hour, minute, second. */
	_determineShow: function(inst) {
		var format = inst.options.format;
		var show = [];
		show[Y] = (format.match('y') ? '?' : (format.match('Y') ? '!' : null));
		show[O] = (format.match('o') ? '?' : (format.match('O') ? '!' : null));
		show[W] = (format.match('w') ? '?' : (format.match('W') ? '!' : null));
		show[D] = (format.match('d') ? '?' : (format.match('D') ? '!' : null));
		show[H] = (format.match('h') ? '?' : (format.match('H') ? '!' : null));
		show[M] = (format.match('m') ? '?' : (format.match('M') ? '!' : null));
		show[S] = (format.match('s') ? '?' : (format.match('S') ? '!' : null));
		return show;
	},
	
		/** Calculate the requested periods between now and the target time.
			@private
			@param inst {object} The current settings for this instance.
			@param show {string[]} Flags indicating which periods are requested/required.
			@param significant {number} The number of periods with values to show, zero for all.
			@param now {Date} The current date and time.
			@return {number[]} The current time periods (always positive)
					by year, month, week, day, hour, minute, second. */
	_calculatePeriods: function(inst, show, significant, now) {
		// Find endpoints
		inst._now = now;
		inst._now.setMilliseconds(0);
		var until = new Date(inst._now.getTime());
		if (inst._since) {
			if (now.getTime() < inst._since.getTime()) {
				inst._now = now = until;
			}
			else {
				now = inst._since;
			}
		}
		else {
			until.setTime(inst._until.getTime());
			if (now.getTime() > inst._until.getTime()) {
				inst._now = now = until;
			}
		}
		// Calculate differences by period
		var periods = [0, 0, 0, 0, 0, 0, 0];
		if (show[Y] || show[O]) {
			// Treat end of months as the same
				var lastNow = this._getDaysInMonth(now.getFullYear(), now.getMonth());
				var lastUntil = this._getDaysInMonth(until.getFullYear(), until.getMonth());
			var sameDay = (until.getDate() == now.getDate() ||
				(until.getDate() >= Math.min(lastNow, lastUntil) &&
				now.getDate() >= Math.min(lastNow, lastUntil)));
			var getSecs = function(date) {
				return (date.getHours() * 60 + date.getMinutes()) * 60 + date.getSeconds();
			};
			var months = Math.max(0,
				(until.getFullYear() - now.getFullYear()) * 12 + until.getMonth() - now.getMonth() +
				((until.getDate() < now.getDate() && !sameDay) ||
				(sameDay && getSecs(until) < getSecs(now)) ? -1 : 0));
			periods[Y] = (show[Y] ? Math.floor(months / 12) : 0);
			periods[O] = (show[O] ? months - periods[Y] * 12 : 0);
			// Adjust for months difference and end of month if necessary
			now = new Date(now.getTime());
			var wasLastDay = (now.getDate() == lastNow);
				var lastDay = this._getDaysInMonth(now.getFullYear() + periods[Y],
				now.getMonth() + periods[O]);
			if (now.getDate() > lastDay) {
				now.setDate(lastDay);
			}
			now.setFullYear(now.getFullYear() + periods[Y]);
			now.setMonth(now.getMonth() + periods[O]);
			if (wasLastDay) {
				now.setDate(lastDay);
			}
		}
		var diff = Math.floor((until.getTime() - now.getTime()) / 1000);
		var extractPeriod = function(period, numSecs) {
			periods[period] = (show[period] ? Math.floor(diff / numSecs) : 0);
			diff -= periods[period] * numSecs;
		};
		extractPeriod(W, 604800);
		extractPeriod(D, 86400);
		extractPeriod(H, 3600);
		extractPeriod(M, 60);
		extractPeriod(S, 1);
		if (diff > 0 && !inst._since) { // Round up if left overs
			var multiplier = [1, 12, 4.3482, 7, 24, 60, 60];
			var lastShown = S;
			var max = 1;
			for (var period = S; period >= Y; period--) {
				if (show[period]) {
					if (periods[lastShown] >= max) {
						periods[lastShown] = 0;
						diff = 1;
					}
					if (diff > 0) {
						periods[period]++;
						diff = 0;
						lastShown = period;
						max = 1;
					}
				}
				max *= multiplier[period];
			}
		}
		if (significant) { // Zero out insignificant periods
			for (var period = Y; period <= S; period++) {
				if (significant && periods[period]) {
					significant--;
				}
				else if (!significant) {
					periods[period] = 0;
				}
			}
		}
		return periods;
	}
	});

})(jQuery);


