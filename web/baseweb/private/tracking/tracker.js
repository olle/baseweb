var Tracking = {
	visitors : null,
	visitor : null,
	isPollVisitorsEnabled : true,
	isPollTracksEnabled : false,
	visitorsShortPoll : 3500,
	visitorsLongPoll : 7000,
	tracksShortPoll : 2000,
	tracksLongPoll : 5000,
	pollStartDelay : 1000,
	baseURL : '/baseweb/modules/tracking/tracking-ajax.php'
};

Tracking.pollVisitors = function () {
	
	if (!Tracking.isPollVisitorsEnabled)
		return;
	
	jQuery.getJSON(
			'/baseweb/modules/tracking/tracking-ajax.php?action=visitors',
			function(data) {
				if (data) {
					Tracking.showVisitors(data);
					setTimeout(Tracking.pollVisitors, Tracking.visitorsLongPoll);
				} else {
					setTimeout(Tracking.pollVisitors, Tracking.visitorsShortPoll);
				}
			}
	);
};

Tracking.showVisitors = function (data) {
	
	var list = jQuery('ul.visitors.new');
	
	if (Tracking.visitors === null && data.length > 0) {
		jQuery('li', list).remove();
		Tracking.visitors = {};		
	}
	
	for (i in data) {

		var id = 'visitor-' + data[i].id;

		if (Tracking.visitors[id])
			continue;
		
		var html = [];
		html.push('<li id="' + id + '">');
		html.push('<img src="/baseweb/private/img/transp.gif" alt="" />');
		html.push(data[i].ip);
		html.push('</li>');
		
		var li = jQuery(html.join('')).click(Tracking.selectVisitor);
		
		list.append(li);
		
		Tracking.visitors[id] = true;
	}
};

Tracking.selectVisitor = function (ev) {

	if (Tracking.visitor) {
		jQuery.getJSON(
				Tracking.baseURL + '?action=stop&' + Tracking.visitor,
				function(data) {
					jQuery('li#visitor-' + Tracking.visitor).removeClass('selected');
					Tracking.visitor = null;
				}
		);
	}
	
	var id = ev.target.id.split('-')[1];

	jQuery.getJSON(
			Tracking.baseURL + '?action=start&id=' + id,
			function(data) {
				Tracking.isPollVisitorsEnabled = false;
				Tracking.isPollTracksEnabled = true;
				jQuery(ev.target).addClass('selected');
				Tracking.visitor = id;
				Tracking.pollTracks();
			}
	);
};

Tracking.pollTracks = function () {
	
	if (!Tracking.isPollTracksEnabled || !Tracking.visitor)
		return;	
	
	jQuery.getJSON(
		Tracking.baseURL + '?action=tracks&id=' + Tracking.visitor,
		function(data) {
			if (data) {
				Tracking.showTracks(data);
				setTimeout(Tracking.pollTracks, Tracking.tracksLongPoll);
			} else {
				setTimeout(Tracking.pollTracks, Tracking.tracksShortPoll);
			}
		}
	);	
};

Tracking.showTracks = function (data) {
	
	for (i in data) {

		var html = [];
		html.push('<li>');
		html.push('<div>' + data[i].created_at + '</div>');
		html.push('</li>');
		
		var li = jQuery(html.join(''));
		
		jQuery('ol.tracks').append(li);
	}	
};

// HANDLERS
jQuery('ul.visitors.new li').click(Tracking.selectVisitor);

// INIT
setTimeout(Tracking.pollVisitors, Tracking.pollStartDelay);