<?php 

/*

/**
 * --------------------------------------------------------------------------
 * API
 * --------------------------------------------------------------------------
 * 
 *  # Docs 
 * http://gw.api.alibaba.com/dev/doc/intl/sys_description.htm?ns=aliexpress.open
 * 
 * 
 *  # Limitations
 * JSON Custom Search API provides 100 search queries per day for free. If you need more, you may sign up for billing in the API Console. Additional requests cost $5 per 1000 queries, up to 10k queries per day. 
 * 
 * 
 *  # Sample query
 * 
 */


/**
 * --------------------------------------------------------------------------
 * Scrap
 * --------------------------------------------------------------------------
 * 
 *  # category :
 *  https://www.aliexpress.com/wholesale?catId=70803001&initiative_id=AS_20180625101631&SearchText=router
 * 
 * category_id = 70803001
 * the category page show orders for each item which can be sorted by the amount
 * 
 *  # item
 * https://www.aliexpress.com/item/Tenda-AC7-wireless-wifi-Routers-11AC-2-4Ghz-5-0Ghz-Wi-fi-Repeater-1-WAN-3/32855112539.html?spm=2114.search0104.3.7.28a9120d7thHXR&ws_ab_test=searchweb0_0,searchweb201602_3_10152_10151_10065_10344_10068_10342_10343_5722611_10340_10341_10696_5722911_5722811_5722711_10084_10083_10618_10307_10059_306_100031_10103_10624_10623_10622_10621_10620_5722511-306,searchweb201603_25,ppcSwitch_7&algo_expid=d0522a44-8008-4ca7-9bf9-3da3756c7381-0&algo_pvid=d0522a44-8008-4ca7-9bf9-3da3756c7381&priceBeautifyAB=0
 * the item id is the cached html file 32855112539.html 
 * 
 *  # item transactions 
 * 
 * selectr in item page : #j-transaction-feedback.transaction-feedback-main
 * 
 *  # find in google 
 * site:aliexpress.com: 32855112539 // << the space before value is needed
 */


/**
 * --------------------------------------------------------------------------
 *  TODO:
 * --------------------------------------------------------------------------
 *
 * TODO: check items uploads dates to count orders per date
 * 
 */





