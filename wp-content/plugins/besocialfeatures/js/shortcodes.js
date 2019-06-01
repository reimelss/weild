(function() {
	tinymce.PluginManager.add('besclwp_mce_button', function( editor, url ) {
		editor.addButton( 'besclwp_mce_button', {
			text: 'Shortcodes',
			icon: false,
			type: 'menubutton',
					menu: [
                        {
							text: 'Accordion',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add an Accordion',
									body: [
                                        {
											type: 'textbox',
											name: 'tabnumber',
											label: 'Number of item:',
											value: '3'
										}
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.tabnumber)) {
                                            editor.windowManager.alert('Number of item must be a number.');
                                            return false;
                                        }
                                        else {
                                            var i = 0;
                                            editor.insertContent('[besclwpaccordioncontainer]<br/><br/>');
                                            while (i < e.data.tabnumber) {
                                                editor.insertContent( '[besclwpaccordion title="Title Here" icon=""][/besclwpaccordion]<br/><br/>');
                                                i++;
                                            }
                                            editor.insertContent('[/besclwpaccordioncontainer]');
                                        }
									}
								});
							}
						},
                        {
							text: 'Tabs',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Add a Tabs',
									body: [
                                        {
											type: 'textbox',
											name: 'tabnumber',
											label: 'Number of item:',
											value: '3'
										},
                                        {
											type: 'listbox',
											name: 'type',
											label: 'Type:',
											'values': [
												{text: 'Default', value: 'default'},
												{text: 'Vertical', value: 'vertical'}
											]
										}
									],
									onsubmit: function( e ) {
                                        if(isNaN(e.data.tabnumber)) {
                                            editor.windowManager.alert('Number of item must be a number.');
                                            return false;
                                        }
                                        else {
                                            var i = 0;
                                            editor.insertContent('[besclwptabgroup type="' + e.data.type + '"]<br/><br/>');
                                            while (i < e.data.tabnumber) {
                                                editor.insertContent( '[besclwptab title="Title Here"][/besclwptab]<br/><br/>');
                                                i++;
                                            }
                                            editor.insertContent('[/besclwptabgroup]');
                                        }
									}
								});
							}
						},
                        {
							text: 'Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert a Button',
									body: [
                                        {
											type: 'textbox',
											name: 'buttonurl',
											label: 'URL:',
											value: ''
										},
                                        {
											type: 'textbox',
											name: 'buttontext',
											label: 'Button Text:',
											value: 'Click Here'
										},
                                        {
											type: 'listbox',
											name: 'newtab',
											label: 'Open in a new tab:',
											'values': [
												{text: 'No', value: ''},
												{text: 'Yes', value: 'yes'}
											]
										},
                                        {
											type: 'listbox',
											name: 'style',
											label: 'Style:',
											'values': [
												{text: 'Large', value: 'large'},
												{text: 'Medium', value: 'medium'},
                                                {text: 'Small', value: 'small'},
											]
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[besclwpbutton url="' + e.data.buttonurl + '" newtab="'+ e.data.newtab +'" besclwpbuttonstyle="'+ e.data.style +'"]' + e.data.buttontext + '[/besclwpbutton]');
									}
								});
							}
						},
                        {
							text: 'Highlighted Text',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Insert a highlighted text',
									body: [
                                        {
											type: 'textbox',
											name: 'text',
											label: 'Text:',
											value: ''
										}
									],
									onsubmit: function( e ) {
										editor.insertContent( '[besclwphighlight]' + e.data.text + '[/besclwphighlight]');
									}
								});
							}
						}
                    ]
		});
	});
})();