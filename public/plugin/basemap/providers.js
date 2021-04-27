(function(factory) {
    if (typeof module !== 'undefined' && module.exports) {
        module.exports = factory(require('leaflet'));
    } else {
        window.providers = factory(window.L);
    }
})(function(L) {
    var providers = {};
    
    $.ajax({
        url   : "setting/getBasemap",
        type  : "GET",
        contentType: false,
        processData: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function(res) {
        for(var a in res){
            var layer = "";
            if(res[a].status == "basemap"){
                if(res[a].type == 2){
                    var detail = JSON.parse(res[a].layer);
                    layer = createLayer('tileLayer',detail);
                    providers[res[a].title] = {
                        title : res[a].title,
                        icon : 'plugin/basemap/icons/'+res[a].icon,
                        layer : layer
                    }
                }else if(res[a].type == 1){
                    var detail = JSON.parse(res[a].layer);
                    layer = createLayer('arcgis',detail);
                    providers[res[a].title] = {
                        title : res[a].title,
                        icon : 'plugin/basemap/icons/'+res[a].icon,
                        layer : layer
                    }
                }
            }
        }
        var layers = [];
        for (var providerId in providers) {
            layers.push(providers[providerId]);
        }
        var ctrl = L.control.iconLayers(layers).addTo(map);
        ctrl.setActiveLayer(providers['OpenStreetMap Mapnik'].layer);
        setMiniMap(providers['OpenStreetMap Mapnik'].layer)
        ctrl.on('activelayerchange', function(e){
            var layer = e.layer;
            setMiniMap(layer);
        })
    });
    
    providers['OpenStreetMap Mapnik'] = {
        title: 'osm',
        icon: 'plugin/basemap/icons/openstreetmap_mapnik.png',
        layer: L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            type : 'tileLayer'
        })
    };

    providers['OpenStreetMap_BlackAndWhite'] = {
        title: 'osm bw',
        icon: 'plugin/basemap/icons/openstreetmap_blackandwhite.png',
        layer: L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            type : 'tileLayer'
        })
    };

    providers['OpenStreetMap_DE'] = {
        title: 'osm de',
        icon: 'plugin/basemap/icons/openstreetmap_de.png',
        layer: L.tileLayer('http://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            type : 'tileLayer'
        })
    }

    providers['Stamen_Toner'] = {
        title: 'toner',
        icon: 'plugin/basemap/icons/stamen_toner.png',
        layer: L.tileLayer('http://stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}.png', {
            attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 20,
            type : 'tileLayer'
        })
    };

    providers['Esri_OceanBasemap'] = {
        title: 'esri ocean',
        icon: 'plugin/basemap/icons/esri_oceanbasemap.png',
        layer: L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/Ocean_Basemap/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Sources: GEBCO, NOAA, CHS, OSU, UNH, CSUMB, National Geographic, DeLorme, NAVTEQ, and Esri',
            maxZoom: 13,
            type : 'tileLayer'
        })
    };

    // providers['HERE_normalDay'] = {
    //     title: 'normalday',
    //     icon: 'plugin/basemap/icons/here_normalday.png',
    //     layer: L.tileLayer('http://{s}.{base}.maps.cit.api.here.com/maptile/2.1/maptile/{mapID}/normal.day/{z}/{x}/{y}/256/png8?app_id={app_id}&app_code={app_code}', {
    //         attribution: 'Map &copy; 1987-2014 <a href="http://developer.here.com">HERE</a>',
    //         maxZoom: 20,
    //         type : 'tileLayer'
    //     })
    // };

    // providers['HERE_normalDayGrey'] = {
    //     title: 'normalday grey',
    //     icon: 'plugin/basemap/icons/here_normaldaygrey.png',
    //     layer: L.tileLayer('http://{s}.{base}.maps.cit.api.here.com/maptile/2.1/maptile/{mapID}/normal.day.grey/{z}/{x}/{y}/256/png8?app_id={app_id}&app_code={app_code}', {
    //         attribution: 'Map &copy; 1987-2014 <a href="http://developer.here.com">HERE</a>',
    //         maxZoom: 20,
    //         type : 'tileLayer'
    //     })
    // };

    providers['HERE_satelliteDay'] = {
        title: 'satellite',
        icon: 'plugin/basemap/icons/here_satelliteday.png',
        layer: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            id: 'mapbox.streets',
            type : 'tileLayer'
        })
        // layer: L.tileLayer('http://{s}.{base}.maps.cit.api.here.com/maptile/2.1/maptile/{mapID}/satellite.day/{z}/{x}/{y}/256/png8?app_id={app_id}&app_code={app_code}', {
        //     attribution: 'Map &copy; 1987-2014 <a href="http://developer.here.com">HERE</a>',
        //     maxZoom: 20
        // })
    };

    // providers['CartoDB_Positron'] = {
    //     title: 'positron',
    //     icon: 'plugin/basemap/icons/cartodb_positron.png',
    //     layer: L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
    //         attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>',
    //         maxZoom: 19
    //     })
    // };

    // providers['wms'] = {
    //     title: 'wms',
    //     icon: 'plugin/basemap/icons/cartodb_positron.png',
    //     layer: L.tileLayer.wms("http://mesonet.agron.iastate.edu/cgi-bin/wms/nexrad/n0r.cgi", {
    //         layers: 'nexrad-n0r-900913',
    //         format: 'image/png',
    //         transparent: true,
    //         attribution: "Weather data © 2012 IEM Nexrad"
    //     })
    // };

    return providers;
});