(function ($) {
	"use strict";

	
	// $(document).ready(function(){
		
	// 	if($(".selectric span:contains(Everyone)")) {
	// 		$('body #item-body > form > div:nth-child(1) > div > label:nth-child(1) > input[type="radio"]').prop("checked", true);
			
	// 	} 
	// });
	
	
		
		// if($('.selectric-hide-select select option:selected').val("self")) {
		// 	$(".bppv-visibility-settings-block .radio label:nth-last-child(1) input").prop("checked", true);
		// 	} 

		// 	if($('.selectric-hide-select select option:selected').val("public")) {
		// 		$(".bppv-visibility-settings-block .radio label:nth-child(1) input").prop("checked", true);
		// 		} 
		
	/********
	***
	*** Members page "view details" toggle 
	***
	********/
	$('#member-info .sub-info').hide(); //Hide children by default
	
	$('#member-info strong').click(function(event){
		if ($(this).next('.sub-info').children().length !== 0) {     
			event.preventDefault();
		}
		$(this).siblings('.sub-info').slideToggle('slow');
	});	

	$('.right_side .sub-info').hide(); //Hide children by default

	$('.right_side strong').click(function(event){
		if ($(this).next('.sub-info').children().length !== 0) {     
			event.preventDefault();
		}
		$(this).siblings('.sub-info').slideToggle('slow');
	});	
	


	

	/********
	***
	*** Members Page Affiliates member info
	***
	********/
	$(".field_298 .data ").ready(function(){
		
		$("tr.field_298 .data a:contains(10 Energy)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_298 .data a:contains(15 Materials)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_298 .data a:contains(20 Industrials)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_298 .data a:contains(25 Consumer Discretionary)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_298 .data a:contains(30 Consumer Staples)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_298 .data a:contains(35 Health Care)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_298 .data a:contains(40 Financials)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_298 .data a:contains(45 Information Technology)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_298 .data a:contains(50 Communication Services)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_298 .data a:contains(55 Utilities)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_298 .data a:contains(60 Real Estate)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
	});

	$(".field_79 .data ").ready(function(){
	    $("tr.field_79 .data a:contains(All Other)").css({'display': 'none'});
	    
		$("tr.field_79 .data a:contains(Mergers & Acquisitions)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_79 .data a:contains(Fairness Opinions)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_79 .data a:contains(Private Placements)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("tr.field_79 .data a:contains(Public Markets)").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});
		$("#item-body > div.profile > div.bp-widget.product-expertise > table > tbody > tr.field_2157.field_all-other.optional-field.visibility-public.alt.field_type_textbox > td.data > a").css({'margin-left': '0', 'font-weight': '600', 'font-size': '17px', 'display':'block'});

		$("tr.field_79 .data a:contains(Taxable)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Tax-Exempt)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		
		$("tr.field_79 .data a:contains(PE Funds)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Venture Capital Funds)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Hedge Funds)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(BDCs)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(REITs)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});

		
		$("tr.field_79 .data a:contains(Tax Exempt)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Product Expertise)").css({'display': 'none', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Mortgage)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Mortgage Backed)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Asset-Backed)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("#item-body > div.profile > div.bp-widget.product-expertise > table > tbody > tr > td.data > p > a:nth-child(14):contains(Other)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});

		$("#item-body > div.profile > div.bp-widget.product-expertise > table > tbody > tr > td.data > p > a:nth-child(21):contains(Other)").css({'margin-left': '40px', 'font-weight': '400', 'font-size': '17px'});

		$("tr.field_79 .data a:contains(Equity Syndicate)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(IPO)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Convertible Securities)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Follow-on)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});

		$("tr.field_79 .data a:contains(PIPEs)").css({'margin-left': '80px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Registered Directs)").css({'margin-left': '80px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Agented)").css({'margin-left': '80px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Underwritten)").css({'margin-left': '80px', 'font-weight': '300', 'font-size': '16px'});

		$("tr.field_79 .data a:contains(Investment Grade)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(High Yield)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Commercial Paper)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Medium Term Notes)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Preferred)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Stock and Sr.)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Retail Preferred)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
		$("tr.field_79 .data a:contains(Baby Bonds)").css({'margin-left': '60px', 'font-weight': '300', 'font-size': '16px'});
	});

	/********
	***
	*** Members Page Affiliates member info
	***
	********/
	$(".product-expertise").ready(function(){
		
		if($('ul.product-expertise li').is('ul.product-expertise li.mergersampacquisitions, ul.product-expertise li.fairnessopinions, ul.product-expertise li.privateplacements, ul.product-expertise li.publicmarkets, ul.product-expertise li.allother') ) {

			// Second Level
			$('ul.product-expertise li').css({'margin-left': '20px', 'font-weight': '400', 'font-size': '17px'});
			$('ul.product-expertise li.mergersampacquisitions').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.product-expertise li.fairnessopinions').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.product-expertise li.privateplacements').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.product-expertise li.publicmarkets').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.product-expertise li.2157').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.product-expertise li.allother').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.product-expertise li.m00').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			
			// Third Level
			if($('.product-expertise li').is('.product-expertise li.debt')) {
				$('.product-expertise li.taxexempt, .product-expertise li.taxable, .product-expertise li.mortgage, .product-expertise li.mortgagebacked, .product-expertise li.assetbacked, #member-info > div > div:nth-child(6) > div > div > ul > li:nth-child(14)').css({'margin-left': '40px', 'font-weight': 'normal', 'font-size': '16px'});
			}

			if($('.product-expertise li').is('.product-expertise li.equity')) {
				$('.product-expertise li.stockandsr, .product-expertise li.preferred, .product-expertise li.convertiblesecurities').css({'margin-left': '40px', 'font-weight': 'normal', 'font-size': '16px'});
			}

			if($('.product-expertise li').is('.product-expertise li.funds')) {
				$('.product-expertise li.pefunds, .product-expertise li.venturecapitalfunds, .product-expertise li.hedgefunds, .product-expertise li.bdcs, .product-expertise li.reits').css({'margin-left': '40px', 'font-weight': 'normal', 'font-size': '16px'});
			}

			if($('.product-expertise li').is('.product-expertise li.ecmequitycapitalmarkets')) {
				$('.product-expertise li.ipo, .product-expertise li.convertiblesecurities, .product-expertise li.followon, .product-expertise li.equitysyndicate').css({'margin-left': '40px', 'font-weight': 'normal', 'font-size': '16px'});
			}

			if($('.product-expertise li').is('.product-expertise li.portuguesearabic')) {
				$('.product-expertise li.portuguesearabic').css({'margin-left': '0px', 'font-weight': 'normal', 'font-size': '16px', 'list-style-type': 'none'});
			}

			if($('.product-expertise li').is('.product-expertise li.dcmdebtcapitalmarkets')) {
				$('#member-info > div > div:nth-child(6) > div > div > ul > li.taxexempt, .product-expertise li.babybonds, .product-expertise li.retailpreferred, .product-expertise li.preferred, .product-expertise li.mediumtermnotes, .product-expertise li.commercialpaper, .product-expertise li.mortgagebacked, .product-expertise li.assetbacked, .product-expertise li.highyield, .product-expertise li.investmentgrade,.product-expertise li.initialcoinofferingsampblockchainamptokens').css({'margin-left': '40px', 'font-weight': 'normal', 'font-size': '16px'});
			}
			
			if($('.product-expertise li')) {
				$('.initialcoinofferingsampblockchainamptokens').css({'margin-left': '20px', 'font-weight': 'normal', 'font-size': '16px'});
			}

			// Fourth Level
			if($('.product-expertise li').is('.product-expertise li.ecmequitycapitalmarkets')) {
				$('.product-expertise li.registereddirects, .product-expertise li.agented, .product-expertise li.pipes, .product-expertise li.underwritten').css({'margin-left': '60px', 'font-weight': 'normal', 'font-size': '16px'});
			}

		}

	})

	$(".industry-expertise").ready(function(){
		
		if($('ul.industry-expertise li').is('ul.industry-expertise li.energy, ul.industry-expertise li.materials, ul.industry-expertise li.industrials, ul.industry-expertise li.consumerdiscretionary, ul.industry-expertise li.consumerstaples, ul.industry-expertise li.healthcare, ul.industry-expertise li.financials, ul.industry-expertise li.informationtechnology, ul.industry-expertise li.communicationservices, ul.industry-expertise li.utilities, ul.industry-expertise li.realestate') ) {

			// Second Level
			$('ul.industry-expertise li').css({'margin-left': '20px', 'font-weight': '400', 'font-size': '17px'});
			$('ul.industry-expertise li.energy').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.industry-expertise li.consumerdiscretionary').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.industry-expertise li.materials').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.industry-expertise li.industrials').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.industry-expertise li.financials').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.industry-expertise li.informationtechnology').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.industry-expertise li.communicationservices').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.industry-expertise li.utilities').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.industry-expertise li.realestate').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.industry-expertise li.consumerstaples').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			$('ul.industry-expertise li.healthcare').css({'margin-left': '0px', 'font-weight': '600', 'font-size': '18px'});
			
			

		}

	})
	
	
	/********
	***
	*** Profile Edit Checkbox fields (Industry Expertise)
	***
	********/
	// 10 Energy
	var tenenergy = $("[value='Energy Equipment & Services'],[value='Oil Gas & Consumable Fuels']");
	console.log(tenenergy);
	$("[value='10 Energy']").change(function () {
    	tenenergy.prop('checked', $(this).prop("checked"));
	})
	tenenergy.change(function(){
		if(tenenergy.is(":checked")) {
    		$("[value='10 Energy']").prop('checked', true);
    	}else{
    		$("[value='10 Energy']").prop('checked', false);
    	}
	});
	


	// 15 Materials

	
	var fields_list15 = $("[value*='Chemicals'],[value*='Construction Materials'],[value*='Containers & Packaging'],[value*='Metals & Mining'],[value*='Paper & Forest Products']");
	var field_father15 = $("[value='15 Materials']"); 

	field_father15.change(function () {
    	fields_list15.prop('checked', $(this).prop("checked"));
	});
	fields_list15.change(function(){
		if(fields_list15.is(":checked")) {
    		field_father15.prop('checked', true);
    	}else{
    		field_father15.prop('checked', false);
    	}
	});
	

// 	// 20 Industrials

	var fields_list20 = $("[value='Aerospace & Defense'], [value*='Building Products'], [value*='Construction & Engineering'], [value*='Electrical Equipment'], [value*='Industrial Conglomerates'], [value*='Machinery'], [value*='Trading Companies & Distributors'], [value*='Commercial Services and Supplies'], [value*='Professional Services'], [value^='Air Freight & Logistics'], [value*='Airlines'], [value*='Marine'], [value*='Road & Rail'], [value*='Transportation Infrastructure']");
	var field_father20 = $("[value='20 Industrials']"); 

	field_father20.change(function () {
    	fields_list20.prop('checked', $(this).prop("checked"));
	});
	
	fields_list20.change(function(){
		if(fields_list20.is(":checked")) {
    		field_father20.prop('checked', true);
    	}else{
    		field_father20.prop('checked', false);
    	}
	});

	// 25 Consumer Discretionary
	
	var fields_list25 = $("[value^='Specialty Retail'],[value^='Multiline Retail'], [value^='Internet & Direct Marketing Retail'], [value^='Distributors'], #field_3311_32, [value^='Diversified Consumer Services'], [value^='Hotels, Restaurants & Leisure'], [value^='Textiles, Apparel & Luxury Goods'], [value^='Leisure Products'], [value^='Household Durables'], [value^='Automobiles'], [value^='Auto Components']");
	var field_father25 = $("[value='25 Consumer Discretionary']"); 

	field_father25.change(function () {
    	fields_list25.prop('checked', $(this).prop("checked"));
	});
	
	fields_list25.change(function(){
		if(fields_list25.is(":checked")) {
    		field_father25.prop('checked', true);
    	}else{
    		field_father25.prop('checked', false);
    	}
	});
	


	// 30 Consumer Staples
	
	var fields_list30 = $("[value*='Personal Products'], [value*='Household Products'], [value*='Tobacco'], [value*='Food Products'], [value*='Beverages'], [value*='Food & Staples Retailling']");
	var field_father30 = $("[value='30 Consumer Staples']"); 

	field_father30.change(function () {
    	fields_list30.prop('checked', $(this).prop("checked"));
	});
	
	fields_list30.change(function(){
		if(fields_list30.is(":checked")) {
    		field_father30.prop('checked', true);
    	}else{
    		field_father30.prop('checked', false);
    	}
	});
	

	// 35 Health Care
	
	var fields_list35 = $("[value='Health Care Equipment & Supplies'], [value='Health Care Providers & Services'], [value='Health Care Technology'], [value='Biotechnology'], [value='Pharmaceuticals'], [value='Life Sciences Tools & Services']");
	var field_father35 = $("[value='35 Health Care']"); 

	field_father35.change(function () {
    	fields_list35.prop('checked', $(this).prop("checked"));
	});
	
	fields_list35.change(function(){
		if(fields_list35.is(":checked")) {
    		field_father35.prop('checked', true);
    	}else{
    		field_father35.prop('checked', false);
    	}
	});


	// 40 Financials

	var field_father40 = $("[value='40 Financials']"); 
	var fields_list40 = $("[value^='Banks'], [value^='Thrifts & Mortgage Finance'], [value^='Diversified Financial Services'], [value^='Consumer Finance'], [value^='Capital Markets'], [value^='Trusts'], [value^='Insurance']");

	field_father40.change(function () {
    	fields_list40.prop('checked', $(this).prop("checked"));
	});
	
	fields_list40.change(function(){
		if(fields_list40.is(":checked")) {
    		field_father40.prop('checked', true);
    	}else{
    		field_father40.prop('checked', false);
    	}
	});
	
	// 45 Information Technology

	var field_father45 = $("[value='45 Information Technology']"); 
	var fields_list45 = $("[value^='Internet Software & Services'], [value^='IT Services'], [value^='Software'], [value^='Communications Equipment'], [value^='Technology Hardware, Storage & Peripherals'], [value^='Electronic Equipment, Instruments & Components'], [value^='Semiconductors & Semiconductor Equipment']");

	field_father45.change(function () {
    	fields_list45.prop('checked', $(this).prop("checked"));
	});
	
	fields_list45.change(function(){
		if(fields_list45.is(":checked")) {
    		field_father45.prop('checked', true);
    	}else{
    		field_father45.prop('checked', false);
    	}
	});
	

// 50 Communication Services

	var field_father50 = $("[value='50 Communication Services']"); 
	var fields_list50 = $("[value^='Diversifield Telecommunication Services'], [value^='Wireless Telecommunication Services'], #field_3349_70, [value^='Entertainment'], [value^='Interactive Media & Services']");

	field_father50.change(function () {
    	fields_list50.prop('checked', $(this).prop("checked"));
	});
	
	fields_list50.change(function(){
		if(fields_list50.is(":checked")) {
    		field_father50.prop('checked', true);
    	}else{
    		field_father50.prop('checked', false);
    	}
	});


	// 55 Utilities


	var field_father55 = $("[value='55 Utilities']"); 
	var fields_list55 = $("[value^='Electric Utilities'], [value^='Gas Utilities'], [value^='Multi-Utilities'], [value^='Water Utilities'], [value^='Independent Power and Renewable Electricity Producers']");

	field_father55.change(function () {
    	fields_list55.prop('checked', $(this).prop("checked"));
	});
	
	fields_list55.change(function(){
		if(fields_list55.is(":checked")) {
    		field_father55.prop('checked', true);
    	}else{
    		field_father55.prop('checked', false);
    	}
	});


	// 60 Real Estate

	var field_father60 = $("[value='60 Real Estate']"); 
	var fields_list60 = $("[value^='Equity Real Estate Investment Trusts (REITs)'], [value^='Real Estate Management & Development']");

	field_father60.change(function () {
    	fields_list60.prop('checked', $(this).prop("checked"));
	});
	
	fields_list60.change(function(){
		if(fields_list60.is(":checked")) {
    		field_father60.prop('checked', true);
    	}else{
    		field_father60.prop('checked', false);
    	}
	});



	/********
	***
	*** Profile Edit Checkbox fields (Product Expertise)
	***
	********/
	
	// Mergers & Acquisitions
	var mergersAcquisitions = $("[value='Private to Public'], [value='Public to Public'], [value='Private to Private'], [value='Public to Private (Going Private)']");
	$("[value='Mergers & Acquisitions']").change(function () {
    	mergersAcquisitions.prop('checked', $(this).prop("checked"));
	})
	mergersAcquisitions.change(function(){
		if(mergersAcquisitions.is(":checked")) {
    		$("[value='Mergers & Acquisitions']").prop('checked', true);
    	}else{
    		$("[value='Mergers & Acquisitions']").prop('checked', false);
    	}
	})

	// Private Placements
	// field_3418_12 == mortagage
	// field_3419_13 == asset-backed 
	// field_3422_16 == preferred
	// field_3422_16
	// field_3423_17 convertable securities
	
	// those fields appear twice on the form 
	
	var allPrivatePlacement = $("[value='Lending Facilities'], [value='Debt'], [value='Taxable'], [value='Tax-Exempt'] , [value='Mortgage'] , #field_3419_13, #field_3418_12 , [value='Equity'], [value='Stock and Sr.'], #field_3422_16 , #field_3423_17 , [value='Funds'], [value='PE Funds'], [value='Venture Capital Funds'], [value='Hedge Funds'], [value='BDCs'], [value='REITs']");
	$("[value='Private Placements']").change(function () {
    	allPrivatePlacement.prop('checked', $(this).prop("checked"));
    })
    allPrivatePlacement.change(function () {
    	if(allPrivatePlacement.is(":checked")) {
    		$("[value='Private Placements']").prop('checked', true);
    	}else{
    		$("[value='Private Placements']").prop('checked', false);
    	}
    })

    // Debt
	// field_3418_12 == mortagage
	// field_3419_13 == asset-backed 
    var debt = $("[value='Taxable'],[value='Tax-Exempt'],[value='Mortgage'], #field_3418_12 ,#field_3419_13");
    $("[value='Debt']").change(function () {
    	debt.prop('checked', $(this).prop("checked"));
    })
    debt.change(function () {
    	if(debt.is(":checked")) {
    		$("[value='Debt']").prop('checked', true);
    	}else{
    		$("[value='Debt']").prop('checked', false);
    	}
    })

    // Equity
    // field_3423_17 convertable sec
    var equity = $("[value='Stock and Sr.'], #field_3422_16 , #field_3423_17 , field_3423_17");
    $("[value='Equity']").change(function () {
    	equity.prop('checked', $(this).prop("checked"));
    })
    equity.change(function () {
    	if(equity.is(":checked")) {
    		$("[value='Equity']").prop('checked', true);
    	}else{
    		$("[value='Equity']").prop('checked', false);
    	}
    })

    // Funds
    var Funds = $("[value='PE Funds'],[value='Venture Capital Funds'],[value='Hedge Funds'],[value='BDCs'],[value='REITs']");
    $("[value='Funds']").change(function () {
    	Funds.prop('checked', $(this).prop("checked"));
    })
    Funds.change(function () {
    	if(Funds.is(":checked")) {
    		$("[value='Funds']").prop('checked', true);
    	}else{
    		$("[value='Funds']").prop('checked', false);
    	}
    })

	// Public Markets
	

		// field_3271_36 == asset-backed 
	// field_3272_37 == mortagage
	// those fields appear twice on the form 
	// field_3434_28 convertible sec 
	// field_3443_37 asset backed
	// field_3447_41 == preferred
	// field_3444_38 mortagage
	
    var publicMarkets = $("#field_3444_38, #field_3434_28 , #field_3443_37, #field_3447_41, #field_3271_36, #field_3272_37,  [value='ECM (Equity Capital Markets)'],[value='Equity Syndicate'],[value='IPO'],[value='Follow-on'],[value='PIPEs'],[value='Registered Directs'],[value='Agented'],[value='Underwritten'],[value='DCM (Debt Capital Markets)'],[value='Investment Grade'],[value='High Yield'],[value='Commercial Paper'],[value='Medium Term Notes'],[value='Retail Preferred'],[value='Baby Bonds'],[value='Tax Exempt'],[value='Initial Coin Offerings & Block Chain & Tokens']");
    $("[value='Public Markets']").change(function () {
    	publicMarkets.prop('checked', $(this).prop("checked"));
    })
    publicMarkets.change(function () {
    	if(publicMarkets.is(":checked")) {
    		$("[value='Public Markets']").prop('checked', true);
    	}else{
    		$("[value='Public Markets']").prop('checked', false);
    	}
    })

    // ECM (Equity Capital Markets)
    // field_3434_28 convertible sec

    var ecmEquityCapitalMarket = $("#field_3434_28, [value='Equity Syndicate'],[value='IPO'],[value='Follow-on'],[value='PIPEs'],[value='Registered Directs'],[value='Agented'],[value='Underwritten']");
    $("[value='ECM (Equity Capital Markets)']").change(function () {
    	ecmEquityCapitalMarket.prop('checked', $(this).prop("checked"));
    })
    ecmEquityCapitalMarket.change(function () {
    	if(ecmEquityCapitalMarket.is(":checked")) {
    		$("[value='ECM (Equity Capital Markets)']").prop('checked', true);
    	}else{
    		$("[value='ECM (Equity Capital Markets)']").prop('checked', false);
    	}
    })

    // Follow-on
    var followon = $("[value='PIPEs'],[value='Registered Directs'],[value='Agented'],[value='Underwritten']");
    $("[value='Follow-on']").change(function () {
    	followon.prop('checked', $(this).prop("checked"));
    })
    followon.change(function () {
    	if(followon.is(":checked")) {
    		$("[value='Follow-on']").prop('checked', true);
    	}else{
    		$("[value='Follow-on']").prop('checked', false);
    	}
    })

    // DCM (Debt Capital Markets)
    //field_3443_37 Asset-Backed
    //field_3444_38 Mortgage Backed
    // field_3447_41 preferred 
    
    var dcmDebtCapitalMarkets = $("[value='Investment Grade'],[value='High Yield'], #field_3443_37 , #field_3444_38, #field_3447_41 ,[value='Commercial Paper'],[value='Medium Term Notes'],[value='Retail Preferred'],[value='Baby Bonds'],[value='Tax Exempt'],[value='Initial Coin Offerings & Block Chain & Tokens']");
    $("[value='DCM (Debt Capital Markets)']").change(function () {
    	dcmDebtCapitalMarkets.prop('checked', $(this).prop("checked"));
    })
    dcmDebtCapitalMarkets.change(function () {
    	if(dcmDebtCapitalMarkets.is(":checked")) {
    		$("[value='DCM (Debt Capital Markets)']").prop('checked', true);
    	}else{
    		$("[value='DCM (Debt Capital Markets)']").prop('checked', false);
    	}
    })
	
	 // Taxable
	/*$("[value^='Taxable']").change(function () {
    $("#field_652_9, [value='Mortgage'], #field_654_11, #field_655_12, #field_656_13 ").prop('checked', $(this).prop("checked"));

    })*/

	// Public Markets
	/*$("[value='Public Markets']").change(function () {
    $("[value='ECM (Equity Capital Markets)'], [value='DCM (Debt Capital Markets)'], #field_640_42, [value='Investment Grade'], [value='High Yield'], #field_677_34, #field_678_35, #field_684_41, [value='Commercial Paper'], [value='Medium Term Notes'], [value='Preferred'], [value='Retail Preferred'], [value='Baby Bonds'], #field_639_41, [value='Equity Syndicate'], [value='IPO'], [value='Convertible Securities'], [value='PIPEs'], [value='Registered Directs'], [value='Follow-on'], [value='Agented'], [value='Underwritten'], #field_685_42, #field_79_match_any_wrap > label:nth-child(40) > input[type=checkbox]").prop('checked', $(this).prop("checked"));

    })*/

	// ECM (Equity Capital Markets)
	/*$("[value='ECM (Equity Capital Markets)']").change(function () {
    $("[value='Equity Syndicate'], [value='IPO'], [value='Convertible Securities'], [value='PIPEs'], [value='Registered Directs'], [value='Follow-on'], [value='Agented'], [value='Underwritten']").prop('checked', $(this).prop("checked"));

    })*/

	 // Follow-on
	/*$("[value='Follow-on']").change(function () {
    $("[value='PIPEs'], [value='Registered Directs'], [value='Agented'], [value='Underwritten']").prop('checked', $(this).prop("checked"));

    })*/
	
	// DCM (Debt Capital Markets)
	/*$("[value='DCM (Debt Capital Markets)']").change(function () {
    $("[value='Investment Grade'], [value='High Yield'], #field_677_34, #field_678_35, #field_684_41, [value='Commercial Paper'], [value='Medium Term Notes'], [value='Preferred'], [value='Retail Preferred'], [value='Baby Bonds'], #field_639_41").prop('checked', $(this).prop("checked"));

	})*/
// $(window).on('load', function() {
//     $("#field_79_match_any_wrap > label:nth-child(44)").appendTo("#field_79_match_any_wrap");
// });



	
})(jQuery);

