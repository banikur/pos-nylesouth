var DrawLayer = L.featureGroup().addTo(map);

// var ciLayer = L.canvasIconLayer({}).addTo(map);

var idMarker = 1;
var idPolyline = 1;
var idPolygon = 1;
var idCircle = 1;
var idEllipse = 1;
var idRectangle = 1;


function random_id(min,max){
  var random =Math.floor(Math.random() * (+max - +min)) + +min; 
  return random;
}

var drawControl = new L.Control.Draw({
  edit: {
    featureGroup: DrawLayer
  }
});

map.on(L.Draw.Event.CREATED, function (event) {
	var layer = event.layer;
	var feature = DrawLayer;
	var options = ObjectControl.getProperty(layer);
	var popup = ObjectControl.getPopupContent(layer);
	if(popup !== null){
		// layer.bindPopup(popup);
	}
	if(layer instanceof L.Marker){
		if(options.uniqueID){
			layer._leaflet_id = options.uniqueID;
			if(options.label){
				// layer.bindLabel(options.label);
			}
			idMarker++;
		}
	}else if(layer instanceof L.Rectangle){
		layer._leaflet_id = options.uniqueID;
		idRectangle++;
	}else if(layer instanceof L.Polygon){
		layer._leaflet_id = options.uniqueID;
		idPolygon++;
	}else if(layer instanceof L.Polyline){
		if(options.uniqueID){
			layer._leaflet_id = options.uniqueID;
			if(options.jalur != false){
				var target = ObjectControl.getObjectById(options.jalur,options.feature);
				// feature = options.feature;
				if(target){
					var targetLLA = target.getLatLng();
					var jalurLLA = layer.getLatLngs();
					jalurLLA[0] = targetLLA;
					layer.setLatLngs(jalurLLA);
				}
			}
			idPolyline++;
		}
	}else if(layer instanceof L.Circle){
		layer._leaflet_id = options.uniqueID;
		if(options.message == "SemiCircle"){
			var latlng = layer.getLatLng();
			layer = ControlSemiCircle.createSemiCircle(latlng,options);
		}
		idCircle++;
	}else if(layer instanceof L.Ellipse){
		layer._leaflet_id = layer.options.uniqueID;
		idEllipse++;
	}
	feature.addLayer(layer);
})
var ObjectControl = {
	AddFeatureGroup : function(){
		return L.featureGroup().addTo(map);
	},
	AddToMap : function(layer,Group){
		if(Group){
			Group.addLayer(layer);
		}else{
			DrawLayer.addLayer(layer);
		}
	},
	zoomTo : function(layer){
		if(layer instanceof L.Polygon){
			map.fitBounds(layer.getBounds());
		}
	},
	setId : function(layer,id,jalur){
		this.Remove(layer);
		if(layer instanceof L.Marker){
			layer._leaflet_id = id;
			// if(layer.options.uniqueID){
			// 	layer.options.uniqueID = id;
			// }else{
			// 	layer.options.icon.uniqueID = id;
			// }
		}else if(layer instanceof L.Polygon){
			layer._leaflet_id = id;
			// if(layer.options.uniqueID){
			// 	layer.options.uniqueID = id;
			// }
		}else if(layer instanceof L.Polyline){
			if(jalur){
				layer.options.jalur = id;
			}else{
				layer._leaflet_id = id;
				// if(layer.options.uniqueID){
				// 	layer.options.uniqueID = id;
				// }
			}
		}else if(layer instanceof L.Circle){
			layer._leaflet_id = id;
			// if(layer.options.uniqueID){
			// 	layer.options.uniqueID = id;
			// }
		}
		var popup = this.getPopupContent(layer);
		if(popup !== null){
			// layer.bindPopup(popup);
		}
		this.AddToMap(layer);
	},
	latLng : function(lat,long){
		return L.latLng(Number(lat),Number(long));
	},
	getFeatureGroup : function(){
		return DrawLayer;
	},
	getAllLayer : function(Group){
		var array = [];
		if(Group){
			Group.eachLayer(function (layer) {
				array.push(layer);
			})
		}else{
			DrawLayer.eachLayer(function (layer) {
				array.push(layer);
			})
		}
		return array;
	},
	getObjectById: function(id,Group){
		var layer = null;
		var Feature = DrawLayer;
		if(Group){
			Feature = Group;
		}
		Feature.eachLayer(function(obj){
			if(obj instanceof L.Marker){
				if(obj._leaflet_id == id){
					layer = obj;
				}else if(obj.options.uniqueID == id){
					layer = obj;
				}
			}else if(obj instanceof L.Polygon){
				if(obj.options.uniqueID == id){
					layer = obj;
				}
			}else if(obj instanceof L.Polyline){
				if(obj.options.uniqueID == id){
					layer = obj;
				}
			}else if(obj instanceof L.Circle){
				if(obj.options.uniqueID == id){
					layer = obj;
				}
			}else{
				if(obj.options.uniqueID == id){
					layer = obj;
				}
			}
		});

		return layer;
	},
	getJalur : function(id,Group){
		var Feature = DrawLayer;
		if(Group){
			Feature = Group;
		}
		var layer = null;

		Feature.eachLayer(function(obj){
			if(obj instanceof L.Polyline){
				if(obj.options.jalur == id){
					layer = obj;
				}
			}
		})
		return layer;
	},
	getID : function(layer){
		var id = "";
		if(layer instanceof L.Marker){
			if(layer.options.uniqueID){
				id = layer.options.uniqueID;
			}else{
				id = layer.options.icon.uniqueID;
			}
		}else{
			id = layer.options.uniqueID;
		}
		return id;
	},
	getProperty : function(layer){
		var prop = false;
		if(layer instanceof L.Marker){
			if(layer.options.uniqueID){
				prop = layer.options
			}else{
				prop = layer.options.icon;
			}
		}else if(layer instanceof L.Polygon){
			prop = layer.options
		}else if(layer instanceof L.Polyline){
			prop = layer.options
		}else if(layer instanceof L.Circle){
			prop = layer.options
		}
		return prop;
	},
	getPopupContent: function(layer){
		var data = "";
			data = this.getID(layer)
		return data;
	},
	LoadToMap : function(type,point,properti,Group){
		var layer = null;
		if(type == "Polygon"){
			layer = ObjectControl.Polygon.Create(point,properti);
		}else if(type == "Point"){
			if(properti.radius){
				layer = L.circle(point,properti.radius,properti);
			}else{
				layer = ObjectControl.Marker.Create(point,properti);
			}
		}
		if(layer!=null){
			layer._leaflet_id = properti.uniqueID;
			if(Group){
				Group.addLayer(layer);
			}else{
				DrawLayer.addLayer(layer);
			}
		}
	},
	LoadGeoJSON : function(json,Group){
		var layer = L.geoJSON(json,{
			pointToLayer: function(feature, latlng){
				var icon = "";
				var uniqueID = "";
				var prop = "";
				var object = "";
				
				if(feature.properties.icon.typeMarker == "markerBoat"){
					var options = feature.properties;
					object = L.boatMarker(latlng,{
						color: options.icon.options.color,
						typeMarker : options.icon.typeMarker
					});
					object.setHeading(options.icon.options.course);
					object.options.icon.uniqueID = options.icon.uniqueID;
					object.options.icon.options.typeMarker = options.icon.typeMarker;
					object.options.icon.typeMarker = options.icon.typeMarker;
					object._leaflet_id = options.icon.uniqueID;
				}else if(feature.properties.icon.typeMarker == "ParallaxMarker"){
					var icon = L.divIcon({
						className: feature.properties.icon.options.className,
						html: feature.properties.icon.options.html,
						iconSize : feature.properties.icon.options.iconSize
					});
					object = L.Marker.parallax(latlng,{
							icon: icon,
							parallaxZoffset : feature.properties.parallaxZoffset
					});
					object.options.icon.uniqueID = feature.properties.icon.uniqueID;
					object.options.icon.typeMarker = feature.properties.icon.typeMarker;
					object.options.uniqueID = feature.properties.icon.uniqueID;
					object._leaflet_id = feature.properties.icon.typeMarker;

				}else if(feature.properties.icon){
					if(feature.properties.icon.options.iconUrl){
						var option = feature.properties.icon.options;
						icon = ObjectControl.Icon.src(option.iconUrl,option.iconSize);
						if(feature.uniqueID){
							uniqueID = feature.uniqueID;
						}else{
							uniqueID = feature.properties.icon.uniqueID;
						}
					}else if(feature.properties.icon.options.typeMarker){
						
						if(feature.properties.icon.options.typeMarker == "beautifyMarker"){
							var options = feature.properties.icon.options;
							icon = L.BeautifyIcon.icon(options);
						}else if(feature.properties.icon.options.typeMarker == "AwesomeMarker"){
							var options = feature.properties.icon.options;
							icon = L.AwesomeMarkers.icon(options);
						}else if(feature.properties.icon.options.typeMarker == "ExtraMarker"){
							var options = feature.properties.icon.options;
							icon = L.ExtraMarkers.icon(options);
						}else if(feature.properties.icon.options.typeMarker == "MapKeyMarker"){
							var options = feature.properties.icon.options;
							icon = L.icon.mapkey({
								icon: options.icon,
								color: options.color,
								background : options.background,
								size : Number(options.size),
								borderRadius : Number(options.borderRadius),
								additionalCSS : options.additionalCSS,
								typeMarker : options.typeMarker
							});
						}else if(feature.properties.icon.options.typeMarker == "markerPulse"){
							var options = feature.properties.icon.options;
							icon = L.icon.pulse({
								iconSize: options.iconSize,
								color: options.color,
								typeMarker : options.typeMarker
							});
						}else if(feature.properties.icon.options.typeMarker == "markerBoat"){
							var options = feature.properties.icon;
						}else if(feature.properties.icon.options.typeMarker == "VectorMarker"){
							
							var options = feature.properties.icon.options;
							icon = L.VectorMarkers.icon({
				                icon: options.icon,
				                markerColor: options.markerColor,
				                iconColor : options.iconColor,
				                typeMarker : options.typeMarker
				            })
						}else if(feature.properties.icon.options.typeMarker == "TextMarker"){
							var options = feature.properties.icon.options;
							icon = L.divIcon(options);
						}
						// console.log(icon);
						if(feature.uniqueID){
							uniqueID = feature.uniqueID;
						}else{
							uniqueID = feature.properties.icon.uniqueID;
						}
					}else{
						icon = new L.Icon.Default();
					}
					var highlight = false;
					var bounceOnAdd = false;
					if(feature.properties.icon.highlight){
						highlight = feature.properties.icon.highlight;
					}
					if(feature.properties.icon.bounceOnAdd){
						bounceOnAdd = feature.properties.icon.bounceOnAdd;
					}
					prop = {
						icon : icon,
						highlight : highlight,
						bounceOnAdd : bounceOnAdd,
						uniqueID : uniqueID
					}
					object = ObjectControl.Marker.Create(latlng,prop);
				}else{
					var id = feature.properties.uniqueID.split("_");
					if(id[0] == "ellipse"){
						prop = feature.properties;
						object = ObjectControl.Ellipse.Create(latlng,[prop.mRadiusX,prop.mRadiusY],prop);
					}else if(id[0] == "circle"){
						prop = feature.properties
						object = ObjectControl.Circle.Create(latlng,prop.radius,prop);
					}
				}

				return object;
			},
			style: function(feature) {
				return feature.properties;
			},
			onEachFeature: function(feature, layer){
				if(feature.uniqueID){
					var pisah = feature.uniqueID.split("_");
					if(pisah[0] == "marker"){
						idMarker = Number(pisah[1]);
						idMarker++;
					}else if(pisah[0] == "polyline"){
						idPolyline = Number(pisah[1]);
						idPolyline++;
					}else if(pisah[0] == "polygon"){
						idPolygon = Number(pisah[1]);
						idPolygon++;
					}else if(pisah[0] == "circle"){
						idCircle = Number(pisah[1]);
						idCircle++;
					}else if(pisah[0] == "rectangle"){
						idRectangle = Number(pisah[1]);
						idRectangle++;
					}else if(pisah[0] == "ellipse"){
						idEllipse = Number(pisah[1]);
						idEllipse++;
					}
					layer._leaflet_id = feature.uniqueID;
				}
				var popup = ObjectControl.getPopupContent(layer);
				if(popup !== null){
					// layer.bindPopup(popup);
				}
			}
		});
		layer.eachLayer(function(d){
			if(Group){
				Group.addLayer(d);
			}else{
				DrawLayer.addLayer(d);
			}
		})
		return layer;
	},
	LoadSHPFile : function(file){
		if (!window.FileReader || !window.File) {
            return Promise.reject('Does not support File API');
        }
        if (!(file instanceof File)) {
            return Promise.reject('Not a file');
		}
		
		return new Promise(function(resolve, reject){
			let fr = new FileReader();

			fr.onerror = function(err){
				reject(err);
			};

			fr.onload = function(){
				result = fr.result;
				var shpfile = new L.Shapefile(result);
				resolve(shpfile);
			};

			fr.readAsArrayBuffer(file);
		})
	},
	removeAll : function(Group){
		if(Group){
			Group.eachLayer(function (layer) {
			    Group.removeLayer(layer);
			});
		}else{
			DrawLayer.eachLayer(function (layer) {
			    DrawLayer.removeLayer(layer);
			});
		}
		idMarker = 1;
		idPolyline = 1;
		idPolygon = 1;
		idCircle = 1;
		idRectangle = 1;
	},
	Remove : function(layer,Group){
		if(Group){
			Group.removeLayer(layer);
		}else{
			DrawLayer.removeLayer(layer);
		}
	},
	geojsonToSHP : function(geojson, folder){
		var options = {
			folder: folder,
			types: {
				point: 'point_'+folder,
				polygon: 'polygon_'+folder,
				line: 'polyline_'+folder
			}
		}
		var collection = {
			type: 'FeatureCollection',
			features : geojson
		};
		console.log(collection);
		shpwrite.download(collection, options);
	},
	toGeoJSON : function(layer){
		var j = "";
		// if(layer instanceof L.Ellipse){
		// 	var lnglat = layer.getLatLng();
		// 	j = {
		// 		"type" : "Feature",
		// 		"geometry" : {
		// 			"coordinates" : [lnglat.lng,lnglat.lat],
		// 			"type" : "Point"
		// 		},
		// 		"properties" : layer.options
		// 	}
		// 	j.properties.mRadiusX = layer._mRadiusX;
		// 	j.properties.mRadiusY = layer._mRadiusY;
		// }else{
			j = layer.toGeoJSON();
		// }
        var feature = "";
        j.properties = layer.options;
        j.uniqueID = layer._leaflet_id;
        feature += JSON.stringify(j)
        return JSON.parse(feature);
	},
	ConvertToCSV : function(objArray,delimiter){
		var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
		var str = '';

		for (var i = 0; i < array.length; i++) {
			var line = '';
			for (var index in array[i]) {
				if (line != '') line += delimiter

				line += array[i][index];
			}

			str += line + '\r\n';
		}

		return str;
	},
	exportCSVFile : function(headers, items, fileTitle,delimiter) {
		if (headers) {
			items.unshift(headers);
		}
	
		// Convert Object to JSON
		var jsonObject = JSON.stringify(items);
	
		var csv = ObjectControl.ConvertToCSV(jsonObject,delimiter);
		// console.log(csv);
		var exportedFilenmae = fileTitle + '.csv' || 'export.csv';
	
		var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
		if (navigator.msSaveBlob) { // IE 10+
			navigator.msSaveBlob(blob, exportedFilenmae);
		} else {
			var link = document.createElement("a");
			if (link.download !== undefined) { // feature detection
				// Browsers that support HTML5 download attribute
				var url = URL.createObjectURL(blob);
				link.setAttribute("href", url);
				link.setAttribute("download", exportedFilenmae);
				link.style.visibility = 'hidden';
				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			}
		}
	},
	exportExcelFile: function(headers, items, fileTitle){
		if (headers) {
			items.unshift(headers);
		}
		var ws_name = "Object";

        if (typeof console !== 'undefined') console.log(new Date());
        var wb = XLSX.utils.book_new(),
            ws = XLSX.utils.aoa_to_sheet(items);

        /* Add worksheet to workbook */
        XLSX.utils.book_append_sheet(wb, ws, ws_name);

        /* Write workbook and Download */
        if (typeof console !== 'undefined') console.log(new Date());
        XLSX.writeFile(wb, fileTitle+".xlsx");
        if (typeof console !== 'undefined') console.log(new Date());
	},
	csvFileToJSON: function(file,delimiter) {
        if (!window.FileReader || !window.File) {
            return Promise.reject('Does not support File API');
        }
        if (!(file instanceof File)) {
            return Promise.reject('Not a file');
        }

        return new Promise(function(resolve, reject) {
            var reader = new FileReader();

            reader.onerror = function(err) {
            reject(err);
            };

            // Closure to capture the file information.
            reader.onload = function() {
            var text = reader.result;
            resolve(ObjectControl.csvJSON(text,delimiter));
            };

            // Read in the image file as a data URL.
            reader.readAsText(file);
        });
    },
	csvJSON : function(csv,delimiter){

        var lines=csv.split('\n');

        var result = [];

        var headers=lines[0].split(delimiter);
		lines.splice(0, 1);
        lines.forEach(function(line) {
        var obj = {};
        var currentline = line.split(delimiter);
        headers.forEach(function(header, i) {
            obj[header] = currentline[i];
        });
        result.push(obj);
        });

        return result; //JavaScript object
    //return JSON.stringify(result); //JSON
    },
	excelToJSON : function(file){
		if (!window.FileReader || !window.File) {
            return Promise.reject('Does not support File API');
        }
        if (!(file instanceof File)) {
            return Promise.reject('Not a file');
		}

		return new Promise(function(resolve, reject) {
            var reader = new FileReader();

            reader.onerror = function(err) {
            reject(err);
            };

            // Closure to capture the file information.
            reader.onload = function() {
				let data = event.target.result;
				let workbook = XLSX.read(data,{type:"binary"});
				let rowObject = [];
				workbook.SheetNames.forEach(sheet => {
					rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
				});
            	resolve(rowObject);
            };

            // Read in the image file as a data URL.
            reader.readAsBinaryString(file);
        });
	},
	isObjectEmpty : function(obj){
		for(var prop in obj) {
			if(obj.hasOwnProperty(prop))
				return false;
		}
	
		return JSON.stringify(obj) === JSON.stringify({});
	}
}

ObjectControl.Circle = 
{
	Draw : function(properti){
		var properti = properti||{};

		var circle = new L.Draw.Circle(map, {
			shapeOptions: {
				stroke: true,
				color: properti.color||'#3388ff',
				weight: properti.weight||4,
				opacity: properti.opacity||0.5,
				fill: properti.fill||true,
				fillColor: properti.fillColor||null, //same as color by default
				fillOpacity: properti.fillOpacity||0,
				clickable: true,
				uniqueID : properti.uniqueID || "circle_"+idCircle,
				message : properti.message || false,
				direction : properti.direction||false,
				angle : properti.angle||false
			},
			showRadius: properti.showRadius||true,
			metric: properti.metric||true, // Whether to use the metric measurement system or imperial
			feet: properti.feet||true, // When not metric, use feet instead of yards for display
			nautic: properti.nautic||false // When not metric, not feet use nautic mile for display
		});
		circle.enable();
	},
	Create : function(point,radius,properties){
		return L.circle(point,radius,properties);
	},
	Update : function(layer,properties){
		layer.setStyle(properties);
	}
}
ObjectControl.Ellipse = 
{
	Draw : function(properti){
		var properti = properti||{};

		var ellipse = new L.Draw.Ellipse(map, {
			shapeOptions: {
				stroke: true,
				color: properti.color||'#3388ff',
				weight: properti.weight||4,
				opacity: properti.opacity||0.5,
				fill: properti.fill||true,
				fillColor: properti.fillColor||null, //same as color by default
				fillOpacity: properti.fillOpacity||0,
				clickable: true,
				uniqueID : properti.uniqueID || "ellipse_"+idEllipse,
				message : properti.message || false
			},
			showRadius: properti.showRadius||true,
			metric: properti.metric||true, // Whether to use the metric measurement system or imperial
			feet: properti.feet||true, // When not metric, use feet instead of yards for display
			nautic: properti.nautic||false // When not metric, not feet use nautic mile for display
		});
		ellipse.enable();
	},
	Create : function(point,radii,properties){
		return L.ellipse(point,radii,0,properties);
	},
	Update : function(layer,properties){
		layer.setStyle(properties);
	}
}

ObjectControl.Rectangle = 
{
	Draw : function(properti){
		var d = new Date();
		var n = d.getTime();
		var properti = properti||{};

		var rectangle = new L.Draw.Rectangle(map, {
			shapeOptions: {
				stroke: true,
				color: properti.color||'#3388ff',
				weight: properti.weight||4,
				opacity: properti.opacity||0.5,
				fill: properti.fill||true,
				fillColor: properti.fillColor||null, //same as color by default
				fillOpacity: properti.fillOpacity||0,
				showArea: properti.showArea||true,
				clickable: properti.clickable||true,
				uniqueID : properti.uniqueID || "rectangle_"+idRectangle,
				message : properti.message || false
			},
			metric: true // Whether to use the metric measurement system or imperial
		});

		rectangle.enable();
	}
}

ObjectControl.Marker = 
{
	Draw : function(properti){
		var d = new Date();
		var n = d.getTime();
		if(properti){
			if(properti.icon){
				properti.icon.uniqueID = "marker_"+idMarker;
				properti.icon.label = properti.label;
			}
		}else{
			properti = {
				uniqueID : "marker_"+idMarker
			}
		}
		var marker = new L.Draw.Marker(map, properti);
		marker.enable();
	},
	Create : function(point,properti){
		if(properti.uniqueID){

		}else{
			properti.uniqueID = "marker_"+idMarker;
		}
		idMarker++;
		if(properti.heading){
			var marker = L.angleMarker(point,properti);
				marker._leaflet_id = properti.uniqueID
        		marker.setHeading(properti.heading);
		}else{
			var marker = new L.Marker(point,properti);
				marker._leaflet_id = properti.uniqueID
		}

		return marker;
	},
	SetIcon : function(marker,icon){
		marker.setIcon(icon);
	},
	CreateJalur : function(properti){
		ObjectControl.Polyline.Draw(properti);
	}
}

ObjectControl.Polygon = {
	Draw : function(properti){
		var polygon = new L.Draw.Polygon(map,{
			shapeOptions: {
				stroke: properti.stroke||true,
				color: properti.color||'#3388ff',
				weight: properti.weight||4,
				opacity: properti.opacity||1,
				fill: properti.fill||true,
				fillColor: properti.fillColor||null, //same as color by default
				fillOpacity: properti.fillOpacity||0.2,
				clickable: properti.clickable||true,
				uniqueID : properti.uniqueID || "polygon_"+idPolygon,
				message : properti.message || false
			}
		});
		polygon.enable();
	},
	Create : function(point,properties){
		var polygon = new L.polygon(point,properties);
		var id = "polygon_"+idPolygon;
		ObjectControl.setId(polygon, id);
		idPolygon++;
		return polygon;
	},
	Update : function(layer,properties){
		layer.setStyle(properties);
	}
}

ObjectControl.Polyline = {
	Draw : function(properti){
		var properti = properti||{};
		
		var polyline = new L.Draw.Polyline(map,{
			// symbol: L.Symbol.dash({pixelSize: 10, pathOptions: {color: '#f00', weight: 2}}),
			shapeOptions: {
				dashArray: properti.dashArray||'0,0',
				color: properti.color||'#3388ff',
				weight: properti.weight||4,
				opacity: properti.opacity||0.5,
				fill: properti.fill||false,
				clickable: properti.clickable||true,
				jalur : properti.jalur||false,
				feature : properti.feature||false,
				uniqueID : properti.uniqueID || "polyline_"+idPolyline,
				status : properti.status || false,
				offset : properti.offset || 0,
				distanceMarkers : properti.distanceMarkers || false,
				// text : properti.text || ""
			},
		})
		polyline.enable();
	},
	Create : function(point,properties){
		var polyline = new L.polyline(point,properties);
		return polyline;
	},
	Update : function(layer,properties){
		layer.setStyle(properties);
		layer.setOffset(Number(properties.offset));
	}
}

ObjectControl.MarkerCluster = {
	Create : function(layer){
		var cluster = new L.MarkerClusterGroup();
		cluster.addLayer(layer);
		return cluster;
	},
	ToMap : function(m){
		return new L.MarkerClusterGroup();
	}
}

ObjectControl.Icon = {
	src : function(url,size,heading){
		if(size){
			var icon = L.icon({
				iconUrl : url,
				iconSize : size
			})
		}else{
			var icon = L.icon({
				iconUrl : url
			})
		}
		return icon;
	},
	divIcon : function(html){

		var icon = L.divIcon({
			className:'my-div-icon',
			html : html,
			iconSize: null
		})

		return icon;
	}
}