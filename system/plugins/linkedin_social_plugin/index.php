<?php

require_once 'linkedin_social_plugin.php';




SJB_SocialPlugin::loadPlugin('linkedin', new LinkedinSocialPlugin());

//LinkedinSocialPlugin::init();

SJB_Event::handle('DisplayContent', array('LinkedinSocialPlugin', 'displayContent'));
SJB_Event::handle('DisplayContentInviteForm', array('LinkedinSocialPlugin', 'displayContentInviteFriends'));

SJB_Event::handle('Login_Plugin', array('SJB_SocialPlugin', 'login'));
SJB_Event::handle('Logout', array('SJB_SocialPlugin', 'logout'), 1000);

/*
 * REGISTRATION
 */
SJB_Event::handle('FillRequestOutSocialData', array('SJB_SocialPlugin', 'fillRequestOutSocialData'));
SJB_Event::handle('FillObjectOutSocialData', array('LinkedinSocialPlugin', 'fillSocialDataWithRequest'));
SJB_Event::handle('FillRegistrationData_Plugin', array('SJB_SocialPlugin', 'fillRegistrationDataWithUser'));
SJB_Event::handle('PrepareRegistrationFields_SocialPlugin', array('SJB_SocialPlugin', 'prepareRegistrationFields'));
SJB_Event::handle('MakeRegistrationFieldsNotRequired_SocialPlugin', array('LinkedinSocialPlugin', 'makeRegistrationFieldsNotRequired'));
SJB_Event::handle('SendUserSocialRegistrationLetter_SocialPlugin', array('SJB_SocialPlugin', 'sendUserSocialRegistrationLetter'));

/*
 * CREATE LISTING
 */
SJB_Event::handle('SocialPlugin_CreateListing', array('SJB_SocialPlugin', 'createListing'));
SJB_Event::handle('SocialPlugin_AddListingFieldsIntoRegistration', array('SJB_SocialPlugin', 'addListingFieldsIntoRegistration'));


SJB_Event::handle('AddReferencePluginDetails', array('SJB_SocialPlugin', 'addReferenceDetails'));

/*
 * LISTING AUTOFILL SYNCHRONIZATION
 */
SJB_Event::handle('SocialSynchronization', array('SJB_SocialPlugin', 'autofillListing'));
SJB_Event::handle('SocialSynchronizationForm', array('SJB_SocialPlugin', 'autofillListingForm'));
SJB_Event::handle('SocialSynchronizationFields', array('SJB_SocialPlugin', 'autofillListingFields'));
SJB_Event::handle('SocialSynchronizationFieldsOnPostingPages', array('SJB_SocialPlugin', 'autofillListingFieldsOnPostingPages'));