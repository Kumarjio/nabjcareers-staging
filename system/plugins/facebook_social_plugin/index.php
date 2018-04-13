<?php

require_once 'facebook_social_plugin.php';

SJB_SocialPlugin::loadPlugin('facebook', new FacebookSocialPlugin());

//FacebookSocialPlugin::init();


SJB_Event::handle('DisplayContent', array('FacebookSocialPlugin', 'displayContent'));
SJB_Event::handle('DisplayContentInviteForm', array('SJB_SocialPlugin', 'displayContentInviteFriends'));

/*
 * login/logout
 */
SJB_Event::handle('Login_Plugin', array('SJB_SocialPlugin', 'login'));
SJB_Event::handle('Logout', array('SJB_SocialPlugin', 'logout'), 1000);

/*
 * registration
 */
SJB_Event::handle('FillRegistrationDataRequest_Plugin', array('FacebookSocialPlugin', 'fillRegistrationDataWithRequest'));
//SJB_Event::handle('FillRegistrationData_Plugin', array('SJB_SocialPlugin', 'fillObjectOutSocialData'));
SJB_Event::handle('FillRegistrationData_Plugin', array('SJB_SocialPlugin', 'fillRegistrationDataWithUser'));
SJB_Event::handle('PrepareRegistrationFields_SocialPlugin', array('FacebookSocialPlugin', 'prepareRegistrationFields'));
SJB_Event::handle('MakeRegistrationFieldsNotRequired_SocialPlugin', array('FacebookSocialPlugin', 'makeRegistrationFieldsNotRequired'));
SJB_Event::handle('AddReferencePluginDetails', array('SJB_SocialPlugin', 'addReferenceDetails'));
SJB_Event::handle('SendUserSocialRegistrationLetter_SocialPlugin', array('SJB_SocialPlugin', 'sendUserSocialRegistrationLetter'));
SJB_Event::handle('SocialPlugin_PostRegistrationActions', array('SJB_SocialPlugin', 'postRegistrationActions'));



/*
 * CREATE LISTING
 */
SJB_Event::handle('SocialPlugin_CreateListing', array('SJB_SocialPlugin', 'createListing'));
SJB_Event::handle('SocialPlugin_AddListingFieldsIntoRegistration', array('FacebookSocialPlugin', 'addListingFieldsIntoRegistration'));

//SJB_Event::handle();
//SJB_Event::handle('Login', array('WordPressBridgePlugin', 'login'));
//SJB_Event::handle('Logout', array('WordPressBridgePlugin', 'logout'));
//SJB_Event::handle('DisplayBlogContent', array('WordPressBridgePlugin', 'displayBlogContent'));


/*
 * LISTING AUTOFILL SYNCHRONIZATION
 */
SJB_Event::handle('SocialSynchronization', array('SJB_SocialPlugin', 'autofillListing'));
SJB_Event::handle('SocialSynchronizationForm', array('SJB_SocialPlugin', 'autofillListingForm'));
SJB_Event::handle('SocialSynchronizationFields', array('SJB_SocialPlugin', 'autofillListingFields'));
SJB_Event::handle('SocialSynchronizationFieldsOnPostingPages', array('SJB_SocialPlugin', 'autofillListingFieldsOnPostingPages'));