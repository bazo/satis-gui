function resizeIframe(obj) {
	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
	var doc = obj.contentWindow.document.getElementById('doc');

	doc.style.width = '100%';
}

$(function() {
	var iframe = document.getElementById('homepage');
	resizeIframe(iframe);
});
