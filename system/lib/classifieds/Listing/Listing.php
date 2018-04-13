<?php

require_once 'orm/Object.php';
require_once 'classifieds/Listing/ListingDetails.php';

class SJB_Listing extends SJB_Object
{
	var $listing_type_sid 	  = 0;
	var $listing_package_info = null;
	var $user_sid;	
	var $active;	
	var $featured;

	// ----------------------- ELDAR --------------------------
	var $priority;
	// ----------------------- end ELDAR --------------------------
	
	var $activation_date;
	var $number_of_views;
	
	/**
	 * JobReference - Special JobG8 integration field
	 *
	 * @var string
	 */
	public $job_reference;
	
	/**
	 * 
	 * @var SJB_ListingDetails
	 */
	public $details = null;
	
	function SJB_Listing($listing_info = array(), $listing_type_sid = 0, $pageID = 0)
	{
		$this->setListingTypeSID($listing_type_sid);
		$this->db_table_name = 'listings';
		
		$this->details = new SJB_ListingDetails($listing_info, $this->listing_type_sid, $pageID);
		
		$this->active   = isset($listing_info['active'])   ? $listing_info['active']   : false;
		$this->user_sid = isset($listing_info['user_sid']) ? $listing_info['user_sid'] : 0;
		$this->featured = isset($listing_info['featured']) ? $listing_info['featured'] : false;
		
		// ----------------------- mods --------------------------
		$this->priority = isset($listing_info['priority']) ? $listing_info['priority'] : false;
		/* 11-09-2016 */
		$this->deleted   = isset($listing_info['deleted'])   ? $listing_info['deleted']   : false;		
		// ----------------------- end --------------------------
		
		
		$this->activation_date = isset($listing_info['activation_date']) ? $listing_info['activation_date'] : null;
		$this->number_of_views = isset($listing_info['views']) ? $listing_info['views'] : null;
		
		// fill special jobg8 integration field if needed
		$this->job_reference	= isset($listing_info['JobReference'])	? $listing_info['JobReference'] : null;
		$this->data_source		= isset($listing_info['data_source'])	? $listing_info['data_source']	: null;
		
	}
	
	function getActivationDate()
	{
		return $this->activation_date;
	}
	
	function getNumberOfViews()
	{
		return $this->number_of_views;
	}
	
	function setListingTypeSID($listing_type_sid)
	{
		$this->listing_type_sid = $listing_type_sid;
	}
	
	function getListingTypeSID()
	{
		return $this->listing_type_sid;
	}
	
	function setUserSID($user_sid)
	{
		$this->user_sid = $user_sid;
	}
	
	function getUserSID()
	{
		return $this->user_sid;
	}
	
	function setListingPackageInfo($listing_package_info)
	{
		$this->listing_package_info = $listing_package_info;
	}
	
	function getListingPackageInfo()
	{
		return $this->listing_package_info;
	}
	
	/**
	 * Set special JobG8 integration field value
	 *
	 * @param string $job_reference
	 */
	public function setJobReference($job_reference)
	{
		$this->job_reference = $job_reference;
	}
	
	/**
	 * Get special JobG8 integration field value
	 *
	 * @return string
	 */
	public function getJobReference()
	{
		return $this->job_reference;
	}
	
	function isActive()
	{
		return $this->active;
	}

	/* 11-09-2016 Deleted mod */
	function isDeleted()
	{
		return $this->deleted;
	}
	/* 11-09-2016 End of Deleted mod */
	
	
	
	function getKeywords()
	{
		$properties = $this->details->getProperties();
		$keywords = '';
		foreach ($properties as $property) {
			$keywords .= $property->getKeywordValue() . ' ';
		}

		$keywords = trim(preg_replace("/\s+/u", ' ', $keywords));

		return $keywords;
	}

	function addActiveProperty($active = null)
	{
		if (empty($active))
			$active = $this->isActive();
		return $this->details->addActiveProperty($active);
	}

	function addUsernameProperty($username = null)		{ return $this->details->addUsernameProperty($username); }
	function addCompanyNameProperty($CompanyName = null){ return $this->details->addCompanyNameProperty($CompanyName); }
	function addIDProperty($id = null)					{ return $this->details->addIDProperty($id); }
	function addListingTypeIDProperty($type_id = null)	{ return $this->details->addListingTypeIDProperty($type_id); }
	function addKeywordsProperty($keywords = null)		{ return $this->details->addKeywordsProperty($keywords); }
	function addPicturesProperty()						{ return $this->details->addPicturesProperty(); }
	function addEmailFrequencyProperty()				{ return $this->details->addEmailFrequencyProperty(); }
	function addRejectReasonProperty()					{ return $this->details->addRejectReasonProperty(); }
	function addPostedWithinProperty()					{ return $this->details->addPostedWithinProperty(); }
    function addActivationDateProperty($activation_date = null)	{ return $this->details->addActivationDateProperty($activation_date); }
	function addExpirationDateProperty($expiration_date = null)	{ return $this->details->addExpirationDateProperty($expiration_date); }
	function addNumberOfViewsProperty($number_of_views = null) { return $this->details->addNumberOfViewsProperty($number_of_views); }
	function addApplicationsProperty($apps = null) 		{ return $this->details->addApplicationsProperty($apps); }
	function addSubuserProperty($sid = 0)				{ return $this->details->addSubuserProperty($sid); }
	function addDataSourceProperty($listing_feed_sid = 0){ return $this->details->addDataSourceProperty($listing_feed_sid); }
	function addExternalIdproperty($ext_id = 0)			{ return $this->details->addExternalIdproperty($ext_id); }
	function addCompleteProperty()						{ return $this->details->addCompleteProperty(); }
	
	function isFeatured()
	{
		return $this->featured;
	}
	
	// ---------------------------- ELDAR ---------------------------------
	function isPriority()
	{
		return $this->priority;
	}
	// ----------------------------  end ELDAR ---------------------------------

	
	function isPropertySetOnAllListings($listings, $sorting_field)
	{
		foreach ($listings as $key => $val){
			$listing = &$listings[$key];
			$isPropertySet = $listing->propertyIsSet($sorting_field);
			if (!$isPropertySet)
				return false;
		}
		return true;
	}
	
	function getPropertyList()
	{
		$result = array();
		$property_list = array_keys($this->getProperties());
		
		foreach ($property_list as $property_name) {
			$result[$property_name] = $property_name;
		}
		return $result;
	}
}
