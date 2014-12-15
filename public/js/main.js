document.addEvent('domready', function() {
	$$('.lightbox-images,.show-image').each(function(gallery) {
		gallery.getElements('a[href$=jpg],a[href$=JPG],a[href$=jpeg],a[href$=JPEG],a[href$=png],a[href$=PNG]').cerabox({
           animation: 'ease',
           displayTitle: false,
           group: false
       });
	});

	$$('.repeatable-inputs').each(function (ric) {
		var list = ric.getElement('.repeatable-list');
		var last_item = cloneParametrizeArrayInput(list.getElements('li').getLast());

		ric.addEvent('click:relay(.repeat-button)', function (event, target) {
			last_item.inject(list, 'bottom');
			last_item = cloneParametrizeArrayInput(last_item);
		});
	});
});

function cloneParametrizeArrayInput(element_to_clone) {
	console.log(element_to_clone);
	var clone = element_to_clone.clone(true);
	clone.getElements('input[name],label[for]').each(function (input) {
		var attr = (input.match('label') ? 'for' : (input.match('input') ? 'name' : null));
		var part = input.get(attr).replace(/(\d+)/gi, function(full, num) {
			return parseInt(num)+1;
		});

		input.set(attr, part);
		if (input.match('input')) {
			input.set('id', part);
		}
	});


	return clone;
}