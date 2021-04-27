var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

var osm2 = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 13});
var miniMap = new L.Control.MiniMap(osm2, { toggleDisplay: true, minimized: true }).addTo(map);

function setMiniMap(layer){
    var type = layer.options.type;
    var detail = {
        url : layer._url,
        maxZoom : layer.options.maxZoom,
        attribution : (layer.options.attribution) ? layer.options.attribution : ""
    }
    var l = createLayer(type, detail);
    miniMap.changeLayer(l);
}
