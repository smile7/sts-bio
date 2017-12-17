/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'jkreativ\'">' + entity + '</span>' + html;
	}
	var icons = {
			'default-untitled' : '&#xf000;',
			'default-search' : '&#xf002;',
			'default-facebook' : '&#xe000;',
			'default-twitter' : '&#xe001;',
			'default-vimeo' : '&#xe002;',
			'default-tumblr' : '&#xe003;',
			'default-picassa' : '&#xe004;',
			'default-skype' : '&#xe005;',
			'default-angle-left' : '&#xf104;',
			'default-angle-right' : '&#xf105;',
			'default-list' : '&#xe006;',
			'default-ellipsis' : '&#xe007;',
			'default-remove' : '&#xf00d;',
			'default-expand' : '&#xe008;',
			'default-contract' : '&#xe009;',
			'default-flickr' : '&#xe00a;',
			'default-github' : '&#xe00b;',
			'default-feed' : '&#xe00c;',
			'default-google' : '&#xe00d;',
			'default-info' : '&#xe00e;',
			'default-reorder' : '&#xf0c9;',
			'default-long-arrow-right' : '&#xf178;',
			'default-long-arrow-left' : '&#xf177;',
			'default-share' : '&#xe00f;',
			'default-dribbble' : '&#xe010;',
			'default-github-2' : '&#xe011;',
			'default-stackoverflow' : '&#xe012;',
			'default-lastfm' : '&#xe013;',
			'default-soundcloud' : '&#xe014;',
			'default-windows8' : '&#xe015;',
			'default-steam' : '&#xe016;',
			'default-share-2' : '&#xe017;',
			'default-info-2' : '&#xe018;',
			'default-share-3' : '&#xe019;',
			'default-heart' : '&#xf004;',
			'default-star-empty' : '&#xf006;',
			'default-left-quote' : '&#xe01a;',
			'default-right-quote' : '&#xe01b;',
			'default-envelope' : '&#xe01c;',
			'default-angle-down' : '&#xf107;',
			'default-location' : '&#xe01d;',
			'default-compass' : '&#xe01e;',
			'default-compass-2' : '&#xe01f;',
			'default-add' : '&#xe020;',
			'default-minus' : '&#xe021;',
			'default-error' : '&#xe022;',
			'default-checked' : '&#xe023;',
			'default-cancel' : '&#xe024;',
			'default-cancel-2' : '&#xe025;',
			'default-cart' : '&#xe026;',
			'default-basket' : '&#xe056;',
			'default-key' : '&#xe037;',
			'default-enter' : '&#xe027;',
			'default-locked' : '&#xe02e;',
			'default-star' : '&#xe028;',
			'default-star-2' : '&#xe029;',
			'default-equalizer' : '&#xe02a;',
			'default-play' : '&#xe02b;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/default-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};