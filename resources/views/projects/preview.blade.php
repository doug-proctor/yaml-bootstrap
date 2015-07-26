<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Previewing {{$project->name}}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width" />

	<link rel="stylesheet" href="/css/preview-bundle.css" />
	<script src="/js/preview-bundle.js"></script>

</head>
<body>

	<script>

		$.get('/yaml/{{ $project->id }}', function(data) {
			var yml = YAML.parse(data);
			start(yml);
		});

		function start(json) {
			for (top_key in json) {
				makePage(top_key, json[top_key]);
			}
		}

		function makePage(name, data) {
			var $container = $('<div />').addClass('container-fluid').appendTo(document.body);
			attachElementsToPage($container, data);
		}
		
		// Run through the data and attach the children
		function attachElementsToPage(parent, data) {

			console.log("Attach! %O %O", parent, data);
			//console.log("Length: " + data.length);

			for (var i = 0; i < data.length; i++) {
				
				var element = data[i];
				//console.log("element is: %O", element);
				
				// Now 'element' is an object which may contain a type/content pair
				// or a type/array pair. Let's find out...

				for (key in element) {

					var value = element[key];
					var components = getComponentArray(key);
					key = components[0];

					if (value instanceof Array || value instanceof Object) {

						if (isNode(key)) {
							// It's an array of elemets, so render the elements:
							//console.log("Creating a node for " + key);
							var $element = getHTMLElementForDescriptor(key, components[1]).appendTo(parent);
							attachElementsToPage($element, value);

						} else {

							// // It's an array of element properties, so render an element
							// // using the properties:
							// var $element = getHTMLElementForDescriptor(key)

							// //console.log(value.length);

							// for (var i = 0; i < value.length; i++) {

							// 	var pair = value[i];
							// 	var pair_key = Object.keys(pair).join();
							// 	var pair_value = pair[pair_key];
								
							// 	//console.log(pair, pair_key, pair_value);

							// 	if (pair_key == 'text') {
							// 		$element.text(pair_value);
							// 	}

							// 	if (pair_key == 'classes') {
							// 		$element.addClass(pair_value);
							// 	}

							// 	if (pair_key == 'annotation') {
							// 		$element.attr('data-annotation', pair_value);
							// 	}
							// };
							
							// $element.appendTo(parent);
							// attachElementsToPage(parent, value);							

						}

					} else {
						
						var $parent = $(parent);
						
						if ($parent.children('.inner').length) {
							$parent = $parent.children('.inner');
						}
						
						var $element = getHTMLElementForDescriptor(key, value).appendTo($parent);
					}
				}
			}
		}

		function getHTMLElementForDescriptor(descriptor, content) {

			var elements = {
				paragraph: 		makeParagraph(content),
				link: 			$('<a />').html(content).attr('href', '#'),
				heading: 		$('<h1 />').html(content),
				subheading: 	$('<h3 />').html(content),
				jumbo: 			makeJumbotron(content),
				password_field: makeFormField('password', content, null, null),
				text_field: 	makeFormField('text', content, content + '...', null),
				checkbox: 		makeCheckbox(content),
				text_area: 		makeTextArea(content),
				radio_button: 	makeRadioButton(content),
				submit: 		makeFormSubmit(content),
				row: 			$('<div />').addClass('row'),
				box100: 		makeColumnWithClasses('col-md-12'),
				box75: 			makeColumnWithClasses('col-md-9'),
				box50: 			makeColumnWithClasses('col-md-6'),
				box25: 			makeColumnWithClasses('col-md-3'),
				box33: 			makeColumnWithClasses('col-md-4'),
				box66: 			makeColumnWithClasses('col-md-8'),
				box: 			makeBox(content),
				panel: 			makePanel(content, 'panel-default'),
				form: 			$('<form />').addClass(''),
				button: 		makeButton(content),
				line: 			$('<hr />'),
				spacing: 		$('<div />').addClass('spacing spacing-' + content),
				alert: 			makeAlert(content),
				circle: 		makeCircle(content),
			}

			return elements[descriptor];
		}

		function isNode(item) {
			var nodes = [
				'row',
				'box100',
				'box75',
				'box50',
				'box25',
				'box33',
				'box66',
				'box',
				'form',
			];
			return nodes.indexOf(item) !== -1;
		}

		/*
		*
		*  Maker functions 
		*/

		function getComponentArray(string) {
			if (string) {
				return string.split('|');
			}
			return false;
		}

		function makeCircle(content) {
			return $('<div />').addClass('circle circle-' + content);
		}

		function makeBox(classes) {
			return $('<div />').addClass('box ' + classes);
		}

		function makeAlert(content) {

			var components = getComponentArray(content);
			$alert = $('<div />').addClass('alert').html(components[0]);

			if (components) {
				if (components.indexOf('success') !== -1) {
					$alert.addClass('alert-success');
				}
				if (components.indexOf('info') !== -1) {
					$alert.addClass('alert-info');
				}
				if (components.indexOf('danger') !== -1) {
					$alert.addClass('alert-danger');
				}
				if (components.indexOf('warning') !== -1) {
					$alert.addClass('alert-warning');
				}
			}
			return $alert;
		}

		function makeParagraph(content) {
			var components = getComponentArray(content);
			$p = $('<p />').html(components[0]);

			// Look for directives in the content string
			if (components && components.indexOf('centered') !== -1) {
				$p.addClass('centered');
			}
			return $p;
		}
		
		function makeColumnWithClasses(classes) {
			$col = $('<div />').addClass('col-xs-12 col ' + classes);
			$inner = $('<div />').addClass('inner').appendTo($col);
			return $col;
		}

		function makeFormGroup() {
			return $('<div />').addClass('form-group');
		}

		function makeTextArea(content) {
			var $group = makeFormGroup();
			var $text_area = $('<textarea />').addClass('form-control').appendTo($group);
			return $group;
		}

		function makeButton(content) {
			var components = getComponentArray(content);
			var $wrapper = $('<div />').addClass('button-wrapper');
			var $button = $('<button />').addClass('btn btn-primary').text(components[0]).appendTo($wrapper);

			if (components && components.indexOf('right')) {
				$wrapper.addClass('right');
			}
			return $wrapper;
		}

		function makeJumbotron(content) {
			var $jumbo = $('<div />').addClass('jumbotron');
			var $heading = $('<h1 />').html(content).appendTo($jumbo);
			return $jumbo;
		}

		function makeCheckbox(content) {
			
			var $group = $('<div />').addClass('checkbox');
			var $label = $('<label />').text(content).appendTo($group);
			var $checkbox = $('<input />', {'type':'checkbox'}).prependTo($label);

			return $group;
		}

		function makeRadioButton(content) {
			var $group = $('<div />').addClass('radio');
			var $label = $('<label />').text(content).appendTo($group);
			var $radio_button = $('<input />', {'type':'radio'}).prependTo($label);
			return $group;
		}

		function makeFormField(type, label, placeholder, value) {

			var $form = $('<div />').addClass('form-group');
			var $label = $('<label />').text(label).appendTo($form);
			var $input = $('<input />').attr({
				type: type,
				placeholder: placeholder,
			}).addClass('form-control').val(value).appendTo($form);

			return $form;
		}

		function makeFormSubmit(value) {

			var $form = $('<div />').addClass('form-group');
			var $input = $('<input />').attr({
				type: 'submit'
			}).addClass('form-control btn btn-primary').val(value).appendTo($form);

			return $form;
		}

		function makePanel(content, classes) {
			var $panel = $('<div />').addClass('panel ' + classes);
			var $body = $('<div />').addClass('panel-body').html(content).appendTo($panel);
			return $panel;
		}

		function getDOM() {
			var dom = $('html').html();
			console.log('<html>' + dom + '</html>');
		}

	</script>

	
</body>
</html>