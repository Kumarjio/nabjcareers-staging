<?php

class SJB_ObjectMother
{
	public static function createListingSearcher()
	{
		require_once("classifieds/Listing/ListingSearcher.php");
		return new SJB_ListingSearcher();
	}
	
	/**
	 * @return SJB_ListingCriteriaSaver
	 */
	public static function createListingCriteriaSaver()
	{
		require_once("classifieds/Listing/ListingCriteriaSaver.php");
		return new SJB_ListingCriteriaSaver();
	}
	
	/**
	 * 
	 * @param $user_info
	 * @param $user_group_sid
	 * @return SJB_User
	 */
	public static function createUser($user_info = array(), $user_group_sid = 0)
	{
		require_once("users/User/User.php");
		return new SJB_User($user_info, $user_group_sid);
	}

	/**
	 * create object of SJB_SubAdmin class
	 * 
	 * @param array $adminInfo
	 * @return SJB_SubAdmin
	 */
	public static function createSubAdmin( $adminInfo )
	{
		require_once ('sub_admins/SubAdmin.php');
		return new SJB_SubAdminProp($adminInfo);
	}
	
	/**
	 * 
	 * @param unknown_type $object
	 * @return SJB_Form
	 */
	public static function createForm($object = null)
	{
		require_once("forms/Form.php");
		return new SJB_Form($object);
	}
	
	/**
	 * Create listing object
	 *
	 * @param array $listing_info
	 * @param int $listing_type_sid
	 * @return Listing
	 */
	public static function createListing($listing_info = array(), $listing_type_sid = 0)
	{
		require_once('classifieds/Listing/Listing.php');
		return new SJB_Listing($listing_info, $listing_type_sid);
	}
	
	public static function createListingGallery()
	{
		require_once("classifieds/ListingGallery/ListingGallery.php");
		return new SJB_ListingGallery();
	}
	
	public static function createParamProvider($schema)
	{
		require_once("classifieds/Browse/UrlParamProvider.php");
		return new SJB_UrlParamProvider($schema);
	}
	
	public static function createCategorySearcherFactory()
	{
		require_once("classifieds/Browse/CategorySearcherFactory.php");
		return new SJB_CategorySearcherFactory();
	}
	
	public static function create_CategorySearcher_Tree($field)
	{
		require_once("classifieds/Browse/CategorySearcher_Tree.php");
		return new SJB_CategorySearcher_Tree($field);
	}
	
	public static function create_CategorySearcher_Value($field)
	{
		require_once("classifieds/Browse/CategorySearcher_Value.php");
		return new SJB_CategorySearcher_Value($field);
	}
	
	public static function create_CategorySearcher_List($field)
	{
		require_once("classifieds/Browse/CategorySearcher_List.php");
		return new SJB_CategorySearcher_List($field);
	}
	
	public static function create_CategorySearcher_Multilist($field)
	{
		require_once("classifieds/Browse/CategorySearcher_Multilist.php");
		return new SJB_CategorySearcher_MultiList($field);
	}
	
	public static function createBrowseManager($listing_type_id)
	{
		require_once("classifieds/Browse/BrowseManager.php");
		return new SJB_BrowseManager($listing_type_id);
	}
	
	public static function createListingFieldListItemManager()
	{
		require_once("classifieds/Browse/AbstractCategorySearcher.php");
		return new SJB_ListingFieldListItemManager();
	}
	
	public static function createContactForm()
	{
		require_once("miscellaneous/ContactForm.php");
		return new SJB_ContactForm();
	}
	
	public static function createTemplateEditor()
	{
		require_once("template_manager/TemplateEditor.php");
		return new SJB_TemplateEditor();
	}
	
	/**
	 * @return I18N
	 */
	public static function createI18N()
	{
		return SJB_I18N::getInstance();
	}	
	
	public static function getMetaDataProvider()
	{
		require_once("classifieds/MetaDataProvider.php");
		return new SJB_MetaDataProvider();
	}	
	
	public static function createFileSystem()
	{
		return new SJB_FileSystem();
	}

	public static function createHTMLTagConverterInArray()
	{
		if (empty($GLOBALS['ObjectMother_instances_HtmlTagConverterInArray'])) {
			require_once('miscellaneous/StructureExplorer.php');
			$explorer = new SJB_StructureExplorer();
			$htmlTagConverter = SJB_ObjectMother::createHTMLTagConverter();
			$explorer->addFilter('gettype($value) === "string"');
			$explorer->addFilter('strrpos($value, ">" ) !== false || strrpos($value, "\"" ) !== false');
			$explorer->addFilter('strpos($value, "JFIF" ) === false');
			$explorer->setEventHandler(array($htmlTagConverter, 'getConverted'));
			$GLOBALS['ObjectMother_instances_HtmlTagConverterInArray'] = $explorer;
		}
		return $GLOBALS['ObjectMother_instances_HtmlTagConverterInArray'];
	}

	public static function createHTMLTagConverter()
	{
		if (empty($GLOBALS['ObjectMother_instances_HtmlTagConverter'])) {
			if (SJB_Settings::getSettingByName('escape_html_tags') === 'htmlentities') {
				require_once('miscellaneous/HTMLTagConverter.php');
				$GLOBALS['ObjectMother_instances_HtmlTagConverter'] = new SJB_HTMLTagConverter();
			}
			else {
				require_once('miscellaneous/NullConverter.php');
				$GLOBALS['ObjectMother_instances_HtmlTagConverter'] = new SJB_NullConverter();
			}
		}
		return $GLOBALS['ObjectMother_instances_HtmlTagConverter'];
	}
}
