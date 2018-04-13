function YMPointCollection() {
    var collection = {};
    var count = 0;

    this.count = function () {
        return count;
    };

    this.add = function(lat, lng) {
        var idx = count;
        collection[idx] = { lat: lat, lng: lng };
        count++;
    };

    this.item = function(idx) {
        return collection[idx];
    }

    this.maxLat = function () {
        if (count > 0) {
            var val = collection[0].lat;

            for (var i = 0; i < count; i++) {
                if (collection[i].lat > val) {
                    val = collection[i].lat;
                }
            }

            return val;
        }
        else {
            return 0;
        }
    };

    this.minLat = function () {
        if (count > 0) {
            var val = collection[0].lat;

            for (var i = 0; i < count; i++) {
                if (collection[i].lat < val) {
                    val = collection[i].lat;
                }
            }

            return val;
        }
        else {
            return 0;
        }
    };

    this.maxLng = function () {
        if (count > 0) {
            var val = collection[0].lng;

            for (var i = 0; i < count; i++) {
                if (collection[i].lng > val) {
                    val = collection[i].lng;
                }
            }

            return val;
        }
        else {
            return 0;
        }
    };

    this.minLng = function () {
        if (count > 0) {
            var val = collection[0].lng;

            for (var i = 0; i < count; i++) {
                if (collection[i].lng < val) {
                    val = collection[i].lng;
                }
            }

            return val;
        }
        else {
            return 0;
        }
    };
}

this._pointsUnique = new YMPointCollection();

function SaveAddressData(callbackUrl, addressToHash, formattedAddress, lat, lng) {
    $.ajax({ 'type': "POST", 'url': callbackUrl,
        'data': ({ Address: addressToHash, FormattedAddress: formattedAddress, Latitude: lat, Longitude: lng }),
        'complete': SavePointCallback,
        'dataType': "json"
    });
}

function SavePointCallback(xhr, status) {
    if (status != "success") {
        var resp = xhr.responseText;
        //alert("Unable to save encoded data: " + resp);
    }
}

function GetUniquePoint(latLng) {
    var found = false;
    var pnt;
    var adjust = 0.00001;
    var newLat = 0.0;
    var newLng = 0.0;

    for (var i = 0; i < this._pointsUnique.count(); i++) {
        pnt = this._pointsUnique.item(i);
        found = false;
        
        if (pnt.lat == latLng.lat() && pnt.lng == latLng.lng()) {
            found = true;

            newLat = (parseFloat(latLng.lat()) + parseFloat(adjust)).toFixed(6);
            newLng = (parseFloat(latLng.lng()) + parseFloat(adjust)).toFixed(6);
            
            var newLatLng = new google.maps.LatLng(newLat, newLng);

            return GetUniquePoint(newLatLng);
        }
    }

    if (!found) {
        this._pointsUnique.add(latLng.lat(), latLng.lng());
        
        return latLng;
    }
}

function YMMarkerManager() {

    this.Init = function () {
        this._addDelay = 500; //in ms
        this._markers = [];
        this._idx = -1;
        this._maintainCenter = false;
        this._geocoder = new google.maps.Geocoder();
        this._points = new YMPointCollection();
        this._pointsUnique = new YMPointCollection();
    };

    this.MaintainCenterFocus = function () {
        this._maintainCenter = true;
    };

    this.AddToQueue = function(marker) {
        this._markers.push(marker);
    };

    this.SetGeocodeCallbackUrl = function(url) {
        this._callbackUrl = url;
    };

    this.ProcessQueue = function(map, mapid) {
        this._map = map;
        //if (this._markerClusterer === undefined) {
        //    this._markerClusterer = new MarkerClusterer(map, null, { 'maxZoom': 8 });
        //}
        //this._markerClusterer.setMap(map);

        this.ProcessNext(mapid);
    };

    this.ProcessNext = function(id) {
    	this._idx++;

    	var idx = this._idx;
    	var marker;
    	var center = false;
    	var themap = this._map;

    	if (idx < this._markers.length) {
    		if (idx === 0 || idx == (this._markers.length - 1)) {
    			//Old logic for centering on each point as it was added. Removed.
    			//center = true;
    		}
    		marker = this._markers[idx];

			try {
    			var that = this;
    			this._geocoder.geocode({ 'address': marker.address }, function(results, status) {
    				if (status != google.maps.GeocoderStatus.OK) {
    					//Handle a failed geocoding here...
    					switch (status) {
    						case google.maps.GeocoderStatus.ZERO_RESULTS:
    							//alert("Geocoding failed. Zero results for '" + marker.address + "'");
    							break;
    						case google.maps.GeocoderStatus.OVER_QUERY_LIMIT:
    							//alert("Geocoding failed. Over query limit.");
    							break;
    						case google.maps.GeocoderStatus.REQUEST_DENIED:
    							//alert("Geocoding failed. Other problem 1.");
    							break;
    						case google.maps.GeocoderStatus.INVALID_REQUEST:
    							//alert("Geocoding failed. Other problem 2.");
    							break;
    					}
    					return;
    				}
    				else {
    					//Geocoded OK. Add the marker to the map
    					var lat = results[0].geometry.location.lat();
    					var lng = results[0].geometry.location.lng();

    					//Place the marker
    					that.PlaceMarker(themap, lat, lng, marker.label, marker.icon, marker.shadow, center, marker.autoOpen, marker.onclick);

    					//Check for addressToHash first? If not avail, use .address?
    					//alert(marker.addressToHash);
    					var addressToHash = marker.address;
    					if (marker.addressToHash) {
    						addressToHash = marker.addressToHash;
    					}

    					//Save the coordinates for later as well
    					that.GeocoderSuccessCallBack(themap, addressToHash, results, marker.label, marker.icon, marker.shadow, center, marker.autoOpen, marker.onclick);
    				}
    			});
    		} catch(e) {}

    		//Set a timeout to process the next item in the queue
    		window.setTimeout(id + "markerManager.ProcessNext('" + id + "');", this._addDelay);
    	}
    	else {
    		//We're done adding markers to the map...now we can center and focus

    		if (this._maintainCenter) {
    			//Don't refocus the map.
    			return;
    		}

    		var points_on_map = this._points;

    		if (points_on_map.count() > 0 && themap.cancelReFocus != true) {

    			if (points_on_map.count() > 1) {
    				//Option 1: Pan and zoom to attempt to fit the bounds containing all available points

    				//Get a bounding box containing all of the points on the map
    				var southwest_corner = new google.maps.LatLng(points_on_map.minLat(), points_on_map.minLng());
    				var northeast_corner = new google.maps.LatLng(points_on_map.maxLat(), points_on_map.maxLng());
    				var bounding_box = new google.maps.LatLngBounds(southwest_corner, northeast_corner);

    				themap.fitBounds(bounding_box);

    				//var listener = google.maps.event.addListener(themap, "idle", function() {
    				//  if (themap.getZoom() > 16)
    				//      themap.setZoom(16);
    				//  google.maps.event.removeListener(listener);
    				//});
    			}
    			else {
    				//Option 2: Pan only, don't change zoom. Good for when adding only one or two points and want a fixed zoom level.
    				if (points_on_map.count() == 1) {
    					//Since there is only one point, it doesn't matter which corner we pan to (sw/ne)
    					themap.panTo(new google.maps.LatLng(points_on_map.item(0).lat, points_on_map.item(0).lng));
    				}
    				else {
    					//No points - zoom back out
    					themap.panTo(new google.maps.LatLng(0, 0));
    					themap.setZoom(1);
    				}
    			}



    		}
    		else if (points_on_map.count() < 0) {
    			//No points or cancelRefocus
    			themap.panTo(new google.maps.LatLng(0, 0));
    			themap.setZoom(1);
    		}
    	}
    };

    this.GeocoderSuccessCallBack = function(map, addressToHash, results, label, icon, shadow, center, autoOpen, onclick) {
        var lat = results[0].geometry.location.lat();
        var lng = results[0].geometry.location.lng();

        if (this._callbackUrl && this._callbackUrl != '') {
            SaveAddressData(this._callbackUrl, addressToHash, results[0].formatted_address, lat, lng);
        }
    };

    this.PlaceMarker = function(map, lat, lng, label, icon, shadow, center, autoOpen, onclick) {

        var latLng = GetUniquePoint(new google.maps.LatLng(lat, lng));
        var mrkr;

        if (this.MarkerClusterer) {
            mrkr = new google.maps.Marker({ position: latLng });
            this.MarkerClusterer.addMarker(mrkr);
        }
        else {
            mrkr = new google.maps.Marker({ position: latLng, map: map });
        }
        
        this._points.add(lat, lng);


        if (icon && icon != '') {
            mrkr.setIcon(icon);
        }

        if (shadow && shadow != '') {
            mrkr.setShadow(shadow);
        }

        if (label && label != '') {
            var infowindow = new google.maps.InfoWindow({ 'content': label });

            google.maps.event.addListener(mrkr, 'click', function() { infowindow.open(map, mrkr); });

            if (autoOpen) {
                infowindow.open(map, mrkr);
            }
        }
        else if (onclick && onclick != '') {
            google.maps.event.addListener(mrkr, 'click', function() { eval(onclick); });
        }

        if (center) {
            map.setCenter(mrkr.getPosition());
        }
    };
}


eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('4 7(c,d,e){3.T(7,s.t.1J);3.l=c;3.k=[];3.K=[];3.1K=[2r,2s,2t,2u,2v];3.E=[];3.13=p;6 f=e||{};3.F=f[\'2w\']||2x;3.1d=f[\'1e\']||u;3.E=f[\'2y\']||[];3.1L=f[\'2z\']||3.1M;3.1N=f[\'2A\']||3.1O;3.1P=f[\'2B\']||B;3.1Q();3.C(c);3.1f=3.l.14();6 g=3;s.t.U.1g(3.l,\'2C\',4(){6 a=g.l.1R[g.l.1S()].1e;6 b=g.l.14();8(b<0||b>a){9}8(g.1f!=b){g.1f=g.l.14();g.V()}});s.t.U.1g(3.l,\'2D\',4(){g.L()});8(d&&d.G){3.1T(d,p)}}7.5.1M=\'2E://s-t-2F-2G-2H.2I.2J/2K/2L/2M/\'+\'2N/m\';7.5.1O=\'2O\';7.5.T=4(b,c){9(4(a){D(1h 2P a.5){3.5[1h]=a.5[1h]}9 3}).2Q(b,[c])};7.5.1U=4(){3.1V(B)};7.5.2R=4(){};7.5.1W=4(){};7.5.1Q=4(){D(6 i=0,W;W=3.1K[i];i++){3.E.v({1i:3.1L+(i+1)+\'.\'+3.1N,I:W,X:W})}};7.5.2S=4(a){3.E=a};7.5.1j=4(){9 3.E};7.5.1X=4(){9 3.1P};7.5.2T=4(){9 3.k};7.5.2U=4(){9 3.k};7.5.2V=4(a){3.1d=a};7.5.1Y=4(){9 3.1d||3.l.1R[3.l.1S()].1e};7.5.1k=4(a,b){6 c=0;6 d=a.G;6 e=d;2W(e!==0){e=1l(e/10,10);c++}c=1m.1Z(c,b);9{M:d,1n:c}};7.5.2X=4(a){3.1k=a};7.5.20=4(){9 3.1k};7.5.1T=4(a,b){D(6 i=0,o;o=a[i];i++){3.1o(o)}8(!b){3.L()}};7.5.1o=4(a){a.N(p);a.C(u);a.Y=p;8(a[\'2Y\']){6 b=3;s.t.U.1g(a,\'2Z\',4(){a.Y=p;b.V();b.L()})}3.k.v(a)};7.5.15=4(a,b){3.1o(a);8(!b){3.L()}};7.5.30=4(a){6 b=-1;8(3.k.16){b=3.k.16(a)}J{D(6 i=0,m;m=3.k[i];i++){8(m==a){b=i;31}}}8(b==-1){9 p}3.k.32(b,1);a.N(p);a.C(u);3.V();3.L();9 B};7.5.1V=4(a){8(!3.13){3.13=a;3.1p()}};7.5.33=4(){9 3.K.G};7.5.17=4(){9 3.l};7.5.C=4(a){3.l=a};7.5.1q=4(){9 3.F};7.5.34=4(a){3.F=a};7.5.1r=4(a){6 b=3.21();6 c=O s.t.22(a.1s().23(),a.1s().24());6 d=O s.t.22(a.1t().23(),a.1t().24());6 e=b.1u(c);e.x+=3.F;e.y-=3.F;6 f=b.1u(d);f.x-=3.F;f.y+=3.F;6 g=b.25(e);6 h=b.25(f);a.T(g);a.T(h);9 a};7.5.26=4(a,b){9 b.27(a.1v())};7.5.35=4(){3.V();3.k=[]};7.5.V=4(){D(6 i=0,1w;1w=3.K[i];i++){1w.18()}D(6 i=0,o;o=3.k[i];i++){o.Y=p;o.C(u);o.N(p)}3.K=[]};7.5.L=4(){3.1p()};7.5.1p=4(){8(!3.13){9}6 a=O s.t.28(3.l.19().1t(),3.l.19().1s());6 b=3.1r(a);D(6 i=0,o;o=3.k[i];i++){6 c=p;8(!o.Y&&3.26(o,b)){D(6 j=0,d;d=3.K[j];j++){8(!c&&d.1x()&&d.29(o)){c=B;d.15(o);36}}8(!c){6 d=O w(3);d.15(o);3.K.v(d)}}}};4 w(a){3.P=a;3.l=a.17();3.F=a.1q();3.z=u;3.k=[];3.1a=u;3.Q=O q(3,a.1j(),a.1q())}w.5.2a=4(a){8(3.k.16){9 3.k.16(a)!=-1}J{D(6 i=0,m;m=3.k[i];i++){8(m==a){9 B}}}9 p};w.5.15=4(a){8(3.2a(a)){9 p}8(!3.z){3.z=a.1v();3.1y()}8(3.k.G==0){a.C(3.l);a.N(B)}J 8(3.k.G==1){3.k[0].C(u);3.k[0].N(p)}a.Y=B;3.k.v(a);3.2b();9 B};w.5.1z=4(){9 3.P};w.5.19=4(){3.1y();9 3.1a};w.5.18=4(){3.Q.18();37 3.k};w.5.1x=4(){9 3.z};w.5.1y=4(){6 a=O s.t.28(3.z,3.z);3.1a=3.P.1r(a)};w.5.29=4(a){9 3.1a.27(a.1v())};w.5.17=4(){9 3.l};w.5.2b=4(){6 a=3.l.14();6 b=3.P.1Y();8(a>b){D(6 i=0,o;o=3.k[i];i++){o.C(3.l);o.N(B)}9}8(3.k.G<2){3.Q.1A();9}6 c=3.P.1j().G;6 d=3.P.20()(3.k,c);3.Q.2c(3.z);3.Q.2d(d);3.Q.2e()};4 q(a,b,c){a.1z().T(q,s.t.1J);3.E=b;3.38=c||0;3.Z=a;3.z=u;3.l=a.17();3.n=u;3.1b=u;3.12=p;3.C(3.l)}q.5.2f=4(){6 a=3.Z.1z();s.t.U.39(a,\'3a\',[3.Z]);8(a.1X()){3.l.3b(3.Z.1x());3.l.3c(3.Z.19())}};q.5.1U=4(){3.n=2g.3d(\'3e\');8(3.12){6 a=3.1c(3.z);3.n.R.2h=3.1B(a);3.n.2i=3.1b.M}6 b=3.3f();b.3g.3h(3.n);6 c=3;s.t.U.3i(3.n,\'3j\',4(){c.2f()})};q.5.1c=4(a){6 b=3.21().1u(a);b.x-=1l(3.S/2,10);b.y-=1l(3.H/2,10);9 b};q.5.1W=4(){8(3.12){6 a=3.1c(3.z);3.n.R.1C=a.y+\'r\';3.n.R.1D=a.x+\'r\'}};q.5.1A=4(){8(3.n){3.n.R.2j=\'3k\'}3.12=p};q.5.2e=4(){8(3.n){6 a=3.1c(3.z);3.n.R.2h=3.1B(a);3.n.R.2j=\'\'}3.12=B};q.5.18=4(){3.C(u)};q.5.3l=4(){8(3.n&&3.n.2k){3.1A();3.n.2k.3m(3.n);3.n=u}};q.5.2d=4(a){3.1b=a;3.3n=a.M;3.3o=a.1n;8(3.n){3.n.2i=a.M}3.2l()};q.5.2l=4(){6 a=1m.3p(0,3.1b.1n-1);a=1m.1Z(3.E.G-1,a);6 b=3.E[a];3.1E=b.1i;3.H=b.I;3.S=b.X;3.1F=b.3q;3.3r=b.3s;3.1G=b.3t};q.5.2c=4(a){3.z=a};q.5.1B=4(a){6 b=[];8(2g.3u){b.v(\'3v:3w:3x.3y.3z(\'+\'3A=3B,3C="\'+3.1E+\'");\')}J{b.v(\'3D:1i(\'+3.1E+\');\')}8(1H 3.A===\'3E\'){8(1H 3.A[0]===\'2m\'&&3.A[0]>0&&3.A[0]<3.H){b.v(\'I:\'+(3.H-3.A[0])+\'r; 2n-1C:\'+3.A[0]+\'r;\')}J{b.v(\'I:\'+3.H+\'r; 2o-I:\'+3.H+\'r;\')}8(1H 3.A[1]===\'2m\'&&3.A[1]>0&&3.A[1]<3.S){b.v(\'X:\'+(3.S-3.A[1])+\'r; 2n-1D:\'+3.A[1]+\'r;\')}J{b.v(\'X:\'+3.S+\'r; M-2p:2q;\')}}J{b.v(\'I:\'+3.H+\'r; 2o-I:\'+3.H+\'r; X:\'+3.S+\'r; M-2p:2q;\')}6 c=3.1F?3.1F:\'3F\';6 d=3.1G?3.1G:11;b.v(\'3G:3H; 1C:\'+a.y+\'r; 1D:\'+a.x+\'r; 3I:\'+c+\'; 3J:3K; 1I-W:\'+d+\'r; 1I-3L:3M,3N-3O; 1I-3P:3Q\');9 b.3R(\'\')};',62,240,'|||this|function|prototype|var|MarkerClusterer|if|return|||||||||||markers_|map_||div_|marker|false|ClusterIcon|px|google|maps|null|push|Cluster|||center_|anchor_|true|setMap|for|styles_|gridSize_|length|height_|height|else|clusters_|redraw|text|setVisible|new|markerClusterer_|clusterIcon_|style|width_|extend|event|resetViewport|size|width|isAdded|cluster_|||visible_|ready_|getZoom|addMarker|indexOf|getMap|remove|getBounds|bounds_|sums_|getPosFromLatLng_|maxZoom_|maxZoom|prevZoom_|addListener|property|url|getStyles|calculator_|parseInt|Math|index|pushMarkerTo_|createClusters_|getGridSize|getExtendedBounds|getNorthEast|getSouthWest|fromLatLngToDivPixel|getPosition|cluster|getCenter|calculateBounds_|getMarkerClusterer|hide|createCss|top|left|url_|textColor_|textSize_|typeof|font|OverlayView|sizes|imagePath_|MARKER_CLUSTER_IMAGE_PATH_|imageExtension_|MARKER_CLUSTER_IMAGE_EXTENSION_|zoomOnClick_|setupStyles_|mapTypes|getMapTypeId|addMarkers|onAdd|setReady_|draw|isZoomOnClick|getMaxZoom|min|getCalculator|getProjection|LatLng|lat|lng|fromDivPixelToLatLng|isMarkerInBounds_|contains|LatLngBounds|isMarkerInClusterBounds|isMarkerAlreadyAdded|updateIcon|setCenter|setSums|show|triggerClusterClick|document|cssText|innerHTML|display|parentNode|useStyle|number|padding|line|align|center|53|56|66|78|90|gridSize|60|styles|imagePath|imageExtension|zoomOnClick|zoom_changed|bounds_changed|http|utility|library|v3|googlecode|com|svn|trunk|markerclusterer|images|png|in|apply|idle|setStyles|getMarkers|getTotalMarkers|setMaxZoom|while|setCalculator|draggable|dragend|removeMarker|continue|splice|getTotalClusters|setGridSize|clearMarkers|break|delete|padding_|trigger|clusterclick|panTo|fitBounds|createElement|DIV|getPanes|overlayImage|appendChild|addDomListener|click|none|onRemove|removeChild|text_|index_|max|opt_textColor|anchor|opt_anchor|opt_textSize|all|filter|progid|DXImageTransform|Microsoft|AlphaImageLoader|sizingMethod|scale|src|background|object|black|cursor|pointer|color|position|absolute|family|Arial|sans|serif|weight|bold|join'.split('|'),0,{}))

